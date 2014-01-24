<?php
class Cuotas_model extends CI_Model {
	
	private $Cuotas= 'Cuotas';
	
        
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('Cuo_Numero','asc');
		return $this->db->get($Cuotas);
	}
	
	function count_all(){
		return $this->db->count_all($this->Cuotas);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
                $offset = 0; //si no le pongo este en cero me va borrando los primeros registros de las tablas y es acumulativo
		$this->db->order_by('Cuo_Numero','asc');
		return $this->db->get($this->Cuotas, $limit, $offset);
	}
	
	function get_by_id($Cuo_Numero){
         $qSqlA="SELECT * FROM Cuotas WHERE Cuotas.Cuo_Numero='$Cuo_Numero'";
        $eSqlA = $this->db->query($qSqlA);
        
        return $eSqlA->result();
	 
	}
	
	function save($Cuotas){
            
		$this->db->insert($this->Cuotas, $Cuotas);
		return $this->db->insert_id();
	}
	
	function update($Cuo_Numero, $Cuotas){
            
		$this->db->where('Cuo_Numero', $Cuo_Numero);
		$this->db->update($this->Cuotas, $Cuotas);
	}
	
	function delete($Cuo_Numero){
		$this->db->where('Cuo_Numero', $Cuo_Numero);
		$this->db->delete($this->Cuotas);
	}
}
?>