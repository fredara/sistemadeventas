addEvent(window,'load',inicializarLogin,false);

function inicializarLogin()
{
  var ref=document.getElementById('ced_paciente');
  addEvent(ref,'blur',enviarLogin,false);
}

var conexion2;
function enviarLogin() 
{
  conexion2=crearXMLHttpRequest();
  conexion2.onreadystatechange = procesarLogin;
  conexion2.open('POST','clases/buscarPacienteCita.php', true);
  conexion2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion2.send(retornarDato());  
}

function retornarDato()
{
  var cad='';
  var nom=document.getElementById('ced_paciente').value;
  cad='nombre='+encodeURIComponent(nom);
  return cad;
}


function procesarLogin()
{
  var resultadosLogin = document.getElementById("resultadosLogin");
  if(conexion2.readyState == 4)
  {
    resultadosLogin.innerHTML = conexion2.responseText;
	  resultadosLogin.style.color='#000000';
	  resultadosLogin.style.fontWeight= 'bold';
	  resultadosLogin.style.font = '10px';
  } 
  else 
  {
    resultadosLogin.innerHTML = 'Procesando...';
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
