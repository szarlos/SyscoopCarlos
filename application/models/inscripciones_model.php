<?php

class Inscripciones_model extends CI_Model {
    
    private $inscripciones='inscripciones';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function list_by_curso($Cur_Id){
        $qSqlA="SELECT * FROM Inscripciones WHERE DictadoCur_Id='$Cur_Id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
}
?>
