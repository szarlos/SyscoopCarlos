<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Otros_Egresos extends MY_Controller {
    
    public function index(){
        $data ['titulo']= 'SysCoop';
        $data ['subtitulo']='Otros Egresos';
        $data['table'] = ' ';
        $data['nuevo_proveedor']= ' ';
        $this->load->model('MovimientosCaja_model');
        
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('otros_egresos/otros_egresos', $data, TRUE);
  
        $this->load->view('templates',$datoPrincipal);
        
    } 
    
    public function buscar(){
       
        $data ['titulo']= 'SysCoop';
        $data['subtitulo']='Otros Egresos';
	$query = $this->input->post('proveedor');
        $this->load->model('Proveedores_model');
	$proveedores = $this->Proveedores_model->buscar_proveedor($query);
	if(! $proveedores){
            $data['table']='<p>No encontrado.</p>';
            
        }else{		
	// generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading(' ','Proveedor','CUIL/CUIT','Dirección','Acciones');
	$i = 0;
	foreach ($proveedores as $proveedor)
	{
		$this->table->add_row(++$i, $proveedor->Prov_RazonSocial,
                              $proveedor->Prov_CUIT,
                              $proveedor->Prov_Direccion,
                		anchor('proveedores/ver/'.$proveedor->Prov_Id,'Ver',array('class'=>'view')).' '.
				anchor('proveedores/editar/'.$proveedor->Prov_Id,'Editar',array('class'=>'update')).' '.
				anchor('otros_egresos/pagar/'.$proveedor->Prov_Id,'Pagar',array('class'=>'money'))
			);
	}
	$data['table'] = $this->table->generate();
        }
        //$this->form_data->dob = date('d-m-Y',strtotime($person->dob));
        $data['nuevo_proveedor']= anchor('proveedor/nuevo/','Nuevo Proveedor',array('class'=>'add'));
		
        $datoPrincipal ['contenidoPrincipal'] = $this->load->view('otros_egresos/otros_egresos', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
    }
    
    function pagar($prov_id){
        $data ['titulo']= 'SysCoop';
        $data ['subtitulo']='Otros Egresos';
        $data['id']=$prov_id;
        $this->load->model('Proveedores_model');
        
        $proveedores= $this->Proveedores_model->get_by_id($prov_id);
        
        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Razón Social','CUIL/CUIT','Domicilio');
		
        $i = 0;
	foreach ($proveedores as $proveedor)
	{
            $this->table->add_row(
                                $proveedor->Prov_RazonSocial,
                                $proveedor->Prov_CUIT,
                                $proveedor->Prov_Direccion
                                
			);
	}
        
        $data['table'] = $this->table->generate();
        $this->load->model('MovimientosCaja_model');
        $rows= $this->MovimientosCaja_model->centro_costo_todas_sec();
        foreach ($rows as $row) {
			$centros[$row->Sec_Descripcion] = $row->Sec_Descripcion;
		}
        $data['centros']=$centros;
	$datoPrincipal ['contenidoPrincipal'] = $this->load->view('otros_egresos/pago', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);      
    }
    
    public function registrar($prov_id){
                $data ['titulo']= 'SysCoop';
                $data['subtitulo']='Otros Egresos';
		
                $comp_tipo = $this->input->post('comp_tipo');
                $comp_nro = $this->input->post('comp_nro');
                $cc = $this->input->post('centros');
                $formaPago = $this->input->post('formaPago');
                $desc = $this->input->post('descripcion');
                $monto = $this->input->post('monto');
                
                $this->load->model('OtrosEgresos_model');
                $this->load->model('MovimientosCaja_model');
                $this->load->model('RendicionesCaja_model');
                
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
                    $cur=$centro->Cur_Id;
                    $dic=$centro->Dic_Id;
                }
               
                $caj_id=$this->session->userdata('caja_id');
                //Egreso >> FALSE
                $fecha=$this->MovimientosCaja_model->insert($caj_id,$tm,$monto,$desc,$formaPago,'FALSE',$sec,$dir,$gru,$cur,$dic);
                
                $movimientos=$this->MovimientosCaja_model->get_id($caj_id,$fecha);
                
                foreach ($movimientos as $movimiento){
                    $mov_id=$movimiento->Mov_Id;
                }
                $this->MovimientosCaja_model->insert_comprobante($comp_tipo,$comp_nro,$caj_id,$mov_id);
                
                $this->RendicionesCaja_model->update_egreso($caj_id,$monto);
                
                
                $ids = $this->OtrosEgresos_model->max_id();
                foreach ($ids as $id){
                    $egreso_id=$id->id;
                }
                $egreso = $this->OtrosEgresos_model->insert($egreso_id,$caj_id,$mov_id,$prov_id);
                
                if ($egreso ==1){
                    $data['message']='<div class="success">Exito!</div>';
                }else{
                    $data['message']='Error, no guardado.';
                }
		                
		
                $datoPrincipal ['contenidoPrincipal'] = $this->load->view('success', $data, TRUE);
                $this->load->view('templates',$datoPrincipal);        
    }
    
    
}

?>
