<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
  
    public function index(){
      
        if($this->caja_abierta()){
        //$data ['titulo']= 'SysCoop';
       // $data ['subtitulo']='Bienvenido';
        
        $datoPrincipal ['contenidoPrincipal'] = NULL;
        $this->load->view('templates',$datoPrincipal);
       // $datoPrincipal ['contenidoPrincipal'] = $this->load->view('bienvenido', $data, TRUE);
                           }
        }  
    
    function login(){
        
        $this->form_validation->set_rules('usuario','Usuario','required|trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('contrasena','contrasena','required|trim|max_length[50]|xss_clean');
        
        if ($this->form_validation->run() == FALSE){
           //siguiendo el patron de carga:
            //$datoPrincipal ['contenidoPrincipal'] = $this->load->view('login/login', TRUE);
             //$this->load->view('templates',$datoPrincipal);
            
            //cargando directamente la vista:
            $this->load->view('login/login');
        }
        else{
           // $username=$this->input->post('usuario');
           extract($_POST);
         
            $user_id=$this->user_model->check_login($usuario,$contrasena);
            if(! $user_id){
                //login failed error
                $this->session->set_flashdata('login_error',TRUE);
                redirect('index/login');
            }
            else{
                //login in
                $nombre=$this->user_model->get_name($user_id);
                $login_data= array('logged_in'=>TRUE, 'user_id'=>$user_id, 'name'=>$nombre['Usr_ApeNom']);
                $this->session->set_userdata($login_data);
               // juntando las 2 de arriba seria:
                //$this->session->set_userdata(array('logged_in'=>TRUE, 'user_id'=>$id));
                redirect('index');
            }
        }
    }
    
    function login_hash($hash){
        $usuario=$this->user_model->buscar_hash($hash);
        if (sizeof($usuario) != 0){
           $login=$this->user_model->check_login($usuario['Usr_Login'],$usuario['Usr_Clave']);
           if(! $login){
                //login failed error
                $this->session->set_flashdata('login_error',TRUE);
                redirect('index/login');
            }
            else{
                //login in
                $nombre=$this->user_model->get_name($login);
                $login_data= array('logged_in'=>TRUE, 'user_id'=>$login, 'name'=>$nombre['Usr_ApeNom']);
                $this->session->set_userdata($login_data);
                redirect('index');
            }
        }
    }
    
    function logout(){
      //  $this->session->set_data('logged_in',FALSE);
        $this->session->sess_destroy();
        redirect('index/login');
    }
        
    function abrir_caja(){
       //chequear caja/sesion
        if ($this->is_logged_in()){
        $this->form_validation->set_rules('monto','Monto','required|trim|max_length[8]|xss_clean');
        
         if ($this->form_validation->run() == FALSE){
        $data ['subtitulo']='Abrir Caja';
        $data ['result'] = $this->caja_model->puestos_disponibles();
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('caja/abrir_caja', $data, TRUE);
        $this->load->view('templates_caja_cerrada',$datoPrincipal);     
                }else{
                  extract($_POST);
                  $nombre_puesto=$this->caja_model->nombre_puesto($puesto_elegido);
                  $this->session->set_userdata('puesto',$nombre_puesto['Pue_Ubicacion']);
                  $this->caja_model->abrir($puesto_elegido,$monto);
                  $datos_caja=$this->caja_model->recuperar_datos_caja($this->session->userdata('user_id'));
                  $this->session->set_userdata('caja_id',$datos_caja['Caj_Id']);
                  $this->caja_model->insert_RendCaja($this->session->userdata('caja_id'),$monto);
                  redirect('index');
                    }
             }
         } 
    function cerrar_caja(){
        
        if ($this->caja_abierta()){
        
       // $this->form_validation->set_rules('monto','Monto','required|trim|max_length[8]|xss_clean');
        $ingresos=$this->caja_model->sumar_ingresos(($this->session->userdata('caja_id')));
        $egresos=$this->caja_model->sumar_egresos(($this->session->userdata('caja_id')));
        $monto=$this->caja_model->obtener_monto_ap(($this->session->userdata('caja_id')));
         //if ($this->form_validation->run() == FALSE){
             
        $data['ingresos']= 0+$ingresos['TotalIng'];
        $data['egresos']= 0+$egresos['TotalEg'];
        $data['monto_apertura']= $monto['Caj_MontoApertura'];
        $data['total']=$data['ingresos']+$data['monto_apertura']-$data['egresos'];
        $data ['subtitulo']='Cerrar Caja';
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('caja/cerrar_caja', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);     
        // }else{
           //  extract($_POST);
             
            // $this->caja_model->cerrar($data['total']);
           //  redirect('index');
       //             }
               }
       }
       function realizar_cierre(){
           if ($this->caja_abierta()){}
        $ingresos=$this->caja_model->sumar_ingresos(($this->session->userdata('caja_id')));
        $egresos=$this->caja_model->sumar_egresos(($this->session->userdata('caja_id')));
        $monto=$this->caja_model->obtener_monto_ap(($this->session->userdata('caja_id')));
        $total=$ingresos['TotalIng']+$monto['Caj_MontoApertura']-$egresos['TotalEg'];
        $this->caja_model->cerrar($total);
        $this->session->set_userdata('caja_id','');
        $this->session->set_userdata('puesto','');
        $data ['subtitulo']='Cerrar Caja';
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('caja/cerrar_caja_exito', $data, TRUE);
        $this->load->view('templates_caja_cerrada',$datoPrincipal);     
       }
}
?>
