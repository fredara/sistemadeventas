<?php
  extract($_REQUEST);
  require_once("./inc/sesion.php");
  $fecha_hoy = date('Y-m-d');

  require_once("clases/almacen.php");
  require_once("clases/utilidades.php");
  require_once("clases/compra.php");
  $uti=new Utilidades();
  $alm=new Almacen();
  $comp=new Compra();
  $uti->getTasaCambio();

  $lista_productos=$alm->getListaProductos(0);


  $lista_comboBanco = $uti->ListacomboBanco();

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
     

        $("#rif_proveedor").keyup(
        function() {
        valor = $("#rif_proveedor").val();
        $("#rif_proveedor").val(valor.toUpperCase());
        });
        $("#num_cedula").keyup(
        function() {
        valor = $("#num_cedula").val();
        $("#num_cedula").val(valor.toUpperCase());
        });
        $("#nombre_proveedor").keyup(
          function() {
          valor = $("#nombre_proveedor").val();
          $("#nombre_proveedor").val(valor.toUpperCase());
        });

        $("#nombre_pro").keyup(
          function() {
          valor = $("#nombre_pro").val();
          $("#nombre_pro").val(valor.toUpperCase());
        });

        $("#nombre_provee").keyup(
          function() {
          valor = $("#nombre_provee").val();
          $("#nombre_provee").val(valor.toUpperCase());
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

            var opts_pro2 = $('#cod_proveedor option').map(function () {
              return [[this.value, $(this).text()]];
            });
            $('#nombre_provee').keyup(function () {
              var rxp = new RegExp($('#nombre_provee').val(), 'i');
              var optlist = $('#cod_proveedor').empty();
              opts_pro2.each(function () {
                if (rxp.test(this[1])) {
                  optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
                }
              });
            });

            
        });
    })(jQuery);


