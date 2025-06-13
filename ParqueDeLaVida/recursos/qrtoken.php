<?php
require_once('../path.php');
require_once('accesibilidadweb.php');

// Si la sesión está vacía
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../index.php");
}
// echo '<pre>';
// print_r($_SESSION['usuario']);
// echo '</pre>';

$usuario = $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'];
$correoUsuario = $_SESSION['usuario']['email'];
$tipoUsuario = $_SESSION['usuario']['tipoUsuario'];

$correo = $correoUsuario;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    // require_once('../'.dirvista.'headerelementos.php');
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--etiqueta para codificar el idioma-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- etiqueta para controlar el zoom en dispositovs moviles -->
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <!-- css diseño de la pagina -->
    <link type="text/css" href="../css/estilos.css" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <title>Generador de Código QR</title>
    <!-- Estilos básicos -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lavender;
            display: flex;
            align-items: center;
            /* Centra verticalmente */
            height: 100vh;
            /* Altura total de la ventana */
            flex-direction: column;
            /* Alinea los elementos en columna */
        }

        h1 {
            color: #333;
        }

        p {
            color: black;
            font-size: 28px;
            margin: 2px;
        }

        #qrcode {
            margin-top: 20px;
            justify-content: center;
            /* Centra horizontalmente */
        }

        .boton-enlace {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .boton-enlace:hover {
            background-color: #218838;
        }
    </style>
    <!-- Biblioteca QRCode.js -->
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
</head>

<body>
    <h1>Para Verificar el Pago</h1>
    <p>Escanea el siguiente código QR:</p>
    <!-- <p><code>recursos/verificarcodigo.php</code></p> -->

    <!-- Contenedor para el código QR -->
    <div id="qrcode"></div>

    <!-- Botón oculto inicialmente -->
    <a id="continuarBtn" href="verificarcodigo.php" class="boton-enlace">
        👉 Continuar
    </a>
</body>

<!-- Script para generar el código QR -->
<script>
    // URL o ruta que se incluirá en el código QR
    const url = "https://ecoparquedelavida.intermediacol.com/recursos/verificarcodigo.php";
    //https://ecoparquedelavida.intermediacol.com/recursos/verificarcodigo.php

    // Generar el código QR
    new QRCode(document.getElementById("qrcode"), {
        text: url,
        width: 200, // Ancho del código QR
        height: 200, // Alto del código QR
        colorDark: "#000000", // Color del código QR
        colorLight: "#ffffff", // Color de fondo
        correctLevel: QRCode.CorrectLevel.H // Nivel de corrección de errores
    });

    // setTimeout(function() {
    //     window.location.href = '../index.php';
    // }, 10000); // 10000 milisegundos = 10 segundos
</script>

</html>