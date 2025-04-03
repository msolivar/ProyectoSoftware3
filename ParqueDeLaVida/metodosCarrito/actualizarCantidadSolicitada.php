<?php

$id = $_POST['idPedido'] ?? null;
$detalleEntrada = $_POST['entrada'] ?? null;
$cantidad = $_POST['cantidad'] ?? null;
$precio = $_POST['precio'] ?? null;
$totalAPagar = $_POST['totalAPagar'] ?? null;

session_start();
if (isset($_SESSION['articulos']))
    $productos = $_SESSION['articulos'];
else $productos = false;

require_once('../conexion.php');
//incluímos la conexión a nuestra base de datos

$qry = $conexion->query("SELECT * FROM boleto WHERE id='" . $id . "'");
$row = $qry->fetch_array();

if ($cantidad <= $row['disponibles']) {
    $productos[md5($id)] =
        array(
            'id' => $id,
            'entrada' => $detalleEntrada,
            'cantidadSolicitada' => $cantidad,
            'precio' => $precio,
            'totalAPagar' => $cantidad * $precio
        );
    $_SESSION['articulos'] = $productos;
} else {
    echo '<script type="text/javascript">
	      	alert("El evento: ' . $detalleEntrada . ', no se puede añadir al carrito. \\nPorque solo hay ' . $row["disponibles"] . ' unidades disponibles en el aforo.");  	
	    </script>';
}

// echo "<pre>";
// print_r($productos);
// echo "</pre>";
