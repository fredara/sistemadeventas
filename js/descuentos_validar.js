function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	
	if(form.nombre_descuento.value == '') {
		form.nombre_descuento.focus();
		mostrar("Debe 'Asignar un Nombre al Descuento' es obligatorio!");
		return false;
	}
	
	if(form.monto_descuento.value == '') {
		form.monto_descuento.focus();
		mostrar("Debe 'Asignar un Monto al Descuento' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	
	if(form.monto_descuento.value == '') {
		form.monto_descuento.focus();
		mostrar("Debe 'Asignar un Monto al Descuento' es obligatorio!");
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