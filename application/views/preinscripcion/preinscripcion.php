<?php echo form_fieldset('Preinscripción');
      echo form_open('preinscripcion/inscribir/'.$curso);?>
    <div>
        
            <h><?php echo ('Ha elegido inscribirse al curso de: '.$nombre_curso['Cur_Nombre']); ?></h>
            <p>
                <small style="color:red;"><?php echo validation_errors(); ?></small> 
            </p>
            <p><?php echo 'Elija un horario: ';//form_label('Elija un horario: ');  ?> </p>
            <p><?php //var_dump($nombre_curso) ;
            echo form_dropdown('dictado_elegido', $dictados, 
				set_value('dictado_elegido'), 'name="dictado_elegido"');
            ?>
                
            </p>
            <p>
            <h><?php echo 'Complete los siguientes datos:';  ?></h>
            </p>
            <div style="width: 57%; ">
            <div style="float:left">
                <div>
                <dni style="float:left">
                  <?php  echo 'DNI ';
                  //     echo form_input(array('id'=>'dni','name'=>'dni')); ?>
                 
                </dni>
                <campo style="float:right">
                    <input type="text" name="dni" value="<?php echo set_value('dni'); ?>" />
                 
                </campo>
                 </div><br/>
                <div >
                <etiqueta style="float:left"> <?php 
                echo 'Nombre y Apellido ';//form_label('Nombre y Apellido', 'nombre_apellido');
                      // echo form_input(array('id'=>'nya','name'=>'nya',set_value('dictado_elegido'))); ?>
                </etiqueta>
                    <field style="float:right">
                 <input type="text" name="nya" value="<?php echo set_value('nya'); ?>" />
                    </field> 
                 </div><br/>
                <div >
                <tel style="float:left"> <?php  echo 'Teléfono ';//form_label('Teléfono', 'telefono');
                       //echo form_input(array('id'=>'telefono','name'=>'telefono')); ?>
                </tel>
                    <field style="float:right">
                  <input type="text" name="telefono" value="<?php echo set_value('telefono'); ?>" />
                    </field> 
                 </div><br/>
                
            </div>
            <div style="float:right">
                <div>
                <clave style="float:left">
                  <?php  echo 'Clave';
                     //   echo form_input(array('id'=>'direccion','name'=>'direccion')); ?>
                </clave>
                <field style="float:right">
                   <input type="password" name="clave" value="<?php echo set_value('clave'); ?>" />
                </field>
                 </div><br/>
                <div >
                <domicilio style="float:left">  <?php  echo 'Domicilio   '//form_label('Domicilio', 'direccion');
                    //   echo form_input(array('id'=>'direccion','name'=>'direccion')); ?>
                </domicilio>
                    <field style="float:right">
                 <input type="text" name="direccion" value="<?php echo set_value('direccion'); ?>" />
                    </field> 
                 </div> <br/>
                <div >
                <mail style="float:left"> <?php  echo 'E-Mail ';//form_label('E-Mail', 'email');
                       //echo form_input(array('id'=>'email','name'=>'email')); ?>
                </mail>
                    <field style="float:right">
                  <input type="text" name="email" value="<?php echo set_value('email'); ?>" />
                    </field> 
                 </div><br/>
            
            </div>
            
            </div>
            <div style="clear:both;" >
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
            </div>
            
           <div style="clear:both;"><?php  echo form_submit(array('name'=>'submit'),'Preinscribir'); ?></div>
          
    
          <?php echo form_close(); 
          
          echo form_fieldset_close();?>