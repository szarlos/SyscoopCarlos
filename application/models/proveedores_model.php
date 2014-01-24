<?php

class Proveedores_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    function buscar_proveedor($prov){
        $q="SELECT * FROM Proveedores WHERE Prov_RazonSocial LIKE'$prov'+'%' ORDER BY Prov_RazonSocial";
        $ejecutarq = $this->db->query($q);
        return $ejecutarq->result();
    }
    
    function get_by_id($prov_id){
        $qSqlA="SELECT * FROM Proveedores WHERE Prov_Id='$prov_id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
    
}

?>