</script>
<script type="text/javascript" src="js/proveedor_existe.js"></script>
<script type="text/javascript">
  let cantidad_permitida = [] ;
  campos=1;
  pagos=0;
  ven=0;
  m=0;

  function cambiaTasa(valor){
    if(valor=='' || valor==null){
      document.getElementById("tasa_cambio").value = <?php echo $uti->tasa_cambio; ?>;
    }
  }

  function cambiaMoneda(valor){
    if(valor=='USD'){
      document.getElementById("info_mone").innerHTML = 'USD';
    }else{
      document.getElementById("info_mone").innerHTML = 'BS';
    }
  }
  function habilita(elemento) {
      if(elemento.value=='cedula') {
          document.getElementById('row_cedula_proveedor').style.display = "flex";
          document.getElementById('row_rif_proveedor').style.display = "none";
          document.getElementById('row_pasaporte_proveedor').style.display = "none";
      }  else {
          if(elemento.value=='rif') {
              document.getElementById('row_cedula_proveedor').style.display = "none";
              document.getElementById('row_rif_proveedor').style.display = "flex";
              document.getElementById('row_pasaporte_proveedor').style.display = "none";
          } else {
              if(elemento.value=='pasaporte') {
                  document.getElementById('row_cedula_proveedor').style.display = "none";
                  document.getElementById('row_rif_proveedor').style.display = "none";
                  document.getElementById('row_pasaporte_proveedor').style.display = "flex";
              } else {
                  document.getElementById('row_cedula_proveedor').style.display = "none";
                  document.getElementById('row_rif_proveedor').style.display = "none";
                  document.getElementById('row_pasaporte_proveedor').style.display = "none";
              }
          }
      }
  }


  function sumacampos(id) {
    let cantidad_precio = 0;
    let tot = 0;
    let total_venta = 0;
    let iva_r = 10;
    let iva_n = 16;
    let base_imponible = 0;
    let base_imponible_r = 0;
    let no_gravable = 0;
    let valor_iva = 0;
    let valor_iva_r = 0;
    
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

    let info_cambio = 0; 
    let tasa_cambio = document.getElementById('tasa_cambio').value;
    var mon = '';
    if(document.getElementById('monedaBSS').checked == true ){
      info_cambio = total_venta / tasa_cambio;
      mon = 'USD';
    }else{
      info_cambio = total_venta * tasa_cambio;
      mon = 'BSS';
    }
    document.getElementById('info_monto_cambio').innerHTML = number_format(info_cambio,2,'.','')+" "+mon;

  }

  function limtCant(campo, elemt){
    let b;
    let u;

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


function agregar() {
	ven=ven+1;
	m=m+1;
  var lista_productos = '<?php echo $lista_productos;?>';
	 $("#tabla_detalle").append('<div class="row mb-12 deta'+ven+' espacio" ><div class="col-sm-4"><select name="cod_producto[]" id="cod_producto'+ven+'" onchange="sumacampos('+ven+');" onblur="sumacampos('+ven+');" class="form-select" required><option value="">Seleccione</option>'+lista_productos+'</select>&nbsp; &nbsp;<input name="nombre_pro'+ven+'" type="text" class="boton_busqueda form-control" id="nombre_pro'+ven+'" size="20" placeholder="Buscar Producto" /><span id="mens'+ven+'" class="badge border-danger border-1 text-danger"></span></div><div class="col-sm-1"><input type="text" class="form-control" name="cantidad[]" id="cantidad'+ven+'" onkeyup="sumacampos('+ven+'); limtCant('+ven+', this);" onblur="sumacampos('+ven+'); limtCant('+ven+', this);" alt="Integer2" required></div><div class="col-sm-2"><input type="text" class="form-control" name="precioxuni[]" id="precioxuni'+ven+'" onkeyup="sumacampos('+ven+');" alt="Costo" required></div><div class="col-sm-2"><input type="text" class="form-control" name="precio[]" id="precio'+ven+'" required readonly></div><div class="col-sm-2"><label for="iva1'+ven+'">16%</label>  <input type="radio" class="form-check-input" name="iva[]'+ven+'" id="iva1'+ven+'" value="16" onchange="sumacampos('+ven+');"><label for="iva2'+ven+'">10%</label>  <input type="radio" class="form-check-input" name="iva[]'+ven+'" id="iva2'+ven+'" value="10" onchange="sumacampos('+ven+');"><label for="iva3'+ven+'">N/A</label>  <input type="radio" class="form-check-input" name="iva[]'+ven+'" id="iva3'+ven+'" value="0" checked required onchange="sumacampos('+ven+');"></div><div class="col-sm-1"><a href="#b" onclick="javascript:borrar('+ven+');sumacampos_d('+ven+');">Borrar</a></div></div>');

   var opts_pro = $('#cod_producto'+ven+' option').map(function () {
      return [[this.value, $(this).text()]];
    });
    $('#nombre_pro'+ven+'').keyup(function () {
      //console.log("cod_producto"+m);
      var rxp = new RegExp($('#nombre_pro'+ven+'').val(), 'i');
      var optlist = $('#cod_producto'+ven+'').empty();
      opts_pro.each(function () {
        if (rxp.test(this[1])) {
          optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
        }
      });
  
    });
}

function borrar(cual) {
	$("div.deta"+cual).remove();
	return false;
}



function VaciarTodo() {
  for(var i=0; i <= ven; i++) {
    document.getElementById("cod_producto"+i).value="";
    document.getElementById("cantidad"+i).value='';
    document.getElementById("precioxuni"+i).value='';
    document.getElementById("precio"+i).value='';
  }

  document.getElementById('subtotal').value =  '';
  document.getElementById('subtotal_R').value = '';
  document.getElementById('exento').value =  '';
  document.getElementById('iva_n').value =  '';
  document.getElementById('ivar').value = '';
  document.getElementById('total').value = '';
  document.getElementById('info_monto_cambio').innerHTML = '';
  
}

function selecPro(va){
  if (va == 'newPro') {
    document.getElementById("tipo_documento").style.display = 'flex';
    document.getElementById("nombre_id_provedor").style.display = 'flex';
    document.getElementById("direc_pro").style.display = 'flex';
  }else{
    document.getElementById("tipo_documento").style.display = 'none';
    document.getElementById("nombre_id_provedor").style.display = 'none';
    document.getElementById("direc_pro").style.display = 'none';
  }

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
    <!-- Error -->
    <?php if(!empty($err)){ ?> 
          <div class="row mb-3">
            <div class="col-sm-12">
                <div <?php if($tp=='e'){ ?> class="alert alert-success alert-dismissible fade show" <?php }else{ ?> class="alert alert-danger alert-dismissible fade show" <?php } ?> role="alert">
                  <?php echo $err;  ?> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?> 
      <!-- End Error -->

    <div class="pagetitle">
      <h1>Registro de Compra</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Registro de Compra</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <form class="row g-3 needs-validation" novalidate action="./controller/Compras.controller.php
        "  method="POST" enctype="multipart/form-data">

        <div class="row mb-3" style="padding-top: 12px;">
          <div class="col-sm-6">
            <span class="badge bg-danger">* Campos obligatorios</span>
          </div>
        </div>

        <div class="row mb-3">
            <label for="fecha_compra" class="col-sm-2 col-form-label">Fecha de Compra <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
                <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" value="<?php echo $fecha_hoy; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fecha_compra" class="col-sm-2 col-form-label">Proveedor <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
              <select class="form-select" name="cod_proveedor" aria-label="Default select example" id="cod_proveedor" required onchange="selecPro(this.value);">
                  <option value="" selected>Selecione</option>
                  <option value="newPro">Agregar Nuevo</option>
                  <?php $comp->comboProveedor(0); ?>
              </select>
              &nbsp;
              <input name="nombre_provee" type="text" class="boton_busqueda form-control" id="nombre_provee" size="20" placeholder="Buscar Proveedor" />
            </div>
        </div>
            

        <div class="row mb-3" id="tipo_documento" style="display: none;">
            <label class="col-sm-2 col-form-label">Tipo de Documento <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
            <select class="form-select" name="tipo_identidad" aria-label="Default select example" onchange="habilita(this)">
                <option value="" selected>Selecione</option>
                <option value="rif">RIF</option>
                <option value="cedula">C&eacute;dula de Identidad</option>
                <option value="pasaporte">Pasaporte</option>
            </select>
            </div>
        </div>
        <div class="row mb-3" id="row_rif_proveedor" style="display: none;">
            <label for="rif_proveedor" class="col-sm-2 col-form-label">Rif</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" alt="Rif" name="rif_proveedor" id="rif_proveedor" onkeyup="existeProveedor(this);" >
            </div>
        </div>
        <div class="row mb-3" id="row_cedula_proveedor" style="display: none;">
            <label for="num_cedula" class="col-sm-2 col-form-label">C&eacute;dula</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" alt="Ced" name="num_cedula" id="num_cedula" onkeyup="existeProveedor(this);" >
            </div>
        </div>
        <div class="row mb-3" id="row_pasaporte_proveedor" style="display: none;">
            <label for="num_pasaporte" class="col-sm-2 col-form-label">Pasaporte</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" alt="pas" name="num_pasaporte" id="num_pasaporte" onkeyup="existeProveedor(this);" >
            </div>
        </div>

        <div class="row mb-3" id="nombre_id_provedor" style="display: none;">
            <label for="nombre_proveedor" class="col-sm-2 col-form-label">Nombre del Proveedor <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
                <input type="text" name="nombre_proveedor"  id="nombre_proveedor" class="form-control">
            </div>
        </div>
        <div class="row mb-3" id="direc_pro" style="display: none;">
            <label for="inputPassword" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
            <div class="col-sm-6">
            <textarea class="form-control" style="height: 55px" name="direccion_proveedor" id="direccion_proveedor"></textarea>
            </div>
        </div>

        
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tasa de Cambio <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
              <input type="text" alt="Costo" class="form-control" name="tasa_cambio" id="tasa_cambio" value="<?php echo $uti->tasa_cambio;?>" onblur="cambiaTasa(this.value);" onkeyup="VaciarTodo();" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Moneda <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
                <label for="monedaBSS">BSS</label>  <input type="radio" class="form-check-input" name="moneda" id="monedaBSS" value="BSS" checked required onchange="cambiaMoneda(this.value);">
                <label for="monedaUSD">USD</label>  <input type="radio" class="form-check-input" name="moneda" id="monedaUSD" value="USD" onchange="cambiaMoneda(this.value);">
            </div>
        </div>




        <div class="row mb-12">
          <div class="card">
            <h5 class="card-title">Detalle de la Compra</h5>
            <div class="card-body">
              <div class="containter" id="tabla_detalle">
                <div class="row mb-12">
                  <div class="col-sm-4">
                    <span class="badge border-primary border-1 text-primary">Producto <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>

                  <div class="col-sm-1">
                    <span class="badge border-primary border-1 text-primary">Cantidad <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>

                  <div class="col-sm-2">
                    <span class="badge border-primary border-1 text-primary">Precio Unitario (Costo) <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>


                  <div class="col-sm-2">
                    <span class="badge border-primary border-1 text-primary">Total <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>

                  <div class="col-sm-2">
                    <span class="badge border-primary border-1 text-primary">IVA <span class="badge border-danger border-1 text-danger">*</span></span>
                  </div>
                  <div class="col-sm-1">
                  </div>
                </div>



                <div class="row mb-12">
                  <div class="col-sm-4">
                    <select name="cod_producto[]" id="cod_producto0" onchange="sumacampos('1');" onblur="sumacampos('1');" class="form-select" required>
                      <option value="">Seleccione</option>
                      <?php $alm->comboProductos(0)?>
                    </select>&nbsp; &nbsp;
                    <input name="nombre_pro" type="text" class="boton_busqueda form-control" id="nombre_pro" size="20" placeholder="Buscar Producto" />
                    <span id="mens0" class="badge border-danger border-1 text-danger"></span>
                  </div>

                  <div class="col-sm-1">
                    <input type="text" class="form-control" name="cantidad[]" id="cantidad0" onkeyup="sumacampos('1'); limtCant('0', this);" onblur="sumacampos('1'); limtCant('0', this);" alt="Integer2" required>
                  </div>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="precioxuni[]" id="precioxuni0" onkeyup="sumacampos('1');" alt="Costo" required>
                  </div>


                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="precio[]" id="precio0" required readonly>
                  </div>

                  <div class="col-sm-2">
                    <label for="iva10">16%</label>  <input type="radio" class="form-check-input" name="iva[]" id="iva10" value="16" onchange="sumacampos('1');">
                    <label for="iva20">10%</label>  <input type="radio" class="form-check-input" name="iva[]" id="iva20" value="10" onchange="sumacampos('1');">
                    <label for="iva30">N/A</label>  <input type="radio" class="form-check-input" name="iva[]" id="iva30" value="0" checked required onchange="sumacampos('1');">
                  </div>
                  <div class="col-sm-1">
                  </div>
                </div>
              </div>

              <div class="row mb-12">
                <div class="col-sm-5">
                  <a name="a" id="a"></a><a href="javascript:agregar();" class="enlace1">Agregar otro</a>
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
                  <label for="inputPassword" class="col-sm-2 col-form-label">Total <span id="info_mone">BS</span>:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="total" id="total" disabled>
                    <span class="badge border-danger border-1 text-danger" id="info_monto_cambio"></span>
                  </div>
              </div>

            </div>
          </div>
        </div>


        <div class="row mb-3">
            <label for="observacion" class="col-sm-2 col-form-label">Observaci&oacute;n: </label>
            <div class="col-sm-6">
            <textarea class="form-control" style="height: 55px" name="observacion" id="observacion"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary" id="registrar_compra">Registrar Compra</button>
              <input type="hidden" name="operacion" id="operacion" value="reg_comp">
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