<h2>INGRESO - Radios</h2>
<fieldset>
<?php echo form_open('radios/buscar'); ?>
        <small><b>Nombre de Cliente</b></small></br>
	<?php echo form_input('cliente', set_value('cliente'), 'id="cliente"'); ?>        
	<?php echo form_submit('action', 'Buscar'); ?>
<?php echo form_close(); ?> 
<hr />

<div class="data"  style="text-align:right">
    <?php echo $table ?>
</div> 

</fieldset>