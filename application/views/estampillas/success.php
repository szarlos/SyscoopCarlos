<?php 
    echo form_fieldset($subtitulo);
    foreach ($mensajes as $mensaje){
        echo $mensaje;
    }
    
    
    form_fieldset_close()
?>
