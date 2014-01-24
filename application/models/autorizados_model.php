<?php

class Autorizados_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    function buscar_autorizado($a) {
        $qSqlA="SELECT * FROM Autorizados WHERE Aut_ApeNom LIKE'$a'+'%' ORDER BY Aut_ApeNom";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
    function get_by_id($aut_id){
        $qSqlA="SELECT * FROM Autorizados WHERE Aut_Id='$aut_id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
}

?>
