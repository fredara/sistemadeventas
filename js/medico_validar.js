function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.nombre_medico.value == "") {
		form.nombre_medico.focus();
		mostrar("El campo 'Nombre' es obligatorio!");
		return false;
	}
	
	if(form.apellido_medico.value == "") {
		form.apellido_medico.focus();
		mostrar("El campo 'Apellido' es obligatorio!");
		return false;
	}
	
	if(form.ced_medico.value == "") {
		form.ced_medico.focus();
		mostrar("El campo 'C&eacute;dula' es obligatorio!");
		return false;
	} else {
	    if(!form.ced_medico.value.match(numericoRegEx)) {
			mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
			form.ced_medico.focus();
			return false;
		}
	}
	
	if(form.rif_medico.value == "") {
		form.rif_medico.focus();
		mostrar("El campo 'RIF' es obligatorio!");
		return false;
	}
	
	if(form.pre_email_medico.value == "") {
		form.pre_email_medico.focus();
		mostrar("Debe colocar un correo electrónico!");
		return false;
	}
	
	if(form.suf_email_medico.value == 0) {
		form.suf_email_medico.focus();
		mostrar("Debe seleccionar un dominio en su correo electrónico!");
		return false;
	}
	
	if(form.suf_email_medico.value == 'otro') {
		if(form.nombre_dominio_correo.value == "") {
			form.nombre_dominio_correo.focus();
			mostrar("Usted seleccion&oacute; la opci&oacute;n otro en correo electr&oacute;nico, por lo tanto debe llenar el campo con el nombre de dominio!");
			return false;
		}
	}
	
	if(form.tlf_celular_medico.value == "") {
		form.tlf_celular_medico.focus();
		mostrar("Debe colocar un n&uacute;mero de celular!");
		return false;
	} else {
		if(!form.tlf_celular_medico.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono Celular' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_celular_medico.focus();
			return false;
		}
	}
	
	if(form.codigo_area_cel.value == 'otro') {
		if(form.codigo_area_cel_otro.value == "") {
			form.codigo_area_cel_otro.focus();
			mostrar("Usted seleccion&oacute; la opci&oacute;n otro en c&oacute;digo de &aacute;rea del celular, por lo tanto debe llenar el campo con el n&uacute;mero de c&oacute;digo!");
			return false;
		}
	}
	
	if(form.cod_especialidad.value == 0) {
		form.cod_especialidad.focus();
		mostrar("Debe seleccionar una 'Especialidad'!");
		return false;
	}
	
	return true;
}

function validarClinicaAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.nombre_clinica.value == "") {
		form.nombre_clinica.focus();
		mostrar("El campo 'Nombre de la Clinica' es obligatorio!");
		return false;
	}
	
	if(form.cod_estado.value == 0) {
		form.cod_estado.focus();
		mostrar("Debe seleccionar un 'Estado' en la Direcci&oacute;n!");
		return false;
	}
	
	if(form.cod_estado.value != 0 && form.cod_municipio.value == 0) {
		form.cod_municipio.focus();
		mostrar("Debe seleccionar un 'Municipio' en la Direcci&oacute;n!");
		return false;
	}
	
	if(form.cod_municipio.value != 0 && form.cod_parroquia.value == 0) {
		form.cod_parroquia.focus();
		mostrar("Debe seleccionar una 'Parroquia' en la Direcci&oacute;!");
		return false;
	}
	
	if(form.calle_av_clinica.value == "") {
		form.calle_av_clinica.focus();
		mostrar("El campo 'Calle/Avenida' en la Direcci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.edif_casa_clinica.value == "") {
		form.edif_casa_clinica.focus();
		mostrar("El campo 'Edificio/Casa' en la Direcci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.apto_clinica.value == "") {
		form.apto_clinica.focus();
		mostrar("El campo 'Número de Apto, Local u Oficina' en la Direcci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.piso_clinica.value == "") {
		form.piso_clinica.focus();
		mostrar("El campo 'Piso' en la Direcci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.tlf_clinica.value == "" && form.tlf_clinica_2.value == "") {
		form.tlf_clinica.focus();
		mostrar("Debe colocar un n&uacute;mero de teléfono!");
		return false;
	} else {
		if( !form.tlf_clinica.value.match(numericoRegEx) || !form.tlf_clinica_2.value.match(numericoRegEx) ) {
			mostrar("El campo 'Tel&eacute;fono' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_clinica.focus();
			return false;
		}
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.nombre_medico.value == "") {
		form.nombre_medico.focus();
		mostrar("El campo 'Nombre' es obligatorio!");
		return false;
	}
	
	if(form.apellido_medico.value == "") {
		form.apellido_medico.focus();
		mostrar("El campo 'Apellido' es obligatorio!");
		return false;
	}
	
	if(form.ced_medico.value == "") {
		form.ced_medico.focus();
		mostrar("El campo 'C&eacute;dula' es obligatorio!");
		return false;
	} else {
	    if(!form.ced_medico.value.match(numericoRegEx)) {
			mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
			form.ced_medico.focus();
			return false;
		}
	}
	
	if(form.rif_medico.value == "") {
		form.rif_medico.focus();
		mostrar("El campo 'RIF' es obligatorio!");
		return false;
	}
	
	if(form.pre_email_medico.value == "") {
		form.pre_email_medico.focus();
		mostrar("Debe colocar un correo electrónico!");
		return false;
	}
	
	if(form.suf_email_medico.value == 0) {
		form.suf_email_medico.focus();
		mostrar("Debe seleccionar un dominio en su correo electrónico!");
		return false;
	}
	
	if(form.suf_email_medico.value == 'otro') {
		if(form.nombre_dominio_correo.value == "") {
			form.nombre_dominio_correo.focus();
			mostrar("Usted seleccion&oacute; la opci&oacute;n otro en correo electr&oacute;nico, por lo tanto debe llenar el campo con el nombre de dominio!");
			return false;
		}
	}
	
	if(form.tlf_celular_medico.value == "") {
		form.tlf_celular_medico.focus();
		mostrar("Debe colocar un n&uacute;mero de celular!");
		return false;
	} else {
		if(!form.tlf_celular_medico.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono Celular' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_celular_medico.focus();
			return false;
		}
	}
	
	if(form.codigo_area_cel.value == 'otro') {
		if(form.codigo_area_cel_otro.value == "") {
			form.codigo_area_cel_otro.focus();
			mostrar("Usted seleccion&oacute; la opci&oacute;n otro en c&oacute;digo de &aacute;rea del celular, por lo tanto debe llenar el campo con el n&uacute;mero de c&oacute;digo!");
			return false;
		}
	}
	
	if(form.cod_especialidad.value == 0) {
		form.cod_especialidad.focus();
		mostrar("Debe seleccionar una 'Especialidad'!");
		return false;
	}
	
	return true;
}

function validarClinicaMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.nombre_medico.value == "") {
		form.nombre_medico.focus();
		mostrar("El campo 'Nombre' es obligatorio!");
		return false;
	}
	
	if(form.apellido_medico.value == "") {
		form.apellido_medico.focus();
		mostrar("El campo 'Apellido' es obligatorio!");
		return false;
	}
	
	if(form.ced_medico.value == "") {
		form.ced_medico.focus();
		mostrar("El campo 'C&eacute;dula' es obligatorio!");
		return false;
	} else {
	    if(!form.ced_medico.value.match(numericoRegEx)) {
			mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
			form.ced_medico.focus();
			return false;
		}
	}
	
	if(form.rif_medico.value == "") {
		form.rif_medico.focus();
		mostrar("El campo 'RIF' es obligatorio!");
		return false;
	}
	
	if(form.pre_email_medico.value == "") {
		form.pre_email_medico.focus();
		mostrar("Debe colocar un correo electrónico!");
		return false;
	}
	
	if(form.suf_email_medico.value == 0) {
		form.suf_email_medico.focus();
		mostrar("Debe seleccionar un dominio en su correo electrónico!");
		return false;
	}
	
	if(form.suf_email_medico.value == 'otro') {
		if(form.nombre_dominio_correo.value == "") {
			form.nombre_dominio_correo.focus();
			mostrar("Usted seleccion&oacute; la opci&oacute;n otro en correo electr&oacute;nico, por lo tanto debe llenar el campo con el nombre de dominio!");
			return false;
		}
	}
	
	if(form.tlf_celular_medico.value == "") {
		form.tlf_celular_medico.focus();
		mostrar("Debe colocar un n&uacute;mero de celular!");
		return false;
	} else {
		if(!form.tlf_celular_medico.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono Celular' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_celular_medico.focus();
			return false;
		}
	}
	
	if(form.codigo_area_cel.value == 'otro') {
		if(form.codigo_area_cel_otro.value == "") {
			form.codigo_area_cel_otro.focus();
			mostrar("Usted seleccion&oacute; la opci&oacute;n otro en c&oacute;digo de &aacute;rea del celular, por lo tanto debe llenar el campo con el n&uacute;mero de c&oacute;digo!");
			return false;
		}
	}
	
	if(form.cod_especialidad.value == 0) {
		form.cod_especialidad.focus();
		mostrar("Debe seleccionar una 'Especialidad'!");
		return false;
	}
	
	if(form.num_colegio_medico.value == "") {
		form.num_colegio_medico.focus();
		mostrar("El campo 'N&uacute;mero de Colegio' es obligatorio!");
		return false;
	}
	
	if(form.calle_av_medico.value == "") {
		form.calle_av_medico.focus();
		mostrar("El campo 'Calle/Avenida' en la Direcci&oacute;n del Consultorio es obligatorio!");
		return false;
	}
	
	if(form.edif_casa_medico.value == "") {
		form.edif_casa_medico.focus();
		mostrar("El campo 'Edificio/Casa' en la Direcci&oacute;n del Consultorio es obligatorio!");
		return false;
	}
	
	if(form.apto_medico.value == "") {
		form.apto_medico.focus();
		mostrar("El campo 'Apto' en la Direcci&oacute;n del Consultorio es obligatorio!");
		return false;
	}
	
	if(form.tlf_consultorio_medico.value == "") {
		form.tlf_consultorio_medico.focus();
		mostrar("Debe colocar un n&uacute;mero de tel&eacute;fono del consultorio!");
		return false;
	} else {
		if(!form.tlf_consultorio_medico.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono del Consultorio' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_consultorio_medico.focus();
			return false;
		}
	}
	
	if(form.codigo_area_consultorio.value == 'otro') {
		if(form.codigo_area_consultorio_otro.value == "") {
			form.codigo_area_consultorio_otro.focus();
			mostrar("Usted seleccion&oacute; la opci&oacute;n otro en c&oacute;digo de &aacute;rea del tel&eacute;fono del consultorio, por lo tanto debe llenar el campo con el n&uacute;mero de c&oacute;digo!");
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