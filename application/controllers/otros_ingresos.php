<?php

class otros_Ingresos extends MY_Controller {
     
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $data['table'] = ' ';
        
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('otros_ingresos/otros_ingresos', $data, TRUE);
  
        $this->load->view('templates',$datoPrincipal);
    } 
    
    public function buscar(){
       
	$query = $this->input->post('cliente');
        $this->load->model('Clientes_model');
	$clientes = $this->Clientes_model->search_cliente($query);
			
	// generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading(' ','Apellido y Nombre','DNI','CUIL/CUIT','Acciones');
	$i = 0;
	foreach ($clientes as $cliente)
	{
		$this->table->add_row(++$i, $cliente->Cli_ApeNom,
                              $cliente->Cli_DNI,
                              $cliente->Cli_CUIL,
                              anchor('otros_ingresos/cobrar/'.$cliente->Cli_Id,'Cobrar',array('class'=>'money'))
			);
	}
	$data['table'] = $this->table->generate();
        //$this->form_data->dob = date('d-m-Y',strtotime($person->dob));
        $data['new_cliente']= anchor('clientes/nuevo/','Nuevo Cliente',array('class'=>'add'));
		
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('otros_ingresos/otros_ingresos', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    public function cobrar($cli_id){
    
        if($this->caja_abierta()){}
        $this->form_validation->set_rules('comp_nro','Recibo Nº','required|trim|exact_length[13]|xss_clean');
        $this->form_validation->set_rules('formaPago','Forma de Pago','required|trim|xss_clean');
        $this->form_validation->set_rules('descripcion','Descripción','required|trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('monto','Importe','required|trim|xss_clean');
        if ($this->form_validation->run() == FALSE){
            $data['id']=$cli_id;
            $clientes= $this->Clientes_model->get_by_id($cli_id);

            // generate table data
            $this->load->library('table');
            $this->table->set_empty("&nbsp;");

            foreach ($clientes as $cliente)
            {   
                //$data['venta']=$venta;
                $this->table->add_row(
                                    "<b>Nombre: </b>$cliente->Cli_ApeNom",
                                    "<b>CUIL: </b>$cliente->Cli_CUIL"
                            );
            }
            $data['table'] = $this->table->generate();
            $this->load->model('MovimientosCaja_model');
            $rows= $this->MovimientosCaja_model->centro_costo_todas_sec();
            foreach ($rows as $row) {
                            $centros[$row->Sec_Descripcion] = $row->Sec_Descripcion;
                    }
            $data['centros']=$centros;

            $datoPrincipal ['contenidoPrincipal'] = $this->load->view('otros_ingresos/cobro', $data, TRUE);
        }else{
        $data['id']=$cli_id;    
        $comp_nro = $this->input->post('comp_nro');
        $formaPago = $this->input->post('formaPago');
        $cc = $this->input->post('centros');
        $desc = $this->input->post('descripcion');
        $monto = $this->input->post('monto');
        $tipo_desc='Servicios a Terceros';
                $tipos= $this->MovimientosCaja_model->tipo_movimiento($tipo_desc);
                foreach ($tipos as $tipo){
                    $tm=$tipo->TipMov_Id;
                }
        
        $centros=  $this->MovimientosCaja_model->centro_costo_sec($cc);
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
        $tipo_comp='RECIBO';
        $this->MovimientosCaja_model->insert_comprobante($tipo_comp,$comp_nro,$caj_id,$mov_id);
        $this->RendicionesCaja_model->update_ingreso($caj_id,$monto);
        
        $ids = $this->otrosIngresos_model->max_id();
        foreach ($ids as $id){
            $i_id=$id->id;
        }
	
        $ingreso = $this->otrosIngresos_model->insert($i_id,$caj_id,$mov_id,$cli_id);
        $data['mov_id']=$mov_id;
        if ($ingreso==TRUE){
            $data['message']='<div class="success">Exito!</div>';
        }else{
            $data['message']='Error, no guardado.';
        }
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('otros_ingresos/imprimir', $data, TRUE);
        }
        $this->load->view('templates',$datoPrincipal);        
       
    }
    public function imprimir($mov_id){
         //Datos de cliente
        $servicios= $this->otrosIngresos_model->buscar_mov($mov_id);
        foreach ($servicios as $servicio)
        {   
            $cli_nom=$servicio->Cli_ApeNom;
            $cli_dir=$servicio->Cli_Direccion;
            $cli_iva=$servicio->Cli_cond_iva;
            $cli_cuil=$servicio->Cli_CUIL;   
            $caj_id= $servicio->MovimientoCaja_Caj_Id;
            $mov_id= $servicio->MovimientoCaja_Mov_Id;
            $fecha= date('d-m-Y',strtotime($servicio->Mov_FechaHora));
            $formaPago= $servicio->Mov_FormaDePago;
            $monto= $servicio->Mov_Mono;
            $desc= $servicio->Mov_Descripcion;
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
