function validarAdd(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.titulo_noticia.value == "") {
		form.titulo_noticia.focus();
		mostrar("El campo 'T&iacute;tulo de la noticia' es obligatorio!");
		return false;
	} else {
		if (form.titulo_noticia.value.length >= 48) {
			form.titulo_noticia.focus();
			mostrar("El campo 'T&iacute;tulo de la noticia no puede tener más de 48 caracteres' es obligatorio!");
			return false;
		}
	}
	
	if(form.cod_grupo_noticia.value == 0) {
		form.cod_grupo_noticia.focus();
		mostrar("El 'Grupo de noticia' es obligatorio!");
		return false;
	}
	
	if(form.texto_inicial_noticia.value == "") {
		form.texto_inicial_noticia.focus();
		mostrar("El campo 'Texto inicial de la noticia' es obligatorio!");
		return false;
	}
	
	if(form.finicio_campana_noticia.value == "") {
		form.finicio_campana_noticia.focus();
		mostrar("El campo 'Fecha de inicio de la campa&ntilde;a' es obligatorio!");
		return false;
	}
	
	if(form.ffinal_campana_noticia.value == "") {
		form.ffinal_campana_noticia.focus();
		mostrar("El campo 'Fecha final de la campa&ntilde;a' es obligatorio!");
		return false;
	}	
	
	if(form.contenido_noticia.value == "") {
		form.contenido_noticia.focus();
		mostrar("El campo 'Contenido de la noticia' es obligatorio!");
		return false;
	} else {
		if (form.texto_inicial_noticia.value.length >= 132) {
			form.texto_inicial_noticia.focus();
			mostrar("El campo 'Texto inicial de la noticia no puede tener más de 132 caracteres' es obligatorio!");
			return false;
		}
	}
	
	if(form.foto_peq.value == "") {
		form.foto_peq.focus();
		mostrar("El campo 'Foto peque&ntilde;a' es obligatorio!");
		return false;
	}
	
	if(form.foto_grande.value == "") {
		form.foto_grande.focus();
		mostrar("El campo 'Foto grande' es obligatorio!");
		return false;
	}
	
	return true;
}

function validarMod(form) {
	
	document.getElementById('Errores').innerHTML = "";
	
	var emailRegEx = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
	//var emailRegEx = /^((\w|\.){2,}@)\w{2,}\.\w{2,4}((\.(\w{2}))?)?$/
	var numericoRegEx = /^\d*$/

	if(form.titulo_noticia.value == "") {
		form.titulo_noticia.focus();
		mostrar("El campo 'T&iacute;tulo de la noticia' es obligatorio!");
		return false;
	} else {
		if (form.titulo_noticia.value.length >= 48) {
			form.titulo_noticia.focus();
			mostrar("El campo 'T&iacute;tulo de la noticia no puede tener más de 48 caracteres' es obligatorio!");
			return false;
		}
	}
	
	if(form.cod_grupo_noticia.value == 0) {
		form.cod_grupo_noticia.focus();
		mostrar("El 'Grupo de noticia' es obligatorio!");
		return false;
	}
	
	if(form.texto_inicial_noticia.value == "") {
		form.texto_inicial_noticia.focus();
		mostrar("El campo 'Texto inicial de la noticia' es obligatorio!");
		return false;
	} else {
		if (form.texto_inicial_noticia.value.length >= 132) {
			form.texto_inicial_noticia.focus();
			mostrar("El campo 'Texto inicial de la noticia no puede tener más de 132 caracteres' es obligatorio!");
			return false;
		}
	}
	
	if(form.finicio_campana_noticia.value == "") {
		form.finicio_campana_noticia.focus();
		mostrar("El campo 'Fecha de inicio de la campa&ntilde;a' es obligatorio!");
		return false;
	}
	
	if(form.ffinal_campana_noticia.value == "") {
		form.ffinal_campana_noticia.focus();
		mostrar("El campo 'Fecha final de la campa&ntilde;a' es obligatorio!");
		return false;
	}	
	
	if(form.contenido_noticia.value == "") {
		form.contenido_noticia.focus();
		mostrar("El campo 'Contenido de la noticia' es obligatorio!");
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