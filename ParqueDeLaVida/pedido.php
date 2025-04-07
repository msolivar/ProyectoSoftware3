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

//Comprobamos que la variable $productos tenga valor.

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
    <title>Pedido</title>
</head>

<style>
    .select-wrapper input.select-dropdown {

        background-color: rgba(144, 238, 144, 0.5);

    }
</style>

<body>

    <?php
	
	require_once(dirvista . 'bodyelementos.php');
    require_once(dirvista . 'navbarprincipal.php');

    ?>

    <?php if ($productos) { // Si $productos tiene algo lo muestra en la tabla. 

    ?>

        <div class="container row">

            <div class="input-field col s6 m6 l6" id="VerCarrito">

                <a class="waves-effect waves-light btn indigo" href="vercarrito.php">

                    <i class="material-icons right" style="color: white;">shopping_basket</i>VOLVER CARRITO DE COMPRA

                </a>

            </div>

            <div class="input-field col s6 m6 l6" id="botonContinuarCompra">

                <a class="waves-effect waves-light btn orange btnModal" href="index.php">

                    <i class="material-icons right" style="color: white;">home</i>AGREGAR OTRO EVENTO

                </a>

            </div>

            <!-- <div class="input-field col s4 m4 l4" id="botonVerPedido">

            <a class="waves-effect waves-light btn blue" href="verpedido.php">

            <i class="material-icons right" style="color: white;">shopping_basket</i>VER PEDIDOS

            </a>

            </div> -->

        </div>

        <div class="container">

            <h4 class="colorClaro">DATOS DEL COMPRADOR:</h4>

        </div>

        <div class="container" style="border: 1px solid black; background-color: #1f3a28; padding: 20px;

    border-radius: 10px;">

            <h5 style="margin-top: 0px; background-color: rgba(144, 238, 144, 0.5); 

        padding: 5px; border-radius: 10px;">Entrada:</h5>

            <form class="formPedido col s12" id="formPedido" name="formPedido" method="post"

                action="<?= dircar ?>enviarpedido.php">

                <div class="row">

                    <div style="margin-left: 30px; color:black; text-align: justify; font-weight: bold; font-size: 16px;" id="resp"></div>

                    <br>

                    <div class="input-field col s12 m6 l6">

                        <i class="material-icons prefix">account_circle</i>

                        <input class="color" maxlength="10" placeholder=" Ingrese la Identificación"
                            name="cedula" type="text" id="cedula" data-length="10" onkeypress="return soloNumeros1(event)" required />

                        <label class="titulo" style="font-size:12pt;" for="cedula">Cedula</label>

                    </div>

                    <div class="input-field col s12 m6 l6">

                        <i class="material-icons prefix">assignment_ind</i>

                        <input class="color" maxlength="25" placeholder=" Ingrese el nombre / los nombres"
                            name="nombre" type="text" id="nombre" data-length="25" onkeypress="return soloLetras(event)" required>

                        <label class="titulo" style="font-size:12pt;" for="nombre">Nombre</label>

                    </div>

                    <div class="input-field col s12 m6 l6">

                        <i class="material-icons prefix">assignment_ind</i>

                        <input class="color" maxlength="25" placeholder=" Ingrese el apellido / los apellidos"
                            name="apellidos" type="text" id="apellidos" data-length="25" onkeypress="return soloLetras(event)" required>

                        <label class="titulo" style="font-size:12pt;" for="apellidos">Apellido</label>

                    </div>

                    <div class="input-field col s12 m6 l6">

                        <i class="material-icons prefix">local_phone</i>

                        <input class="color" maxlength="10" placeholder=" Ingrese el telefono"
                            name="telefono" type="text" id="telefono" data-length="10" onkeypress="return soloNumeros1(event)" required>

                        <label class="titulo" style="font-size:12pt;" for="telefono">Teléfono</label>

                    </div>

                    <div class="input-field col s12 m6 l6">

                        <i class="material-icons prefix">email</i>

                        <input class="color validate" maxlength="30" placeholder=" Ingrese el correo"
                            name="email" type="email" id="email" data-length="30" required>

                        <label class="titulo" style="font-size:12pt;" for="email">Correo Electronico</label>

                    </div>

                    <div class="input-field col s12 m6 l6">

                        <i class="material-icons prefix">payment</i>

                        <select name="tipoDePago" style="background-color: white;" required>

                            <option value="" disabled selected> Seleccione el tipo de Pago</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>

                        </select>

                        <label class="titulo" style="font-size:12pt;" for="tipoDePago">Tipo de Pago</label>

                    </div>



                    <div class="input-field col s12 m10 l8" style="margin-left: 20px;">

                        <button class="btn waves-effect waves-light indigo" id="Enviar" name="Enviar" name="Enviar">Pagar

                            <i class="material-icons right" style="color: white;">send</i>

                        </button> &nbsp; &nbsp;

                        <a class="waves-effect waves-light btn red" href="#" id="btnLimpiar"><i class="material-icons right" style="color: white;">send</i>Limpiar Formulario</a>
                    </div>

                </div>

            </form>

            <?php

            $estado = "DeleteEnPedido";

            require_once(dirvista . 'listaproductos.php');

            ?>

        </div>

    <?php

    } else { // Si $productos NO tiene nada solo muestra un link a index.php.

    ?>

        <div class="container">

            <h4>No se han realizado Pedidos.</h4>

        </div>

        <div class="container row">

            <div class="input-field col s6 m6 l6" id="botonContinuarC">

                <a class="waves-effect waves-light btn green" href="index.php">

                    <i class="material-icons right" style="color: white;">home</i>AGREGAR COMPRA

                </a>

            </div>

        </div>

    <?php } ?>

</body>

<?php

require_once(dirvista . 'piedepagina.php');

?>

</html>

<script>
    $(document).ready(function() {

        $('select').material_select();

        //   M.textareaAutoResize($('#observaciones'));

        $('#btnLimpiar').click(function(e) {

            e.preventDefault(); // Prevenir el comportamiento por defecto del enlace

            // Limpiar todos los campos del formulario

            $('#formPedido')[0].reset();

        });

        $('#cedula').on('input', function() {

            var bus = $(this);

            if (validarInput(bus, "Por favor ingrese la cedula")) {} else {

                var cedula = "buscar=" + bus.val().trim();

                $.ajax({

                    type: "POST",
                    url: "<?= dircar ?>cargarcliente.php",
                    data: cedula,
                    dataType: "json", // Esperamos un JSON de respuesta

                    success: function(data) {

                        if (data.error) {

                            $('#resp').html(data.error).addClass('colorClaro'); // Mostrar error si no se encuentra el cliente

                            // Limpiar campos del formulario

                            $('#nombre').val("");
                            $('#apellidos').val("");
                            $('#direccion').val("");
                            $('#telefono').val("");
                            $('#email').val("");

                        } else {

                            $('#resp').html("").removeAttr('class');
                            $('#nombre').val(data.nombre);
                            $('#apellidos').val(data.apellido);
                            $('#direccion').val(data.direccion);
                            $('#telefono').val(data.telefono);
                            $('#email').val(data.email);
                        }
                    },

                    error: function(jqXHR, textStatus, errorThrown) {

                        $('#resp').html("Error al buscar cliente. Inténtalo de nuevo.");

                    }

                });

            }

        });

    });
</script>