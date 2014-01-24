<h2>INGRESO - Otros Ingresos</h2>
<fieldset>
<?php echo form_open('otros_ingresos/imprimir/'.$mov_id); ?>

    
    <?php 
        
        echo $message;              
    ?>
    
<div>

    <?php echo form_submit('action', 'Imprimir'); ?>
    
</div>
 
<?php form_close(); ?>  
</fieldset>