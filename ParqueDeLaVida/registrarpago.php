<?php

// Verificar si se enviaron los datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del formulario

    $nombres = empty($_POST["nombres"]) ? "Sin datos" : trim($_POST["nombres"]);

    $apellidos = empty($_POST["apellidos"]) ? "Sin datos" : trim($_POST["apellidos"]);

    $cedula = empty($_POST["cedula"]) ? "Sin datos" : trim($_POST["cedula"]);

    $celular = empty($_POST["celular"]) ? "Sin datos" : trim($_POST["celular"]);

    $correo = empty($_POST["correo"]) ? "Sin datos" : trim($_POST["correo"]);

    $precioEntrada = empty($_POST["precioEntrada"]) ? "Sin datos" : $_POST["precioEntrada"];

    $totalPagar = empty($_POST["totalPagar"]) ? "Sin datos" : $_POST["totalPagar"];

?>



<!DOCTYPE html>

<html lang="es">

<head>

    <?php
	
	require_once(dirvista . 'bodyelementos.php');
    require_once(dirvista . 'headerelementos.php');
	
    ?>

    <title>Resumen de Pago</title>

    <style>

        body {

            background-color: #2d4739;

            color: white;

        }

        .container {

            background: #1f3a28;

            padding: 20px;

            border-radius: 10px;

        }

        .total-pagar {

            font-size: 22px;

            color: red;

            font-weight: bold;

        }

        .payment-option {

            background: #c4a460;

            color: white;

            padding: 15px;

            border-radius: 10px;

            text-align: center;

            cursor: pointer;

            margin-bottom: 10px;

            transition: 0.3s;

        }

        .payment-option:hover {

            background: #a48a50;

        }

        input[type="radio"] {

            display: none;

        }

        input[type="radio"]:checked + .payment-option {

            background: gray;

            color: black;

        }

    </style>

</head>

<body>

    <div class="container mt-4">

        <h2 class="bg-success text-white p-2 rounded text-center">Resumen de la compra</h2>

        <p><strong>Cédula:</strong> <?= $cedula ?></p>

        <p><strong>Cliente:</strong> <?php echo $nombres . " " . $apellidos; ?></p>

        <p><strong>Celular:</strong> <?= $celular ?></p>

        <p><strong>Correo:</strong> <?= $correo ?></p>

        <p><strong>Precio Unitario:</strong> $ <?= $precioEntrada ?></p>

        <p class="total-pagar"><strong>Total a pagar:</strong> <?= $totalPagar ?></p>



        <h3 class="text-center mt-3">Seleccione su método de pago</h3>

        <form action="procesarPago.php" method="post">

            <input type="hidden" name="nombres" value="<?= $nombres ?>">

            <input type="hidden" name="apellidos" value="<?= $apellidos ?>">

            <input type="hidden" name="cedula" value="<?= $cedula ?>">

            <input type="hidden" name="celular" value="<?= $celular ?>">

            <input type="hidden" name="correo" value="<?= $correo ?>">

            <input type="hidden" name="totalPagar" value="<?= $totalPagar ?>">

            

            <label>

                <input type="radio" name="metodoPago" value="Efectivo" required>

                <div class="payment-option">💵 Pago en efectivo</div>

            </label>

            <label>

                <input type="radio" name="metodoPago" value="Tarjeta" required>

                <div class="payment-option">💳 Tarjeta de Crédito/Débito</div>

            </label>

            <label>

                <input type="radio" name="metodoPago" value="Transferencia" required>

                <div class="payment-option">🏦 Transferencia Bancaria</div>

            </label>

            

            <button type="submit" class="btn btn-warning w-100 mt-3">Confirmar Pago</button>

        </form>

    </div>

</body>

</html>



<?php

} else {

    echo "<h3 class='text-danger text-center mt-3'>Error: No se enviaron datos.</h3>";

}

?>

