<?php
  extract($_REQUEST);
  require_once("./inc/sesion.php");
  $fecha_hoy = date('Y-m-d');

  require_once("clases/ventas.php");
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

    });

    (function($){
        $(function(){
            $('input:text').setMask();
            }
        );
    })(jQuery);


</script>
    <script type="text/javascript">
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
              <span>Jefe del Sistema</span>
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
          <li class="breadcrumb-item active">Registro de Ventas</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row mb-3">
            <label for="inputDate" class="col-sm-2 col-form-label">Nro Venta</label>
            <div class="col-sm-6">
                <input type="text" name="nro_venta" class="form-control" value="<?php echo  $ven->nro_venta; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="fecha_venta" class="col-sm-2 col-form-label">Fecha de Venta</label>
            <div class="col-sm-6">
                <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" value="<?php echo $fecha_hoy; ?>">
            </div>
        </div>
        <div class="row mb-3" id="row_rif_cliente">
            <label class="col-sm-2 col-form-label">Moneda</label>
            <div class="col-sm-6">
                BSS <input type="radio" class="form-check-input" name="moneda" id="monedaBSS" value="BSS" checked>
                USD <input type="radio" class="form-check-input" name="moneda" id="monedaUSD" value="USD">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tipo de Documento</label>
            <div class="col-sm-6">
            <select class="form-select" name="tipo_identidad" aria-label="Default select example" onchange="habilita(this)">
                <option selected>Selecione</option>
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
            <label for="nombre_cliente" class="col-sm-2 col-form-label">Nombre Cliente</label>
            <div class="col-sm-6">
                <input type="text" name="nombre_cliente"  id="nombre_cliente" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
            <div class="col-sm-6">
            <textarea class="form-control" style="height: 100px" name="direccion_cliente"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <h5 class="card-title">Detalle de la Venta</h5>
        </div>







        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-6">
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
            </div>
        </div>
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