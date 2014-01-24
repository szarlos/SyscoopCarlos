<?php echo form_fieldset($subtitulo);?>
    <h5>Proveedor</h5>

<?php echo $table ?>     


<h5>Detalle</h5>


<fieldset>

<div>
<?php echo form_open('otros_egresos/registrar/'.$id); ?>

<div id="content">
<p>
        <?$options = array(
                  'Factura'  => 'Factura',
                  'Recibo'    => 'Recibo',
                  
                  );
        echo "<b>Comprobante Tipo</b>", form_dropdown('comp_tipo', $options,set_value('Factura'), 'id="comp_tipo"');?>

        <?echo "<b>Comprobante Nº </b>", form_input('comp_nro', set_value('0'), 'id="comp_nro"'),"</br>";?>
</p>
<p>
        <?$options = array(
                  'Contado'  => 'Contado',
                  'Cheque'    => 'Cheque',
                  );
        echo "<b>Forma de Pago </b>", form_dropdown('formaPago', $options,set_value('Contado'), 'id="formaPago"'),"</br>";?>
</p>
<p>
        <?echo "<b>Centros de Costo </b>", form_dropdown('centros', $centros,set_value('Decanato'), 'id="centros"'),"</br>";?>
</p>
<p>
        <?echo "<b>Descripcion </b>", form_textarea('descripcion', set_value('midescripcion'), 'id="descripcion"'),"</br>";?>
</p>
<p>
        <?echo "<b>Monto $ </b>", form_input('monto', set_value('0.0'), 'id="monto"'),"</br>";?>
</p>
</div>
    
<div id="content" style="text-align:right">    
    <?php echo form_submit('action', 'Aceptar'); ?>
    
</div>
<?php form_close(); ?>  
</fieldset>

<?php form_fieldset_close()?>
