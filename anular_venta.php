<?php
  extract($_REQUEST);
  require_once("./inc/sesion.php");
  $fecha_hoy = date('Y-m-d');

  require_once("clases/ventas.php");
  require_once("clases/almacen.php");
  require_once("clases/utilidades.php");
  $uti=new Utilidades();
  $alm=new Almacen();
  $ven=new Ventas();
  $ven->getCodigoUltimoPedido();
  $uti->getTasaCambio();
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
     

        $("#motivo").keyup(
        function() {
        valor = $("#motivo").val();
        $("#motivo").val(valor.toUpperCase());
        });
       

    });

    function Anular(){
      if (!confirm('¿Desea Anular por Completo la Venta?')){
        return false;
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
      <h1>Anular Venta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="listar_ventas.php">Listado Ventas</a></li>
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
            <label for="motivo" class="col-sm-2 col-form-label">Motivo de Anular: <span class="badge border-danger border-1 text-danger">*</span></label>
            <div class="col-sm-6">
            <textarea class="form-control" style="height: 55px" name="motivo" id="motivo" required></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary" id="anular_venta" onclick="return Anular();">Anular</button>
              <input type="hidden" name="operacion" id="operacion" value="anulaVenta">
              <input type="hidden" name="cod_venta" id="cod_venta" value="<?php echo $cod_venta; ?>">
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