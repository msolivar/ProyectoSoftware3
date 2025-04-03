<?php
require_once('path.php');
require_once(dirRecursos.'funciones.php');

//Creamos sesión y una conexión con la base de datos.
session_start();
require_once('conexion.php');

// Mostrar La Descripcion De La Tabla
// $tabla = "transaccion";
// require_once(dirRecursos.'descripcionDeLaTabla.php');  

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
    <title>Ver Pedido</title>
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
    <!-- js lista dinamica -->
    <script type="text/javascript" src="js/listadinamica.js"></script>
    <!-- js para mostrar la contraseña -->
    <script type="text/javascript" src="js/mostrarcontraseña.js"></script>

    <?php
    include(dirVista.'NavBarPrincipal.php');
    ?>

    <?php

    //Hacemos la consulta a la base de datos para mostrar los pedidos
    $qry = $conexion->query("SELECT f.id as 'f.id',usuario_id,productos,tipoDePago,totalAPagar,estadoPago,fechaRegistroPago,u.id as 'u.id',cedula,nombre,email,fechaRegistroUsuario,telefono,password 
    FROM factura f INNER JOIN usuario u ON f.usuario_id = u.id ORDER BY f.id DESC;");

    $registros = $qry->num_rows;

    if ($registros > 0) {

    ?>
        <?php
        require_once(dirVista.'listaPedido.php');
        ?>

    <?php

    }

    ?>

    <div class="container row">
        <div class="input-field col s4 m4 l4" id="botonContinuarCompra">
            <a class="waves-effect waves-light btn green" href="index.php">
                <i class="material-icons right" style="color: white;">home</i>AGREGAR COMPRA
            </a>
        </div>
        <div class="input-field col s4 m4 l4" id="botonFinalizarCompra">
            <a class="waves-effect waves-light btn indigo" href="pedido.php">
                <i class="material-icons right" style="color: white;">assignment_ind</i>FINALIZAR COMPRA
            </a>
        </div>
    </div>

    <?php
    include(dirVista.'pieDePagina.php');
    ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>