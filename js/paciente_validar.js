function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	var numericoRegEx = /^\d*$/
	var fecha=new Date();
	var ano=fecha.getFullYear();

	if(form.ced_paciente.value == "") {
		form.ced_paciente.focus();
		mostrar("Debe completar la cédula del paciente!");
		
		return false;
	}
	
	if(!form.ced_paciente.value.match(numericoRegEx)) {
		mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
		
		form.ced_paciente.focus();
		return false;
	}

	if(form.nombre_paciente.value == "") {
		form.nombre_paciente.focus();
		mostrar("El campo 'Nombre' es obligatorio!");
		
		return false;
	}
	
	if(form.apellido1_paciente.value == "") {
		form.apellido1_paciente.focus();
		mostrar("El campo 'Primer Apellido' es obligatorio!");
		
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/


	if(form.ced_paciente.value == "") {
		form.ced_paciente.focus();
		mostrar("Debe completar la cédula del paciente!");
		
		return false;
	}
	
	if(!form.ced_paciente.value.match(numericoRegEx)) {
		mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
		
		form.ced_paciente.focus();
		return false;
	}

	if(form.nombre_paciente.value == "") {
		form.nombre_paciente.focus();
		mostrar("El campo 'Nombre' es obligatorio!");
		
		return false;
	}
	
	if(form.apellido1_paciente.value == "") {
		form.apellido1_paciente.focus();
		mostrar("El campo 'Primer Apellido' es obligatorio!");
		
		return false;
	}
	
	return true;
}

