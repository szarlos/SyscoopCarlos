<?php echo form_fieldset($subtitulo);?>
<?php echo form_open('otros_egresos/buscar'); ?>
    <div class="content">
        <?php echo form_label('Nombre Proveedor', 'proveedor'); ?>
	<?php echo form_input('proveedor', set_value('proveedor'), 'id="proveedor"'); ?>
        
	<?php echo form_submit('action', 'Buscar'); ?>
    
	
<?php echo form_close(); ?>  

    <div class="data"  style="text-align:right">
        <?php echo $nuevo_proveedor; ?>
    </div>     
    <?php echo $table ?>

</div>
<?php form_fieldset_close() ?>