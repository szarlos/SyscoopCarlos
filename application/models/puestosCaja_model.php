<?php

class PuestosCaja_model extends CI_Model {
    
    function list_puestos() {
		
		$qrows = 'SELECT Pue_Ubicacion FROM PuestosCaja';
		$rows = $this->db->query($qrows);
                return $rows->result();
		
	}
}

?>
