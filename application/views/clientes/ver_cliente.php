<?php echo form_fieldset($subtitulo);?>
<!--<h5>Cliente</h5>-->
<div class="content">
		
	<div class="data">
                <?php foreach ($clientes as $cliente) {
                ?>
		<table>
			<tr>
				<td width="25%"><b>ID</b></td>
				<td><?php echo $cliente->Cli_Id; ?></td>
			</tr>
			<tr>
				<td><b>Apellido y Nombre</b></td>
				<td><?php echo $cliente->Cli_ApeNom; ?></td>
			</tr>
			<tr>
				<td><b>DNI</b></td>
				<td><?php echo $cliente->Cli_DNI;?></td>
			</tr>
                        <tr>
				<td><b>CUIL/CUIT</b></td>
				<td><?php echo $cliente->Cli_CUIL; ?></td>
			</tr>
                        <tr>
				<td><b>Domicilio</b></td>
				<td><?php echo $cliente->Cli_Direccion; ?></td>
			</tr>
                        <tr>
				<td><b>Teléfono</b></td>
				<td><?php echo $cliente->Cli_Telefono; ?></td>
			</tr>                        
                        <tr>
				<td><b>e-mail</b></td>
				<td><?php echo $cliente->Cli_Email; ?></td>
			</tr>
			<tr>
				<td><b>Nombre de la Empresa</b></td>
				<td><?php echo $cliente->Cli_NomEmpresa; ?></td>
			</tr>
		</table>
                <?}?>    
		</div>
</div>
