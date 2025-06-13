<?php
require_once('path.php');
require_once(dirrecursos . 'funciones.php');
require_once(dirrecursos . 'accesibilidadweb.php');

//Conexión con la base de datos.
session_start();
require_once('conexionbd.php');

// Mostrar La Descripcion De La Tabla
// $tabla = "transaccion";
// require_once(dirrecursos.'descripciondelatabla.php');  

//Creamos la Sesion articulos que va almacenar los productos.
if (isset($_SESSION['articulos'])) {

    $productos = $_SESSION['articulos'];
    if (count($productos) > 0) {

        $cantidadProductos = count($productos);
    } else {

        $cantidadProductos = "";
    }
} else {

    $productos = false;
    $cantidadProductos = "";
}
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <?php
    require_once(dirvista . 'headerelementos.php');
    ?>
    <title>Registro</title>
</head>

<style>
    body {
        background: url(recursos/sesion/login.png);
        background-size: 100% 100%;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-color: lavender;
    }

    main {
        flex: 1 0 auto;
    }

    .input-field input[type=date]:focus+label,
    .input-field input[type=text]:focus+label,
    .input-field input[type=txt_uname_email]:focus+label,
    .input-field input[type=password]:focus+label {
        color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=txt_uname_email]:focus,
    .input-field input[type=password]:focus {
        border-bottom: 2px solid #e91e63;
        box-shadow: none;
    }

    .color {
        background: rgba(0, 0, 0, .2);
    }

    i.material-icons,
    label.blanco {
        color: white;
    }

    h5 {
        color: white;
        text-align: justify;
    }

    div.row div.input-field input {
        size: 35;
    }

    input,
    input::-webkit-input-placeholder {
        font-size: 21px;
        line-height: 3;
        color: white;
    }

    button {
        font-size: 26px;
        margin-left: auto;
        margin-right: auto;
    }

    /*Pintar checkbok*/
    [type="checkbox"]+label:before,
    [type="checkbox"]:not(.filled-in)+label:after {
        border: 2px solid black;
    }
</style>

<body>

    <?php
    require_once(dirvista . 'bodyelementos.php');
    require_once(dirvista . 'navbarinicio.php');
    ?>

    <main>
        <center>
            <div class="section"></div>
            <div id="container">
                <!-- <h3 style="color: #D35400">CaiceTravel</h3> -->

                <div class="color" style="display: inline-block; padding: 0px 39px 0px 39px;">
                    <form class="col s12 m12 l12" name="Ingresar"
                        action="<?= dirsesion ?>recuperarcuenta.php" method="post">

                        <h3 style="color: yellow;">Recuperar Password</h3>

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">email</i>
                                <input maxlength="30" placeholder=" Ingrese el correo"
                                    name="email" type="email" id="email" data-length="30" style="color:white;font-size:15pt;" required>
                                <label class="blanco" style="font-size:16pt; text-align: left;" for="email">Correo Electronico</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">vpn_key</i>
                                <input placeholder="&#128272; Digite el nuevo password" 
                                id="password" name="txt_password" type="password" data-length="30" class="validate" style="color:white;font-size:15pt;" size="35" required>
                                <label class="blanco" style="font-size:16pt; text-align: left;" for="txt_password">Contraseña</label>
                            </div>

                            <p class="justificar">
                                <input name="VerPassword" id="VerPassword" type="checkbox" style="color:black;">
                                <label class="blanco" style="font-size:13pt; background-color:#F1F1F1;; color:black;" for="VerPassword">Ver contraseña</label>
                            </p
                                </div>

                            <div class="row">
                                <button class="col s7 m8 l8 offset-s3 offset-m2 offset-l2 waves-effect waves-light btn-large  indigo darken-4" type="submit" name="btn-login">Registrar
                                </button>
                            </div>

                            <h5>¡Tienes cuenta! <a style="color:#00FFFF" href="login.php">Volver</a></h5>
                    </form>

                    <div class="section"></div>
                </div>
            </div>

        </center>
    </main>

</body>

<?php

require_once(dirvista . 'piedepagina.php');

?>

</html>