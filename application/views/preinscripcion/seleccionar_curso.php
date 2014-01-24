<?php echo form_fieldset('Preinscripción');
      echo form_open('preinscripcion/');?>
    <div>
        <ul>
            <p>
            <?php // var_dump($result);
            foreach ($query_cursos->result_array() as $row) {
                         $cursos[($row['Cur_Id'])]= $row['Cur_Nombre'];
                         }
                 echo form_label('Seleccionar Curso', 'cursos');
                 echo form_dropdown('curso_elegido', $cursos, 
				set_value('Central'), 'id="cursos"');
                        ?>
            </p>
            <p> <?php echo form_submit(array('name'=>'submit'),'Continuar'); ?></p>
        </ul>
    </div>
    
    <?php echo form_close(); 
          echo form_fieldset_close();?>
