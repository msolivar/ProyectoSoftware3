<?php

    require_once('conexionbd.php');



    $entrada=empty($_REQUEST["entrada"]) ? "" : $_REQUEST["entrada"];



    $valor=0;

    $evento="";



    // $tabla = "boleto";

    // require_once(dirrecursos .'descripciondelatabla.php');  // Mostrar La Descripcion De La Tabla



    $consulta="SELECT * FROM `boleto` WHERE id='$entrada'";

    $qry = $conexion->query($consulta);

    $fila = $qry->fetch_array(MYSQLI_BOTH); // Obtiene la primera fila de resultados como un array asociativo

    

    $valor= $fila['precio'];

    $evento= $fila['evento'];

?>



<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Compra de Entradas</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>

        body {

            background-color: lavender;

            color: black;

        }

        .container {

            background: #1f3a28;

            padding: 20px;

            border-radius: 10px;

        }

        .form-control {

            background: #e6e6e6;

            border: none;

            border-radius: 10px;

        }

        .total-pagar {

            font-size: 20px;

            color: red;

            font-weight: bold;

        }

        .btn-comprar {

            background-color: #c4a460;

            color: white;

            padding: 10px;

            border-radius: 20px;

            text-decoration: none;

            display: block;

            text-align: center;

        }

    </style>

</head>

<body>
	
	<?php

     require_once(dirvista . 'bodyelementos.php');
     require_once(dirvista . 'navbarprincipal.php');

    ?>
	
    <div class="container mt-4">

        <h4 class="bg-success text-white p-2 rounded">Entrada </h4>

        <form action="registrarpago.php" method="post">

            <div class="mt-3">

                <label>Número de cédula</label>

                <input type="text" name="cedula" class="form-control" placeholder="Número de cédula" required>

            </div>

            <div class="row mt-3">

                <div class="col-md-6">

                    <label>Nombres</label>

                    <input type="text" name="nombres" class="form-control" placeholder="Nombre" required>

                </div>

                <div class="col-md-6">

                    <label>Apellidos</label>

                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>

                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-6">

                    <label>Correo electrónico</label>

                    <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>

                </div>

                <div class="col-md-6">

                    <label>Celular</label>

                    <input type="text" name="celular" class="form-control" placeholder="Celular" required>

                </div>

            </div>

            <div class="table-responsive mt-4">

                <table class="table text-white">

                    <thead>

                        <tr>

                            <th>Entrada</th>

                            <th>Precio unitario</th>

                            <th>Cantidad</th>

                            <th>Total a pagar</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td> <?= $evento;?> </td>

                            <td><input readonly type="text" name="precioEntrada" id="precioEntrada" class="form-control" placeholder="precioEntrada" value="<?php echo $valor;?>" required></td>

                            <td>

                                <button type="button" class="btn btn-secondary" onclick="cambiarCantidad(-1)">-</button>

                                <span id="cantidad">1</span>

                                <button type="button" class="btn btn-secondary" onclick="cambiarCantidad(1)">+</button>

                            </td>

                            <td><input readonly type="text" id="totalPagar" name="totalPagar" class="form-control" placeholder="Total a Pagar" value="<?php echo $valor;?>" required></td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <button type="submit" class="btn btn-comprar">Ir a pagar</button>

        </form>

    </div>



    <script>

        let cantidad = 1;

        const precioUnitario = document.getElementById('precioEntrada').value;

        

        



        function cambiarCantidad(valor) {

            cantidad += valor;

            



            document.getElementById('cantidad').innerText = cantidad;

            document.getElementById('totalPagar').value = "$ " + (cantidad * precioUnitario).toFixed(3);

        }

    </script>

</body>

</html>