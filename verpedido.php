<?php
require_once('path.php');
require_once(dirrecursos . 'funciones.php');
require_once(dirrecursos . 'accesibilidadweb.php');

//Creamos sesión y una conexión con la base de datos.
session_start();
require_once('conexion.php');

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
    <title>Entradas</title>

</head>

<body>

    <?php

	require_once(dirvista . 'bodyelementos.php');
    require_once(dirvista . 'navbarprincipal.php');

    ?>

    <?php

    //Hacemos la consulta a la base de datos para mostrar los pedidos
    $qry = $conexion->query("SELECT f.id as 'f.id',usuario_id,productos,tipoDePago,totalAPagar,estadoPago,fechaRegistroPago,u.id as 'u.id',cedula,nombre,email,fechaRegistroUsuario,telefono,password 
    FROM factura f INNER JOIN usuario u ON f.usuario_id = u.id ORDER BY f.id DESC;");

    $registros = $qry->num_rows;

    if ($registros > 0) {

    ?>
        <div class="container row">

            <div class="input-field col s9 m9 l9" id="botonContinuarCompra">

                <a class="waves-effect waves-light btn green" href="index.php">

                    <i class="material-icons right" style="color: white;">home</i>AGREGAR COMPRA

                </a>

            </div>

            <!-- <div class="input-field col s6 m4 l4" id="botonFinalizarCompra">

            <a class="waves-effect waves-light btn indigo" href="pedido.php">

                <i class="material-icons right" style="color: white;">assignment_ind</i>FINALIZAR COMPRA

            </a>

        </div> -->

        </div>

        <?php

        require_once(dirvista . 'listapedido.php');

        ?>



    <?php



    }



    ?>







    <?php

    require_once(dirvista . 'piedepagina.php');

    ?>

</body>



</html>



<script>
    $(document).ready(function() {

        $('select').material_select();

    });
</script>