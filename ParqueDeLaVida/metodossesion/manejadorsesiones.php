<?php

//Controlador de Sesiones
require_once('../conexionbd.php');

// Recibimos las dos variables
$usuario = isset($_POST["txt_uname_email"]) ? trim($_POST["txt_uname_email"]) : null;
$password = isset($_POST["txt_password"]) ? trim($_POST["txt_password"]) : null;

// Realizamos una consulta, para verificar en la base de datos, si el cliente existe
$sql = "SELECT * FROM usuario WHERE email = '$usuario' AND password = '$password'";
$res = $conexion->query($sql);

$sql = "SELECT * FROM usuario WHERE email = '$usuario' AND password = '$password'";
$res1 = $conexion->query($sql);
$row = $res1->fetch_array();
$tipoUsuario = empty($row['tipoUsuario']) ? Null : $row['tipoUsuario'];

session_start(); // Iniciamos la variable de session

if (mysqli_num_rows($res) > 0) {

    if ($tipoUsuario === "Cliente") {
        echo $tipoUsuario;
        while ($row1 = $res->fetch_array(MYSQLI_ASSOC)) {
            $_SESSION['usuario'] = $row1;
        }
        header("Location: ../iniciousuario.php"); // Indicamos la pagina donde se va a mostrar la variable de session 
    }
    if ($tipoUsuario === "Administrador") {
        
        while ($row1 = $res->fetch_array(MYSQLI_ASSOC)) {
            $_SESSION['admin'] = $row1;
        }
        header("Location: ../productos.php");
    }
   
}

// En caso de no existir el usuario en la base de datos
else {
    // Lo redirreciona a la pagina principal
    echo '<script type="text/javascript">
            alert("Credenciales Incorrectas\nNo puede acceder a este sitio web");     
            window.location="../login.php";
        </script>';
}