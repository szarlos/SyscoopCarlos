<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Liquidaciones extends MY_Controller {
    
   	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Liquidaciones_model','',TRUE);
                //$this->load->model('Cursos_model','',TRUE);

                $this->form_validation->set_message('required', 'Campo Obligatorio');
	
                //$this->load->view('plantilla');
        }
  
    
    
    
    public function index(){
        if($this->caja_abierta()){};
        $data ['titulo']= 'SysCoop';
        $data ['subtitulo']='Cuotas';
                  $uri_segment = 3;
                    $offset = $this->uri->segment($uri_segment);

                    // load data
                    $persons = $this->Liquidaciones_model->get_paged_list($this->limit, $offset)->result();

                    // generate pagination
                    $this->load->library('pagination');
                    $config['base_url'] = site_url('person/view2/');
                    $config['total_rows'] = $this->Liquidaciones_model->count_all();
                    $config['per_page'] = $this->limit;
                    $config['uri_segment'] = $uri_segment;
                    $this->pagination->initialize($config);
                    $data['pagination'] = $this->pagination->create_links();

                    // generate table data
                    $this->load->library('table');
                    $this->table->set_empty("&nbsp;");
                    		
		// load view
		 $datoPrincipal ['contenidoPrincipal'] = $this->load->view('liquidaciones/principalliquidaciones', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
                    

    }

     function search() { 
	  if($this->caja_abierta()){};	
         $data ['titulo']= 'SysCoop';
         $dato ='';
                $data['subtitulo']='Honorarios';
		$query = $this->input->post('Cur_Nombre');
                //$this->load->model('Person_model');
                $nombre = array ('Cur_Nombre' => $this->input->post('Cur_Nombre'),);
                $Cur_Nombre = $nombre['Cur_Nombre'];
                $data['nombre'] = $Cur_Nombre;
                
		$persons = $this->Liquidaciones_model->search_liquidaciones($query);
               
                if ($persons == NULL) {
                        $query = $this->db->query("SELECT * FROM Cursos WHERE Cursos.Cur_Nombre='$Cur_Nombre'"); 
                        foreach ($query->result_array() as $row) 
                        { $dato = $row['Cur_Nombre'];}
                        if ($dato == ''){$data['message'] = '(El curso Elegido no Existe)';}
                        else{$data['message'] = '(No estan emitidos los Honorarios del Curso)';}
                            }
                else {$data['message'] = '';}
                if ($Cur_Nombre == '') {$data['message'] = '(No se ingreso Nombre del Curso)';}
                // generate table data
                $this->load->library('table');
                $this->table->set_empty("&nbsp;");
                $this->table->set_heading('Profesor', 'Fecha de Liquidacion','Fecha Inicio', 'Fecha Fin', 'Importe', 'Acciones');
                    $i = 0; // + $offset;
                   foreach ($persons as $person)
		{
			$this->table->add_row( $person->Pro_ApeNom, date('d-m-Y',strtotime($person->Liq_Fecha)), date('d-m-Y',strtotime($person->Liq_Desde)), date('d-m-Y',strtotime($person->Liq_Hasta)), $person->Liq_Monto, 
				anchor('liquidaciones/cobrar/'.$person->Liq_Id,'Registrar Pago de Honorarios',array('class'=>'view'))//.' '.
				//anchor('person/update/'.$person->idAlumnos,'Actualizar',array('class'=>'update')).' '.
				//anchor('person/delete/'.$person->idAlumnos,'Borrar',array('class'=>'delete','onclick'=>"return confirm('Esta seguro que desea borrar el Alumno?')"))
			);
		}
		$data['table'] = $this->table->generate();
                
		//$datoSegundo['tabla_alu']= $this->load->view('cuotas/exito_alumno',$data,TRUE);
                //$datoPrincipal ['contenidoPrincipal'] = $this->load->view('cuotas/cuotas', $datoSegundo, TRUE);
                //$this->load->view('templates',$datoPrincipal);
                
                 $datoPrincipal ['contenidoPrincipal'] = $this->load->view('Liquidaciones/principalliquidaciones2', $data, TRUE);
        $this->load->view('templates',$datoPrincipal);
                
        }
	
   
        
        public function cobrar($Liq_Id){
        
                if($this->caja_abierta()){};
                $data ['subtitulo']='EGRESO - Pago de Honorarios';
                $data['id']=$Liq_Id;
                $this->form_validation->set_rules('comp_nro','Recibo Nº','required|trim|exact_length[13]|xss_clean');
                $this->form_validation->set_rules('formaPago','Forma de Pago','required|trim|xss_clean');
                $this->form_validation->set_rules('descripcion','Descripción','required|trim|max_length[50]|xss_clean');
                $this->form_validation->set_rules('monto','Importe','required|trim|xss_clean');
                
                
                
                if ($this->form_validation->run() == FALSE){
                    
                    $data['id']=$Liq_Id;
                    $liquidaciones= $this->Liquidaciones_model->buscar($Liq_Id);

                    // generate table data

                    $this->table->set_empty("&nbsp;");
                    $i = 0;
                    foreach ($liquidaciones as $liquidacion)
                    {   $data['liquidacion']=$liquidacion;
                        $this->table->add_row(
                                            "<b>Nombre: </b>$liquidacion->Pro_ApeNom",
                                            "<b>DNI: </b>$liquidacion->Pro_DNI",
                                            "<b>Nombre del Curso: </b>$liquidacion->Cur_Nombre"

                                    );
                    }
                    $data['table'] = $this->table->generate();
                    $datoPrincipal ['contenidoPrincipal'] = $this->load->view('liquidaciones/cobroliquidaciones', $data, TRUE);
                }else{
                    $comp_nro = $this->input->post('comp_nro');
                    $formaPago = $this->input->post('formaPago');
                    $desc = $this->input->post('descripcion');
                    $monto = $this->input->post('monto');

                    $liquidaciones= $this->Liquidaciones_model->buscar($Liq_Id);

                    // Genero la tabla que muestra los datos de cliente
                    foreach ($liquidaciones as $liquidacion)
                    {   
                        $data['apeNom']=$liquidacion->Pro_ApeNom;
                        $data['dni']=$liquidacion->Pro_DNI;
                        $data['CurNombre']=$liquidacion->Cur_Nombre;
                        $data['lugardictado']=$liquidacion->Dic_LugarDictado;    
                    }
                    
                    // Genero la tabla que muestra el detalle del movimiento
                    $data['comp_nro']=$comp_nro;
                    $data['formaPago']=$formaPago;
                    $data['desc']=$desc;
                    $data['monto']=$monto;
                    //$data['link_back'] = anchor('alquileres/cobrar/'.$id,'Volver',array('class'=>'back'));
                    $datoPrincipal ['contenidoPrincipal'] = $this->load->view('liquidaciones/confirmarliquidacion', $data, TRUE);
                    }
                    $this->load->view('templates',$datoPrincipal);
                
    }
    
 public function registrar($Liq_Id){
                if($this->caja_abierta()){};
                $data ['subtitulo']='INGRESO - Alquileres';
                $data['id']=$Liq_Id;
    
                $tipo_desc='liquidacion';
                $tipos= $this->MovimientosCaja_model->tipo_movimiento($tipo_desc);
                foreach ($tipos as $tipo){
                    $tm=$tipo->TipMov_Id;
                }
                $gru_desc='liquidacion';
                $centros=  $this->MovimientosCaja_model->centro_costo_grupo($gru_desc);
                foreach ($centros as $centro){
                    $sec=$centro->Sec_Id;
                    $dir=$centro->Dir_Id;
                    $gru=$centro->Gru_Id;
                    $cur=$centro->Cur_Id;
                    $Dic=$centro->Dic_Id;
                }
                $com_nro = $this->input->post('comp_nro');
                $formaPago = $this->input->post('formaPago');
                $desc = $this->input->post('desc');
                $monto = $this->input->post('monto');
                $comp_nro = $this->input->post('monto');
                
                //cambiar caj_id cuando tengamos sesiones
                
                
                $caj_id=$this->session->userdata('caja_id');
                $fecha=$this->MovimientosCaja_model->insert($caj_id,$tm,$monto,$desc,$formaPago,'TRUE',$sec,$dir,$gru,$cur,$Dic);
                
                $movimientos=$this->MovimientosCaja_model->get_id($caj_id,$fecha);
                foreach ($movimientos as $movimiento){
                    $mov_id=$movimiento->Mov_Id;
                }
                
                
                $tipo_comp='RECIBO';
               // $this->MovimientosCaja_model->insert_comprobante($tipo_comp,$com_nro,$caj_id,$mov_id);
                //$this->RendicionesCaja_model->update_ingreso($caj_id,$monto);
                $liquidaciones ='';

		$liquidaciones = $this->Liquidaciones_model->update($Liq_Id,$caj_id,$mov_id);
                //Armo la vista
                if ($liquidaciones==FALSE){
                    $data['message']='Error, no guardado.';
                }else{
                    $data['message'] = '<div class="success">Exito!</div>';
                
                }
                $datoPrincipal ['contenidoPrincipal'] = $this->load->view('Liquidaciones/imprimirliquidaciones', $data, TRUE);
                
                $this->load->view('templates',$datoPrincipal);      
    }

  
 /*function imprimir($Liq_id){
        //Datos de cliente
        $liquidaciones= $this->Liquidaciones_model->buscar($Liq_id);
        foreach ($liquidaciones as $liquidacion)
        {   
            $Pro_ApeNom=$liquidacion->Pro_ApeNom;
            $Pro_Direccion=$liquidacion->Pro_Direccion;
            //$cli_iva=$liquidacion->Cli_cond_iva;
            $Pro_DNI=$liquidacion->Pro_DNI;   
            $caj_id= $liquidacion->MovimientoCaja_Caj_Id;
            $mov_id= $liquidacion->MovimientoCaja_Mov_Id;
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
        

        $impresion->recibo($fecha,$cli_nom,$cli_dir,$cli_cuil,$cli_iva,$formaPago,$monto,$desc);
        
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
"RECIBI de: $Pro_ApeNom
DOMICILIO: $Pro_Direccion
CUIT: $Pro_DNI                                                                I.V.A.: ";

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
    } */   
    
    
}

?>
