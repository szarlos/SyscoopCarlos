<?php

class alquileres extends MY_Controller {
     
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        if($this->caja_abierta()){};
        $data['table'] = ' ';     
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('alquileres/alquileres', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }   
    
    public function buscar(){
       if($this->caja_abierta()){};
	$query = $this->input->post('cliente');
        
	$alquileres = $this->Alquileres_model->buscar_cliente($query);
			
	// generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading(' ','Razón Social','CUIL/CUIT','Lugar de Alquiler','Fecha Desde','Fecha Hasta','Acciones');
	$i = 0;
	foreach ($alquileres as $alquiler)
	{
		$this->table->add_row(++$i, $alquiler->Cli_ApeNom,
                              $alquiler->Cli_CUIL,
                              $alquiler->Rec_Nombre,
                              date('d-m-Y',strtotime($alquiler->Alq_FechaDesde)),
                              date('d-m-Y',strtotime($alquiler->Alq_FechaHasta)),
                              anchor('alquileres/cobrar/'.$alquiler->Alq_Id,'Cobrar',array('class'=>'money'))
			);
	}
	$data['table'] = $this->table->generate();
        
		
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('alquileres/alquileres', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    public function cobrar($alq_id){
        
                if($this->caja_abierta()){};
                $data ['subtitulo']='INGRESO - Alquileres';
                $data['id']=$alq_id;
                $this->form_validation->set_rules('comp_nro','Recibo Nº','required|trim|exact_length[13]|xss_clean');
                $this->form_validation->set_rules('formaPago','Forma de Pago','required|trim|xss_clean');
                $this->form_validation->set_rules('descripcion','Descripción','required|trim|max_length[50]|xss_clean');
                $this->form_validation->set_rules('monto','Importe','required|trim|xss_clean');
                
                
                
                if ($this->form_validation->run() == FALSE){
                    
                    $data['id']=$alq_id;
                    $alquileres= $this->Alquileres_model->buscar($alq_id);

                    // generate table data

                    $this->table->set_empty("&nbsp;");
                    $i = 0;
                    foreach ($alquileres as $alquiler)
                    {   $data['alquiler']=$alquiler;
                        $this->table->add_row(
                                            "<b>Nombre: </b>$alquiler->Cli_ApeNom",
                                            "<b>CUIL/CUIT: </b>$alquiler->Cli_CUIL"

                                    );
                    }
                    $data['table'] = $this->table->generate();
                    $datoPrincipal ['contenidoPrincipal'] = $this->load->view('alquileres/cobro_alquiler', $data, TRUE);
                }else{
                    $comp_nro = $this->input->post('comp_nro');
                    $formaPago = $this->input->post('formaPago');
                    $desc = $this->input->post('descripcion');
                    $monto = $this->input->post('monto');

                    $alquileres= $this->Alquileres_model->buscar($alq_id);

                    // Genero la tabla que muestra los datos de cliente
                    foreach ($alquileres as $alquiler)
                    {   $data['cli_id']=$alquiler->Cli_Id;
                        $data['apeNom']=$alquiler->Cli_ApeNom;
                        $data['dir']=$alquiler->Cli_Direccion;
                        $data['iva']=$alquiler->Cli_cond_iva;
                        $data['cuil']=$alquiler->Cli_CUIL;    
                    }
                    
                    // Genero la tabla que muestra el detalle del movimiento
                    $data['comp_nro']=$comp_nro;
                    $data['formaPago']=$formaPago;
                    $data['desc']=$desc;
                    $data['monto']=$monto;
                    //$data['link_back'] = anchor('alquileres/cobrar/'.$id,'Volver',array('class'=>'back'));
                    $datoPrincipal ['contenidoPrincipal'] = $this->load->view('alquileres/confirmacion', $data, TRUE);
                    }
                    $this->load->view('templates',$datoPrincipal);
                
    }
    
public function registrar($alq_id){
                if($this->caja_abierta()){};
                $data ['subtitulo']='INGRESO - Alquileres';
                $data['id']=$alq_id;
    
                $tipo_desc='Alquiler';
                $tipos= $this->MovimientosCaja_model->tipo_movimiento($tipo_desc);
                foreach ($tipos as $tipo){
                    $tm=$tipo->TipMov_Id;
                }
                $gru_desc='Aula Magna';
                $centros=  $this->MovimientosCaja_model->centro_costo_grupo($gru_desc);
                foreach ($centros as $centro){
                    $sec=$centro->Sec_Id;
                    $dir=$centro->Dir_Id;
                    $gru=$centro->Gru_Id;
                    $cur=$centro->Cur_Id;
                    $Dic=$centro->Dic_Id;
                }
                $cli_id = $this->input->post('cli_id');
                $razonsocial = $this->input->post('apeNom');
                $comp_nro = $this->input->post('comp_nro');
                $formaPago = $this->input->post('formaPago');
                $desc = $this->input->post('desc');
                $monto = $this->input->post('monto');
                
                //cambiar caj_id cuando tengamos sesiones
                
                
                $caj_id=$this->session->userdata('caja_id');
                $fecha=$this->MovimientosCaja_model->insert($caj_id,$tm,$monto,$desc,$formaPago,'TRUE',$sec,$dir,$gru,$cur,$Dic);
                
                $movimientos=$this->MovimientosCaja_model->get_id($caj_id,$fecha);
                foreach ($movimientos as $movimiento){
                    $mov_id=$movimiento->Mov_Id;
                }
                
                
                $tipo_comp='RECIBO';
                $this->MovimientosCaja_model->insert_comprobante($tipo_comp,$comp_nro,$caj_id,$mov_id);
                $this->RendicionesCaja_model->update_ingreso($caj_id,$monto);
                
                $this->MovimientosCaja_model->insertIngreso_movCli($caj_id,$mov_id,$cli_id,$razonsocial);
                
		$alquiler = $this->Alquileres_model->update($alq_id,$caj_id,$mov_id);
                //Armo la vista
                if ($alquiler==FALSE){
                    $data['message']='Error, no guardado.';
                }else{
                    $data['message'] = '<div class="success">Exito!</div>';
                
                }
                $datoPrincipal ['contenidoPrincipal'] = $this->load->view('alquileres/imprimir', $data, TRUE);
                
                $this->load->view('templates',$datoPrincipal);      
    }
    
    function imprimir($alq_id){
        //Datos de cliente
        $alquileres= $this->Alquileres_model->buscar($alq_id);
        foreach ($alquileres as $alquiler)
        {   
            $cli_nom=$alquiler->Cli_ApeNom;
            $cli_dir=$alquiler->Cli_Direccion;
            $cli_iva=$alquiler->Cli_cond_iva;
            $cli_cuil=$alquiler->Cli_CUIL;   
            $caj_id= $alquiler->MovimientoCaja_Caj_Id;
            $mov_id= $alquiler->MovimientoCaja_Mov_Id;
        }
        
        $movs= $this->MovimientosCaja_model->get_mov($caj_id,$mov_id);
        foreach ($movs as $mov){
            $fecha= date('d-m-Y',strtotime($mov->Mov_FechaHora));
            $formaPago= $mov->Mov_FormaDePago;
            $monto= $mov->Mov_Mono;
            $desc= $mov->Mov_Descripcion;
        }
        if($fPago=1){
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


LA SUMA DE PESOS $monto.--
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