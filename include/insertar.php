<?php 

	$conexion=mysqli_connect('localhost','root','','barcode');
	
if(isset($_POST)){
	if (strlen($_POST['nombre']) >= 1 && strlen($_POST['codigo']) >= 1) {
		  $nombre = trim($_POST['nombre']);
		  $codigo = trim($_POST['codigo']);

	$consulta = "INSERT INTO tabla (nombre, codigo) VALUES ('$nombre', '$codigo')";
     $resultado=mysqli_query($conexion, $consulta);

		if($resultado){
echo'El registro fue guardado correctamente';
      
		}else{
			echo 'Error al guardar los datos';
		}
}else{
	echo 'No data';
}
}
 ?>