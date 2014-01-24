<h2><?php echo 'EGRESO - Anticipos para gastos'; ?></h2>
<fieldset>
<?php echo form_open('anticipos/imprimir/'.$id); ?>

    
    <?php 
        
        echo $message;              
    ?>
    
<div>

    <?php echo form_submit('action', 'Imprimir'); ?>
    
</div>
 
<?php form_close(); ?>  
</fieldset>