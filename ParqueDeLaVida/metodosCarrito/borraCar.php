<?php
    session_start();
    error_reporting(E_ALL);
    @ini_set('display_errors', '1');
    
    //con session_start() creamos la sesión si no existe o la retomamos si ya
    //ha sido creada.
    extract($_REQUEST);
    $productos=$_SESSION['articulos'];
    
    //Asignamos a la variable $productos los valores guardados en la sessión
    unset($productos[md5($id)]);
    
    //la función unset borra el elemento de un array que le pasemos por parámetro.
    //En este caso la usamos para borrar el elemento cuyo id le pasemos a la
    //página por la url.
    $_SESSION['articulos']=$productos;
    
    //Finalmente, actualizamos la sessión, como hicimos cuando agregamos un
    //producto y volvemos al catálogo.

    if($estado=="DeleteAlInicio"){
        header("Location:../index.php?&id=".$id);
    }
    else if($estado=="DeleteEnCarrito"){
        header("Location:../vercarrito.php?&id=".$id);
    }
    else if($estado=="DeleteEnPedido"){
        header("Location:../pedido.php?&id=".$id);
    }
    else{
        echo "No se puede cargar el recurso: <b>".$estado."</b>";
    }
?>