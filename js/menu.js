var peticion = false; 
if (window.XMLHttpRequest) {
      peticion = new XMLHttpRequest();
      } else if (window.ActiveXObject) {
            peticion = new ActiveXObject("Microsoft.XMLHTTP");
}

function init(){
	for(var i=1; i<=6; i++){
		document.getElementById('contenido'+i).style.display = 'none';
	}
}

function init1(){
	for(var i=1; i<=1; i++){
		document.getElementById('contenido'+i).style.display = 'none';
	}
}

function init2(){
	for(var i=1; i<=2; i++){
		document.getElementById('contenido'+i).style.display = 'none';
	}
}

function init3(){
	for(var i=1; i<=3; i++){
		document.getElementById('contenido'+i).style.display = 'none';
	}
}

function init4(){
	for(var i=1; i<=4; i++){
		document.getElementById('contenido'+i).style.display = 'none';
	}
}

function init5(){
	for(var i=1; i<=5; i++){
		document.getElementById('contenido'+i).style.display = 'none';
	}
}

function init6(){
	for(var i=1; i<=6; i++){
		document.getElementById('contenido'+i).style.display = 'none';
	}
}

function viewSection(id,total){
	for (var i=1; i<=6; i++){
		if(i!=id){
			document.getElementById('contenido'+i).style.display = 'none';
		}else{
			document.getElementById('contenido'+i).style.display = 'block';
		}
	}
}

function viewSection1(id,total){
	for (var i=1; i<=1; i++){
		if(i!=id){
			document.getElementById('contenido'+i).style.display = 'none';
		}else{
			document.getElementById('contenido'+i).style.display = 'block';
		}
	}
}

function viewSection2(id,total){
	for (var i=1; i<=2; i++){
		if(i!=id){
			document.getElementById('contenido'+i).style.display = 'none';
		}else{
			document.getElementById('contenido'+i).style.display = 'block';
		}
	}
}

function viewSection3(id,total){
	for (var i=1; i<=3; i++){
		if(i!=id){
			document.getElementById('contenido'+i).style.display = 'none';
		}else{
			document.getElementById('contenido'+i).style.display = 'block';
		}
	}
}

function viewSection4(id,total){
	for (var i=1; i<=4; i++){
		if(i!=id){
			document.getElementById('contenido'+i).style.display = 'none';
		}else{
			document.getElementById('contenido'+i).style.display = 'block';
		}
	}
}

function viewSection5(id,total){
	for (var i=1; i<=5; i++){
		if(i!=id){
			document.getElementById('contenido'+i).style.display = 'none';
		}else{
			document.getElementById('contenido'+i).style.display = 'block';
		}
	}
}

function viewSection6(id,total){
	for (var i=1; i<=6; i++){
		if(i!=id){
			document.getElementById('contenido'+i).style.display = 'none';
		}else{
			document.getElementById('contenido'+i).style.display = 'block';
		}
	}
}

function CambiarEstilo(id) {
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