<?php

class Alumnos_model extends CI_Model {
    
    private $alumnos='alumnos';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function todosAlumnos(){
        $qSqlA='SELECT * FROM Alumnos';
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
    function search_alumno($dni) {
		
	$qSqlA="SELECT * FROM Alumnos WHERE Alu_DNI='$dni'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	
    }
}

?>
