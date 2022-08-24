<?php
extract($_REQUEST);
require_once("./inc/sesion.php");
require_once("./clases/almacen.php");
if (empty($regxpag))  $regxpag=30;
if (empty($pag)) $pag=1;
$alm = new Almacen();
$objPrecios= $alm->listarPreciosHistorico($cod_producto, $pag, $regxpag);
$total_paginas=ceil($alm->total/$regxpag);

$alm->getProducto($cod_producto);

?>
<!DOCTYPE html PUBLIC>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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


    });

    (function($){
        $(function(){
            $('input:text').setMask();
            }
        );
    })(jQuery);


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


  <main id="main2" class="main">
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
        <h1>Historico de Precio</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="lista_productos.php">Lista Productos</a></li>
            <li class="breadcrumb-item active"><a href="precio_producto.php?cod_producto=<?php echo $cod_producto; ?>">Precio Producto</a></li>
            <li class="breadcrumb-item active"><a href="precio_producto_historico.php?cod_producto=<?php echo $cod_producto; ?>">Historico Precio</a></li>
            </ol>

            <ol class="breadcrumb">
            <li class="breadcrumb-item"><h3 class="card-title"><strong>Producto: </strong> <?php echo $alm->codigo_producto; ?> <?php echo $alm->nombre_producto; ?> <?php echo $alm->marca; ?></h3></li>
            </ol>

            <ol class="breadcrumb">
              <li class="breadcrumb-item"><span class="card-title"><strong>Precio Actual: </strong> <?php echo @number_format($alm->precio, 1, ',', '.'); echo " $"; ?></span></li>
            </ol>

        </nav>
    </div>

    <section class="section dashboard">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th style="width: 5%; text-align: center;">Fecha Ajuste</th>
                        <th style="width: 30%; text-align: center;">Precio</th>
                        <th style="width: 15%; text-align: center;">Registrado Por</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(!empty($objPrecios)) {
				            foreach ($objPrecios as $obj) {
                    ?>
                        <tr>
                            <th scope="row"> <?php echo $obj->fecha_reg; ?></th>
                            <td style="text-align: center;"><?php echo @number_format($obj->precio, 1, ',', '.'); ?></td>
                            <td style="text-align: center;"><?php echo $obj->nombre_usuario; echo " "; echo $obj->apellido_usuario; ?></td>
                            
                        </tr>
                    <?php
				            }
				        }
                    ?>
                    </tbody>
                    </table>
                    

                    <span class="d-flex align-items-center justify-content-center pagination">
                      <label class="page-link">
                        <?php 
                          if (!empty($objPrecios)) {
                            echo $alm->primero?>
                            -<?php echo $alm->ultimo?> de <?php echo $alm->total; 
                          } 
                        ?>
                      </label>
                    </span>

                </div>
                </div>

                
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