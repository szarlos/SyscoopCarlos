<h2><?php echo $subtitulo;?></h2>
<fieldset>
<?php echo form_open('liquidaciones/registrar/'.$id); ?>

    <b> Profesor</b>
    <?php 
        
        $this->table->set_empty("&nbsp;");
        $this->table->add_row("<b>Nombre: </b>$apeNom",
                              "<b>DNI: </b>$dni");
        $this->table->add_row("<b>Nombre del Curso: </b>$CurNombre",
                              "<b>Lugar de Dictado: </b>$lugardictado");    
        echo $this->table->generate();              
    ?>
    
    </br>
    <b>Detalle</b>
    <?php
    // Genero la tabla que muestra el detalle del movimiento

                    $this->table->set_empty("&nbsp;");
                        $this->table->add_row("<b>Recibo Nº: </b>$comp_nro");
                        $this->table->add_row("<b>Forma de Pago: </b>$formaPago");
                        $this->table->add_row("<b>Descripción: </b>$desc");
                        $this->table->add_row("<b>Importe: </b>$monto");

                    echo $this->table->generate();
    ?>
    <input type="hidden" name="comp_nro" value="<?php echo set_value('formaPago',$comp_nro); ?>"/>
    <input type="hidden" name="formaPago" value="<?php echo set_value('formaPago',$formaPago); ?>"/>
    <input type="hidden" name="desc" value="<?php echo set_value('desc',$desc); ?>"/>
    <input type="hidden" name="monto" value="<?php echo set_value('monto',$monto); ?>"/>
<div>

    <?php echo form_submit('action', 'Confirmar'); ?>
    <?php //echo $link_back; ?>
</div>
 
<?php form_close(); ?>  
</fieldset>