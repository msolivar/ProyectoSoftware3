<?php
	require_once('../conexion.php');

	$buscar = isset($_POST["buscar"]) ? trim($_POST["buscar"]) : "";

	$sql="SELECT * FROM usuario WHERE cedula='$buscar'"; 
    $res=mysqli_query($conexion,$sql);
    
    // $row = mysqli_fetch_array($res);

    if (mysqli_num_rows($res) > 0) {
        // Obtener los datos del cliente
        $cliente = mysqli_fetch_assoc($res);
        echo json_encode($cliente);
    }else {
        // Enviar un mensaje de error si no se encuentra el cliente
        echo json_encode(array("error" => "Cliente no encontrado."));
    }

    // Cerrar la conexión
    mysqli_close($conexion);
?>