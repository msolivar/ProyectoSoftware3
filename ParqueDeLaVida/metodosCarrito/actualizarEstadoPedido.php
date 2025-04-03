<?php
	require_once('../conexion.php');

    $idPedido = isset($_POST["idPedido"]) ? trim($_POST["idPedido"]) : "";
    $estadoPedido = isset($_POST["estadoPedido"]) ? trim($_POST["estadoPedido"]) : "";

	// Actualizar el estado del pedido
    $sql = "UPDATE factura SET estadoPago = '".$estadoPedido."' WHERE id = '".$idPedido."'";
    $res=mysqli_query($conexion,$sql);

    //Pendiente Notificar Correo cuando cambie estado a Enviado
    // if($estadoPedido == "Enviado"){

    // }

    if ($res) {
        echo "Pedido Actualizado.";
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
?>