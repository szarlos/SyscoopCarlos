<?php

class RendicionesCaja_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function list_all($user){
        $query='SELECT * FROM RendicionesCaja
                            LEFT JOIN Cajas
                            ON RendicionesCaja.Caj_Id=Cajas.Caj_Id
                            WHERE Cajas.Usr_Login= ? 
                            ORDER BY Cajas.Caj_FechaHoraApertura';
        $result=$this->db->query($query,array($user));
        return $result->result();
        
    }
    
    function search_cliente($cliente) {
        $qSqlA="SELECT * FROM Clientes WHERE Cli_ApeNom LIKE'$cliente'+'%' ORDER BY Cli_ApeNom";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
    function get_by_id($id){
        $qSqlA="SELECT * FROM RendicionesCaja WHERE RendCaj_Id='$id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
   function insert($caj_id,$mov_id,$comp_nro,$comp_tipo,$concepto,$tipo_mov,$montoIngreso,$montoEgreso){
        
        $sql="INSERT INTO RendicionesCaja(RendCaj_Id,Caj_Id,Mov_Id,
					  Comp_nro,comp_tipo,
					  concepto,TipMov_Id,
					  ingreso,egreso)
                                    VALUES('$caj_id','$caj_id','$mov_id','$comp_nro','$comp_tipo','$concepto','$tipo_mov','$montoIngreso','$montoEgreso')";
        $esql = $this->db->query($sql);
    }
    
     function update_egreso($caj_id,$monto){
         $sql="UPDATE RendicionesCaja
                    SET egreso = egreso+'$monto'
                    WHERE RendCaj_Id = '$caj_id'";
         $esql = $this->db->query($sql);
         return $esql;
     }
     
     function update_ingreso($caj_id,$monto){
         $sql="UPDATE RendicionesCaja
                    SET ingreso = ingreso+'$monto'
                    WHERE RendCaj_Id = '$caj_id'";
         $esql = $this->db->query($sql);
         return $esql;
     }
    
    function ver($caja_id){
        //Tipo y NºComprobante,Razón Social,Concepto,Descripcion,Ingresos,Egresos,Acciones
        $sql="SELECT * FROM MovimientosCli INNER JOIN(
                SELECT distinct *
                        FROM Comprobantes INNER JOIN 
                        (SELECT distinct TiposMovimientosCaja.TipMov_Id, TiposMovimientosCaja.TipMov_Descripcion,
                                        MovimientosCaja.Caj_Id,MovimientosCaja.Mov_Anulado,MovimientosCaja.Mov_Descripcion,
                                        MovimientosCaja.Mov_FechaHora,MovimientosCaja.Mov_FormaDePago,MovimientosCaja.Mov_Id,
                                        MovimientosCaja.Mov_IngresoEgreso,MovimientosCaja.Mov_Mono 
                                FROM TiposMovimientosCaja INNER JOIN MovimientosCaja
                                ON TiposMovimientosCaja.TipMov_Id=MovimientosCaja.TipMov_Id

                        )AS TEMP2
                        ON Comprobantes.MovimientoCaja_Caj_Id=TEMP2.Caj_Id
                )AS TEMP
                ON MovimientosCli.Caj_Id=TEMP.Caj_Id
                WHERE TEMP.Caj_Id= ? ";
         $esql = $this->db->query($sql,array($caja_id));
         return $esql->result();
    }
     
    

}

?>