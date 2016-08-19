<?php
	require_once('clases/Personas.php');

	$ArrayDePersonas = Alumno::TraerTodasLasPersonas();

	echo "<table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Nombre     </th>
					<th>  Apellido   </th>
					<th>  Legajo     </th>
					<th>  BORRAR     </th>
					<th>  MODIFICAR  </th>
				</tr> 
			</thead>";   	

		foreach ($ArrayDePersonas as $personaAux){
			echo "<pre>";
			print_r($personaAux);
			echo "</pre>";
			echo " 	<tr>
						
						<td>".$personaAux->GetNombre()."</td>
						<td>".$personaAux->GetApellido()."</td>
						<td>".$personaAux->GetLegajo()."</td>
						<td><button class='btn btn-danger' name='Borrar' onclick='Borrar(".$personaAux->GetId().")'>   <span class='glyphicon glyphicon-remove-circle'>&nbsp;</span>Borrar</button></td>
						<td><button class='btn btn-warning' name='Modificar' onclick='Modificar(".$personaAux->GetId().")'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Modificar</button></td>
					</tr>";
		}	
	echo "</table>";		
?>
