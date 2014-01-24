<?php
class Dictados_model extends CI_Model {
	
	private $Dictados= 'Dictados';
	
        
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('Dic_Id','asc');
		return $this->db->get($Dictados);
	}
	
	function count_all(){
		return $this->db->count_all($this->Dictados);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('Alu_Id','asc');
                //return $this->db->get($this->Alumnos, $limit, $offset)
             $qSqlA='SELECT * FROM Dictados ORDER BY Dic_Id ASC';
             $eSqlA = $this->db->query($qSqlA);
             return $eSqlA; 
                    
        }
	
	function get_by_id($DictadoDic_Id){
         $qSqlA="SELECT * FROM Dictados WHERE Dic_Id='$DictadoDic_Id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
	
	function save($person){
		$this->db->insert($this->Dictados, $person);
		return $this->db->insert_id();
	}
	
	function update($Dic_Id, $person){
		$this->db->where('Dic_Id', $Dic_Id);
		$this->db->update($this->Dictados, $person);
	}
	
	function delete($Dic_Id){
		$this->db->where('Dic_Id', $Dic_Id);
		$this->db->delete($this->Dictados);
	}
}
?>
