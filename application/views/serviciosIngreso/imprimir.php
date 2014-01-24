<h2>INGRESO - Servicios a Terceros</h2>
<fieldset>
<?php echo form_open('servicios_ingreso/imprimir/'.$mov_id); ?>

    
    <?php 
        
        echo $message;              
    ?>
    
<div>

    <?php echo form_submit('action', 'Imprimir'); ?>
    
</div>
 
<?php form_close(); ?>  
</fieldset>