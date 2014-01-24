<?php echo "<h2>$subtitulo</h2>";
echo form_fieldset();
foreach ($result->result_array() as $row) {
                         $puestos[($row['Pue_Id'])]= $row['Pue_Ubicacion'];
                         } 
echo form_open('index/abrir_caja');?>
    <div>

                <?php  echo form_label('Monto apertura', 'monto');
                echo form_input(array('id'=>'monto','name'=>'monto')); ?>
    </div>
    <div>
                <?php // var_dump($result);
                 echo form_label('Puestos de Caja', 'puestos');
                 echo form_dropdown('puesto_elegido', $puestos, 
				set_value('Central'), 'id="puestos"') ?>
    </div>
<div>
            <p>
                <?php echo validation_errors(); ?>
                <?php echo form_submit(array('name'=>'submit'),'Abrir'); ?>
            </p>

    </div>
    
    <?php echo form_close(); 
    echo form_fieldset_close();
    ?>
