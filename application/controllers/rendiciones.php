<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rendiciones extends MY_Controller {
    
    public function index(){
       
        $this->load->model('RendicionesCaja_model');
        $user = $this->session->userdata('user_id');
	$rendiciones = $this->RendicionesCaja_model->list_all($user);
	if(! $rendiciones){
            $data['table']='<p>No se efecturaron Rendiciones.</p>';
            
        }else{		
	// generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading(' ','Fecha','Apertura','Ingresos','Egresos','TOTAL','Acciones');
	$i = 0;
	foreach ($rendiciones as $rendicion)
	{       $total= $rendicion->apertura + $rendicion->ingreso - $rendicion->egreso;
		$this->table->add_row(++$i,$rendicion->Caj_FechaHoraApertura,
                              "$ $rendicion->apertura",
                              "$ $rendicion->ingreso",
                              "$ $rendicion->egreso",
                              "$ $total",
                              anchor('rendiciones/ver/'.$rendicion->RendCaj_Id,'Ver',array('class'=>'view'))
			);
	}
	$data['table'] = $this->table->generate();
        }
        		
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('rendicionesDiarias/ver', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    function ver($caja_id){
        $rendiciones = $this->RendicionesCaja_model->ver($caja_id);
        $data['caja_id']=$caja_id;
	if(! $rendiciones){
            $data['table']='<p>No se efecturaron Movimientos.</p>';
            
        }else{		
	// generate table data
            $data['caja_id']=$caja_id;
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading(' ','Tipo y NºComprobante','Razón Social','Descripcion','Ingresos','Egresos','Acciones');
	$i = 0;
	foreach ($rendiciones as $rendicion)
	{       
		//Tipo Comprobante 1 = RECIBO
                //Tipo Comprobante 2 = FACTURA
                //Tipo Comprobante 3 = VALE
                //Tipo Comprobante 4 = OTRO
                switch ($rendicion->Tipo_Comprobante){
                    case 1:$tipo_comp='RBO.';
                    break;
                    case 2:$tipo_comp='FACT';
                    break;
                    case 3:$tipo_comp='VALE';
                    break;
                    default:$tipo_comp='OTRO';
                }
                if($rendicion->Mov_IngresoEgreso==1){
                    $ingreso=$rendicion->Mov_Mono;
                    $egreso=0.0;
                }else{
                    $ingreso=0.0;
                    $egreso=$rendicion->Mov_Mono;
                }
                $this->table->add_row(++$i,"$tipo_comp Nº $rendicion->Comp_Nro_Externo",
                              $rendicion->RazonSocial,$rendicion->Mov_Descripcion,
                              "$ $ingreso","$ $egreso",
                              
                              //$rendicion->Mov_FormaDePago,
                              
                              anchor('rendiciones/anular_mov/'.$rendicion->MovimientoCaja_Mov_Id,'Anular Movimiento',array('class'=>'delete'))
			);
	}
	$data['table'] = $this->table->generate();
        }
        		
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('rendicionesDiarias/movimientos', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    function anular_mov($mov_id){
        
    }
    
    function imprimir($caja_id){
        $this->load->library('cezpdf');
		$this->load->helper('pdf');
		
                $this->cezpdf->ezText('RENDICION DE CAJA', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
        $cajas=$this->MovimientosCaja_model->get_caja($caja_id);
        foreach($cajas as $caja){
            $apenom=$caja->Usr_ApeNom;
            $fecha=date('d-m-Y',strtotime($caja->Caj_FechaHoraApertura));
            $puestos=$this->MovimientosCaja_model->nombre_puesto($caja->Pue_Id);
            foreach($puestos as $puesto){
                $pue= $puesto->Pue_Ubicacion;
                
            }
            
        }
        $content = 
"Cajero: $apenom
Puesto: $pue
Fecha: $fecha";

		$this->cezpdf->ezText($content, 10, array('justification' => 'left'));
                $this->cezpdf->ezSetDy(-10);
        
        
        
        $rendiciones = $this->RendicionesCaja_model->ver($caja_id);
        $i=0;
        foreach ($rendiciones as $rendicion)
	{       
		//Tipo Comprobante 1 = RECIBO
                //Tipo Comprobante 2 = FACTURA
                //Tipo Comprobante 3 = VALE
                //Tipo Comprobante 4 = OTRO
                switch ($rendicion->Tipo_Comprobante){
                    case 1:$tipo_comp='RBO.';
                    break;
                    case 2:$tipo_comp='FACT';
                    break;
                    case 3:$tipo_comp='VALE';
                    break;
                    default:$tipo_comp='OTRO';
                }
                if($rendicion->Mov_IngresoEgreso==1){
                    $ingreso=$rendicion->Mov_Mono;
                    $egreso=0.0;
                }else{
                    $ingreso=0.0;
                    $egreso=$rendicion->Mov_Mono;
                }
                $db_data[] = array('i' => ++$i, 
                                   'tipoynro' => "$tipo_comp Nro $rendicion->Comp_Nro_Externo", 
                                   'razonsocial' => $rendicion->RazonSocial,
                                   'descripcion' => $rendicion->Mov_Descripcion,
                                   'ingreso' => "$ $ingreso",
                                   'egreso' => "$ $egreso");
                
	}
        $this->load->library('cezpdf');
	$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.

		
				
		$col_names = array(
                        'i' => '',
			'tipoynro' => 'Tipo y Nro Comprobante',
			'razonsocial' => 'Razon Social',
			'descripcion' => 'Descripcion',
                        'ingreso' => 'Ingresos',
                        'egreso' => 'Egresos',
		);
		
		$this->cezpdf->ezTable($db_data, $col_names, ' ', array('width'=>550));
		$this->cezpdf->ezStream();
                
    }
    

    
    
}

?>
