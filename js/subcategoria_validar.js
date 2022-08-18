function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.cod_categoria_prod.value == 0) {
		form.cod_categoria_prod.focus();
		mostrar("La 'Categor&iacute;a la que pertenece' es obligatoria!");
		return false;
	}
	
	if(form.nombre_subcategoria_prod.value == '') {
		form.nombre_subcategoria_prod.focus();
		mostrar("El 'Nombre de la Sub-Categor&iacute;a' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.cod_categoria_prod.value == 0) {
		form.cod_categoria_prod.focus();
		mostrar("La 'Categor&iacute;a la que pertenece' es obligatoria!");
		return false;
	}
	
	if(form.nombre_subcategoria_prod.value == '') {
		form.nombre_subcategoria_prod.focus();
		mostrar("El 'Nombre de la Sub-Categor&iacute;a' es obligatorio!");
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