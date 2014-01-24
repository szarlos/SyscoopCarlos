<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function is_logged_in()
    {
    if ($this->session->userdata('logged_in')){
      return TRUE;  
   }else{
         redirect('index/login');   
        }
     }
     
    public function caja_abierta(){
        if ($this->is_logged_in()){
        if ($this->caja_model->caja_abierta()){
            //caja abierta, el modelo controla en la db con los datos de sesion
            //si hay caja abierta y no estan los datos en la sesion, por ej cuando vuelven a abrir sesion, se vuelven a cargar acá
            //$datos_sesion=$this->session->userdata('puesto');
            if (!$this->session->userdata('puesto')) {
                $datos_caja=$this->caja_model->recuperar_datos_caja($this->session->userdata('user_id'));
                $nombre_puesto=$this->caja_model->nombre_puesto($datos_caja['Pue_Id']);
                $this->session->set_userdata('puesto',$nombre_puesto['Pue_Ubicacion']);
                $this->session->set_userdata('caja_id',$datos_caja['Caj_Id']);
            }
         return TRUE;
        }else{
            //caja cerrada o datos inconsistentes (?)
        $datoPrincipal ['contenidoPrincipal'] = 'Para realizar movimientos de caja primero debe abrir una caja';
        
  
        $this->load->view('templates_caja_cerrada',$datoPrincipal);
        
        }
    } 
    }
}
?>
