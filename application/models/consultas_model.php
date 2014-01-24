<?php
class Consultas_model extends CI_Model {
	
	private $Alumnos= 'Alumnos';
        private $Cuotas= 'Cuotas';
	
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
         $qSqlA="SELECT * FROM Inscripciones, Cursos, Dictados, Alumnos, FormasPago WHERE Inscripciones.FormaPagoFor_Id=FormasPago.For_Id AND Alumnos.Alu_Id='$Alu_Id' AND Inscripciones.Alu_Id='$Alu_Id' AND Inscripciones.DictadoCur_Id=Cursos.Cur_Id AND Inscripciones.DictadoDic_Id=Dictados.Dic_Id";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
        
        
          function datoscuotas($Alu_Id){
       $qSqlA="SELECT * FROM Inscripciones, Cuotas, Alumnos WHERE  Alumnos.Alu_Id='$Alu_Id' AND Inscripciones.Alu_Id='$Alu_Id' AND Inscripciones.DictadoCur_Id=Cuotas.Cur_Id AND Inscripciones.DictadoDic_Id=Cuotas.Dic_Id AND Inscripciones.Alu_Id=Cuotas.Alu_Id";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	 
	}
        
          function LeerUnaCuota($Cuo_Numero){
       $qSqlA="SELECT * FROM Cuotas WHERE Cuotas.Cuo_Numero='$Cuo_Numero'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	 
	}
	
        function consultacuotas($Alu_Id){
         $qSqlA="SELECT * FROM Inscripciones, Cuotas WHERE Inscripciones.Alu_Id='$Alu_Id' AND Inscripciones.DictadoCur_Id=Cuotas.Cur_Id AND Inscripciones.DictadoDic_Id=Cuotas.Dic_Id AND Inscripciones.Alu_Id=Cuotas.Alu_Id AND Cuotas.Cuo_Monto>Cuotas.Cuo_MontoPagado";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
        
         function consultacuotas2($Alu_Id){
         $qSqlA="SELECT * FROM Inscripciones, Cuotas, Alumnos WHERE  Alumnos.Alu_Id='$Alu_Id' AND Inscripciones.Alu_Id='$Alu_Id' AND Inscripciones.DictadoCur_Id=Cuotas.Cur_Id AND Inscripciones.DictadoDic_Id=Cuotas.Dic_Id AND Inscripciones.Alu_Id=Cuotas.Alu_Id";
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