function validarAddPag1(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	var numericoRegEx = /^\d*$/
			
	if(form.ced_paciente.value == "") {
		form.ced_paciente.focus();
		mostrar("El campo 'C&eacute;dula' es obligatorio!");
		return false;
	} else {
	    if(!form.ced_paciente.value.match(numericoRegEx)) {
			mostrar("El campo 'C&eacute;dula' s&oacute;lo puede contener n&uacute;meros.");
			form.ced_paciente.focus();
			return false;
		}
	}

	if(form.nombre_paciente.value == "") {
		form.nombre_paciente.focus();
		mostrar("El campo 'Nombre' es obligatorio!");
		return false;
	}
	
	if(form.apellido1_paciente.value == "") {
		form.apellido1_paciente.focus();
		mostrar("El campo 'Primer Apellido' es obligatorio!");
		return false;
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
	}
				
	if(form.lugar_nacimiento_paciente.value == "") {
		form.lugar_nacimiento_paciente.focus();
		mostrar("El campo 'Lugar de Nacimiento' es obligatorio!");
		return false;
	}
	
	if(form.cod_pais_nacimiento_paciente.value == 0) {
		form.pais_nacimiento_paciente.focus();
		mostrar("El campo 'Pa&iacute;s de Nacimiento' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarAddPag2(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	var numericoRegEx = /^\d*$/
	
	if(form.cod_pais.value == 0) {
		form.cod_pais.focus();
		mostrar("El campo 'Pa&iacute;s' de la Direcci&oacute;n de Habitaci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.cod_pais.value == 233 && form.cod_estado.value == 0) {
		form.cod_estado.focus();
		mostrar("Usted seleccion&oacute; Venezuela, por lo tanto debe seleccionar el 'Estado' en la Direcci&oacute;n de Habitaci&oacute;n!");
		return false;
	}
	
	if(form.cod_estado.value != 0 && form.cod_municipio.value == 0) {
		form.cod_municipio.focus();
		mostrar("Debe seleccionar un 'Municipio' en la Direcci&oacute;n de Habitaci&oacute;n!");
		return false;
	}
	
	if(form.cod_municipio.value != 0 && form.cod_parroquia.value == 0) {
		form.cod_parroquia.focus();
		mostrar("Debe seleccionar una 'Parroquia' en la Direcci&oacute;n de Habitaci&oacute;n!");
		return false;
	}
	
	if(form.calle_av_paciente.value == "") {
		form.calle_av_paciente.focus();
		mostrar("El campo 'Calle/Avenida' en la Direcci&oacute;n de Habitaci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.edif_casa_paciente.value == "") {
		form.edif_casa_paciente.focus();
		mostrar("El campo 'Edificio/Casa' en la Direcci&oacute;n de Habitaci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.apto_paciente.value == "") {
		form.apto_paciente.focus();
		mostrar("El campo 'Apto' en la Direcci&oacute;n de Habitaci&oacute;n es obligatorio!");
		return false;
	}
	
	if(form.tlf_habitacion_paciente.value !== "") {
		if(!form.tlf_habitacion_paciente.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono de Habitaci&oacute;n' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_habitacion_paciente.focus();
			return false;
		}
	}
	
	if(form.tlf_trabajo_paciente.value !== "") {
		if(!form.tlf_trabajo_paciente.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono de Trabajo' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_trabajo_paciente.focus();
			return false;
		}
	}
	
	if(form.tlf_celular1_paciente.value !== "") {
		if(!form.tlf_celular1_paciente.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono Celular1' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_celular1_paciente.focus();
			return false;
		}
	}
	
	if(form.tlf_celular2_paciente.value !== "") {
		if(!form.tlf_celular2_paciente.value.match(numericoRegEx)) {
			mostrar("El campo 'Tel&eacute;fono Celular2' s&oacute;lo puede contener n&uacute;meros.");
			form.tlf_celular2_paciente.focus();
			return false;
		}
	}
	
	if(form.tlf_habitacion_paciente.value == "" && form.tlf_trabajo_paciente.value == "" && form.tlf_celular1_paciente.value == "" && form.tlf_celular2_paciente.value == "") {
		form.tlf_habitacion_paciente.focus();
		mostrar("Debe colocar al menos un n&uacute;mero de tel&eacute;fono!");
		return false;
	}
	
	if(form.pre_email_paciente.value !== "" && form.suf_email_paciente.value !== "") {
		email_paciente = form.pre_email_paciente.value + '@' + form.suf_email_paciente.value;
		if(!email_paciente.match(emailRegEx)) {
			form.pre_email_paciente.focus();
			mostrar("Debe ingresar una direcci&oacute;n de correo v&aacute;lida.");
			return false;
		}
	}
	
	return true;
}

function validarAddPag3(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	var numericoRegEx = /^\d*$/
	
	if(form.cod_profesion_paciente.value == 1 && form.nombre_profesion.value=="") {
		form.nombre_profesion.focus();
		mostrar("El campo 'Nombre de Otra Profesi&oacute;n' es obligatorio!");
		return false;
	}

	if(form.cod_ocupacion.value == 0) {
		form.cod_ocupacion.focus();
		mostrar("El campo 'Ocupaci&oacute;n' es obligatorio!");
		return false;
	} else {
	    if(form.cod_ocupacion.value == 20 && form.nombre_ocupacion.value=="") {
			form.nombre_ocupacion.focus();
			mostrar("El campo 'Nombre de Otra Ocupaci&oacute;n' es obligatorio!");
			return false;
		}
    }
	
	return true;
}

function validarAddPag4(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	var numericoRegEx = /^\d*$/
	
	if(form.ced_familiar.value != "" || form.nombre_familiar.value != "") {
		if(form.ced_familiar.value == "") {
			form.ced_familiar.focus();
			mostrar("El campo 'C&eacute;dula del Familiar' es obligatorio!");
			return false;
		}
		if(!form.ced_familiar.value.match(numericoRegEx)) {
			mostrar("El campo 'C&eacute;dula del Familiar' s&oacute;lo puede contener n&uacute;meros.");
			form.ced_familiar.focus();
			return false;
		}
		if(form.nombre_familiar.value == "") {
			form.nombre_familiar.focus();
			mostrar("El campo 'Nombre del Familiar' es obligatorio!");
			return false;
		}
		if(form.apellido1_familiar.value == "") {
			form.apellido1_familiar.focus();
			mostrar("El campo 'Primer Apellido del Familiar' es obligatorio!");
			return false;
		}
	}
	
	return true;
}

function validarAddPag5(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	var numericoRegEx = /^\d*$/
	
	return true;
}

function validarAddPag6(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	var numericoRegEx = /^\d*$/
	
	if(form.cod_medico_tratante.value == 'otro' && (form.nombre_medico_tratante.value=='Escriba el nombre' || form.apellido_medico_tratante.value=='Escriba el apellido')) {
		form.nombre_medico_tratante.focus();
		mostrar("El campo 'Nombre y Apellido de Otro M&eacute;dico' es obligatorio, ya que usted seleccion&oacute; la opci&oacute;n 'otro'!");
		return false;
	}
	
	if(form.cod_referido.value == 1 && form.tipo_referido.value=="") {
		form.tipo_referido.focus();
		mostrar("El campo 'Nombre de Otra Referido' es obligatorio, ya que usted seleccion&oacute; la opci&oacute;n 'otro'!");
		return false;
	}
	
	if(form.hobbie_paciente.value == "") {
		form.hobbie_paciente.focus();
		mostrar("El campo 'Hobbie(s)' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarAntecedentesMed(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var radioCheckOperado = false;
	for (i = 0; i < form.operado.length; i++) {
		if (form.operado[i].checked) {
		    if(form.operado[i].value == 's' && form.cod_operacion.value==0) {
		        form.cod_operacion.focus();
		        mostrar("Debe seleccionar el nombre de la operaci&oacute;n!");
		        return false;
			}
		}
		
		if(form.operado[i].value == 's' && form.cod_operacion.value=='otro' && form.nombre_operacion.value == '') {
		    form.nombre_operacion.focus();
			mostrar("Debe colocar el nombre de la operaci&oacute;n!");
			return false;
		}
	}
	
	var radioCheckAlergico = false;
	for (i = 0; i < form.alergico.length; i++) {
		if (form.alergico[i].checked) {
		    if(form.alergico[i].value == 's' && form.cod_alergia.value==0) {
				form.cod_alergia.focus();
				mostrar("Debe seleccionar el nombre de la alergia!");
				return false;
			}
		}
		
		if(form.alergico[i].value == 's' && form.cod_alergia.value=='otro' && form.nombre_alergia.value == '') {
			form.nombre_alergia.focus();
			mostrar("Debe colocar el nombre de la alergia!");
			return false;
		}
	}
	
	var radioCheckFamiliar = false;
	for (i = 0; i < form.familiar_medico.length; i++) {
		if (form.familiar_medico[i].checked) {
		    if(form.familiar_medico[i].value == 's' && (form.cod_nexo.value==0 || form.cod_familiar_medico.value==0)) {
				form.cod_nexo.focus();
				mostrar("Verifique que haya seleccionado el nexo y el nombre del familiar m&eacute;dico!");
				return false;
			}
		}
		
		if(form.familiar_medico[i].value == 's' && form.cod_nexo.value=='otro' && form.nombre_nexo.value == '') {
			form.nombre_nexo.focus();
			mostrar("Debe colocar el nombre del nexo familiar!");
			return false;
		}
		
		if(form.familiar_medico[i].value == 's' && form.cod_familiar_medico.value == 'otro' && (form.nombre_familiar_medico.value == '' || form.apellido_familiar_medico.value == '' || form.nombre_familiar_medico.value == 'Escriba el nombre' || form.apellido_familiar_medico.value == 'Escriba el apellido')) {
		form.nombre_familiar_medico.focus();
		mostrar("Verifique que haya colocado el nombre y apellido del familiar m&eacute;dico!");
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
	document.getElementById('Errores').style.textAlign ='center';
	document.getElementById('Errores').style.padding = '3px';
	window.scrollTo(0,0);
}