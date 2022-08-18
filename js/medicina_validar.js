function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	
	if(form.nombre_medicina.value == '') {
		form.nombre_medicina.focus();
		mostrar("El 'Nombre de la Medicina' es obligatorio!");
		return false;
	}
	
	if(form.cod_presentacion.value == 0) {
		form.cod_presentacion.focus();
		mostrar("La 'Presentación de la Medicina' es obligatoria!");
		return false;
	}
	
	if(form.cantidad_presentacion.value != '') {
		if(!form.cantidad_presentacion.value.match(numericoRegEx)) {
			mostrar("El campo 'Cantidad' s&oacute;lo puede contener n&uacute;meros.");
			form.cantidad_presentacion.focus();
			return false;
		}
	}
	
	if(form.cantidad_presentacion.value != '') {
		if(form.nombre_cantidad_presentacion.value == 0) {
			form.nombre_cantidad_presentacion.focus();
			mostrar("Debe indicar si es ml o mg en cantidad!");
			return false;
		}
	}
	
	if(form.cod_laboratorio.value == 0) {
		form.cod_laboratorio.focus();
		mostrar("El 'Laboratorio' es obligatorio!");
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
	document.getElementById('Errores').style.background = "#ffffff";
	document.getElementById('Errores').style.font = 'bold 12px Century Gothic';
	document.getElementById('Errores').style.color = '#0033FF';
	document.getElementById('Errores').style.textAlign =  'center';
	document.getElementById('Errores').style.padding = '3px';

}