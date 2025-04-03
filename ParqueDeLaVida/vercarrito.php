<?php
require_once('path.php');
require_once(dirRecursos . 'funciones.php');

//Creamos sesión y una conexión con la base de datos.
session_start();
require_once('conexion.php');

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VerCarrito</title>
    <!--etiqueta para codificar el idioma-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- etiqueta para controlar el zoom en dispositovs moviles -->
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <!-- css diseño de la pagina -->
    <link href="css/estilos.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!-- js para mostrar la contraseña -->
    <script type="text/javascript" src="js/mostrarcontraseña.js"></script>

    <?php
    require_once(dirVista . 'NavBarPrincipal.php');
    ?>

    <?php if ($productos) { // Si $productos tiene algo lo muestra en la tabla. 
    ?>
        <div class="container">
            <?php
            $estado = "DeleteEnCarrito";
            require_once(dirVista . 'listaProductos.php');

            ?>
        </div>

        <div class="container row">
            <div class="input-field col s6 m6 l6" id="botonContinuarCompra">
                <a class="waves-effect waves-light btn green" href="index.php">
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

    <?php
    } else { // // Si $productos NO tiene nada solo muestra un link a index.php.
    ?>

        <div class="container">
            <h4>El carrito de compra está vacío.</h4>
        </div>

        <div class="container row">
            <div class="input-field col s6 m6 l6" id="botonContinuarC">
                <a class="waves-effect waves-light btn green" href="index.php">
                    <i class="material-icons right" style="color: white;">home</i>AGREGAR OTRO EVENTO
                </a>
            </div>
        </div>

    <?php } ?>
    <?php
    require_once(dirVista . 'pieDePagina.php');
    ?>
</body>

</html>