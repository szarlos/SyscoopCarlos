<h2><?php echo $subtitulo;?></h2>
<fieldset>
<?php echo form_open('alquileres/registrar/'.$id); ?>

    <b>Cliente</b>
    <?php 
        
        $this->table->set_empty("&nbsp;");
        $this->table->add_row("<b>Nombre: </b>$apeNom",
                              "<b>Domicilio: </b>$dir");
        $this->table->add_row("<b>IVA: </b>$iva",
                              "<b>CUIL/CUIT: </b>$cuil");    
        echo $this->table->generate();              
    ?>
    
    </br>
    <b>Detalle</b>
    <?php
    // Genero la tabla que muestra el detalle del movimiento

                    $this->table->set_empty("&nbsp;");

                        $this->table->add_row("<b>Forma de Pago: </b>$formaPago");
                        $this->table->add_row("<b>Descripción: </b>$desc");
                        $this->table->add_row("<b>Importe: </b>$monto");

                    echo $this->table->generate();
    ?>
    <input type="hidden" name="apeNom" value="<?php echo set_value('apeNom',$apeNom); ?>"/>
    <input type="hidden" name="cli_id" value="<?php echo set_value('cli_id',$cli_id); ?>"/>
    <input type="hidden" name="comp_nro" value="<?php echo set_value('comp_nro',$comp_nro); ?>"/>
    <input type="hidden" name="formaPago" value="<?php echo set_value('formaPago',$formaPago); ?>"/>
    <input type="hidden" name="desc" value="<?php echo set_value('desc',$desc); ?>"/>
    <input type="hidden" name="monto" value="<?php echo set_value('monto',$monto); ?>"/>
<div>

    <?php echo form_submit('action', 'Confirmar'); ?>
    <?php //echo $link_back; ?>
</div>
 
<?php form_close(); ?>  
</fieldset>