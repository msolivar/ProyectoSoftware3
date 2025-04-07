<?php
require_once('../conexion.php');

$correo = "us1@email.com";

$sql = "SELECT f.id as fid, token FROM factura as f INNER JOIN usuario as u ON u.id = f.usuario_id WHERE email='" . $correo . "'
ORDER BY fechaRegistroPago DESC LIMIT 1";

$res = $conexion->query($sql);
$row = $res->fetch_array();

// Token
$token = empty($row['token']) ? null : $row['token'];
echo $token."</br>";

// Verificar si se ha enviado el token por GET

// Obtener el token almacenado en la sesión
// URL http://localhost/ParqueDeLaVida/recursos/verificarcodigo.php

// Selecionar una factura
$idFactura = empty($row['fid']) ? Null : $row['fid'];
echo $idFactura;

if (!empty($idFactura)) {
    $sql = "UPDATE factura SET estadoPago='Pagado' WHERE id='" . $idFactura . "'";
    $res = $conexion->query($sql);
    header('Location:../verpedido.php');
} else {
    echo '<script type="text/javascript">
  		alert("No se ha proporcionado ningún token para validar.");     
	    window.location="../index.php"
	</script>';
}
?>

// Verificar si se ha enviado el token por GET
// if (isset($_GET['pedido'])) {
//     // Obtener el token enviado por la URL
//     $tokenIngresado = trim($_GET['pedido']);

//     // Obtener el token almacenado en la sesión
//     $tokenGuardado = $_SESSION['pedido'] ?? '';

//     // Comparar los tokens
//     if ($tokenIngresado === $tokenGuardado) {
//         echo "¡Token válido! Verificación exitosa.";
//         header('Location:../verpedido.php');
//     } else {
//         echo "Token inválido. Por favor, inténtalo de nuevo.";
//     }
// } else {
//     echo "No se ha proporcionado ningún token para validar.";
// }
