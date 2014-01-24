<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Listado de Alumnos</title>

<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
        <h1>Datos del Alumno</h1>
       
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $person->$Alu_Id; ?></td>
			</tr>
			
			<tr>
				<td valign="top">DNI</td>
				<td><?php echo $person->Alu_DNI; ?></td>
			</tr>
		
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>