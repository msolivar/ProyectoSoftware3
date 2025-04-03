<?php

session_start();
error_reporting(E_ALL);
@ini_set('display_errors', '1');
//con session_start() creamos la sesión si no existe o la retomamos si ya ha
//sido creada

extract($_REQUEST);
// la función extract toma las claves de una matriz asociativa y las convierte en nombres de variable, ejemplo: $id=$_GET['ID'];

require_once('../conexion.php');
// incluimos la conexión a nuestra base de datos

if (isset($_SESSION['articulos']))
    $productos = $_SESSION['articulos'];

$suma = 0;

foreach ($productos as $k => $v) {
    $subto = $v['totalAPagar'];
    $suma = $suma + $subto;

    $qry = $conexion->query("SELECT * FROM boleto WHERE evento='" . $v['entrada'] . "'");
    $row = $qry->fetch_array();

    $disponible = $row['disponibles'] - $v['cantidadSolicitada'];

    // $v['id'].' '.$v['entrada'].' '.$v['cantidadSolicitada'].' '.$v['precio'].' '.$v['totalAPagar']

    $sql = "UPDATE boleto SET disponibles='" . $disponible . "' WHERE evento='" . $v['entrada'] . "'";
    // print_r($sql);

    // Disminuir Cantidad Productos de acuerdo al pedido
    $qry = $conexion->query($sql);

    // Transaccion id	factura_id	boleto_id	precio	disponibles	cantidad	fechaRegistroTransaccion	

}

$pedido = array(
    'cedula' => $cedula,
    'nombre' => $nombre,
    "apellido" => $apellidos,
    'cliente' => $nombre . " " . $apellidos,
    'telefono' => $telefono,
    'correo' => $email,
    'tipoDePago' => $tipoDePago,
    'productos' => $productos,
    'estadoPago' => 'Pendiente',
    'totalAPagar' => $suma,
);

//Insertar usuario
$sql = "SELECT * FROM usuario WHERE cedula='" . $pedido['cedula'] . "';";
$res = $conexion->query($sql);
$row = $res->fetch_array();
$idUsuario = empty($row['id']) ? "Null" : $row['id'];

// $row = mysqli_fetch_array($res);

if (mysqli_num_rows($res) > 0) {
    // El cliente ya existe, puedes manejarlo como desees
} else {
    $sql = "INSERT INTO usuario
        VALUES (NULL,'" . $pedido['cedula'] . "','" . $pedido['nombre'] . "','" . $pedido['apellido'] . "','"
        . $pedido['correo'] . "','" . $pedido['telefono'] . "','1234','Cliente',NOW())";
    // Insertar usuario
    $qry = $conexion->query($sql);

    $sql = "SELECT * FROM usuario WHERE cedula='" . $pedido['cedula'] . "'";
    // Insertar usuario
    $qry1 = $conexion->query($sql);

    $row = $qry1->fetch_array();
    $idUsuario = empty($row['id']) ? "Null" : $row['id'];
}

$sql = "INSERT INTO factura
    VALUES (NULL,'" . $idUsuario . "','" . json_encode($pedido['productos'], JSON_PRETTY_PRINT) . "','" .
    $pedido['tipoDePago'] . "','" . $pedido['totalAPagar'] . "','" . $pedido['estadoPago'] . "',NOW())";

//Insertar factura
$qry = $conexion->query($sql);

$sql = "SELECT * FROM factura ORDER BY id DESC LIMIT 1";

// Insertar usuario
$qry1 = $conexion->query($sql);

$row = $qry1->fetch_array();
$idFactura = empty($row['id']) ? "Null" : $row['id'];

foreach ($productos as $k => $v) {
    // Transaccion 	id	factura_id	boleto_id	precio	cantidad	fechaRegistroTransaccion		
    // $v['id'].' '.$v['entrada'].' '.$v['cantidadSolicitada'].' '.$v['precio'].' '.$v['totalAPagar']

    $sql = "INSERT INTO transaccion
    VALUES (NULL,'" . $idFactura . "','" . $v['id'] . "','" .
        $v['precio'] . "','" . $v['cantidadSolicitada'] . "','" . $v['totalAPagar'] . "',NOW())";

    //Insertar transaccion
    $qry = $conexion->query($sql);
}

// ALTER TABLE factura AUTO_INCREMENT = 1;
// ALTER TABLE transaccion AUTO_INCREMENT = 1;

//Vaciar Array
$productos = array();
$_SESSION['articulos'] = $productos;

//Notificacion Correos
// Enviar el primer pedido a la API
// $apiUrl = 'https://notifications-net8.optiplan.co/Notifications/pedido/send';

// // Convertir el primer pedido a JSON
// $primerPedidoJson = json_encode($pedidos[0]);

// // Inicializar cURL
// $ch = curl_init($apiUrl);

// // Configurar cURL
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $primerPedidoJson);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     'Content-Length: ' . strlen($primerPedidoJson)
// ));

// // Ejecutar cURL y obtener la respuesta
// $response = curl_exec($ch);

// // Verificar si ocurrió un error
// if (curl_errno($ch)) {
//     echo 'Error en cURL: ' . curl_error($ch);
// } else {
//     // Procesar la respuesta de la API
//     echo 'Respuesta de la API: ' . $response;
// }

// // Cerrar la sesión cURL
// curl_close($ch);

if (count($productos) === 0) {
    header("Location:../verpedido.php");
}
