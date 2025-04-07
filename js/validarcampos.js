// sirve para mostrar una alerta y cambiar el color en un campo
function estiloCajas($param,$mensaje) {
	$param.focus(); //Devolver foco
    $param.parent().children("span").text($mensaje).show().css("color", "red"); //Mensaje y color del mensaje
}

// ocultamos alerta
function ocultarCajas($param){
	$param.parent().children("span").text("").hide();
}

// validamos el numero de caracteres permitidos
function validarInput($idInput,$mensaje){
	if ($idInput.val().length < 3) {
		estiloCajas($idInput,$mensaje); //mostramos la alerta
		return true;
	}
	else{
		ocultarCajas($idInput); //ocultamos la alerta
		return false;	
	}
}

// validamos que el correo tenga el @ y termine en .co, .es, entre otros
function validarCorreo($idInput,$mensaje){
	var expC = /^([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z]{2,})+$/;

	if (!expC.test($idInput.val())) {
		estiloCajas($idInput,$mensaje);
		return true;
	}
	else{
		ocultarCajas($idInput);
		return false;	
	}
}

// validamos que la direccion contenga las siguiente condiciones
// cll 54 # 20 20, cr 12 # 42 30, cll 30 # 15 - 43
function validarDireccion($idInput,$mensaje){
	var expD = /^([a-zA-Z]+\s)+([a-zA-Z0-9]+\s)+[\#|n|N]+\s(([0-9])+\s+[\-|n|N|\#|\s]+\s)+([0-9]{1,})+$/;

	if (!expD.test($idInput.val())) {
	    estiloCajas($idInput,$mensaje);
	    return true;
	}
	else{
	    ocultarCajas($idInput);
	    return false; 
	}
}

// validamos el numero de caracteres permitidos en un combobox
function validarCombobox($idInput,$mensaje){
	if ($idInput.val().length === 0) {
		$idInput.text($mensaje).show().css("color", "red");
		return true;
	}
	else{
		ocultarCajas($idInput);
		return false;	
	}
}