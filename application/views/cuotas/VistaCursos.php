 <h2>Cobro de Cuotas:</h2>
 <fieldset>
 <?php echo form_open('person/principal2'); ?>     
      
    
<!-- Cuerpo de la pantalla -->    
    
		<h3>Cursos Activos</h3>
		<div class="paging"><?php //echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />
		<?php // echo anchor('person/add/','Tratar Preinscripcion',array('class'=>'add')); ?>
	
  
       <!-- Fin del cuerpo de la pantalla -->            
      </fieldset>   