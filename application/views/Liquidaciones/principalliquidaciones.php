<h2>EGRESO - Pago de Honorarios:</h2>
<fieldset>
 <?php echo form_open('liquidaciones/search'); ?> 


		<h3>Ingresar Curso:</h3>

 
   
     
        <form method="post" action="http://127.0.0.1/SC/index.php?/liquidaciones/search">
		
		<table>
			<tr>
				<td width="30%" hi>Nombre de Curso</td>
				
				<input type="hidden" name="Cur_Nombre" value=""/>
                                <td><input type="text" name="Cur_Nombre" class="text" value=""/>
<?php echo form_error('Cur_Nombre'); ?>
				</td>
                           
				<td><input type="submit" value="Buscar"/></td> 
			</tr>
                       
                </table>  
        </form>    
                
       <P align="right"> <?php //echo anchor('person/index/','Listado Completo de Alumnos',array('class'=>'add')); ?></P>	





     
    
       <!-- Fin del cuerpo de la pantalla -->     
        
        
           </fieldset>