  <h2>Cobro de Cuotas:</h2>
<fieldset>
 <?php echo form_open('person/viewcuotasdictados'); ?>      
 <!-- Cuerpo de la pantalla -->                 
       <P align="right"> <?php 
      
       
       echo anchor('person/estadocuenta/'.$dato,'Ver Estado de Cuenta Completo del Alumno',array('class'=>'add')); ?></P>	





		<h3>Detalle de Cuotas del Alumno</h3>
		<div class="paging"><?php //echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		
                
		
	<br />
       
<div class="content">
		<h1>Cuotas Pendientes de Pago</h1>
		<div class="paging"><?php //echo $pagination; ?></div>
		<div class="data"><?php echo $table1; ?></div>
		
                <br />
		</div>
     
    
       <!-- Fin del cuerpo de la pantalla -->     

   </fieldset>           
        
     