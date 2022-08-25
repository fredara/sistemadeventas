<?php
  extract($_REQUEST);
  require_once("./inc/sesion.php");
  $fecha_hoy = date('Y-m-d');

  require_once("clases/ventas.php");
  require_once("clases/almacen.php");
  $alm=new Almacen();
  $ven=new Ventas();
  $ven->getCodigoUltimoPedido();
  //$n_ven=1;
  if(empty( $ven->nro_venta)){ $ven->nro_venta = '0001';}else{
    $loncadena = strlen( $ven->nro_venta);
    echo "cadena es: ".$loncadena;
    if($loncadena==1){
         $ven->nro_venta = '000'. $ven->nro_venta;
    }
    if($loncadena==2){
         $ven->nro_venta = '00'. $ven->nro_venta;
    }
    if($loncadena==3){
         $ven->nro_venta = '0'. $ven->nro_venta;
    }
    
  };
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistema de Ventas</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="./css/estilos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
    <script type="text/javascript" src="js/gen_validatorv4.js" language="JavaScript" xml:space="preserve"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.14.custom.min.js"></script>
    <script type="text/javascript" src="js/jquerymask.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/top_up-min.js"></script>


  <link href="assets/css/style.css" rel="stylesheet">
  <script type="text/javascript">
    $(document).ready(function() {
        $("#datePickerDemo input.calendar").datepicker({showOn: 'button', buttonImage: 'images/calendar.png',
            buttonImageOnly: true, firstDay:1, dateFormat: 'dd/mm/yy'});
     

        $("#rif_cliente").keyup(
        function() {
        valor = $("#rif_cliente").val();
        $("#rif_cliente").val(valor.toUpperCase());
        });
        $("#num_cedula").keyup(
        function() {
        valor = $("#num_cedula").val();
        $("#num_cedula").val(valor.toUpperCase());
        });
        $("#nombre_cliente").keyup(
          function() {
          valor = $("#nombre_cliente").val();
          $("#nombre_cliente").val(valor.toUpperCase());
        });

        $("#nombre_pro").keyup(
          function() {
          valor = $("#nombre_pro").val();
          $("#nombre_pro").val(valor.toUpperCase());
        });

    });

    (function($){
        $(function(){
            $('input:text').setMask();

            var opts_pro = $('#cod_producto0 option').map(function () {
              return [[this.value, $(this).text()]];
            });
            $('#nombre_pro').keyup(function () {
              var rxp = new RegExp($('#nombre_pro').val(), 'i');
              var optlist = $('#cod_producto0').empty();
              opts_pro.each(function () {
                if (rxp.test(this[1])) {
                  optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
                }
              });
          
            });
        });
    })(jQuery);


