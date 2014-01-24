<?php
class ServiciosIngreso_model extends CI_Model {
   
    function insert($cli_id,$nombre,$desc,$monto,$sec,$dir,$gru,$cur,$dic,$caja_id,$mov_id){
        $now= now();
        $fecha=  unix_to_human($now);
        $qSqlA="INSERT ServiciosVarios(Cli_Id,
Serv_Fecha,
Serv_Nombre,
Serv_Descripcion,
Ser_Monto,
Sec_Id,Dir_Id,Gru_Id,Cur_Id,Dic_Id,
MovimientoCaja_Caj_Id,MovimientoCaja_Mov_Id)
values ('$cli_id','$fecha','$nombre','$desc','$monto','$sec','$dir','$gru','$cur','$dic','$caja_id','$mov_id')";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA;
    }
    
    function list_grupos() {
		
		$qrows = "SELECT DISTINCT Gru_Descripcion FROM Grupos 
                          INNER JOIN (SELECT Dir_Id FROM Direcciones 
                                      WHERE Dir_Descripcion='Equipos I+D' OR Dir_Descripcion='Servicios a Terceros') AS TEMP
                          ON Grupos.Dir_Id=TEMP.Dir_Id";
		$rows = $this->db->query($qrows);
                return $rows->result();
		
	}
    function get_id_grupo($nom){
        
        $qrows = 'SELECT * FROM Recintos';
		$rows = $this->db->query($qrows);
                return $rows->result();
            
    }
    
    function buscar_clientes($cli_nom){
        $qclientes="SELECT * FROM Clientes
                    INNER JOIN ServiciosVarios
                    ON Clientes.Cli_Id=ServiciosVarios.Cli_Id
                    WHERE ((ServiciosVarios.MovimientoCaja_Mov_Id IS NULL)AND (Cli_ApeNom LIKE '%' + ? +'%'))
                    ORDER BY Cli_ApeNom,Serv_Fecha";
        $clientes= $this->db->query($qclientes, array($cli_nom));
        return $clientes->result();
        
    }
    function buscar_cliente_serv($serv_id){
        $qclientes="SELECT * FROM ServiciosVarios
INNER JOIN Clientes
ON ServiciosVarios.Cli_Id=Clientes.Cli_Id
WHERE ServiciosVarios.Serv_Id= ? ";
        $clientes= $this->db->query($qclientes, array($serv_id));
        return $clientes->result();
        
    }
    function buscar_servicio($serv_id){
        $qservicios="SELECT * FROM Clientes
                    INNER JOIN ServiciosVarios
                    ON Clientes.Cli_Id=ServiciosVarios.Cli_Id
                    WHERE (ServiciosVarios.Serv_Id = ? )";
        $servicios= $this->db->query($qservicios, array($serv_id));
        return $servicios->result();
        
    }
    
    function update($serv_id,$caj_id,$mov_id){
        $qservicios="UPDATE ServiciosVarios
                        SET MovimientoCaja_Caj_Id = ? ,
                            MovimientoCaja_Mov_Id = ? 
                        WHERE Serv_Id = ?";
        $servicios= $this->db->query($qservicios, array($caj_id,$mov_id,$serv_id));
       
        return $servicios;
    }
    
    function buscar_mov($mov_id){
        $qservicios="SELECT * FROM MovimientosCaja
                    INNER JOIN 
                    (SELECT Clientes.Cli_ApeNom, Clientes.Cli_CUIL, Clientes.Cli_Direccion,Clientes.Cli_cond_iva,
                                    ServiciosVarios.MovimientoCaja_Mov_Id
                            FROM ServiciosVarios INNER JOIN Clientes
                            ON ServiciosVarios.Cli_Id=Clientes.Cli_Id
                            WHERE ServiciosVarios.MovimientoCaja_Mov_Id=?
                    )AS TEMP
                    ON MovimientosCaja.Mov_Id = TEMP.MovimientoCaja_Mov_Id";
        $servicios= $this->db->query($qservicios, array($mov_id));
        return $servicios->result();
    }
    
}

?>
