<?php
session_start();

// Eliminar la variable de sesión "seccion"
unset($_SESSION['articulos']);

echo json_encode(["mensaje" => "Sección liberada."]);
?>