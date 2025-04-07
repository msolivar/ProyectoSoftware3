<?php
require_once('../conexion.php');

// Función para generar un token aleatorio
function generarToken($longitud = 32) {
    return bin2hex(random_bytes($longitud));
}

$correo = "us1@email.com";

// Generar el token
$token = generarToken();
$hash = password_hash($token, PASSWORD_DEFAULT);

$sql = "UPDATE usuario SET password=". "'" . $token . "' WHERE email='" . $correo . "'";

// Insertar usuario

$qry = $conexion->query($sql);

// Mostrar el token generado al usuario
echo "Tu token de verificación es: " . $hash . "<br>";
// echo "Haz clic en el siguiente enlace para validar el token:<br>";
echo '<a href="verificarcodigo.php">Validar Token</a>';
?>
<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <?php
    require_once(dirvista . 'headerelementos.php');
    ?>
    <title>Enviar Código por AJAX</title>
</head>
<body>
    <h1>Ingresa tu código de verificación</h1>
    <form id="codigoForm">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required>
        <button type="submit">Verificar</button>
    </form>
    <div id="resultado"></div>

    <script>
        $(document).ready(function() {
            $('#codigoForm').on('submit', function(event) {
                event.preventDefault(); // Evitar que el formulario se envíe normalmente

                // Obtener el valor del código ingresado
                var codigoIngresado = $('#codigo').val();

                // Enviar el código mediante AJAX
                $.ajax({
                    url: 'verificarcodigo.php',
                    type: 'POST',
                    data: { codigo: codigoIngresado },
                    success: function(response) {
                        // Mostrar la respuesta del servidor
                        $('#resultado').html(response);
                    },
                    error: function() {
                        $('#resultado').html('Error al verificar el código.');
                    }
                });
            });
        });
    </script>
</body>
</html> -->