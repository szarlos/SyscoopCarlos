<?php echo form_fieldset($subtitulo);?>
<small style="color:red;"><?php echo validation_errors(); ?></small>
<?php echo form_open('clientes/registrar'); ?>
<div class="content">

		<table>
			<tr>
				<td style="text-align: right" width="25%"><b>Apellido y Nombre</b></td>
				<td><?php echo form_input('nom', set_value('nom'), 'id="nom"'); ?></td>
			</tr>
			<tr>
				<td style="text-align: right"><b>DNI</b></td>
				<td><?php echo form_input('dni', set_value('dni'), 'id="dni"'); ?></td>
			</tr>
                        <tr>
				<td style="text-align: right"><b>CUIL/CUIT</b></td>
				<td><?php echo form_input('cuil', set_value('cuil'), 'id="cuil"'); ?></td>
			</tr>
                        <tr>
				<td style="text-align: right"><b>Domicilio</b></td>
				<td><?php echo form_input('dir', set_value('dir'), 'id="dir"'); ?></td>
			</tr>
                        <tr>
				<td style="text-align: right"><b>Teléfono</b></td>
				<td><?php echo form_input('tel', set_value('tel'), 'id="tel"'); ?></td>
			</tr>                        
                        <tr>
				<td style="text-align: right"><b>e-mail</b></td>
				<td><?php echo form_input('email', set_value('email'), 'id="email"'); ?></td>
			</tr>
			<tr>
				<td style="text-align: right"><b>Nombre de la Empresa</b></td>
				<td><?php echo form_input('empresa', set_value('empresa'), 'id="empresa"'); ?></td>
			</tr>
		</table>
  
</div>
<div id="content" style="text-align:right">    
    <?php echo form_submit('aceptar', 'Aceptar'); ?>

</div>
<?php form_close(); ?>  
<?php form_fieldset_close()?>