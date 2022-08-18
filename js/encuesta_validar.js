function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.titulo_encuesta.value == "") {
		form.titulo_encuesta.focus();
		mostrar("El campo 'T&iacute;tulo' es obligatorio!");
		return false;
	}
	
	if(form.pregunta_encuesta.value == "") {
		form.pregunta_encuesta.focus();
		mostrar("El campo 'Pregunta' es obligatorio!");
		return false;
	}
	
	var radioCheck = false;
	for (i = 0; i < form.tipo_encuesta.length; i++) {
		if (form.tipo_encuesta[i].checked)
		    radioCheck = true;
	}
				
	if (!radioCheck) {
		mostrar("Debe seleccionar el 'Tipo de Respuesta'!");
		return false;
	}
	
	for (i = 0; i < form.tipo_encuesta.length; i++) {
		if (form.tipo_encuesta[i].checked) {
			if ((form.tipo_encuesta[i].value == "m") && (form.respuesta1_encuesta.value == "") && (form.respuesta2_encuesta.value == "")) {
				mostrar("Los Campos 'Respuesta1 y Respuesta2' son obligatorios ya que usted seleccion&oacute; Respuestas M&uacute;ltiples!");
				return false;
			}
		}		    
	}
	
	var radioEstatus = false;
	for (i = 0; i < form.estatus_encuesta.length; i++) {
		if (form.estatus_encuesta[i].checked)
		    radioEstatus = true;
	}
				
	if (!radioEstatus) {
		mostrar("Debe seleccionar el 'Estatus'!");
		return false;
	}
	
	if(form.cod_grupo_encuesta.value == "0") {
		mostrar("El campo 'Grupo' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.titulo_encuesta.value == "") {
		form.titulo_encuesta.focus();
		mostrar("El campo 'T&iacute;tulo' es obligatorio!");
		return false;
	}
	
	if(form.pregunta_encuesta.value == "") {
		form.pregunta_encuesta.focus();
		mostrar("El campo 'Pregunta' es obligatorio!");
		return false;
	}
	
	var radioCheck = false;
	for (i = 0; i < form.tipo_encuesta.length; i++) {
		if (form.tipo_encuesta[i].checked)
		    radioCheck = true;
	}
				
	if (!radioCheck) {
		mostrar("Debe seleccionar el 'Tipo de Respuesta'!");
		return false;
	}
	
	for (i = 0; i < form.tipo_encuesta.length; i++) {
		if (form.tipo_encuesta[i].checked) {
			if ((form.tipo_encuesta[i].value == "m") && (form.respuesta1_encuesta.value == "") && (form.respuesta2_encuesta.value == "")) {
				mostrar("Los Campos 'Respuesta1 y Respuesta2' son obligatorios ya que usted seleccion&oacute; Respuestas M&uacute;ltiples!");
				return false;
			}
		}		    
	}
	
	var radioEstatus = false;
	for (i = 0; i < form.estatus_encuesta.length; i++) {
		if (form.estatus_encuesta[i].checked)
		    radioEstatus = true;
	}
				
	if (!radioEstatus) {
		mostrar("Debe seleccionar el 'Estatus'!");
		return false;
	}
	
	if(form.cod_grupo_encuesta.value == "0") {
		mostrar("El campo 'Grupo' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarResponder(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.tipo_encuesta.value == "m") {
		var radioCheck = false;
		for (i = 0; i < form.respuesta_encuesta.length; i++) {
			if (form.respuesta_encuesta[i].checked)
		    radioCheck = true;
		}
		if (!radioCheck) {
			mostrar("Debe seleccionar una respuesta!");
			return false;
		}
	} else {
		if(form.respuesta_encuesta_des.value == "") {
			mostrar("El campo 'Respuesta' es obligatorio!");
			return false;
		}
	}
	window.opener.document.location.reload();
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