<?php
class Alquileres_model extends CI_Model {
   
    function update($alq_id,$caj_id,$mov_caja){
        //$desde= date('d-m-Y',strtotime($desde));
        //$hasta=date('d-m-Y',strtotime($hasta));
        /*date_default_timezone_set('America/Argentina/Buenos_Aires');
        $ar=explode("-",$desde);
        $d=$ar[0];
        $m=$ar[1];
        $a=$ar[2];
        $desde="$a-$m-$d";
        $arr=explode("-",$hasta);
        $dia=$arr[0];
        $mes=$arr[1];
        $anio=$arr[2];
        $hasta="$anio-$mes-$dia";*/
        
        $query_alquiler="UPDATE Alquileres
                            SET MovimientoCaja_Caj_Id =$caj_id ,
                                MovimientoCaja_Mov_Id =  $mov_caja
                          WHERE Alq_Id='$alq_id'";
        $alquiler=$this->db->query($query_alquiler);
        
        if($alquiler==1){
            return TRUE;
        }else{
            return FALSE;
        }
        
        
    }
    function list_recintos() {
		
		$qrows = 'SELECT Rec_Nombre FROM Recintos';
		$rows = $this->db->query($qrows);
                return $rows->result();
		
	}
    function get_id_recinto($nom){
        
        $qrows = "SELECT * FROM Recintos WHERE Rec_Nombre='$nom'";
		$rows = $this->db->query($qrows);
                return $rows->result();
            
    }
    
    function buscar_cliente($cli_nom){
                $qrows = "SELECT DISTINCT Clientes.Cli_ApeNom, 
				Clientes.Cli_CUIL,
				TEMP.Rec_Nombre,
				TEMP.Alq_FechaDesde,
				TEMP.Alq_FechaHasta,
				TEMP.Alq_Id
                        FROM Clientes INNER JOIN 
                        (SELECT Distinct 
                                Alquileres.Cli_Id,
                                Alquileres.Alq_Id,
                                Alquileres.MovimientoCaja_Mov_Id,
                                Recintos.Rec_Nombre,
                                Alquileres.Alq_FechaDesde,Alquileres.Alq_FechaHasta
                        FROM Alquileres INNER JOIN Recintos ON Alquileres.Rec_Id=Recintos.Rec_Id) AS TEMP
                        ON Clientes.Cli_Id= TEMP.Cli_Id
                        WHERE ((TEMP.MovimientoCaja_Mov_Id IS NULL) AND (Cli_ApeNom LIKE '$cli_nom'+'%'))
                        ORDER BY Cli_ApeNom, Alq_FechaDesde";
		$rows = $this->db->query($qrows);
                return $rows->result();
    }
    
    function buscar($alquiler_id){
        $qalquiler = "SELECT DISTINCT Clientes.Cli_ApeNom, Clientes.Cli_Id,
				Clientes.Cli_CUIL,
				Clientes.Cli_cond_iva,
                                Clientes.Cli_Direccion,
				TEMP.Rec_Nombre,
				TEMP.Rec_Ubicacion,
				TEMP.Alq_FechaDesde,
				TEMP.Alq_FechaHasta,
				TEMP.Alq_Descripcion,
				TEMP.Alq_Monto,
                                TEMP.MovimientoCaja_Caj_Id,
                                TEMP.MovimientoCaja_Mov_Id
                        FROM Clientes INNER JOIN 
                        (SELECT Distinct 
                                Alquileres.Cli_Id,
                                Alquileres.Alq_Id,
                                Alquileres.MovimientoCaja_Caj_Id,
                                Alquileres.MovimientoCaja_Mov_Id,
                                Recintos.Rec_Id,
                                Recintos.Rec_Nombre,
                                Recintos.Rec_Ubicacion,
                                Alquileres.Alq_Descripcion,	
                                Alquileres.Alq_FechaDesde,Alq_FechaHasta,
                                Alquileres.Alq_Monto
                                FROM Alquileres INNER JOIN Recintos ON Alquileres.Rec_Id=Recintos.Rec_Id) AS TEMP
                        ON Clientes.Cli_Id= TEMP.Cli_Id
                        WHERE (TEMP.Alq_Id=?)";
        $alquiler = $this->db->query($qalquiler, array($alquiler_id));
        return $alquiler->result();
    }
    
}

?>
