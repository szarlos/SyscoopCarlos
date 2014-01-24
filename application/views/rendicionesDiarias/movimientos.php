<h2>INGRESO - Rendiciones Diarias</h2>
<fieldset>
        <?php echo $table;?>
</fieldset>
<?php echo form_open('rendiciones/imprimir/'.$caja_id); ?>
    
<div>

    <?php echo form_submit('action', 'Imprimir'); ?>
    
</div>
 
<?php form_close(); ?> 