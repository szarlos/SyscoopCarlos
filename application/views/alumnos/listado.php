<h1><?php echo $subtitulo;?></h1>
<table>
    <thead>
        <th>Id</th>
        <th>DNI</th>
        <th>Apellido y Nombre</th>
    </thead>
    <tbody>
<?php foreach($alumnos as $alumno){
  
?>
        <tr>
            <td><?php echo $alumno->Alu_Id;?></td>
            <td><?php echo $alumno->Alu_DNI;?></td>
            <td><?php echo $alumno->Alu_ApeNom;?></td>
        </tr>
<?php
        }
?>        
    </tbody>
    <tfoot>
        
    </tfoot>
</table>