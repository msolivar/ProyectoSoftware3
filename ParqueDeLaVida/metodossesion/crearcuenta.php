<?php
require_once('../conexionbd.php');

$cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
$nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
$apellido = isset($_POST["apellidos"]) ? trim($_POST["apellidos"]) : null;
$telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$password = isset($_POST["txt_password"]) ? trim($_POST["txt_password"]) : null;

//Insertar usuario
$sql = "SELECT * FROM usuario WHERE cedula = '" . $cedula . "' OR email = '" . $email . "'";
$res = $conexion->query($sql);

if (mysqli_num_rows($res) > 0) {

    echo '<script type="text/javascript">
	    alert("El usuario: ' . $nombre . ' ' . $apellido . ',  \\n ya están registrado en la BD.");
  		window.location="../registrarcliente.php"
	    </script>';
} else {

    // Insertar usuario
    $sql = "INSERT INTO usuario
        VALUES (NULL,'" . $cedula . "','" . $nombre . "','" . $apellido . "','"
        . $email . "','" . $telefono . "','" . $password . "','Cliente',NOW())";
    $qry = $conexion->query($sql);
    header("Location:../login.php");
}
