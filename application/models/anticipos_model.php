<?php
class Anticipos_model extends CI_Model {
   
    function insert($aut_id,$caja_id,$mov_id){
        
        $qSqlA="INSERT INTO AnticiposParaGastos(Aut_Id,
                                                Entrega_Caj_Id,
                                                Entrega_Mov_Id)
                                                VALUES('$aut_id','$caja_id','$mov_id')";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA;
    }
    /*function get_id($caj_id,$mov_id){
        $qanticipo="";
        $anticipo= $this->db->query($qanticipo);
        return $anticipo->result();
    }*/
}

?>
