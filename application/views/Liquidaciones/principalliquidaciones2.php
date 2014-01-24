<h2>EGRESO - Pago de Honorarios:</h2>
<fieldset>
 <?php echo form_open('liquidaciones/search'); ?> 


		<h3>Ingresar Curso:</h3>

 
   
     
        <form method="post" action="index.php?/liquidaciones/search">
		
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




<div class="content1">
		<h1>Honorarios Pendientes de Pago</h1>
		<div class="paging"><?php //echo $pagination; ?></div>
		<?php echo 'Nombre del Curso: '; echo $nombre; ?><br/>
                <?php echo $message; ?>
                
                <div class="data"><?php echo $table; ?></div>
		<br />
               
                
		<?php // echo anchor('person/add/','Tratar Preinscripcion',array('class'=>'add')); ?>
	</div>

     
    
       <!-- Fin del cuerpo de la pantalla -->     
        
        
           </fieldset>
