<?php

class Clientes_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function todosClientes(){
        $qSqlA='SELECT * FROM Clientes';
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
    function search_cliente($cliente) {
        $qSqlA="SELECT * FROM Clientes WHERE Cli_ApeNom LIKE'$cliente'+'%' ORDER BY Cli_ApeNom";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
    function get_by_id($cli_id){
        $qSqlA="SELECT * FROM Clientes WHERE Cli_Id='$cli_id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
    
    function nuevo_cliente($nom,$cuil,$dni,$dir,$email,$empresa,$tel){
        $sql="INSERT INTO Clientes(
            Cli_ApeNom,
            Cli_CUIL,
            Cli_DNI,
            Cli_Direccion,
            Cli_Email,
            Cli_NomEmpresa,
            Cli_Telefono)
            VALUES('$nom','$cuil','$dni','$dir','$email','$empresa','$tel')";
        $esql = $this->db->query($sql);
    }
    
    function editar_cliente($cli_id,$nom,$cuil,$dni,$dir,$email,$empresa,$tel){
        $sql="UPDATE Clientes 
                SET Cli_ApeNom='$nom',
                    Cli_CUIL='$cuil',
                    Cli_DNI='$dni',
                    Cli_Direccion='$dir',
                    Cli_Email='$email',
                    Cli_NomEmpresa='$empresa',
                    Cli_Telefono='$tel'
                WHERE Cli_Id='$cli_id'";
        $esql = $this->db->query($sql);
    }
    
    function eliminar_cliente($cli_id){
        
    }

}

?>