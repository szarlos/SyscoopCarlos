<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estampillas extends MY_Controller {
    
    public function index(){
        if($this->caja_abierta()){}
        $data ['titulo']= 'SysCoop';
        $data ['subtitulo']='Estampillas';
        //$this->_set_rules();
	$data['estampillas'] = $this->Estampillas_model->listar_por_valores();
			
	$datoPrincipal ['contenidoPrincipal'] = $this->load->view('estampillas/cobro_estampillas', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    public function registrar(){
        if($this->caja_abierta()){}        
        $data ['titulo']= 'SysCoop';
                $data['subtitulo']='Estampillas';
		
                // set validation properties
		
                $this->form_validation->set_rules('cant', 'Cantidad', "less_than['$stock']");
                $estampillas = $this->Estampillas_model->listar_por_valores();
                $mensajes=NULL;
                foreach ($estampillas as $estampilla){
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
                        $data['mensajes']=$mensajes;
                        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('estampillas/success', $data, TRUE);
                    }
                    
    }
    $this->load->view('templates',$datoPrincipal);        
    }
    function _set_rules($stock){
        if($this->caja_abierta()){}
        $this->form_validation->set_rules('cant', 'Cantidad', "less_than['$stock']");
    }
    
}

?>
