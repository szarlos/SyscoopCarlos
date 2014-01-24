<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Otras_rendiciones extends MY_Controller {
    
    public function index(){
        $data ['titulo']= 'SysCoop';
        $data ['subtitulo']='Rendiciones de otras Cajas';
        $this->load->model('Cajas_model');
        $data['cajeros'] = $this->Cajas_model->listar_cajeros();
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('otras_rendiciones/cobro', $data, TRUE);
  
        $this->load->view('templates',$datoPrincipal);
    } 
    
    public function registrar(){
                $data ['titulo']= 'SysCoop';
                $data['subtitulo']='Rendiciones de otras Cajas';
		
                // set validation properties
		$this->load->model('MovimientosCaja_model');
                
                $tipo_desc='Estampillas';
                $tipos= $this->MovimientosCaja_model->tipo_movimiento($tipo_desc);
                foreach ($tipos as $tipo){
                    $tm=$tipo->TipMov_Id;
                }
                $gru_desc='Estampillas';
                $centros=  $this->MovimientosCaja_model->centro_costo_sec($sec_desc);
                foreach ($centros as $centro){
                    $sec=$centro->Sec_Id;
                }
                //cambiar caj_id cuando tengamos sesiones
                $caj_id=1;
                $formaPago=1;
                $estampillas = $this->Estampillas_model->listar_por_valores();
                $mensajes=NULL;
                
                foreach ($estampillas as $estampilla){
                    
                    $fecha=$this->MovimientosCaja_model->insert($caj_id,$tm,$monto,$desc,$formaPago,$sec);
                    
                    $movimientos=$this->MovimientosCaja_model->get_id($caj_id,$fecha);
                    foreach ($movimientos as $movimiento){
                        $mov_id=$movimiento->Mov_Id;
                    }
                            
                    $id= $estampilla->Est_Id;
                    $stock=$estampilla->Est_Stock;
                    $this->form_validation->set_rules($id, 'Cantidad', "less_than[$stock]");         
                    if ($this->form_validation->run() == TRUE)	{
                        
                        $cant = $this->input->post($id);
                        $venta=0;
                        $venta = $this->Estampillas_model->insert($id,$cant);
                        if ($venta=0){
                            $mensajes[$id]='Error, no guardado.</br>';
                        }else{
                            $mensajes[$id]='Exito.</br>';
                        }
                    }else {
                        $data['estampillas']=$estampillas;
                        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('estampillas/cobro_estampillas', $data, TRUE);
                    }
                    if ($mensajes <> NULL){
                        $data['message'] = '<div class="success">Exito!</div>';
                        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('estampillas/success', $data, TRUE);
                    }
                    
    }
    $this->load->view('templates',$datoPrincipal);        
    }
    
}

?>
