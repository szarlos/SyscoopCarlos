<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anticipos extends MY_Controller {
    
    public function index(){
        
        $data['table'] = ' ';
        
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('anticipos/anticipos', $data, TRUE);
  
        $this->load->view('templates',$datoPrincipal);
    } 
    
    public function buscar(){
       
	$query = $this->input->post('autorizado');
        $this->load->model('Autorizados_model');
	$autorizados = $this->Autorizados_model->buscar_autorizado($query);
	if(! $autorizados){
            $data['table']='<p>No encontrado.</p>';
            
        }else{		
	// generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Apellido y Nombre','DNI','Acciones');
	$i = 0;
	foreach ($autorizados as $autorizado)
	{
		$this->table->add_row($autorizado->Aut_ApeNom,
                              $autorizado->Aut_DNI,
                              anchor('anticipos/pagar/'.$autorizado->Aut_Id,'Pagar',array('class'=>'money'))
			);
	}
	$data['table'] = $this->table->generate();
        }
        //$this->form_data->dob = date('d-m-Y',strtotime($person->dob));
        $data['nuevo_proveedor']= anchor('proveedor/nuevo/','Nuevo Proveedor',array('class'=>'add'));
		
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('anticipos/anticipos', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    function pagar($aut_id){
        
        $data['id']=$aut_id;
        $this->load->model('Autorizados_model');
        
        $autorizados= $this->Autorizados_model->get_by_id($aut_id);
        
        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        
	foreach ($autorizados as $autorizado)
	{
            $this->table->add_row(
                                "<b>Nombre: </b>$autorizado->Aut_ApeNom",
                                "<b>DNI: </b>$autorizado->Aut_DNI"
                                );
	}
        
        $data['table'] = $this->table->generate();
        $this->load->model('MovimientosCaja_model');
        $rows= $this->MovimientosCaja_model->centro_costo_todas_sec();
        foreach ($rows as $row) {
			$centros[$row->Sec_Descripcion] = $row->Sec_Descripcion;
		}
        $data['centros']=$centros;
	$datoPrincipal ['contenidoPrincipal'] = $this->load->view('anticipos/pago', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);      
    }
    
    public function registrar($aut_id){
                		
                $comp_tipo = 'VALE';
                
                $cc = $this->input->post('centros');
                $formaPago = 'Contado';
                $desc = $this->input->post('descripcion');
                $monto = $this->input->post('monto');
                
                $this->load->model('Anticipos_model');
                $this->load->model('MovimientosCaja_model');
                
                //dar a elegrir TIPO DE MOVIMIENTO DE CAJA
                $tipo_desc='Gastos Varios';
                $tipos= $this->MovimientosCaja_model->tipo_movimiento($tipo_desc);
                foreach ($tipos as $tipo){
                    $tm=$tipo->TipMov_Id;
                }
                
                //Completar con Centros de Costos Completos.
                $centros=  $this->MovimientosCaja_model->centro_costo_grupo($cc);
                foreach ($centros as $centro){
                    $sec=$centro->Sec_Id;
                    $dir=$centro->Dir_Id;
                    $gru=$centro->Gru_Id;
                }
                //cambiar caj_id cuando tengamos sesiones
                $caj_id=$this->session->userdata('caja_id');
                //Egreso >> FALSE
                $fecha=$this->MovimientosCaja_model->insert($caj_id,$tm,$monto,$desc,$formaPago,'FALSE',$sec,$dir,$gru,0,0);
                
                $movimientos=$this->MovimientosCaja_model->get_id($caj_id,$fecha);
                
                foreach ($movimientos as $movimiento){
                    $mov_id=$movimiento->Mov_Id;
                }
                
                $this->MovimientosCaja_model->insert_vale($caj_id,$mov_id);
                $vales= $this->MovimientosCaja_model->get_id_comprobante($caj_id,$mov_id);
                foreach ($vales as $vale){
                    $comp_nro=$vale->Comp_Nro;
                }
                $this->MovimientosCaja_model->insert_comprobante($comp_tipo,$comp_nro,$caj_id,$mov_id);
                $this->RendicionesCaja_model->update_egreso($caj_id,$monto);
                $egreso = $this->Anticipos_model->insert($aut_id,$caj_id,$mov_id);
                if ($egreso ==0){
                    $data['message']='Error, no guardado.';
                }else{
                    $data['message']='<div class="success">Exito!</div>';
                    $data['id']=$mov_id;
                }
		                
		
                $datoPrincipal ['contenidoPrincipal'] = $this->load->view('anticipos/imprimir', $data, TRUE);
                $this->load->view('templates',$datoPrincipal);        
    }
    
    
}

?>
