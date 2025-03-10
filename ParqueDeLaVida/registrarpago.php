<?php
// Verificar si se enviaron los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombres = isset($_POST["nombres"]) ? trim($_POST["nombres"]) : "";
    $apellidos = isset($_POST["apellidos"]) ? trim($_POST["apellidos"]) : "";
    $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
    $celular = isset($_POST["celular"]) ? trim($_POST["celular"]) : "";
    $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
    $precioEntrada = isset($_POST["precioEntrada"]) ? $_POST["precioEntrada"] : 0;
    $totalPagar = isset($_POST["totalPagar"]) ? $_POST["totalPagar"] : 1;

    // Validación de campos vacíos
    if (empty($nombres) || empty($apellidos) || empty($cedula) || empty($celular) || empty($correo) ) {
        echo "<h3 class='text-danger text-center mt-3'>Error: Todos los campos son obligatorios y el total debe ser mayor a 0.</h3>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Pago</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            background: #ffcc00;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="bg-success text-white p-2 rounded text-center">Resumen de la compra</h2>
        <p><strong>Nombre:</strong> <?php echo $nombres . " " . $apellidos; ?></p>
        <p><strong>Cédula:</strong> <?php echo $cedula; ?></p>
        <p><strong>Celular:</strong> <?php echo $celular; ?></p>
        <p><strong>Correo:</strong> <?php echo $correo; ?></p>
        <p><strong>Precio Unitario:</strong> $<?php echo number_format($precioEntrada, 2); ?></p>
        <p class="total-pagar"><strong>Total a pagar:</strong> <?php echo $totalPagar; ?></p>

        <h3 class="text-center mt-3">Seleccione su método de pago</h3>
        <form action="procesarPago.php" method="post">
            <input type="hidden" name="nombres" value="<?php echo $nombres; ?>">
            <input type="hidden" name="apellidos" value="<?php echo $apellidos; ?>">
            <input type="hidden" name="cedula" value="<?php echo $cedula; ?>">
            <input type="hidden" name="celular" value="<?php echo $celular; ?>">
            <input type="hidden" name="correo" value="<?php echo $correo; ?>">
            <input type="hidden" name="totalPagar" value="<?php echo $totalPagar; ?>">

            <label>
                <input type="radio" name="metodoPago" value="Tarjeta" required>
                <div class="payment-option">💳 Tarjeta de Crédito/Débito</div>
            </label>
            <label>
                <input type="radio" name="metodoPago" value="Transferencia" required>
                <div class="payment-option">🏦 Transferencia Bancaria</div>
            </label>
            <label>
                <input type="radio" name="metodoPago" value="Efectivo" required>
                <div class="payment-option">💵 Pago en efectivo</div>
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
