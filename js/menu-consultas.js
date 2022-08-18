var peticion = false; 
if (window.XMLHttpRequest) {
      peticion = new XMLHttpRequest();
      } else if (window.ActiveXObject) {
            peticion = new ActiveXObject("Microsoft.XMLHTTP");
}

function inic_consultas(){
	for(var i=2; i<=9; i++){
		document.getElementById('tab_consulta'+i).style.display = 'none';
	}
}

function ver_seccion(id){
	for (var i=1; i<=9; i++){
		if(i!=id){
			document.getElementById('tab_consulta'+i).style.display = 'none';
		}else{
			document.getElementById('tab_consulta'+i).style.display = 'block';
		}
	}
}

function cambiar_estilo(id) {
	var elementosMenu = getElementsByClassNameConsulta(document, "li", "prendido");
	for (k = 0; k< elementosMenu.length; k++) {
	elementosMenu[k].className = "apagado";
	}
	var identity=document.getElementById(id);
	identity.className="prendido";
	
}

/*
    function getElementsByClassNameConsulta
    Written by Jonathan Snook, http://www.snook.ca/jonathan
    Add-ons by Robert Nyman, http://www.robertnyman.com
*/

function getElementsByClassNameConsulta(oElm, strTagName, strClassName){
    var arrElements = (strTagName == "*" && document.all)? document.all : oElm.getElementsByTagName(strTagName);
    var arrReturnElements = new Array();
    strClassName = strClassName.replace(/\-/g, "\\-");
    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
    var oElement;
    for(var i=0; i<arrElements.length; i++){
        oElement = arrElements[i];      
        if(oRegExp.test(oElement.className)){
            arrReturnElements.push(oElement);
        }   
    }
    return (arrReturnElements)
}