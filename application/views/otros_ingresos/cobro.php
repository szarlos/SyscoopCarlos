<h2>INGRESO - Otros Ingresos</h2>
<small style="color:red;"><?php echo validation_errors(); ?></small>
<?php echo form_open('otros_ingresos/cobrar/'.$id); ?>
<b>Cliente</b>
<fieldset>
<?php echo $table ?>   
</fieldset>
<b>Detalle</b>
<fieldset>
<div>
    <label for="comp_nro">Recibo Nº <span style="color:red;">*</span></label>
    <?php echo form_input('comp_nro', set_value('comp_nro','0000-00000000'), 'id="comp_nro"'); ?>
    
</div>
<div>
    <label for="formaPago">Forma de Pago <span style="color:red;">*</span></label>
        <?php $options = array(
                  ''  => '',
                  'Contado'  => 'Contado',
                  'Cheque'    => 'Cheque',
                  );
        echo form_dropdown('formaPago', $options,set_value('Contado'), 'id="formaPago"','size="35"'),"</br>";?>
    
</div>
<div>
    <label for="descripcion">Centro de Costo<span style="color:red;">*</span></label>
    <?php echo form_dropdown('centros', $centros,set_value('Decanato'), 'id="centros"');?>    
</div>
<div>
    <label for="descripcion">Descripción <span style="color:red;">*</span></label>
    <?php echo form_textarea('descripcion','','id="descripcion"'); ?>
    
</div>
<div>
    <label for="monto">Importe $ <span style="color:red;">*</span></label>
    <?php echo form_input('monto','','id="monto"'); ?>
</div>
<div>
    <label></label>
    <?php echo form_submit('action', 'Aceptar'); ?>
</div>
<small style="color:red;">* Indica Campo Requerido</small>
</fieldset>  
<?php form_close(); ?>  