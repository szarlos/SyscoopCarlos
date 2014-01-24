<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MovimientosCaja_model extends CI_Model {
    
    
    function tipo_movimiento($tipo_desc){
        $query_tipo="SELECT * 
                    FROM TiposMovimientosCaja 
                    WHERE TipMov_Descripcion ='$tipo_desc'";
        $tipo_mov= $this->db->query($query_tipo);
        return $tipo_mov->result();
    }
    function centro_costo_todas_sec(){
        $query_centro_costo="SELECT * FROM Secretarias";
        $centro_costo=  $this->db->query($query_centro_costo);
        return $centro_costo->result();
    }
    
    
    function centro_costo_sec($sec_desc){
        $query_centro_costo="SELECT DISTINCT CentrosDeCostos.Sec_Id,
                                            CentrosDeCostos.Dir_Id,
                                            CentrosDeCostos.Gru_Id,
                                            CentrosDeCostos.Cur_Id,
                                            CentrosDeCostos.Dic_Id
                                                    FROM CentrosDeCostos
                                        INNER JOIN Secretarias
                                        ON (CentrosDeCostos.Sec_Id=Secretarias.Sec_Id)
                                        WHERE Secretarias.Sec_Descripcion= ? ";
        $centro_costo=  $this->db->query($query_centro_costo,array($sec_desc));
        return $centro_costo->result();
    }
    
    function centro_costo_grupo($gru_desc){
        $query_centro_costo="SELECT DISTINCT CentrosDeCostos.Sec_Id,
                                            CentrosDeCostos.Dir_Id,
                                            CentrosDeCostos.Gru_Id,
                                            CentrosDeCostos.Cur_Id,
                                            CentrosDeCostos.Dic_Id
                            FROM CentrosDeCostos
                            INNER JOIN Grupos
                                ON (CentrosDeCostos.Sec_Id=Grupos.Sec_Id
                                AND CentrosDeCostos.Dir_Id=Grupos.Dir_Id
                                AND CentrosDeCostos.Gru_Id=Grupos.Gru_Id)
                            WHERE Grupos.Gru_Descripcion='$gru_desc'";
        $centro_costo=  $this->db->query($query_centro_costo);
        return $centro_costo->result();
    }
    
    function centro_costo_dir($dir_desc){
        $query_centro_costo="SELECT * FROM Direcciones WHERE Dir_Descripcion='$dir_desc'";
        $centro_costo=  $this->db->query($query_centro_costo);
        return $centro_costo->result();
    }
    
    function get_id($caj_id,$fecha){
        $query="SELECT * FROM MovimientosCaja 
                WHERE Caj_Id='$caj_id' AND Mov_FechaHora='$fecha'";
        $equery=  $this->db->query($query);
        return $equery->result();
    }
    
    
    
    function get_id_comprobante($caj_id,$mov_caj){
        $query="SELECT Comp_Nro FROM Comprobantes 
                WHERE MovimientoCaja_Caj_Id='$caj_id' AND MovimientoCaja_Mov_Id='$mov_caj';";
        $equery=  $this->db->query($query);
        return $equery->result();
    }
    
    public function insert($caj_id,$tipo_mov,$monto,$desc,$fPago,$ie,$sec,$dir,$gru,$curso,$dictado){
        
        $now= now();
        $fecha=  unix_to_human($now);
        
        if($fPago=='Contado'){
            $formaPago=1;
        }else{
            $formaPago=2;
        }
        $query_mov_caja="INSERT INTO MovimientosCaja(
                                        Caj_Id,
                                        TipMov_Id,
                                        Mov_Mono,
                                        Mov_Descripcion,
                                        Mov_FechaHora,
                                        Mov_FormaDePago,
                                        Mov_IngresoEgreso,
                                        Mov_Anulado,
                                        Sec_Id,Dir_Id,Gru_Id,Cur_Id,Dic_Id)
                        VALUES('$caj_id','$tipo_mov','$monto','$desc','$fecha','$formaPago','$ie','FALSE','$sec','$dir','$gru','$curso','$dictado');";
        $equery=  $this->db->query($query_mov_caja);
        return $fecha;
    }
    
    
     
    function insert_comprobante($comp_tipo,$com_nro,$caj_id,$mov_caj){
        //Tipo Comprobante 1 = RECIBO
        //Tipo Comprobante 2 = FACTURA
        //Tipo Comprobante 3 = VALE
        //Tipo Comprobante 4 = OTRO
        if($comp_tipo=='RECIBO'){
            $comp_tipo=1;
        }else if($comp_tipo=='FACTURA'){
            $comp_tipo=2;
        }else if($comp_tipo=='VALE'){
            $comp_tipo=3;
        }else{
            $comp_tipo=4;
        }
        $q_comp="INSERT INTO Comprobantes(
                                        Tipo_Comprobante,
                                        Comp_Nro_Externo,                                            
                                        MovimientoCaja_Caj_Id,
                                        MovimientoCaja_Mov_Id)
                                        VALUES('$comp_tipo','$com_nro','$caj_id','$mov_caj')";
        $comp= $this->db->query($q_comp);
         
    }
    
    function insert_vale($caj_id,$mov_caj){
        //Tipo Comprobante 1 = RECIBO
        //Tipo Comprobante 2 = FACTURA
        //Tipo Comprobante 3 = VALE
        //Tipo Comprobante 4 = OTRO
        $comp_tipo=3;
        
        $q_comp="INSERT INTO Comprobantes(
                                        Tipo_Comprobante,
                                        MovimientoCaja_Caj_Id,
                                        MovimientoCaja_Mov_Id)
                                        VALUES('$comp_tipo','$caj_id','$mov_caj')";
        $comp= $this->db->query($q_comp);
         
    }
    function get_mov($caj_id,$mov_caj){
        $query="SELECT * FROM MovimientosCaja 
                WHERE Caj_Id='$caj_id' AND Mov_Id='$mov_caj';";
        $equery=  $this->db->query($query);
        return $equery->result();
    }
    
    function get_mov_cli($caj_id,$mov_caj){
        $query="SELECT * FROM MovimientosCaja 
                WHERE Caj_Id='$caj_id' AND Mov_Id='$mov_caj';";
        $equery=  $this->db->query($query);
        return $equery->result();
    }
   
    function insertIngreso_movCli($caj_id,$mov_id,$cli_id,$razonsocial){
        $query="INSERT INTO MovimientosCli
                            (Caj_Id,Mov_Id,Cli_Id,Prov_Id,RazonSocial)
                        VALUES
                            (?,?,?,NULL,?)";
        $equery=  $this->db->query($query,array($caj_id,$mov_id,$cli_id,$razonsocial));
        return $equery;
    }
    
    function insertEgreso_movCli($caj_id,$mov_id,$prov_id,$razonsocial){
        $query="INSERT INTO MovimientosCli
                            (Caj_Id,Mov_Id,Cli_Id,Prov_Id,RazonSocial)
                        VALUES
                            (?,?,NULL,?,?)";
        $equery=  $this->db->query($query,array($caj_id,$mov_id,$prov_id,$razonsocial));
        return $equery;
    }
    
    function get_caja($caj_id){
        $query="SELECT * FROM Cajas INNER JOIN Usuarios
                ON Cajas.Usr_Login=Usuarios.Usr_Login
                WHERE Caj_Id= ? ";
        $equery=  $this->db->query($query,array($caj_id));
        return $equery->result();
    }
    function nombre_puesto($puesto_id){
            $query='SELECT Pue_Ubicacion FROM PuestosCaja WHERE Pue_Id= ?';
            $result=$this->db->query($query,array($puesto_id));
            
            return $result->result();
        }
}

?>
