var peticion = false; 

if (window.XMLHttpRequest) {

      peticion = new XMLHttpRequest();

      } else if (window.ActiveXObject) {

            peticion = new ActiveXObject("Microsoft.XMLHTTP");

}



function initGrupo(){

	for(var i=2; i<=11; i++){

		document.getElementById('contenidoModulo'+i).style.display = 'none';

	}

}



function viewSectionGrupo(id){

	for (var i=1; i<=11; i++){

		if(i!=id){

			document.getElementById('contenidoModulo'+i).style.display = 'none';

		}else{

			document.getElementById('contenidoModulo'+i).style.display = 'block';

		}

	}

}



function CambiarEstiloGrupo(id) {

	var elementosMenu = getElementsByClassName(document, "li", "activo");

	for (k = 0; k< elementosMenu.length; k++) {

	elementosMenu[k].className = "inactivo";

	}

	var identity=document.getElementById(id);

	identity.className="activo";

}



/*

    function getElementsByClassName

    Written by Jonathan Snook, http://www.snook.ca/jonathan

    Add-ons by Robert Nyman, http://www.robertnyman.com

*/



function getElementsByClassName(oElm, strTagName, strClassName){

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