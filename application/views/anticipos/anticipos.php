<h2><?php echo 'EGRESO - Anticipos para gastos'; ?></h2>
<fieldset>

<div class="content">
    <?php echo form_open('anticipos/buscar'); ?>

        <small><b>Nombre de Autorizado</b></small></br>
	<?php echo form_input('autorizado', set_value('autorizado'), 'id="autorizado"'); ?>
        
	<?php echo form_submit('action', 'Buscar'); ?>
    
	
<?php echo form_close(); ?>  
<hr />
<div class="data"  style="text-align:right">
    <?php echo $table ?>
</div> 
</div>
</fieldset>
