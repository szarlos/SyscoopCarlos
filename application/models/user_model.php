<?php
class User_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function check_login($username,$password){
        //falta encriptar password dentro de la db!!
        //para desencriptarlo $sha1_password=$password;
        $perfil='Cajero';
        $sql = 'SELECT * FROM Usuarios WHERE Usr_Login = ? AND Usr_Clave = ? AND Usr_Perfil = ? ' ;
        $result=$this->db->query($sql, array($username, $password, $perfil));
        
        if($result->num_rows()==1){
            return $username;
        }
        else{
            return FALSE;
        }
    }
    function get_name($username){
        $query='SELECT Usr_ApeNom FROM Usuarios WHERE Usr_Login = ?';
        $result=$this->db->query($query,array($username));
        return $result->row_array();
    }
    function buscar_hash($hash){
        $query='SELECT [Usr_Login],[Usr_Clave] FROM [Cooperadora].[dbo].[Usuarios] WHERE Usr_session_hash = ?';
        $result=$this->db->query($query,array($hash));
        //borrar hash
       $query2=' UPDATE [Cooperadora].[dbo].[Usuarios] SET [Usr_session_hash] = NULL WHERE [Usr_session_hash]= ?';
       $this->db->query($query2,array($hash));
       
       return $result->row_array();
    }
}

?>
