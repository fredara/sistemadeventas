function cargarEstados(indice){
	var aregion2=indice;
	var lazo=0;
	var listo;
	var j=0;
	var cadena=new Array();
	with (document.forma_medico.cod_estado) {
		for (var i = options.length; i > 0; i--) options[i] = null;
		options[1]=new Option('No Disponible','-1');
		while(listo==null){ 
			cadena=arregloedo[lazo].split(",");
			if (cadena[0]==aregion2 && indice != -1){
				options[j+1]=new Option(cadena[2],cadena[1]);
				j++;
			}
			lazo=lazo+1;	
			if (cadena[0]==null){ 
				listo=1;
			}
			if (arregloedo[lazo]==null){
				listo=1;
			}
		}
		options[0].selected = true;
	}
}

function cargarMunicipios(indice){
	var aregion2=indice;
	var lazo=0;
	var listo;
	var j=0;
	var cadena=new Array();
	with (document.forma_medico.cod_municipio) {
		for (var i = options.length; i > 0; i--) options[i] = null;
		options[1]=new Option('No Disponible','-1');
		while(listo==null){ 
			cadena=arreglomun[lazo].split(",");
			if (cadena[0]==aregion2 && indice != -1){
				options[j+1]=new Option(cadena[2],cadena[1]);
				j++;
			}
			lazo=lazo+1;	
			if (cadena[0]==null){ 
				listo=1;
			}
			if (arreglomun[lazo]==null){
				listo=1;
			}
		}
		options[0].selected = true;
	}
}

function cargarParroquias(indice){
	var aregion2=indice;
	var lazo=0;
	var listo;
	var j=0;
	var cadena=new Array();
	with (document.forma_medico.cod_parroquia) {
		for (var i = options.length; i > 0; i--) options[i] = null;
		options[1]=new Option('No Disponible','-1');
		while(listo==null){ 
			cadena=arreglopar[lazo].split(",");
			if (cadena[0]==aregion2 && indice != -1){
				options[j+1]=new Option(cadena[2],cadena[1]);
				j++;
			}
			lazo=lazo+1;	
			if (cadena[0]==null){ 
				listo=1;
			}
			if (arreglopar[lazo]==null){
				listo=1;
			}
		}
		options[0].selected = true;
	}
}

function cargarEstadosDos(indice){
	var aregion2=indice;
	var lazo=0;
	var listo;
	var j=0;
	var cadena=new Array();
	with (document.forma_medico.cod_estado_factura) {
		for (var i = options.length; i > 0; i--) options[i] = null;
		options[1]=new Option('No Disponible','-1');
		while(listo==null){ 
			cadena=arregloedo[lazo].split(",");
			if (cadena[0]==aregion2 && indice != -1){
				options[j+1]=new Option(cadena[2],cadena[1]);
				j++;
			}
			lazo=lazo+1;	
			if (cadena[0]==null){ 
				listo=1;
			}
			if (arregloedo[lazo]==null){
				listo=1;
			}
		}
		options[0].selected = true;
	}
}

function cargarMunicipiosDos(indice){
	var aregion2=indice;
	var lazo=0;
	var listo;
	var j=0;
	var cadena=new Array();
	with (document.forma_medico.cod_municipio_factura) {
		for (var i = options.length; i > 0; i--) options[i] = null;
		options[1]=new Option('No Disponible','-1');
		while(listo==null){ 
			cadena=arreglomun[lazo].split(",");
			if (cadena[0]==aregion2 && indice != -1){
				options[j+1]=new Option(cadena[2],cadena[1]);
				j++;
			}
			lazo=lazo+1;	
			if (cadena[0]==null){ 
				listo=1;
			}
			if (arreglomun[lazo]==null){
				listo=1;
			}
		}
		options[0].selected = true;
	}
}

function cargarParroquiasDos(indice){
	var aregion2=indice;
	var lazo=0;
	var listo;
	var j=0;
	var cadena=new Array();
	with (document.forma_medico.cod_parroquia_factura) {
		for (var i = options.length; i > 0; i--) options[i] = null;
		options[1]=new Option('No Disponible','-1');
		while(listo==null){ 
			cadena=arreglopar[lazo].split(",");
			if (cadena[0]==aregion2 && indice != -1){
				options[j+1]=new Option(cadena[2],cadena[1]);
				j++;
			}
			lazo=lazo+1;	
			if (cadena[0]==null){ 
				listo=1;
			}
			if (arreglopar[lazo]==null){
				listo=1;
			}
		}
		options[0].selected = true;
	}
}