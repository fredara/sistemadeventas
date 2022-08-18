function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	
	if(form.cod_categoria_prod.value == 0) {
		form.cod_categoria_prod.focus();
		mostrar("La 'Categor&iacute;a la que pertenece' es obligatoria!");
		return false;
	}
	
	if(form.nombre_producto.value == '') {
		form.nombre_producto.focus();
		mostrar("El 'Nombre del Producto' es obligatorio!");
		return false;
	}
	
	if(form.monto_producto.value == '' && form.porcentaje_producto.value == '') {
		form.porcentaje_producto.focus();
		mostrar("Debe 'Asignar un Monto al Producto o un Porcentaje' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	
	if(form.cod_categoria_prod.value == 0) {
		form.cod_categoria_prod.focus();
		mostrar("La 'Categor&iacute;a la que pertenece' es obligatoria!");
		return false;
	}
	
	if(form.nombre_producto.value == '') {
		form.nombre_producto.focus();
		mostrar("El 'Nombre del Producto' es obligatorio!");
		return false;
	}
	
	if(form.monto_producto.value == '' && form.porcentaje_producto.value == '') {
		form.porcentaje_producto.focus();
		mostrar("Debe 'Asignar un Monto al Producto o un Porcentaje' es obligatorio!");
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