 <h2>Cobro de Cuotas:</h2>
<fieldset>
 <?php echo form_open('person/principal'); ?>     
    
<!-- Cuerpo de la pantalla -->    
    
<br><br/>
<div class="">
		<h3>Coloque Dni o Apellido de Alumno a Buscar:</h3>
		
	</div>
 
   
     
        <form method="post" action="index.php?/person/search">
		
		<table>
			<tr>
				<td width="30%" hi>DNI del Alumno</td>
				
				<input type="hidden" name="Alu_DNI" value=""/>
                                <td><input type="text" name="Alu_DNI" class="text" value=""/>
<?php echo form_error('Alu_DNI'); ?>
				</td>
                           
				<td><input type="submit" value="Buscar"/></td> 
			</tr>
                       
                </table>  
        </form>    
        <form method="post" action="index.php?/person/search2">
                <table>
                        <tr>
				<td width="30%" hight="50">Apellido del Alumno</td>
				
				<input type="hidden" name="Alu_ApeNom" value=""/>
                                <td><input type="text" name="Alu_ApeNom" class="text" value=""/>
<?php echo form_error('Alu_DNI'); ?>
				</td>
                           
				<td><input type="submit" value="Buscar" /></td> 
			</tr>
		</table>
        
        </form>
        
       <P align="right"> <?php echo anchor('person/index/','Listado Completo de Alumnos',array('class'=>'add')); ?></P>	



<div class="content">
		<h1></h1>
		<div class="paging"><?php //echo $pagination; ?></div>
		<div class="data"><?php //echo $table; ?></div>
		<br />
		<?php // echo anchor('person/add/','Tratar Preinscripcion',array('class'=>'add')); ?>
	</div>

        
     
    
       <!-- Fin del cuerpo de la pantalla -->     
        
             </fieldset>      
  