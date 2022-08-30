function existeCliente(val){
    var tipo_identi = '';
    if (val.id == 'num_cedula') {
        tipo_identi = 'cedula';
    }
    if (val.id == 'rif_cliente') {
        tipo_identi = 'rif';
    }
    if (val.id == 'num_pasaporte') {
        tipo_identi = 'pasaporte';
    }

    if (val.value.length >=3) {
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            var resultado = xmlhttp.responseText
            resultado = JSON.parse(resultado);
            if(resultado.nombre_cliente != null){
                document.getElementById('nombre_cliente').value = resultado.nombre_cliente;
                document.getElementById('direccion_cliente').innerHTML = resultado.direccion_cliente;
            }else{
                document.getElementById('nombre_cliente').value = "";
                document.getElementById('direccion_cliente').innerHTML = "";
            }
        }
        }
    
        data="tipo_identi="+tipo_identi+"&num_identificacion="+val.value;
        xmlhttp.open("POST","./inc/existeCliente.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

}