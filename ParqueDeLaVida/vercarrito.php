<?php
require_once('path.php');
require_once(dirrecursos . 'funciones.php');
require_once(dirrecursos . 'accesibilidadweb.php');

//Creamos sesión y una conexión con la base de datos.
session_start();
require_once('conexionbd.php');

// Si la sesión está vacía
if (!isset($_SESSION['usuario'])) {
    header("location:index.php");
}
// echo '<pre>';
// print_r($_SESSION['usuario']);
// echo '</pre>';

$usuario = $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'];
$correoUsuario = $_SESSION['usuario']['email'];
$tipoUsuario = $_SESSION['usuario']['tipoUsuario'];

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

    <title>Compras</title>

</head>



<body>

    <?php

    require_once(dirvista . 'bodyelementos.php');
    require_once(dirvista . 'navbarprincipal.php');

    ?>



    <?php if ($productos) { // Si $productos tiene algo lo muestra en la tabla. 

    ?>

        <div class="container row">

            <div class="input-field col s6 m6 l6" id="botonContinuarCompra">

                <a class="waves-effect waves-light btn green" href="iniciousuario">

                    <i class="material-icons right" style="color: white;">home</i>AGREGAR OTRO EVENTO

                </a>

            </div>

            <div class="input-field col s6 m6 l6" id="botonFinalizarCompra">

                <a class="waves-effect waves-light btn indigo" href="pedido.php">

                    <i class="material-icons right" style="color: white;">assignment_ind</i>FINALIZAR COMPRA

                </a>

            </div>

            <!-- <div class="input-field col s4 m4 l4" id="botonVerPedido">

    <a class="waves-effect waves-light btn blue" href="verpedido.php">

    <i class="material-icons right" style="color: white;">shopping_basket</i>VER PEDIDOS

    </a>

</div> -->

        </div>

        <div class="container">

            <?php

            $estado = "DeleteEnCarrito";

            require_once(dirvista . 'listaproductos.php');

            ?>

        </div>

    <?php

    } else { // // Si $productos NO tiene nada solo muestra un link a index.php.

    ?>



        <div class="container">

            <h4>El carrito de compra está vacío.</h4>

        </div>



        <div class="container row">

            <div class="input-field col s6 m6 l6" id="botonContinuarC">

                <a class="waves-effect waves-light btn green" href="iniciousuario">

                    <i class="material-icons right" style="color: white;">home</i>AGREGAR OTRO EVENTO

                </a>

            </div>

        </div>



    <?php } ?>

    <?php

    require_once(dirvista . 'piedepagina.php');

    ?>

</body>



</html>