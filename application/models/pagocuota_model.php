<?php
class Pagocuota_model extends CI_Model {
	
	private $PagosCuotas= 'PagosCuotas';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('Pag_Id','asc');
		return $this->db->get(PagosCuotas);
	}
	
	function count_all(){
		return $this->db->count_all($this->PagosCuotas);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('Alu_Id','asc');
                //return $this->db->get($this->Alumnos, $limit, $offset)
             $qSqlA='SELECT * FROM PagosCuotas ORDER BY Pag_Id ASC';
             $eSqlA = $this->db->query($qSqlA);
             return $eSqlA; 
                    
        }

	
	function get_by_id($Pag_Id){
         $qSqlA="SELECT * FROM PagosCuotas WHERE Pag_Id='$Pag_Id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
	
	function save($person){
		//$this->db->insert($this->MovimientosCaja, $person);
              
                $Cur_Id = $person['Cur_Id'];               
                $Dic_Id  = $person['Dic_Id'];
                $Alu_Id = $person['Alu_Id'];  
                $Cuo_Numero = $person['Cuo_Numero'];
                $MovimientoCaja_Caj_Id = $person['MovimientoCaja_Caj_Id'];                   
                $MovimientoCaja_Mov_Id = $person['MovimientoCaja_Mov_Id'];                     
                                 
               //en el inset se coloca la fecha sin comillas para que no tome como string
    		$qSqlA = "INSERT INTO PagosCuotas 
                (Cur_Id
                ,Dic_Id
                ,Alu_Id
                ,Cuo_Numero
                ,MovimientoCaja_Caj_Id
                ,MovimientoCaja_Mov_Id)
                           VALUES ('$Cur_Id', '$Dic_Id', '$Alu_Id', $Cuo_Numero, '$MovimientoCaja_Caj_Id', '$MovimientoCaja_Mov_Id')";
         $eSqlA = $this->db->query($qSqlA);
                if ($eSqlA){
                    echo 'grabo pago de cuotas';
                      }
                      else{ echo ' NO cargo nada';}
	}
	
	function update($Mov_Id, $person){
		$this->db->where('Mov_Id', $Mov_Id);
		$this->db->update($this->MovimientosCaja, $person);
	}
	
	function delete($Mov_Id){
		$this->db->where('Mov_Id', $Mov_Id);
		$this->db->delete($this->MovimientosCaja);
	}

        
}
?>
