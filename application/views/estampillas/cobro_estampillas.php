<h2><?php echo 'INGRESO - Estampillas'; ?></h2>
<fieldset>
<small style="color:red;">
<?php foreach ($estampillas as $estampilla){
echo validation_errors(); }?>
</small>
<?php echo form_open('estampillas/registrar'); ?>
<?php         
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Tramite','Valor','Stock Actual','Cantidad Vendida');
	
	foreach ($estampillas as $estampilla){
                $id=$estampilla->Est_Id;
		$this->table->add_row($estampilla->Est_Tramite,
                              $valor= "$ $estampilla->Est_Valor",
                              $estampilla->Est_Stock,
                              form_input($id, set_value('0'), 'id=$id')
			);
	}
	$table = $this->table->generate();
        echo $table;


?>      
<div style="text-align:right">    
    <?php echo form_submit('action', 'Aceptar'); ?>

</div>
<?php form_close(); ?>  
</fieldset>