<?php
// Archivo: conexion.php

$host = 'localhost'; // Cambiar si es necesario
$usuario = 'root'; // Cambiar según configuración
$clave = ''; // Cambiar según configuración
$base_datos = 'parquedelavida'; // Cambiar por el nombre real de la BD

$conexion = new mysqli($host, $usuario, $clave, $base_datos);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Establecer codificación de caracteres
$conexion->set_charset("utf8");

?>
