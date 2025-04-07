<?php
define('base', rtrim(__DIR__, '/') . '/'); // Ruta base del proyecto

//RutaDinamica
// define('dirdina', base . 'vista/');

//recurso Funciones y Descripcion atributos de Tabla en mysql
define('dirrecursos',  'recursos/');

//cargar vista tablas, Navegacion, Pie de pagina
define('dirvista', 'vista/');

//carrito de compra
define('dircar', 'metodoscarrito/');

//libreria pdf
define('dirpdf','libpdf/tcpdf.php');

//Se Implementan PDFS Asi
// require_once('path.php');
// require_once(dirpdf);

// reportes pdf
define('doct','reportes/');

//sesion
define('dirsesion','metodossesion/');

// echo dirrecursos;
?>