</script>
<script type="text/javascript">
  let cantidad_permitida = [] ;
  campos=1;
  ped=0;
  m=0;

  function habilita(elemento) {
      if(elemento.value=='cedula') {
          document.getElementById('row_cedula_cliente').style.display = "flex";
          document.getElementById('row_rif_cliente').style.display = "none";
          document.getElementById('row_pasaporte_cliente').style.display = "none";
      }  else {
          if(elemento.value=='rif') {
              document.getElementById('row_cedula_cliente').style.display = "none";
              document.getElementById('row_rif_cliente').style.display = "flex";
              document.getElementById('row_pasaporte_cliente').style.display = "none";
          } else {
              if(elemento.value=='pasaporte') {
                  document.getElementById('row_cedula_cliente').style.display = "none";
                  document.getElementById('row_rif_cliente').style.display = "none";
                  document.getElementById('row_pasaporte_cliente').style.display = "flex";
              } else {
                  document.getElementById('row_cedula_cliente').style.display = "none";
                  document.getElementById('row_rif_cliente').style.display = "none";
                  document.getElementById('row_pasaporte_cliente').style.display = "none";
              }
          }
      }
  }

  function CargaDataProduct(str, campo) {
    if (str==null) {
      str = document.getElementById('cod_producto'+campo).value;
    }
    var Moneda = '';
    if(document.getElementById('monedaBSS').checked == true ){
      Moneda = 'BS';
    }else{
      Moneda = 'USD';
    }
    let tasa_cambio = document.getElementById('tasa_cambio').value;
    if (tasa_cambio=='') {
      alert("Debe Ingresar la Tasa de Cambio");
      return;
    }
  
    selec = "cod_producto"+campo;
    
      var xmlhttp;
      if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
      }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          var resultado = xmlhttp.responseText
          //console.log(resultado);
          verificaExistencia(str, campo);
          if (resultado=='Producto sin Precio') {
            document.getElementById("mens"+campo).innerHTML=resultado;
            document.getElementById("cantidad"+campo).value='';
            document.getElementById("precioxuni"+campo).value='';
            document.getElementById("precio"+campo).value='';
          }else{
            if(Moneda=='USD'){
              var precio = 1*resultado;
              var pre = precio.toFixed(2);

              //console.log(resultado);
              var resul = parseFloat(resultado);
            }else{
              var precio = 1*(resultado*tasa_cambio);
              var pre = precio.toFixed(2);

              //console.log(resultado);
              var resul = parseFloat(resultado*tasa_cambio);
            }
           
            document.getElementById("cantidad"+campo).value=1;
            document.getElementById("precioxuni"+campo).value=resul;
            document.getElementById("precio"+campo).value=pre;
            document.getElementById("mens"+campo).innerHTML='';

          }
          
        }
      }
      
    
      //console.log(cod_ruta);
      data="&cod_producto="+str+"&operacion=1";
      xmlhttp.open("POST","inc/combo4.php",true);
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xmlhttp.send(data);
    
  }

  function verificaExistencia(cod_producto, campo){
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        var resultado = xmlhttp.responseText
        var resultado = JSON.parse(resultado);
        //console.log(resultado);
        if (resultado.existencia<=0) {
          //no es posible no hay en inventario

          document.getElementById('cod_producto'+campo).value='';
          document.getElementById("mens"+campo).innerHTML='Falla de Inventario';
          document.getElementById("cantidad"+campo).value='';
          document.getElementById("precioxuni"+campo).value='';
          document.getElementById("precio"+campo).value='';

          /*document.getElementById("bulto"+campo).checked=true;
          document.getElementById("individual"+campo).checked=false;*/
          alert(`NO ES POSIBLE CARGAR ESTE PRODUCTO. FALLA DE INVENTARIO ${resultado.existencia}`);

        }else{
          cantidad_permitida[campo] = resultado.existencia;
          document.getElementById("mens"+campo).innerHTML='Existencia en Almacen ('+resultado.existencia+') Unidades. Precio $ ('+resultado.precio_almacen+')';
          //nada Todo bien
          
        }
      }
    }
  
    data="cod_producto="+cod_producto;
    xmlhttp.open("POST","inc/verficiaExistenciaProducto.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(data);
  }

  function sumacampos(id) {
    var cantidad_precio = 0;
    var tot = 0;
    var total_venta = 0;
    var iva_r = 10;
    var iva_n = 16;
    var base_imponible = 0;
    var base_imponible_r = 0;
    var no_gravable = 0;
    var valor_iva = 0;
    var valor_iva_r = 0;
    
    if(id>=campos)
      campos=campos+1;
    for(var i=0; i < campos; i++) {
      if(document.getElementById('precioxuni'+i)) {
        if(document.getElementById('cantidad'+i).value!=" " && document.getElementById('precioxuni'+i).value!=" ") {
          cantidad_precio = parseFloat(eval("document.getElementById('precioxuni"+i+"').value"));
          
          tot = cantidad_precio * parseFloat(eval("document.getElementById('cantidad"+i+"').value"));

          if (document.getElementById('iva1'+i).checked) {
            base_imponible = base_imponible + tot;
          }
          if (document.getElementById('iva2'+i).checked) {
            base_imponible_r = base_imponible_r + tot;
          }
          if (document.getElementById('iva3'+i).checked) {
            no_gravable = no_gravable + tot;
          }
        
          //total_venta+=cantidad_precio;
          //console.log(cantidad_precio);
          if (cantidad_precio!=NaN) {
              tot = number_format(tot,2,'.','');
              //console.log(tot);
              document.getElementById('precio'+i).value = tot;
          }

        }
      }
    }


    valor_iva_r = (base_imponible_r*iva_r)/100;
    valor_iva = (base_imponible*iva_n)/100;
    total_venta = base_imponible+base_imponible_r+valor_iva+no_gravable+valor_iva_r;
    document.getElementById('subtotal').value =  number_format(base_imponible,2,'.','');
    document.getElementById('subtotal_R').value = number_format(base_imponible_r,2,'.','');
    document.getElementById('exento').value =  number_format(no_gravable,2,'.','');
    document.getElementById('iva_n').value =  number_format(valor_iva,2,'.','');
    document.getElementById('ivar').value = number_format(valor_iva_r,2,'.','');
    document.getElementById('total').value = number_format(total_venta,2,'.','');
  }

  function limtCant(campo, elemt){
    let b;
    let u;
    let pro_por;
    let cant_limt;

    if (parseInt(elemt.value)>parseInt(cantidad_permitida[campo])) {
      document.getElementById(elemt.id).value=cantidad_permitida[campo];
      alert("CANTIDAD INCORRECTA, NO PUEDE EXCEDER LA EXISTENCIA");
    }
      
   
  }

  function number_format(number, decimals, dec_point, thousands_point) {
    if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    }
    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }
    if (!dec_point) {
        dec_point = '.';
    }
    if (!thousands_point) {
        thousands_point = ',';
    }
    number = parseFloat(number).toFixed(decimals);
    number = number.replace(".", dec_point);
    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);
    return number;
}




