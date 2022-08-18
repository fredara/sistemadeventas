function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	
	if(form.cod_posicion_banner.value == 0) {
		form.cod_posicion_banner.focus();
		mostrar("La 'Posici&oacute;n del Banner' es obligatoria!");
		return false;
	}
	
	if(form.cod_grupo_banner.value == 0) {
		form.cod_grupo_banner.focus();
		mostrar("El 'Grupo al que será mostrado el Banner' es obligatorio!");
		return false;
	}
	
	if(form.archivo.value == '') {
		form.archivo.focus();
		mostrar("La 'Imagen asociado al Banner' es obligatoria!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var numericoRegEx = /^\d*$/	
	
	if(form.cod_posicion_banner.value == 0) {
		form.cod_posicion_banner.focus();
		mostrar("La 'Posici&oacute;n del Banner' es obligatoria!");
		return false;
	}
	
	if(form.cod_grupo_banner.value == 0) {
		form.cod_grupo_banner.focus();
		mostrar("El 'Grupo al que será mostrado el Banner' es obligatorio!");
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