<?php

// Archivo: conexion.php

//Servidor
$host = 'localhost'; // Cambiar si es necesario
$usuario = 'lkkxjgdf_admin'; // Cambiar según configuración
$clave = '6I(;%g;(DBnK'; // Cambiar según configuración
$base_datos = 'lkkxjgdf_parquedelavida'; // Cambiar por el nombre real de la BD

$conexion = new mysqli($host, $usuario, $clave, $base_datos);

// Verificar si hay errores en la conexión
if ($conexion->connect_error) {

    die("Error en la conexión a la base de datos: " . $conexion->connect_error);

}

// Establecer codificación de caracteres
$conexion->set_charset("utf8");

// Establecer la zona horaria de Colombia en PHP
date_default_timezone_set('America/Bogota');

// Configurar la zona horaria en MySQL para la conexión actual
$conexion->query("SET time_zone = '-05:00'");

// Formato de fecha y hora Colombia
$fecha_colombia = date('d-m-Y H:i:s'); // Ejemplo: "23-03-2025 15:30:00"

$fecha_original = date('Y-m-d');

$hora_colombia = date('H:i:s A');
// Mostrar la fecha y hora actuales
// echo "Fecha y hora en Colombia: $fecha_colombia";

?>