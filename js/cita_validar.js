function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	var fecha=new Date();
	var dia_mes_actual=fecha.getDate();
	var mes_actual=fecha.getMonth()+1;
	var ano_actual=fecha.getFullYear();

	if(form.dia_cita.value == 0) {
		form.dia_cita.focus();
		mostrar("El 'D&iacute;a de la Cita' es obligatorio!");
		return false;
	} else {
		if((form.dia_cita.value < dia_mes_actual) && (form.mes_cita.value = mes_actual) ) {
			form.mes_cita.focus();
			mostrar("Verifique que el d&iacute;a de la cita este correcto");
			return false;
		}
	}
	
	if(form.mes_cita.value == 0) {
		form.mes_cita.focus();
		mostrar("El 'Mes de la Cita' es obligatorio!");
		return false;
	} else {
		if((form.mes_cita.value < mes_actual) && (form.anio_cita.value = ano_actual) ) {
			form.mes_cita.focus();
			mostrar("Verifique que el mes de la cita este correcto");
			return false;
		}
	}
	
	if(form.anio_cita.value == 0) {
		form.anio_cita.focus();
		mostrar("El 'A&ntilde;o de la Cita' es obligatorio!");
		return false;
	} else {
		if(form.anio_cita.value < ano_actual ) {
			form.anio_cita.focus();
			mostrar("Verifique que el a&ntilde;o de la cita este correcto");
			return false;
		}
	}
	
	if(form.hora_cita.value == 0) {
		form.hora_cita.focus();
		mostrar("La 'Hora de la Cita' es obligatorio!");
		return false;
	}
	
	if(form.minuto_cita.value == '') {
		form.minuto_cita.focus();
		mostrar("Los 'Minutos en la Hora de la Cita' es obligatorio!");
		return false;
	}
	
	if(form.cod_medico.value == 0) {
		form.cod_medico.focus();
		mostrar("El 'M&eacute;dico con quien se concertar&aacute; la Cita' es obligatorio!");
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