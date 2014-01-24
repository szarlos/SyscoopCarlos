<h1>Usted se ha inscripto al Curso de: <?php echo $curso; ?></h1>
<p>En el horario de: </p>
<p><?php echo $dictado_elegido ?></p>
<p>Con los siguientes Datos:</p>
<p>DNI: <?php echo $preinscripcion['Pre_DNI'];  ?></p>
<p>Nombre: <?php echo $preinscripcion['Pre_Usr_ApeNom'];  ?></p>
<p>Domicilio: <?php echo $preinscripcion['Pre_Usr_Direccion'];  ?></p>
<p>Teléfono: <?php echo $preinscripcion['Pre_Usr_Telefono'];  ?></p>
<p>E-Mail: <?php echo $preinscripcion['Pre_Usr_Mail'];  ?></p>
<p>fuentes: <?php// echo $fuentes;  ?></p>
<p> <button><?php echo anchor('preinscripcion','Continuar') ?> </button> </p>
