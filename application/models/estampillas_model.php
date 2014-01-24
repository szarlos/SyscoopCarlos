<?php

class Estampillas_model extends CI_Model {
    
    public function listar_por_valores(){
        $sql='SELECT * FROM Estampillas ORDER BY Est_Valor desc';
        $esql = $this->db->query($sql);
        return $esql->result();
    }
    
    public function insert($id,$cant){
        $desc='Venta de Estampillas.';
        $now= now();
        $fecha=  unix_to_human($now);
        //Tipo 1 correspondiente a INGRESOS.
        $tipo=1;
        $sql="INSERT INTO MovimientosEstampilla(
                            Est_Id,
                            Mov_Est_Cantidad,
                            Mov_Est_Descripcion,
                            Mov_Est_Fecha,
                            Mov_Est_Tipo) 
                       VALUES('$id','$cant','$desc','$fecha','$tipo')";
        
        $esql = $this->db->query($sql);
    }
    
    public function update_cant(){
        
    }
}

?>
