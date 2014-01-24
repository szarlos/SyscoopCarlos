<?php
class Cursos_model extends CI_Model {
	
	private $Cursos= 'Cursos';
	
        
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('Cur_Id','asc');
		return $this->db->get($Cursos);
	}
	
	function count_all(){
		return $this->db->count_all($this->Cursos);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('Alu_Id','asc');
                //return $this->db->get($this->Alumnos, $limit, $offset)
             $qSqlA='SELECT * FROM Cursos ORDER BY Cur_Id ASC';
             $eSqlA = $this->db->query($qSqlA);
             return $eSqlA; 
                    
        }
	
	function get_by_id($Cur_Id){
         $qSqlA="SELECT * FROM Cursos, Inscripciones, Alumnos  WHERE Cur_Id='$Cur_Id' AND DictadoCur_Id='$Cur_Id' AND Alumnos.Alu_Id=Inscripciones.Alu_Id";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
	
	function save($person){
		$this->db->insert($this->Cursos, $person);
		return $this->db->insert_id();
	}
	
	function update($Cur_Id, $person){
		$this->db->where('Cur_Id', $Cur_Id);
		$this->db->update($this->Cursos, $person);
	}
	
	function delete($Cur_Id){
		$this->db->where('Cur_Id', $Cur_Id);
		$this->db->delete($this->Cursos);
	}
}
?>