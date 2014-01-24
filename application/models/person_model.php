<?php
class Person_model extends CI_Model {
	
	private $Alumnos= 'Alumnos';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('Alu_Id','asc');
		return $this->db->get($Alumnos);
	}
	
	function count_all(){
		return $this->db->count_all($this->Alumnos);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('Alu_Id','asc');
                //return $this->db->get($this->Alumnos, $limit, $offset)
             $qSqlA='SELECT * FROM Alumnos ORDER BY Alu_Id ASC';
             $eSqlA = $this->db->query($qSqlA);
             return $eSqlA; 
                    
        }

	
	function get_by_id($Alu_Id){
         $qSqlA="SELECT * FROM Alumnos WHERE Alu_Id='$Alu_Id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
	
	function save($person){
		$this->db->insert($this->Alumnos, $person);
		return $this->db->insert_id();
	}
	
	function update($Alu_Id, $person){
		$this->db->where('Alu_Id', $Alu_Id);
		$this->db->update($this->Alumnos, $person);
	}
	
	function delete($Alu_Id){
		$this->db->where('Alu_Id', $Alu_Id);
		$this->db->delete($this->Alumnos);
	}

           function search_alumno($Alu_Id) {
		
	$qSqlA="SELECT * FROM Alumnos WHERE Alu_DNI='$Alu_Id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	
    }
          function search_alumno2($Alu_ApeNom) {
		
	$qSqlA="SELECT * FROM Alumnos WHERE Alu_ApeNom='$Alu_ApeNom'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	
    }
        
}
?>