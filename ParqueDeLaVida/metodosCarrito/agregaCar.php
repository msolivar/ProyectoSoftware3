<?php

session_start();
error_reporting(E_ALL);
@ini_set('display_errors', '1');

//con session_start() creamos la sesión si no existe o la retomamos si ya ha
//sido creada

extract($_REQUEST);

//la función extract toma las claves de una matriz asoiativa y las convierte 
//en nombres de variable, ejemplo: $id=$_GET['ID']; 

require_once('../conexionbd.php');

//incluímos la conexión a nuestra base de datos

$qry = $conexion->query("SELECT * FROM boleto WHERE evento='" . $detalleEntrada . "'");
$row = $qry->fetch_array();

//Si ya hemos introducido algún producto en el carro lo tendremos guardado 
//temporalmente en el array superglobal $_SESSION['carro'], de manera que 
//rescatamos los valores de dicho array y se los asignamos a la variable $productos, 
//previa comprobación con isset de que $_SESSION['carro'] ya haya sido definida

if (isset($_SESSION['articulos']))

    $productos = $_SESSION['articulos'];

//Ahora introducimos el nuevo producto en la matriz $productos, utilizando como índice
// el id del producto, encriptado con md5. Utilizamos md5 porque genera 
//un valor alfanumérico que luego, cuando busquemos un producto en particular dentro 
//de la matriz, no podrá ser confundido con la posición que ocupa dentro de dicha 
//matriz, como podría ocurrir si fuera sólo numérico. Cabe aclarar que si el producto
//ya había sido agregado antes, los nuevos valores que le asignemos reemplazarán
//a los viejos. 
//Al mismo tiempo, y no porque sea estrictamente necesario sino a modo de ejemplo, 
//guardamos más de un valor en la variable $productos, valiéndonos de nuevo de la 
//herramienta array.

if ($cantidad <= $row['disponibles']) {

    $productos[md5($row['id'])] =

        array(
            'id' => $row['id'],
            'entrada' => $detalleEntrada,
            'cantidadSolicitada' => $cantidad,
            'precio' => $row['precio'],
            'totalAPagar' => $cantidad * $row['precio']
        );

    //Ahora dentro de la sesión ($_SESSION['carro']) tenemos sólo los valores que teníamos
    // (si es que teníamos alguno) antes de ingresar a esta página y en la variable $productos
    //tenemos esos mismos valores más el que acabamos de sumar. De manera que 
    //tenemos que actualizar (reemplazar) la variable de sesión por la variable $productos.

    $_SESSION['articulos'] = $productos;

    //Y volvemos a nuestro catálogo de artículos. La cadena SID representa al
    //identificador de la sesión, que, dependiendo  de la configuración del servidor
    //y de si el usuario tiene o no activadas las cookies puede no ser necesario
    //pasarla por la url. Pero para que nuestro carro funcione, independientemente
    //de esos factores, conviene escribirla siempre.

    header("Location:../iniciousuario.php");
} else {

    echo '<script type="text/javascript">
	    alert("El evento: ' . $detalleEntrada . ', no se puede añadir al carrito. \\nPorque solo hay ' . $row["disponibles"] . ' unidades disponibles en el aforo.");
  		window.location="../iniciousuario.php"
	    </script>';
}
