<?php

class Cajas_model extends CI_Model {
    
    public function listar_cajeros(){
        $sql="SELECT * FROM Usuarios WHERE Usr_Perfil='Cajero'";
        $esql = $this->db->query($sql);
        return $esql->result();
    }
}

?>
