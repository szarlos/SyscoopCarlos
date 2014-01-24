<?php echo form_fieldset($subtitulo);?>
<?php echo form_open('clientes/editar_/'.$cliente->Cli_Id); ?>
<div class="content">

		<table>
			<tr>
				<td style="text-align: right" width="25%"><b>Apellido y Nombre</b></td>
				<td><?php echo form_input('nom', set_value('nom',$cliente->Cli_ApeNom), 'id="nom"'); ?></td>
			</tr>
			<tr>
				<td style="text-align: right"><b>DNI</b></td>
				<td><?php echo form_input('dni', set_value('dni',$cliente->Cli_DNI), 'id="dni"'); ?></td>
			</tr>
                        <tr>
				<td style="text-align: right"><b>CUIL/CUIT</b></td>
				<td><?php echo form_input('cuil', set_value('cuil',$cliente->Cli_CUIL), 'id="cuil"'); ?></td>
			</tr>
                        <tr>
				<td style="text-align: right"><b>Domicilio</b></td>
				<td><?php echo form_input('dir', set_value('dir',$cliente->Cli_Direccion), 'id="dir"'); ?></td>
			</tr>
                        <tr>
				<td style="text-align: right"><b>Teléfono</b></td>
				<td><?php echo form_input('tel', set_value('tel',$cliente->Cli_Telefono), 'id="tel"'); ?></td>
			</tr>                        
                        <tr>
				<td style="text-align: right"><b>e-mail</b></td>
				<td><?php echo form_input('email', set_value('email',$cliente->Cli_Email), 'id="email"'); ?></td>
			</tr>
			<tr>
				<td style="text-align: right"><b>Nombre de la Empresa</b></td>
				<td><?php echo form_input('empresa', set_value('empresa',$cliente->Cli_NomEmpresa), 'id="empresa"'); ?></td>
			</tr>
		</table>
  
    </div>
    <div id="content" style="text-align:right">    
   <?php echo form_submit('action', 'Aceptar'); ?>

    </div>
    <?php form_close(); ?>  
    <?php form_fieldset_close()?>