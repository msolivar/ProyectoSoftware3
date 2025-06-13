<?php
require_once('../conexionbd.php');

$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$password = isset($_POST["txt_password"]) ? trim($_POST["txt_password"]) : null;

//Insertar usuario
$sql = "SELECT * FROM usuario WHERE email = '" . $email . "' AND tipoUsuario = 'Cliente'";
$res = $conexion->query($sql);

if (mysqli_num_rows($res) > 0) {

    // Recuperar Correo Electronico
    $sql = "UPDATE usuario SET 
    password='$password'
     WHERE email='$email'";
    //  echo $sql;
    mysqli_query($conexion, $sql);
    
    echo '<script type="text/javascript">
	    alert("Cambio de Password Realizado Bienvenido al parque de la vida");
  		window.location="../login.php"
	    </script>';

} else {
    
    echo '<script type="text/javascript">
	    alert("El correo: ' . $email . ',  \\n no están registrado.");
  		window.location="../registrarcliente.php"
	    </script>';

    
}
