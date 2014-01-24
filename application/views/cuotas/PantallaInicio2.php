 <fieldset>
 <?php echo form_open('person/cobrarcuotas'); ?>       
    
<!-- Cuerpo de la pantalla -->    
<div class="content">
		<h4>Cobro de Cuotas:</h4>

	
	</div>

<h1></h1>
<div class="">
		<h1>Elija Opcion de Busqueda:</h1>
	<br></br>
	
	</div>
 
   
     
       
        
       <P align="left"> <?php echo anchor('person/principal/','Buscar Alumno',array('class'=>'buscar')); ?></P>	
</p>
       <P align="left"> <?php echo anchor('person/principal2/','Buscar Curso',array('class'=>'buscar')); ?></P>	
       
    <div class="content">
		<h4>Cuota Cobrada</h4>
	
	
	</div>

       <div class="">
		<h1></h1>
		<div class="paging"><?php //echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />
		<?php // echo anchor('person/add/','Tratar Preinscripcion',array('class'=>'add')); ?>
	</div>

     
    
       <!-- Fin del cuerpo de la pantalla -->     
                 </fieldset>      
