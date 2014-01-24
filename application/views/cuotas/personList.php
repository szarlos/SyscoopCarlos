 <h2>Cobro de Cuotas:</h2>
<fieldset>
 <?php echo form_open('person/index'); ?>     
 <?php echo form_open('person/view'); ?>   
<!-- Cuerpo de la pantalla -->    

		

	
		<h3>Listado de Alumnos Inscriptos a Cursos</h3>
		<div class="paging"><?php //echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
                
              
	
                
                
                
                <br />
		<?php echo anchor('person/principalInicio/','Volver a Pantalla Inicial de Busqueda',array('class'=>'add')); ?>
	

     
    
        <!-- Fin del cuerpo de la pantalla -->     

  </fieldset>