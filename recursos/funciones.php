<?php
function formatoMoneda($cantidad, $decimales = 0) {
    return "$ " . number_format($cantidad, $decimales, ",", ".");
}

function formatoMoneda1($cantidad, $decimales = 0) {
    return number_format($cantidad, $decimales, ",", ".");
}
?>
