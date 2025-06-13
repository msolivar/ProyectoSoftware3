<?php

function formatoMoneda($cantidad, $decimales = 0) {
    return "$ " . number_format($cantidad, $decimales, ",", ".");
}

function formatoMoneda1($cantidad, $decimales = 0) {
    return number_format($cantidad, $decimales, ",", ".");
}

function enviarCorreo($correo, $asunto, $mensaje) {
    // Cabeceras
    $headers = "From: no-reply@ecoparquedelavida.intermediacol.com\r\n";
    $headers .= "Reply-To: no-reply@ecoparquedelavida.intermediacol.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Enviar el correo
    return mail($correo, $asunto, $mensaje, $headers, "-fno-reply@ecoparquedelavida.intermediacol.com");
}

?>

