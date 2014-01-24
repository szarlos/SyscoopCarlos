    <fieldset>
	<small style="color:red;"><?php echo validation_errors(); ?></small>
 <?php echo form_open('person/cobrarcuotas'); ?>
    
    <!-- aca comienza el cuerpo -->
    
         <div class="content">
		<h1>Cobro de Cuotas:</h1>

	
	</div>
	<div class="">
		<h1><?php// echo $title; ?></h1>
                <div class="data"><?php //echo $table; ?></div>
         
		<h1><?php //echo'Cuota Seleccionada'; ?></h1>
                <div class="data"><?php //echo $table1; ?></div>
              
                
                          <h1 id="site-description2" align="left">Curso:   <?php echo $Cur_Nombre; ?></h1>
          
          <h1 id="site-description2" align="left">Alumno:   <?php echo $Alu_ApeNom; ?></h1>
                
                
                
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
                
	  <br />
          

            
          <div class="content"><h1><?php echo'Datos de Cuota'?></h1></div>
          <?php echo $message2;?> </br>
          <?php echo $message3; ?>
                <br><br/>
                   
                 <table>
			<tr>
				<td valign="top">Numero de Cuota a Cobrar<span style="color:red;">*</span></td>
				<td><input type="text" name="Cuo_Numero" class="text"  value="<?php echo set_value('Cuo_Numero', $Cuo_Numero); ?>"/>
<?php echo form_error('Cuo_Numero'); ?>
				</td>
			</tr>
			<tr>
                            <td valign="top">Fecha de Vencimiento (dd-mm-aaaa)<span style="color:red;">*</span></td>
				<td><input type="text" name="Cuo_FechaVto" disabled onclick="displayDatePicker('Cuo_FechaVto');" class="text" value="<?php echo set_value('Cuo_FechaVto', $Cuo_FechaVto); //$this->form_data->Cuo_FechaVto); ?>"/>
				<a href="javascript:void(0);" onclick="displayDatePicker('Cuo_FechaVto');"></a>
<?php echo form_error('Cuo_FechaVto'); ?></td>
				</td>
			</tr>
			<tr>
				<td valign="top">Valor<span style="color:red;">*</span></td>
				<td><input type="text" name="Cuo_Monto" class="text" disabled  value="<?php echo $Cuo_Monto; ?>"/>
<?php echo form_error('Cuo_Monto'); ?>
				</td>
			</tr>
			
                     <tr>
				<td valign="top">Monto Pagado<span style="color:red;">*</span></td>
				<td><input type="text" name="Cuo_MontoPagado" class="text" disabled value="<?php echo set_value('Cuo_MontoPagado', $Cuo_MontoPagado); //$this->form_data->Cuo_MontoPagado); ?>"/>
<?php echo form_error('Cuo_MontoPagado'); ?>
				</td>
			</tr>
                       
                        <tr>
				<td valign="top">Monto a Abonar<span style="color:red;">*</span></td>
				<td><input type="text" name="monto" class="text" value="<?php echo set_value('monto', $monto); //$this->form_data->monto); ?>"/>
<?php echo form_error('monto'); ?>
				</td>
			</tr>
		
                    	<tr>
                            <td valign="top">Fecha de Pago (dd-mm-aaaa)<span style="color:red;">*</span></td>
				<td><input type="text" name="fecha" onclick="displayDatePicker('fecha');" class="text" value="<?php echo set_value('fecha', $fecha)	; //$this->form_data->fecha); ?>"/>
				<a href="javascript:void(0);" onclick="displayDatePicker('fecha');"><img src="<?php echo base_url(); ?>css/images/calendar.png" alt="calendar" border="0"></a>
<?php echo form_error('fecha'); ?></td>
				</td>
			</tr>
                     
                        <tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Cobrar"/></td>
			</tr>
		</table>
		</div> 
		</form>
		<br />
		<?php //echo $link_back; ?>
	</div>
  
         
  <!-- Fin del cuerpo de la pantalla -->     
               
         
             </fieldset>      
