<?php
class Radios_model extends CI_Model {
   
    function insert_pago($venta_id,$caj_id,$mov_id){
        
        $qpago="INSERT INTO PagosVentasRadio(Ven_Rad_Id,MovimientoCaja_Caj_Id,MovimientoCaja_Mov_Id)
                        VALUES(?,?,?)";
        $pago = $this->db->query($qpago, array($venta_id,$caj_id,$mov_id));
        return $pago;
    }
    
    function update_venta($venta_id,$monto){
        $qventa="UPDATE VentasRadio
                    SET Ven_Rad_MontoPagado = Ven_Rad_MontoPagado + ?
                    WHERE Ven_Rad_Id= ?";
        $venta= $this->db->query($qventa,array($monto,$venta_id));
    }
    
    function buscar_venta($cli_nom){
        $qradio="SELECT DISTINCT Clientes.Cli_Id, Cli_ApeNom,Cli_CUIL,
				Ven_Rad_Id, Vent_Rad_Tipo,Ven_Rad_Desde,Ven_Rad_Hasta,
				Ven_Rad_Descripcion, Ven_Rad_Monto,Ven_Rad_MontoPagado				
                        FROM VentasRadio INNER JOIN Clientes
                        ON VentasRadio.Cli_Id=Clientes.Cli_Id
                        WHERE (VentasRadio.Ven_Rad_MontoPagado < VentasRadio.Ven_Rad_Monto AND Clientes.Cli_ApeNom LIKE '%'+?+'%')
                        ORDER BY Clientes.Cli_ApeNom, Ven_Rad_Desde";
        $venta_radio = $this->db->query($qradio, array($cli_nom));
        return $venta_radio->result();
    }
    
    function buscar($id){
        $qradio="SELECT * 
                    FROM VentasRadio INNER JOIN Clientes
                    ON VentasRadio.Cli_Id=Clientes.Cli_Id
                    WHERE Ven_Rad_Id=?";
        $radio= $this->db->query($qradio,array($id));
        return $radio->result();
    }
    
    function buscar_pago($mov_id){
        $qradio="SELECT DISTINCT * FROM Clientes INNER JOIN
                        (
                        SELECT DISTINCT VentasRadio.Ven_Rad_Id,Cli_Id,Mov_Descripcion,Mov_FechaHora,Mov_FormaDePago,
                                                        Mov_Id, Mov_Mono,MovimientoCaja_Caj_Id
                        FROM VentasRadio INNER JOIN
                                (
                                SELECT DISTINCT * FROM MovimientosCaja INNER JOIN PagosVentasRadio
                                ON Mov_Id=PagosVentasRadio.MovimientoCaja_Mov_Id
                                WHERE Mov_Id=?
                                ) AS TEMP1
                        ON VentasRadio.Ven_Rad_Id=TEMP1.Ven_Rad_Id)AS TEMP2
                ON Clientes.Cli_Id=TEMP2.Cli_Id";
        $radio= $this->db->query($qradio,array($mov_id));
        return $radio->result();  
    }
    function buscar_cliente($id){
        $qradio="SELECT * FROM VentasRadio INNER JOIN Clientes
ON VentasRadio.Cli_Id=Clientes.Cli_Id
WHERE VentasRadio.Ven_Rad_Id=?";
        $radio= $this->db->query($qradio,array($id));
        return $radio->result();
    }
}

?>
