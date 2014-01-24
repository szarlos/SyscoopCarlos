<?php echo form_fieldset('Preinscripción');
      echo form_open('preinscripcion/ingresar_clave/'.$curso);?>
            
<h>Ha elegido inscribirse al curso de:<?php echo ' '.$nombre_curso['Cur_Nombre']; ?></h>
<br>
                <small style="color:red;"><?php echo validation_errors(); ?>
                <?php //mostrar error
                if (($this->session->flashdata('login_error'))==TRUE) {
                    echo 'DNI o Clave incorrecta';
                }?></small> 
<br>       
            <?php echo ('Elija un horario: ');  ?> <br>
            <p><?php //var_dump($dictados) ;
            echo form_dropdown('dictado_elegido', $dictados, 
				set_value('dictado_elegido'), 'name="dictado_elegido"');
            ?>
                
            </p>
            
             <?php echo 'Ingrese DNI y Clave';  ?>
            <br/>
            <div>
            
                   <?php  echo 'DNI ';//form_label('DNI', 'dni'); 
                  //     echo form_input(array('id'=>'dni','name'=>'dni')); ?>
                    <input type="text" name="dni" value="<?php echo set_value('dni'); ?>" />
            
                <?php  echo 'Clave '//form_label('Clave', 'clave');
                    //   echo form_input(array('id'=>'direccion','name'=>'direccion')); ?>
                <input type="password" name="clave" value="<?php echo set_value('clave'); ?>" />
            
            </div>
            <p><b><?php echo anchor('preinscripcion/inscribir/'.$curso,'No recuerdo la Clave'); ?></b></p>
            <?php echo '¿Cómo te enteraste de este curso?' ;?>
            <div style="width: 30%; ">
            <table>
               <?php    foreach ($fuentes as $key => $value) {
                echo  '<tr><td><input type="checkbox" name= "checkbox'.$key.'"  value="'.$value.'"> '.$value.'</td></tr>';  }?>
                
                <tr><td><?php  echo form_label('Otro: ', 'fuente');?>
                <input type="text" name="fuente" value="<?php echo set_value('fuente'); ?>" style="float:left" />
                    </td></tr>
            
            </table>
            </div>
            <p> <?php echo form_submit(array('name'=>'submit'),'Preinscribir'); ?></p>
    <?php echo form_close(); echo form_fieldset_close();?>