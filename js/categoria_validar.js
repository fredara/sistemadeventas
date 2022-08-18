function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.nombre_categoria_prod.value == '') {
		form.nombre_categoria_prod.focus();
		mostrar("El 'Nombre de la Categor&iacute;a' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.nombre_categoria_prod.value == '') {
		form.nombre_categoria_prod.focus();
		mostrar("El 'Nombre de la Categor&iacute;a' es obligatorio!");
		return false;
	}
	
	return true;
}

function mostrar(error) {
	document.getElementById('Errores').innerHTML = error;
	document.getElementById('Errores').style.background = "#ff0000";
	document.getElementById('Errores').style.font = '12px verdana,arial,helvetica,sans-serif';
	document.getElementById('Errores').style.color = '#ffffff';
	document.getElementById('Errores').style.textAlign =  'center';
	document.getElementById('Errores').style.padding = '3px';
}