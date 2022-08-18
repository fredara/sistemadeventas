function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/
	
	if(form.cod_modulo.value == 0) {
		form.cod_modulo.focus();
		mostrar("El campo 'M&oacute;dulo' es obligatorio!");
		return false;
	}
	
	if(form.cod_prioridad_ticket.value == 0) {
		form.cod_prioridad_ticket.focus();
		mostrar("El campo 'Prioridad' es obligatorio!");
		return false;
	}

	if(form.asunto_ticket.value == "") {
		form.asunto_ticket.focus();
		mostrar("El campo 'Asunto' es obligatorio!");
		return false;
	}
	
	if(form.mensaje_ticket.value == "") {
		form.mensaje_ticket.focus();
		mostrar("El campo 'Mensaje' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/
	
	if(form.cod_modulo.value == 0) {
		form.cod_modulo.focus();
		mostrar("El campo 'M&oacute;dulo' es obligatorio!");
		return false;
	}
	
	if(form.cod_prioridad_ticket.value == 0) {
		form.cod_prioridad_ticket.focus();
		mostrar("El campo 'Prioridad' es obligatorio!");
		return false;
	}

	if(form.asunto_ticket.value == "") {
		form.asunto_ticket.focus();
		mostrar("El campo 'Asunto' es obligatorio!");
		return false;
	}
	
	if(form.mensaje_ticket.value == "") {
		form.mensaje_ticket.focus();
		mostrar("El campo 'Mensaje' es obligatorio!");
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