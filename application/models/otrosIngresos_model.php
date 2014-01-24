<?php

class otrosIngresos_model extends CI_Model{
    
    function max_id(){
        $q="SELECT MAX(ingresos_Id) AS id FROM Otros_Ingresos ";
        $e= $this->db->query($q);
        return $e->result();
        
    }


    function insert($i_id,$caj_id,$mov_id,$cli_id){
        $i_id=$i_id+1;
        $q="INSERT INTO Otros_Ingresos(ingresos_id,Caj_Id,Mov_Id,Cli_Id)
                    VALUES(?,?,?,?)";
        $i= $this->db->query($q, array($i_id,$caj_id,$mov_id,$cli_id));
        
        return $i;
    }
     function buscar_mov($mov_id){
        $qservicios="SELECT * FROM MovimientosCaja
                    INNER JOIN 
                    (SELECT Clientes.Cli_ApeNom, Clientes.Cli_CUIL, Clientes.Cli_Direccion,Clientes.Cli_cond_iva,
                                    Otros_Ingresos.Mov_Id
                            FROM Otros_Ingresos INNER JOIN Clientes
                            ON Otros_Ingresos.Cli_Id=Clientes.Cli_Id
                            WHERE Otros_Ingresos.Mov_Id=?
                    )AS TEMP
                    ON MovimientosCaja.Mov_Id = TEMP.Mov_Id";
        $servicios= $this->db->query($qservicios, array($mov_id));
        return $servicios->result();
    }
}

?>
