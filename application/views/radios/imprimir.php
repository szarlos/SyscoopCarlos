<h2>INGRESO - Radios</h2>
<fieldset>
<?php echo form_open('radios/imprimir/'.$mov_id); ?>

    
    <?php 
        
        echo $message;              
    ?>
    
<div>

    <?php echo form_submit('action', 'Imprimir'); ?>
    
</div>
 
<?php form_close(); ?>  
</fieldset>