<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Radios extends MY_Controller {
    
    public function index(){
        if($this->caja_abierta()){}
        $data['table'] = ' ';
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('radios/radios', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    public function buscar(){
       if($this->caja_abierta()){}
        $cli_nom = $this->input->post('cliente');
        $ventas = $this->Radios_model->buscar_venta($cli_nom);
			
	// generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        //Concepto es vent_radio_tipo
        $this->table->set_heading(' ','Razón Social','CUIL/CUIT','Concepto','Fecha Desde','Fecha Hasta','Acciones');
	$i = 0;
	foreach ($ventas as $venta)
	{
            if ($venta->Vent_Rad_Tipo == 1){
                $tipo='Espacio en radio';
            }else{
                $tipo='Publicidad en radio';
            }
		$this->table->add_row(++$i, $venta->Cli_ApeNom,
                              $venta->Cli_CUIL,
                              $tipo,
                              date('d-m-Y',strtotime($venta->Ven_Rad_Desde)),
                              date('d-m-Y',strtotime($venta->Ven_Rad_Hasta)),
                              anchor('radios/cobrar/'.$venta->Ven_Rad_Id,'Cobrar',array('class'=>'money'))
                        );
	}
	$data['table'] = $this->table->generate();
        //$this->form_data->dob = date('d-m-Y',strtotime($person->dob));
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('radios/radios', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    public function cobrar($radio_id){
        if($this->caja_abierta()){}
        $this->form_validation->set_rules('comp_nro','Recibo Nº','required|trim|exact_length[13]|xss_clean');
        $this->form_validation->set_rules('formaPago','Forma de Pago','required|trim|xss_clean');
        $this->form_validation->set_rules('descripcion','Descripción','required|trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('monto','Importe','required|trim|xss_clean');
        if ($this->form_validation->run() == FALSE){
            $data['id']=$radio_id;
            $ventas= $this->Radios_model->buscar($radio_id);

            // generate table data
            $this->load->library('table');
            $this->table->set_empty("&nbsp;");

            foreach ($ventas as $venta)
            {   
                $data['venta']=$venta;
                $this->table->add_row(
                                    "<b>Nombre: </b>$venta->Cli_ApeNom",
                                    "<b>CUIL: </b>$venta->Cli_CUIL"
                            );
            }
            $data['table'] = $this->table->generate();

            $datoPrincipal ['contenidoPrincipal'] = $this->load->view('radios/cobro_radio', $data, TRUE);
        }else{
        $data['id']=$radio_id;  
        
        $comp_nro = $this->input->post('comp_nro');
        $formaPago = $this->input->post('formaPago');
        $desc = $this->input->post('descripcion');
        $monto = $this->input->post('monto');
        $tipo_desc='Radio';
                $tipos= $this->MovimientosCaja_model->tipo_movimiento($tipo_desc);
                foreach ($tipos as $tipo){
                    $tm=$tipo->TipMov_Id;
                }
        $gru_desc='Radio';
        $centros=  $this->MovimientosCaja_model->centro_costo_grupo($gru_desc);
        foreach ($centros as $centro){
                    $sec=$centro->Sec_Id;
                    $dir=$centro->Dir_Id;
                    $gru=$centro->Gru_Id;
                    $cur=$centro->Cur_Id;
                    $Dic=$centro->Dic_Id;
        }
        
        $caj_id=$this->session->userdata('caja_id');
        
        $fecha=$this->MovimientosCaja_model->insert($caj_id,$tm,$monto,$desc,$formaPago,'TRUE',$sec,$dir,$gru,$cur,$Dic);
                
        $movimientos=$this->MovimientosCaja_model->get_id($caj_id,$fecha);
        foreach ($movimientos as $movimiento){
            $mov_id=$movimiento->Mov_Id;
        }
        $clientes=$this->Radios_model->buscar_cliente($radio_id);
        foreach ($clientes as $cliente){
            $cli_id=$cliente->Cli_Id;
            $razonsocial=$cliente->Cli_ApeNom;
            
        }
        $this->MovimientosCaja_model->insertIngreso_movCli($caj_id,$mov_id,$cli_id,$razonsocial);
        $tipo_comp='RECIBO';
        $this->MovimientosCaja_model->insert_comprobante($tipo_comp,$comp_nro,$caj_id,$mov_id);
        $this->RendicionesCaja_model->update_ingreso($caj_id,$monto);
                
	$radio = $this->Radios_model->update_venta($radio_id,$monto);
        $radio = $this->Radios_model->insert_pago($radio_id,$caj_id,$mov_id);
        $data['mov_id']=$mov_id;
        if ($radio==TRUE){
            $data['message']='<div class="success">Exito!</div>';
        }else{
            $data['message']='Error, no guardado.';
        }
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('radios/imprimir', $data, TRUE);
        }
        $this->load->view('templates',$datoPrincipal);        
    }
    
    public function imprimir($mov_id){
         //Datos de cliente
        $radios= $this->Radios_model->buscar_pago($mov_id);
        foreach ($radios as $radio)
        {   
            $cli_nom=$radio->Cli_ApeNom;
            $cli_dir=$radio->Cli_Direccion;
            $cli_iva=$radio->Cli_cond_iva;
            $cli_cuil=$radio->Cli_CUIL;   
            $caj_id= $radio->MovimientoCaja_Caj_Id;
            $mov_id= $radio->MovimientoCaja_Mov_Id;
            $fecha= date('d-m-Y',strtotime($radio->Mov_FechaHora));
            $formaPago= $radio->Mov_FormaDePago;
            $monto= $radio->Mov_Mono;
            $desc= $radio->Mov_Descripcion;
        }
        if($fPago==1){
            $formaPago='Contado';
        }else{
            $formaPago='Cheque';
        }
        

        //$impresion->recibo($fecha,$cli_nom,$cli_dir,$cli_cuil,$cli_iva,$formaPago,$monto,$desc);
        
        $this->load->library('cezpdf');
		$this->load->helper('pdf');
		
                $this->cezpdf->ezText('RECIBO [C]', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
                
$content = 
"N* 0001-00076831
FECHA: $fecha";

		$this->cezpdf->ezText($content, 10, array('justification' => 'right'));
                $this->cezpdf->ezSetDy(-10);
		

$content = 
"RECIBI de: $cli_nom
DOMICILIO: $cli_dir
CUIT: $cli_cuil                                                                I.V.A.: $cli_iva";

		$this->cezpdf->ezText($content, 10, array('justification' => 'left'));
                $this->cezpdf->ezSetDy(-10);

$content = 
"
FORMA DE PAGO: $formaPago


LA SUMA DE PESOS $monto.------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------------------

EN CONCEPTO DE $desc.--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------------------";
                $this->cezpdf->ezText($content, 10, array('justification' => 'full'));
                $this->cezpdf->ezSetDy(-10);

$content = '
CHEQUE c/BCO.:----------------------------------------------------------------------------------------- N*------------------------------------------------- $-------------------------,------

CHEQUE c/BCO.:----------------------------------------------------------------------------------------- N*------------------------------------------------- $-------------------------,------

CHEQUE c/BCO.:----------------------------------------------------------------------------------------- N*------------------------------------------------- $-------------------------,------
';                
                $this->cezpdf->ezText($content, 8, array('justification' => 'full'));
                $this->cezpdf->ezSetDy(-10);

$content = "TOTAL $         $monto";
                $this->cezpdf->ezText($content, 15, array('justification' => 'right'));
                $this->cezpdf->ezSetDy(-60);
                
$this->cezpdf->ezText('RECIBO [C]', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
                
$content = 
"N* 0001-00076831
FECHA: $fecha";

		$this->cezpdf->ezText($content, 10, array('justification' => 'right'));
                $this->cezpdf->ezSetDy(-10);
		

$content = 
"RECIBI de: $cli_nom
DOMICILIO: $cli_dir
CUIT: $cli_cuil                                                                I.V.A.: $cli_iva";

		$this->cezpdf->ezText($content, 10, array('justification' => 'left'));
                $this->cezpdf->ezSetDy(-10);

$content = 
"
FORMA DE PAGO: $formaPago


LA SUMA DE PESOS $monto.------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------------------

EN CONCEPTO DE $desc.--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------------------";
                $this->cezpdf->ezText($content, 10, array('justification' => 'full'));
                $this->cezpdf->ezSetDy(-10);

$content = '
CHEQUE c/BCO.:----------------------------------------------------------------------------------------- N*------------------------------------------------- $-------------------------,------

CHEQUE c/BCO.:----------------------------------------------------------------------------------------- N*------------------------------------------------- $-------------------------,------

CHEQUE c/BCO.:----------------------------------------------------------------------------------------- N*------------------------------------------------- $-------------------------,------
';                
                $this->cezpdf->ezText($content, 8, array('justification' => 'full'));
                $this->cezpdf->ezSetDy(-10);

$content = "TOTAL $         $monto";
                $this->cezpdf->ezText($content, 15, array('justification' => 'right'));
                $this->cezpdf->ezSetDy(-60);
                
        $this->cezpdf->ezStream();
    }

    

 
}

?>
