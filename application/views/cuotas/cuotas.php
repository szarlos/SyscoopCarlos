<?php echo form_fieldset($subtitulo);?>

<div class="content">
<?php echo form_open('cuotas/search'); ?>
    
        <?php echo form_label('DNI', 'dni'); ?>
	<?php echo form_input('dni', set_value('dni'), 'id="dni"'); ?>
	<?php echo form_submit('action', 'Buscar'); ?>
    
	
<?php echo form_close(); ?>  
<div class="data">
<p></p>
<?php echo $table ?>
</div>
</div>
<?php form_fieldset_close()?>