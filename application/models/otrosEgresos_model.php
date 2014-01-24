<?php

class OtrosEgresos_model extends CI_Model{
    
    function max_id(){
        $q="SELECT MAX(egresos_Id) AS id FROM Otros_Egresos ";
        $e= $this->db->query($q);
        return $e->result();
        
    }


    function insert($e_id,$caj_id,$mov_id,$prov_id){
        $e_id=$e_id+1;
        $q="INSERT INTO Otros_Egresos(egresos_id,Caj_Id,Mov_Id,Prov_ID)
                    VALUES('$e_id','$caj_id','$mov_id','$prov_id')";
        $e= $this->db->query($q);
        
        return $e;
    }
    
}

?>
