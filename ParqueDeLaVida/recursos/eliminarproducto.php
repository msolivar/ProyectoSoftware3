<?php
	require_once('../conexionbd.php');
	
	$datoBorrar=isset($_REQUEST['idEliminar']) ? $_REQUEST['idEliminar'] : null;

  	$consulta="SELECT * FROM boleto WHERE id='$datoBorrar'";
  	$resultado=mysqli_query($conexion,$consulta);
	$fila=mysqli_fetch_array($resultado);

	$imagen = ($fila['imagenEvento'] != "") ? "../".$fila['imagenEvento']: "";

	if($imagen != ""){
		// echo __FILE__;

		unlink($imagen);
	}

	$sql="DELETE FROM boleto WHERE id='$datoBorrar'";
	// echo $sql;
	mysqli_query($conexion,$sql);

	header("location:../productos.php");
?>