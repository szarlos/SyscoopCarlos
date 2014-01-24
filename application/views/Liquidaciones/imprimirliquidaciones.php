<h2><?php echo $subtitulo;?></h2>
<fieldset>
<?php echo form_open('liquidaciones/imprimir/'.$id); ?>

    
    <?php 
        
        echo $message;              
    ?>
    
<div>

    <?php echo form_submit('action', 'Imprimir'); ?>
    
</div>
 
<?php form_close(); ?>  
</fieldset>