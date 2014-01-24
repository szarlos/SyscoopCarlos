<h2><?php echo $subtitulo;?></h2> 
<fieldset>
<div style="width: 60%">
<?php
$tabla= array (array('Descripción','Monto'),
    array('Apertura de Caja','$'.$monto_apertura),
    array('Total Ingresos','$'.$ingresos),
    array('Total Egresos','$'.$egresos),
    array('<b>Total Movimientos</b>','<b>$'.$total.'</b>')
);
echo $this->table->generate($tabla);
?>
    <p>
       <button><?php echo anchor('index/realizar_cierre','Cerrar Caja'); ?> </button>
   </p>
</div>    
<?php echo form_fieldset_close();?>

