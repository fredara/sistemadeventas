function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.nombre_tratamiento.value == "") {
		form.nombre_tratamiento.focus();
		mostrar("El campo 'Nombre del Tratamiento' es obligatorio!");
		return false;
	}
	
	if(form.contenidotratamiento.value == "") {
		mostrar("El campo 'Contenido del Tratamiento' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.nombre_tratamiento.value == "") {
		form.nombre_tratamiento.focus();
		mostrar("El campo 'Nombre del Tratamiento' es obligatorio!");
		return false;
	}
	
	if(form.contenidotratamiento.value == "") {
		mostrar("El campo 'Contenido del Tratamiento' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarModTra(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.contenidotratamiento.value == "") {
		mostrar("El campo 'Contenido del Tratamiento' es obligatorio!");
		return false;
	}
	
	if(form.recipetratamiento.value == "") {
		mostrar("El campo 'Nombre del Tratamiento' es obligatorio!");
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