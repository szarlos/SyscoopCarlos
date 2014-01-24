<?php
class Movimiento_model extends CI_Model {
	
	private $MovimientosCaja= 'MovimientosCaja';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('Mov_Id','asc');
		return $this->db->get(MovimientosCaja);
	}
	
	function count_all(){
		return $this->db->count_all($this->MovimientosCaja);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
             $qSqlA='SELECT * FROM MovimientosCaja ORDER BY Mov_Id ASC';
             $eSqlA = $this->db->query($qSqlA);
             return $eSqlA; 
                    
        }

	
	function get_by_id($Mov_Id){
         $qSqlA="SELECT * FROM MovimientosCaja WHERE Mov_Id='$Mov_Id'";
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
	 
	}
	
	function save($person){
		//$this->db->insert($this->MovimientosCaja, $person);
              
                $Caj_Id = $person['Caj_Id'];               
                $TipMov_Id  = $person['TipMov_Id'];
                $Mov_Mono = $person['Mov_Mono'];  
                $Mov_FechaHora = $person['Mov_FechaHora'];
                $Mov_IngresoEgreso = $person['Mov_IngresoEgreso']; 
                $Mov_Descripcion = $person['Mov_Descripcion'];
                $Mov_Anulado = $person['Mov_Anulado'];
                $Mov_FormadePago = $person['Mov_FormadePago'];                   
                $Sec_Id = $person['Sec_Id'];                     
                $Dir_Id = $person['Dir_Id'];                   
                $Gru_Id = $person['Gru_Id'];                
                $Cur_Id = $person['Cur_Id'];        
                $Dic_Id = $person['Dic_Id'];           
                $Cuo_Numero = $person['Cuo_Numero'];
                echo 'la fecha del mov es ';
                echo $Mov_FechaHora;
              
               //en el inset se coloca la fecha sin comillas para que no tome como string, al ser solo date lleva comilla
               
               
		$qSqlA = "INSERT INTO MovimientosCaja 
           (Caj_Id
           ,TipMov_Id
           ,Mov_Mono
           ,Mov_FechaHora
           ,Mov_IngresoEgreso
           ,Mov_Descripcion
           ,Mov_Anulado
           ,Mov_FormaDePago
           ,Sec_Id
           ,Dir_Id
           ,Gru_Id
           ,Cur_Id
           ,Dic_Id)
                           VALUES ('$Caj_Id', '$TipMov_Id', '$Mov_Mono', '$Mov_FechaHora', '$Mov_IngresoEgreso', '$Mov_Descripcion', '$Mov_Anulado', '$Mov_FormadePago', '$Sec_Id', '$Dir_Id', '$Gru_Id', '$Cur_Id', '$Dic_Id')";
         $eSqlA = $this->db->query($qSqlA);
                if ($eSqlA){
                    
                       $qSqlA="SELECT * FROM Cuotas WHERE Cuotas.Cuo_Numero='$Cuo_Numero'";
                        $eSqlA = $this->db->query($qSqlA);

                     foreach ($eSqlA->result_array() as $row) 
                        {                         
                         $Cuo_Numero = $row['Cuo_Numero'];
                        
                         $Cur_Id = $row['Cur_Id'];
                         
                         $Dic_Id = $row['Dic_Id'];
                        
                         $Alu_Id = $row['Alu_Id'];
                        
                         $Cuo_FechaVto = $row['Cuo_FechaVto'];
                        
                         $Cuo_Monto = $row['Cuo_Monto'];
                         
                         $Cuo_MontoPagado = $row['Cuo_MontoPagado'];
                        
                         
                         }               
                 $diferencia =   $Cuo_Monto -  $Cuo_MontoPagado  ; 
                 $acobrar = $Cuo_MontoPagado + $Mov_Mono;
                  
      
                 if ($acobrar  <= $Cuo_Monto)
                     { 
                     //echo 'entra a l bucke update';
                            $sql="UPDATE Cuotas 
                           SET Cur_Id='$Cur_Id',
                               Dic_Id='$Dic_Id',
                               Alu_Id='$Alu_Id',
                               Cuo_FechaVto='$Cuo_FechaVto',
                               Cuo_Monto='$Cuo_Monto',                  
                               Cuo_MontoPagado='$acobrar'
                           WHERE Cuo_Numero='$Cuo_Numero'";
                            $esql = $this->db->query($sql);        
                       }
                    
                        else    
                        {  
                        $tope = 0;
                        
                       
                           $sql="UPDATE Cuotas 
                           SET Cur_Id='$Cur_Id',
                               Dic_Id='$Dic_Id',
                               Alu_Id='$Alu_Id',
                               Cuo_FechaVto='$Cuo_FechaVto',
                               Cuo_Monto='$Cuo_Monto',                  
                               Cuo_MontoPagado='$Cuo_Monto'
                           WHERE Cuo_Numero='$Cuo_Numero'";
                            $esql = $this->db->query($sql);        
       
                             $Mov_Mono = $Mov_Mono - $diferencia ; 
                           
                             while ($Cuo_Monto  <= $Mov_Mono)
                            {
                            
                           $Cuo_Numero = $Cuo_Numero + 1;
                            echo 'la cuota que sigue es ';
                            echo $Cuo_Numero;
                            $sql="UPDATE Cuotas 
                           SET Cur_Id='$Cur_Id',
                               Dic_Id='$Dic_Id',
                               Alu_Id='$Alu_Id',
                               Cuo_FechaVto='$Cuo_FechaVto',
                               Cuo_Monto='$Cuo_Monto',                  
                               Cuo_MontoPagado='$Cuo_Monto'
                           WHERE Cuo_Numero='$Cuo_Numero'";
                            $esql = $this->db->query($sql); 
                              echo 'la cuota que sigue es ';
                            
                         $Mov_Mono = $Mov_Mono - $Cuo_Monto;
                      }
                      $Cuo_Numero = $Cuo_Numero + 1;
                        $sql="UPDATE Cuotas 
                           SET Cur_Id='$Cur_Id',
                               Dic_Id='$Dic_Id',
                               Alu_Id='$Alu_Id',
                               Cuo_FechaVto='$Cuo_FechaVto',
                               Cuo_Monto='$Cuo_Monto',                  
                               Cuo_MontoPagado='$Mov_Mono'
                           WHERE Cuo_Numero='$Cuo_Numero'";
                            $esql = $this->db->query($sql);         
              
                       
                        return $esql;  
                           
                            
      
                            
                        
                        
                        }
             }      
               
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