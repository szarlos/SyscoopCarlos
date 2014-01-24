<?php
class Liquidaciones_model extends CI_Model {
	
	private $Liquidaciones= 'Liquidaciones';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('Liq_Id','asc');
		return $this->db->get($Liquidaciones);
	}
	
	function count_all(){
		return $this->db->count_all($this->Liquidaciones);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('Alu_Id','asc');
                //return $this->db->get($this->Alumnos, $limit, $offset)
             $qSqlA='SELECT * FROM Liquidaciones, Cursos, Dictados, Profesores WHERE Liquidaciones.Cur_Id=Cursos.Cur_Id AND Liquidaciones.Dic_Id=Dictados.Dic_Id AND Profesores.Pro_Id=Dictados.Pro_Id';
             $eSqlA = $this->db->query($qSqlA);
             return $eSqlA; 
                    
        }

	
	function get_by_id($Liq_Id){
         $qSqlA="SELECT * FROM Liquidaciones WHERE Liq_Id='$Liq_Id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
	
	function save($person){
		$this->db->insert($this->Liquidaciones, $person);
		return $this->db->insert_id();
	}
	
	function update($Liq_id,$caj_id,$mov_caja){
        
        $query_liquidaciones="UPDATE Liquidaciones
                            SET MovimientoCaja_Caj_Id =$caj_id ,
                                MovimientoCaja_Mov_Id =  $mov_caja
                          WHERE Liq_Id='$Liq_id'";
        $liquidaciones=$this->db->query($query_liquidaciones);
        
        if($liquidaciones==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
	
	function delete($Liq_Id){
		$this->db->where('Liq_Id', $Liq_Id);
		$this->db->delete($this->Liquidaciones);
	}

           function search_liquidaciones($Cur_Nombre) {
	$vacio = NULL;
        
        
	 $qSqlA="SELECT * FROM Liquidaciones, Cursos, Dictados, Profesores WHERE  Liquidaciones.Cur_Id=Cursos.Cur_Id AND Liquidaciones.Dic_Id=Dictados.Dic_Id AND Profesores.Pro_Id=Dictados.Pro_Id AND Cursos.Cur_Nombre='$Cur_Nombre' AND Liquidaciones.MovimientoCaja_Mov_Id is null";
             $eSqlA = $this->db->query($qSqlA);
             return $eSqlA->result();

    }
          function search_alumno2($Alu_ApeNom) {
		
	$qSqlA="SELECT * FROM Alumnos WHERE Alu_ApeNom='$Alu_ApeNom'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	
    }

    function buscar($Liq_Id){
        $qliquidacion = "SELECT * FROM Cursos, Dictados, Profesores, Liquidaciones WHERE Cursos.Cur_Id=Liquidaciones.Cur_Id AND Dictados.Cur_Id=Cursos.Cur_Id AND Dictados.Dic_Id=Liquidaciones.Dic_Id AND Profesores.Pro_Id=Dictados.Pro_Id";
        $liquidacion = $this->db->query($qliquidacion, array($Liq_Id));
        echo var_dump($liquidacion);
        return $liquidacion->result();
    }
    
    
    
}
?>