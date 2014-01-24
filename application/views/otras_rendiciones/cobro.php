<h2>INGRESO - Rendiciones de Otras Cajas</h2>
<fieldset>
<small style="color:red;">
<?php foreach ($cajeros as $cajero){
echo validation_errors(); }?>
</small>
<?php echo form_open('otras_rendiciones/registrar'); ?>
<?php         
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Apellido y Nombre','Monto Registrado','Monto Recibido');
	
	foreach ($cajeros as $cajero){
                $id=$cajero->Usr_Login;
		$this->table->add_row(
                              $cajero->Usr_ApeNom,
                              ' ',
                              form_input($id, set_value('0'), 'id=$id')
			);
	}
	$table = $this->table->generate();
        echo $table;


?>      
<div id="content" style="text-align:right">    
    <?php echo form_submit('action', 'Aceptar'); ?>

</div>
<?php form_close(); ?>  
</fieldset>
