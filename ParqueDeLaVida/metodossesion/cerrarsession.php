<?php 
	// Abrimos la sesión
	session_start();
	
	$tipoUsuario = isset($_GET['logout']) ? trim($_GET['logout']) : null;

	if ($tipoUsuario === "Cliente") {
		// Usamos la función session_unset(), sirve para liberar la sesión
		$productos = array();
		$_SESSION['articulos'] = $productos;
		
		unset($_SESSION['usuario']);
	}

	if ($tipoUsuario === "Administrador") {
		// Usamos la función session_unset(), sirve para liberar la sesión
	    unset($_SESSION['admin']);
	}
	 
	// Despues de destruirse la sesion, se carga la página principal
	header("location:../index.php"); 

?>