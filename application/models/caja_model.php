<?php
class Caja_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
 
    function caja_abierta(){
        $usuario=$this->session->userdata('user_id');
        $query_str='SELECT * FROM Cajas WHERE Usr_Login= ? AND Caj_FechaHoraCierre IS NULL';
        $result=$this->db->query($query_str,array($usuario));
        if ($result->num_rows()==1){
        
            //1 resultado: caja abierta
            return TRUE;
        }else{
            //sin resultados: no caja abierta con ese usuario
            if ($result->num_rows()==0){
                return false;
            }else{
                //mas de 1 caja abierta, error??
                //redirigir pagina de error
                echo 'Existe mas de una caja abierta';
            }
        }
    }
     function puestos_disponibles(){
           
          return $this->db->query('SELECT Pue_Id, Pue_Ubicacion FROM puestoscaja WHERE Pue_Ubicacion NOT IN (
SELECT Pue_Ubicacion FROM puestoscaja,cajas WHERE Caj_FechaHoraCierre IS NULL AND cajas.Pue_Id=puestoscaja.Pue_Id)');
        }
        
   function abrir($puesto,$monto){
            $user=$this->session->userdata('user_id');
            $query='INSERT INTO Cajas (Pue_Id,Usr_Login,Caj_MontoApertura,Caj_FechaHoraApertura) VALUES ( ? , ? , ? , GETDATE())';
            $this->db->query($query,array($puesto,$user,$monto));
            
        }
        
        function cerrar($monto){
          $user=$this->session->userdata('user_id');
          $query='UPDATE Cajas SET Caj_FechaHoraCierre=GETDATE(), Caj_MontoCierre = ? WHERE Caj_FechaHoraCierre IS NULL AND Usr_Login= ? ';
          $this->db->query($query,array($monto,$user));
        }
        function nombre_puesto($puesto_id){
            $query='SELECT Pue_Ubicacion FROM PuestosCaja WHERE Pue_Id= ?';
            $result=$this->db->query($query,array($puesto_id));
            return $result->row_array();
        }
        function recuperar_datos_caja($user_id){
          $query='SELECT Caj_Id,Pue_Id FROM Cajas WHERE Usr_Login=? AND Caj_FechaHoraCierre IS NULL';
         $result=  $this->db->query($query,array($user_id));
         return $result->row_array();
        }
        function sumar_ingresos($caja_id){
            $query='SELECT SUM(Mov_Mono) AS TotalIng FROM [Cooperadora].[dbo].[MovimientosCaja] WHERE Caj_Id= ? AND Mov_IngresoEgreso = 1';
            $result= $this->db->query($query,array($caja_id));
            return $result->row_array();
        }
        function sumar_egresos($caja_id){
            $query='SELECT SUM(Mov_Mono) AS TotalEg FROM [Cooperadora].[dbo].[MovimientosCaja] WHERE Caj_Id= ? AND Mov_IngresoEgreso = 0';
            $result= $this->db->query($query,array($caja_id));
            return $result->row_array();
        }
       function obtener_monto_ap($caja_id){
          $query='SELECT Caj_MontoApertura FROM Cajas WHERE Caj_Id=?'; 
          $result=$this->db->query($query,array($caja_id));
          return $result->row_array();
         }  
      function insert_RendCaja($caja_id,$monto_apertura){
          $query='INSERT INTO RendicionesCaja
                                (Caj_Id
                                ,RendCaj_Id
                                ,ingreso
                                ,egreso
                                ,apertura)
                            VALUES
                                (?,?,0,0,?)'; 
          $result=$this->db->query($query,array($caja_id,$caja_id,$monto_apertura));
          return $result;
          
      }
}
?>
