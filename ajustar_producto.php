<?php
  extract($_REQUEST);
  require_once("./inc/sesion.php");
  require_once("./clases/almacen.php");
  $alm = new Almacen();
  $alm->getProducto($cod_producto);
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
    (function($){
        $(function(){
            $('input:text').setMask();
            }
        );
    })(jQuery);


</script>
<script type="text/javascript">
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
            <div class="col-sm-8">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?php echo $err;  ?> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
          </div>
        <?php } ?> 
      <!-- End Error -->


    <div class="pagetitle">
      <h1>Ajuste de Producto</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="lista_productos.php">Lista Productos</a></li>
          <li class="breadcrumb-item active"><a href="ajustar_producto.php?cod_producto=<?php echo $cod_producto; ?>">Ajuste Producto</a></li>
        </ol>

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><h3 class="card-title"><strong>Producto: </strong> <?php echo $alm->codigo_producto; ?> <?php echo $alm->nombre_producto; ?> <?php echo $alm->marca; ?></h3></li>
        </ol>

      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form class="row g-3 needs-validation" novalidate action="./controller/Almacen.controller.php
        "  method="POST" enctype="multipart/form-data">


        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-3 pt-0">Seleccione una Opci&oacute;n: </legend>
            <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="gridRadios1" value="registrar">
                    <label class="form-check-label" for="gridRadios1">
                    Registrar Ajuste
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                    Ver Ajustes
                    </label>
                </div>
            </div>
        </fieldset>

        <div class="row mb-3">
          <label for="algo" class="col-sm-2"></label>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-primary">Siguiente</button>
                <input type="hidden" name="operacion" id="operacion" value="ajus_op">
                <input type="hidden" name="cod_producto" id="cod_producto" value="<?php echo $cod_producto; ?>">
                
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