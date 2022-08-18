addEvent(window,'load',inicializarEventos,false);

function inicializarEventos()
{
  var ref=document.getElementById('email_usuario');
  addEvent(ref,'blur',enviarNombre,false);
}

var conexion1;
function enviarNombre() 
{
  conexion1=crearXMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','clases/verificarCorreo.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(retornarDatos());
}

function retornarDatos()
{
  var cad='';
  var nom=document.getElementById('email_usuario').value;
  cad='nombre='+encodeURIComponent(nom);
  return cad;
}


function procesarEventos()
{
  var resultados = document.getElementById("resultados");
  if(conexion1.readyState == 4)
  {
	
	resultados.innerHTML = conexion1.responseText;
	if (conexion1.responseText=='Ya existe un usuario registrado con ese correo') {
	  resultados.style.color='#ff0000';
	  resultados.style.font = '11px verdana,arial,helvetica,sans-serif';
	  resultados.style.fontWeight= 'bold';
	  document.getElementById('email_usuario').value='';
	}
  } 
  else 
  {
    resultados.innerHTML = 'Procesando...';
  }
}

//***************************************
//Funciones comunes a todos los problemas
//***************************************
function addEvent(elemento,nomevento,funcion,captura)
{
  if (elemento.attachEvent)
  {
    elemento.attachEvent('on'+nomevento,funcion);
    return true;
  }
  else  
    if (elemento.addEventListener)
    {
      elemento.addEventListener(nomevento,funcion,captura);
      return true;
    }
    else
      return false;
}

function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}