</script>

  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    
    <div class="d-flex align-items-center justify-content-between">
      <a href="home.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Recarval</span>
      </a>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/logo_admin.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['nombre_usuario_log']; ?> <?php echo $_SESSION['apellido_usuario_log']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['nombre_usuario_log']; ?> <?php echo $_SESSION['apellido_usuario_log']; ?></h6>
              <span></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="controller/Usuario.controller.php?operacion=sc">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar Sesi&oacute;n</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Registro de Ventas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Registro de Venta</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <form class="row g-3 needs-validation" novalidate action="./controller/Ventas.controller.php
        "  method="POST" enctype="multipart/form-data">

        <div class="row mb-3" style="padding-top: 12px;">
          <div class="col-sm-6">
            <span class="badge bg-danger">* Campos obligatorios</span>
          </div>
        </div>

        <div class="row mb-3">
            <label for="fecha_venta" class="col-sm-2 col-form-label">Fecha de Venta <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
                <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" value="<?php echo $fecha_hoy; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Moneda <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
                <label for="monedaBSS">BSS</label>  <input type="radio" class="form-check-input" name="moneda" id="monedaBSS" value="BSS" checked required>
                <label for="monedaUSD">USD</label>  <input type="radio" class="form-check-input" name="moneda" id="monedaUSD" value="USD">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tasa de Cambio <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
              <input type="number" class="form-control" name="tasa_cambio" id="tasa_cambio" value="7" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tipo de Documento <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
            <select class="form-select" name="tipo_identidad" aria-label="Default select example" onchange="habilita(this)" required>
                <option value="" selected>Selecione</option>
                <option value="rif">RIF</option>
                <option value="cedula">C&eacute;dula de Identidad</option>
                <option value="pasaporte">Pasaporte</option>
            </select>
            </div>
        </div>
        <div class="row mb-3" id="row_rif_cliente" style="display: none;">
            <label for="rif_cliente" class="col-sm-2 col-form-label">Rif</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" alt="Rif" name="rif_cliente" id="rif_cliente" >
            </div>
        </div>
        <div class="row mb-3" id="row_cedula_cliente" style="display: none;">
            <label for="num_cedula" class="col-sm-2 col-form-label">C&eacute;dula</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" alt="Ced" name="num_cedula" id="num_cedula" >
            </div>
        </div>
        <div class="row mb-3" id="row_pasaporte_cliente" style="display: none;">
            <label for="num_pasaporte" class="col-sm-2 col-form-label">Pasaporte</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" alt="pas" name="num_pasaporte" id="num_pasaporte" >
            </div>
        </div>

        <div class="row mb-3">
            <label for="nombre_cliente" class="col-sm-2 col-form-label">Nombre Cliente <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
                <input type="text" name="nombre_cliente"  id="nombre_cliente" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
            <div class="col-sm-6">
            <textarea class="form-control" style="height: 100px" name="direccion_cliente"></textarea>
            </div>
        </div>


        <div class="row mb-12">
          <div class="card">
            <h5 class="card-title">Detalle de la Venta</h5>
            <div class="card-body">
              <div class="containter">
                <div class="row mb-12">
                  <div class="col-sm-5">
                    <span class="badge border-primary border-1 text-primary">Producto <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>

                  <div class="col-sm-1">
                    <span class="badge border-primary border-1 text-primary">Cantidad <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>

                  <div class="col-sm-2">
                    <span class="badge border-primary border-1 text-primary">Precio Unitario <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>


                  <div class="col-sm-2">
                    <span class="badge border-primary border-1 text-primary">Total <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>

                  <div class="col-sm-2">
                    <span class="badge border-primary border-1 text-primary">IVA <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>
                </div>



                <div class="row mb-12">
                  <div class="col-sm-5">
                    <select name="cod_producto[]" id="cod_producto0" onchange="CargaDataProduct(this.value, '0'); sumacampos('1');" onblur="sumacampos('1');" class="form-select" required>
                      <option value="">Seleccione</option>
                      <?php $alm->comboProductos(0)?>
                    </select>&nbsp; &nbsp;
                    <input name="nombre_pro" type="text" class="boton_busqueda form-control" id="nombre_pro" size="20" placeholder="Buscar Producto" onblur="CargaDataProduct(null, '0');" />
                    <span id="mens0" class="badge border-danger border-1 text-danger"></span>
                  </div>

                  <div class="col-sm-1">
                    <input type="number" class="form-control" name="cantidad[]" id="cantidad0" onkeyup="sumacampos('1'); limtCant('0', this);" onblur="sumacampos('1'); limtCant('0', this);" required>
                  </div>

                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="precioxuni[]" id="precioxuni0" onkeyup="sumacampos('1');" required>
                  </div>


                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="precio[]" id="precio0" required readonly>
                  </div>

                  <div class="col-sm-2">
                    <label for="monedaUSD">16%</label>  <input type="radio" class="form-check-input" name="iva[]" id="iva10" value="16" onchange="sumacampos('1');">
                    <label for="monedaUSD">10%</label>  <input type="radio" class="form-check-input" name="iva[]" id="iva20" value="10" onchange="sumacampos('1');">
                    <label for="monedaUSD">N/A</label>  <input type="radio" class="form-check-input" name="iva[]" id="iva30" value="0" checked required onchange="sumacampos('1');">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="row mb-12">
          <div class="card">
            <h5 class="card-title">Totales</h5>
            <div class="card-body">
              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Subtotal I.V.A. 16%:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="subtotal" id="subtotal" disabled>
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Subtotal I.V.A. 10%:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="subtotal_R" id="subtotal_R" disabled>
                  </div>
              </div>

              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Exento:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="exento" id="exento" disabled>
                  </div>
              </div>

              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">I.V.A. 16%:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="iva_n" id="iva_n" disabled>
                  </div>
              </div>

              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">I.V.A. 10%:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="ivar" id="ivar" disabled>
                  </div>
              </div>

              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Total:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="total" id="total" disabled>
                  </div>
              </div>
            </div>
          </div>
        </div>







        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary">Registrar Venta</button>
              <input type="hidden" name="operacion" id="operacion" value="reg_venta">
            </div>
        </div>
      </form>
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>