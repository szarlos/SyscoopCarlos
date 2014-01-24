<h2><?php echo 'EGRESO - Anticipos para gastos'; ?></h2>
<small style="color:red;"><?php echo validation_errors(); ?></small>
<?php echo form_open('anticipos/registrar/'.$id); ?>
<b>Autorizado</b>
<fieldset>
<?php echo $table ?>   
</fieldset>
<b>Detalle</b>
<fieldset>
<div>
<p>
    <label for="centros">Centro de Costo<span style="color:red;">*</span></label>    
    <?php echo form_dropdown('centros', $centros,set_value('Decanato'), 'id="centros"'),"</br>";?>
</p>
</div>
<div>
<p>
    <label for="descripcion">Descripción: <span style="color:red;">*</span></label>
    <?php echo form_textarea('descripcion', set_value('midescripcion'), 'id="descripcion"'),"</br>";?>
</p>
</div>
<div>
<p>
    <label for="monto">Importe $ <span style="color:red;">*</span></label>
    <?php echo form_input('monto', set_value('0.0'), 'id="monto"'),"</br>";?>
</p>
</div>
    
<div>
    <label></label>
    <?php echo form_submit('action', 'Aceptar'); ?>   
</div></br>
<?php form_close(); ?>  
    <small style="color:red;">* Indica Campo Requerido</small>
</fieldset>

<?php form_fieldset_close()?>
