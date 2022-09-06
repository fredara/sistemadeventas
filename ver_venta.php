<?php
  extract($_REQUEST);
  require_once("./inc/sesion.php");
  require_once("./clases/ventas.php");
  $vent = new Ventas();	
  $vent->getVenta($cod_venta);
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
      <h1>Ver Venta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="listar_ventas.php">Lista Ventas</a></li>
          <li class="breadcrumb-item active"><a href="ver_venta.php?cod_venta=<?php echo $cod_venta; ?>">Ver Venta</a></li>
        </ol>

      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <label class="col-sm-8 col-form-label"><strong>Nro Venta:</strong>  <?php echo $cod_venta; ?></label>
        </div>
        <div class="row">
            <label class="col-sm-8 col-form-label"><strong>Fecha de Venta:</strong>  <?php echo $vent->fecha_ven; ?></label>
        </div>
        
        <div class="row">
            <label class="col-sm-8 col-form-label"><strong>Nombre Cliente:</strong>  <?php echo $vent->nombre_cliente; ?></label>
        </div>
        <div class="row">
            <label class="col-sm-8 col-form-label"><strong>Identificaci&oacute;n:</strong>  <?php echo $vent->num_identificacion; ?></label>
        </div>
        <div class="row">
            <label class="col-sm-8 col-form-label"><strong>Direcci&oacute;n:</strong>  <?php echo $vent->direccion_cliente; ?></label>
        </div>

        <div class="row">
            <label class="col-sm-8 col-form-label"><strong>Tasa de Cambio:</strong>  <?php echo @number_format($vent->tasa_cambio, 2, ',', '.'); ?>    <strong>Moneda:</strong>  <?php echo $vent->moneda; ?></label>
        </div>

        <div class="row">
            <label class="col-sm-8 col-form-label"><span class="badge bg-info text-dark"><strong>Observaci&oacute;n:</strong><?php echo $vent->observacion; ?></span></label>
        </div>

        <div class="row mb-4">
          <?php if ($vent->estado=='Cerrada') {$class = 'badge rounded-pill bg-success';}else{$class = 'badge rounded-pill bg-danger';} ?>
            <label class="col-sm-8 col-form-label"><span class="<?php echo $class; ?>"><?php echo $vent->estado;?><strong> Motivo: </strong><?php echo $vent->motivo_anulacion; ?></span></label>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                    <p></p>
                    <!-- Bordered Table -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center;"><strong>CANT</strong></th>
                            <th scope="col" style="text-align: center;"><strong>DESCRIPCION</strong></th>
                            <th scope="col" style="text-align: center;"><strong>PRECIOxUNIDAD</strong></th>
                            <th scope="col" style="text-align: center;"><strong>IVA</strong></th>
                            <th scope="col" style="text-align: center;"><strong>TOTAL PRECIO</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i=0;
                            $listaDetalle = $vent->detalleVenta($cod_venta);
                            if (!empty($listaDetalle)) {
                                foreach ($listaDetalle as $obj) {
                                    $i=$i+1;
                                    $cantidad_precio = $obj->cantidad * $obj->precioxuni;

                                    if ($obj->porcentaje_iva==16) {
                                        $subtotal=$subtotal+$cantidad_precio;
                                    } elseif ($obj->porcentaje_iva == 10) {
                                        $subtotal_r=$subtotal_r+$cantidad_precio;
                                    } else {
                                        $exento=$exento+$cantidad_precio;
                                    }
                            ?>
                                    <tr>
                                        <th scope="row" style="text-align: center;"><?php echo $i; ?></th>
                                        <td style="text-align: center;"><?php echo $obj->nombre_producto; ?></td>
                                        <td style="text-align: center;"><?php echo $obj->precioxuni;?></td>
                                        <td style="text-align: center;"><?php if ($obj->porcentaje_iva=='') {echo " N/A";}else{echo " ".$obj->porcentaje_iva."%";}  ?></td>
                                        <td style="text-align: right;"><?php echo @number_format($cantidad_precio, 2, ',', '.');  ?></td>
                                    </tr>
                            <?php 
                                    $iva=($subtotal*16)/100;
                                    $total=$subtotal+$subtotal_r+$exento+$iva;
                                }
                            }
                            ?>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><strong>Base Imponible</strong></td>
                                <td style="text-align: right;"><?php echo @number_format($subtotal, 2, ',', '.');?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><strong>Exento</strong></td>
                                <td style="text-align: right;"><?php echo @number_format($exento, 2, ',', '.');?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><strong>IVA</strong></td>
                                <td style="text-align: right;"><?php echo @number_format($iva, 2, ',', '.');?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><strong>TOTAL</strong></td>
                                <td style="text-align: right;"><?php echo @number_format($total, 2, ',', '.');?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Forma de Pago</h5>
                    <p></p>
                    <!-- Bordered Table -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center;"><strong>INSTRUMENTO</strong></th>
                            <th scope="col" style="text-align: center;"><strong>BANCO</strong></th>
                            <th scope="col" style="text-align: center;"><strong>NUMERO</strong></th>
                            <th scope="col" style="text-align: center;"><strong>MONTO</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_pagado_bs = 0;
                            $total_pagado_usd = 0;
                            $pagosRealizados = $vent->detallePAGO($cod_venta);
                            if (!empty($pagosRealizados)) {
                                foreach ($pagosRealizados as $pag) {
                            ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $pag->instru; ?></td>
                                        <td style="text-align: center;"><?php echo $pag->nombre_banco;?></td>
                                        <td style="text-align: center;"><?php echo $pag->numero;?></td>
                                        <td style="text-align: right;"><?php echo @number_format($pag->monto, 2, ',', '.'); echo " ".$pag->moneda_pago; ?></td>
                                    </tr>
                            <?php
                                    if ($pag->moneda_pago=='BS') {
                                        $total_pagado_bs += $pag->monto;
                                    }else{
                                        $total_pagado_usd += $pag->monto;
                                    }
                                
                                }
                            }
                            ?>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><strong>TOTAL BS</strong></td>
                                <td style="text-align: right;"><?php echo @number_format($total_pagado_bs, 2, ',', '.');?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><strong>TOTAL USD</strong></td>
                                <td style="text-align: right;"><?php echo @number_format($total_pagado_usd, 2, ',', '.');?></td>
                            </tr>
                        </tbody>
                    </table>
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