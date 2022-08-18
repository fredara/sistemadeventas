function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.ced_usuario.value == "") {
		form.ced_usuario.focus();
		mostrar("El campo 'C&eacute;dula' es obligatorio!");
		return false;
	} else {
	    if(!form.ced_usuario.value.match(numericoRegEx)) {
			mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
			form.ced_usuario.focus();
			return false;
		}
	}
	
	if(form.dia_nacimiento.value == 0) {
		form.dia_nacimiento.focus();
		mostrar("El 'D&iacute;a de Nacimiento' es obligatorio!");
		return false;
	}
	
	if(form.mes_nacimiento.value == 0) {
		form.mes_nacimiento.focus();
		mostrar("El 'Mes de Nacimiento' es obligatorio!");
		return false;
	}
				
	if(form.anio_nacimiento.value == 0) {
		form.anio_nacimiento.focus();
		mostrar("El 'A&ntilde;o de Nacimiento' es obligatorio!");
		return false;
	} /*else {
		hoy=new Date() 
		var ano_actual= hoy.getYear();
		if(form.anio_nacimiento.value > ano_actual ) {
			form.anio_nacimiento.focus();
			mostrar("Verifique que el a&ntilde;o de nacimiento este correcto");
			return false;
		}
	}*/
	
	if(form.email_usuario.value == "") {
		form.email_usuario.focus();
		mostrar("El campo 'Correo Electr&oacute;nico' es obligatorio!");
		return false;
	} else {
		if(!form.email_usuario.value.match(emailRegEx)) {
			form.email_usuario.focus();
			mostrar("Debe ingresar una direcci&oacute;n de correo v&aacute;lida.");
			return false;
		}
	}
	
	if(form.nombre_usuario.value == "") {
		form.nombre_usuario.focus();
		mostrar("El campo 'Nombres' es obligatorio!");
		return false;
	}
	
	if(form.cod_pais_nacimiento_usuario.value == 0) {
		form.cod_pais_nacimiento_usuario.focus();
		mostrar("El campo 'Pa&iacute;s de Nacimiento' es obligatorio!");
		return false;
	}
	
	if(form.login_usuario.value == "") {
		form.login_usuario.focus();
		mostrar("El campo 'Login' es obligatorio!");
		return false;
	} else {
		if(form.login_usuario.value.length < 6) {
			form.login_usuario.focus();
			mostrar("El 'Login' debe tener al menos 6 caracteres!");
			return false;
		}	
	}
	
	if(form.apellido_usuario.value == "") {
		form.apellido_usuario.focus();
		mostrar("El campo 'Apellidos' es obligatorio!");
		return false;
	}
	
	if(form.lugar_nacimiento_usuario.value == "") {
		form.lugar_nacimiento_usuario.focus();
		mostrar("El campo 'Lugar de Nacimiento' es obligatorio!");
		return false;
	}	
	
	if(form.clave_usuario.value == "") {
		form.clave_usuario.focus();
		mostrar("El campo 'Clave' es obligatorio!");
		return false;
	} else {
		if(form.clave_usuario.value.length < 6) {
			form.clave_usuario.focus();
			mostrar("La 'Clave' debe tener al menos 6 caracteres!");
			return false;
		}
	}
	
	if(form.clave_rep_usuario.value == "") {
		form.clave_rep_usuario.focus();
		mostrar("El campo 'Repita Clave' es obligatorio!");
		return false;
	} else {
		if(form.clave_rep_usuario.value != form.clave_usuario.value) {
		    mostrar("La 'Claves' no coinciden!");
		    return false;
		}
	}
	
	if(form.telefono_habitacion.value == "") {
		form.telefono_habitacion.focus();
		mostrar("El campo 'Tel&eacute;fono de Habitaci&oacute;n' es obligatorio!");
		return false;
	} else {
		if(!form.telefono_habitacion.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono de Habitaci&oacute;n' s&oacute;lo puede contener n&uacute;meros.");
			form.telefono_habitacion.focus();
			return false;
		}
	}
	
	if(form.cod_grupo.value == 0) {
		form.cod_grupo.focus();
		mostrar("El campo 'Grupo' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.ced_usuario.value == "") {
		form.ced_usuario.focus();
		mostrar("El campo 'C&eacute;dula' es obligatorio!");
		return false;
	} else {
	    if(!form.ced_usuario.value.match(numericoRegEx)) {
			mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
			form.ced_usuario.focus();
			return false;
		}
	}
	
	if(form.dia_nacimiento.value == 0) {
		form.dia_nacimiento.focus();
		mostrar("El 'D&iacute;a de Nacimiento' es obligatorio!");
		return false;
	}
	
	if(form.mes_nacimiento.value == 0) {
		form.mes_nacimiento.focus();
		mostrar("El 'Mes de Nacimiento' es obligatorio!");
		return false;
	}
				
	if(form.anio_nacimiento.value == 0) {
		form.anio_nacimiento.focus();
		mostrar("El 'A&ntilde;o de Nacimiento' es obligatorio!");
		return false;
	} else {
		if(form.anio_nacimiento.value > 2009 ) {
			form.anio_nacimiento.focus();
			mostrar("Verifique que el a&ntilde;o de nacimiento este correcto");
			return false;
		}
	}
	
	if(form.email_usuario.value == "") {
		form.email_usuario.focus();
		mostrar("El campo 'Correo Electr&oacute;nico' es obligatorio!");
		return false;
	} else {
		if(!form.email_usuario.value.match(emailRegEx)) {
			form.email_usuario.focus();
			mostrar("Debe ingresar una direcci&oacute;n de correo v&aacute;lida.");
			return false;
		}
	}
	
	if(form.nombre_usuario.value == "") {
		form.nombre_usuario.focus();
		mostrar("El campo 'Nombres' es obligatorio!");
		return false;
	}
	
	if(form.cod_pais_nacimiento_usuario.value == 0) {
		form.cod_pais_nacimiento_usuario.focus();
		mostrar("El campo 'Pa&iacute;s de Nacimiento' es obligatorio!");
		return false;
	}
	
	if(form.login_usuario.value == "") {
		form.login_usuario.focus();
		mostrar("El campo 'Login' es obligatorio!");
		return false;
	} else {
		if(form.login_usuario.value.length < 6) {
			form.login_usuario.focus();
			mostrar("El 'Login' debe tener al menos 6 caracteres!");
			return false;
		}	
	}
	
	if(form.apellido_usuario.value == "") {
		form.apellido_usuario.focus();
		mostrar("El campo 'Apellidos' es obligatorio!");
		return false;
	}
	
	if(form.lugar_nacimiento_usuario.value == "") {
		form.lugar_nacimiento_usuario.focus();
		mostrar("El campo 'Lugar de Nacimiento' es obligatorio!");
		return false;
	}	
	
	if(form.clave_rep_usuario.value != "" && form.clave_usuario.value != "") {
		if(form.clave_rep_usuario.value != form.clave_usuario.value) {
		    mostrar("La 'Claves' no coinciden!");
		    return false;
		}
	}
	
	if(form.telefono_habitacion.value == "") {
		form.telefono_habitacion.focus();
		mostrar("El campo 'Tel&eacute;fono de Habitaci&oacute;n' es obligatorio!");
		return false;
	} else {
		if(!form.telefono_habitacion.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono de Habitaci&oacute;n' s&oacute;lo puede contener n&uacute;meros.");
			form.telefono_habitacion.focus();
			return false;
		}
	}
	
	if(form.cod_grupo.value == 0) {
		form.cod_grupo.focus();
		mostrar("El campo 'Grupo' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarCambioClave(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.clave_anterior.value == "") {
		form.clave_anterior.focus();
		mostrar("El campo 'Clave anterior' es obligatorio!");
		return false;
	}
	
	if(form.clave_anterior2.value == "") {
		form.clave_anterior2.focus();
		mostrar("El campo 'Confirmar clave anterior' es obligatorio!");
		return false;
	} else {
		if(form.clave_anterior.value != form.clave_anterior2.value) {
		    mostrar("La 'Claves' no coinciden!");
		    return false;
		}
	}
	
	if(form.clave_actual.value == "") {
		form.clave_actual.focus();
		mostrar("El campo 'Clave actual' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarCambioClaveSuper(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	if(form.clave_actual.value == "") {
		form.clave_actual.focus();
		mostrar("El campo 'Clave actual' es obligatorio!");
		return false;
	}
	
	if(form.clave_actual2.value == "") {
		form.clave_actual2.focus();
		mostrar("El campo 'Confirmar clave actual' es obligatorio!");
		return false;
	} else {
		if(form.clave_actual.value != form.clave_actual2.value) {
		    mostrar("La 'Claves' no coinciden!");
		    return false;
		}
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