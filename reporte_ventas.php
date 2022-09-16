<?php
extract($_REQUEST);
require_once("./inc/sesion.php");
require_once("./clases/ventas.php");
$vent = new Ventas();

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
            var cod_venta = <?php echo $cod_venta; ?>

            if (cod_venta != '') {
                abrirVentana(`venta_imprimir.php?cod_venta=${cod_venta}`);
            }

        });

        (function($) {
            $(function() {
                $('input:text').setMask();
            });
        })(jQuery);

        function abrirVentana(url) {
            window.open(url, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=350, height=660 left=600 top=80");
        }

        function cambiaBuscar(val) {
            if (val == 'Numero') {
                document.getElementById('numero_venta').style.display = 'inline';
            } else {
                document.getElementById('numero_venta').style.display = 'none';
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


    <main id="main2" class="main">
        <!-- Error -->
        <?php if (!empty($err)) { ?>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div <?php if ($tp == 'e') { ?> class="alert alert-success alert-dismissible fade show" <?php } else { ?> class="alert alert-danger alert-dismissible fade show" <?php } ?> role="alert">
                        <?php echo $err;  ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            </div>
        <?php } ?>
        <!-- End Error -->


        <div class="pagetitle">
            <h1>Reporte de Ventas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="reporte_ventas.php">Reporte de Ventas</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="container breadcrumb">
            <div class="row mb-12">
                <div class="col-lg-12">
                    <form action="reporte_ventas_imprimir.php" method="post" target="_blank">
                        <div class="row mb-4">
                            <label for="desde" class="col-sm-5 col-form-label">Fecha desde <span class="badge border-danger border-1 text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="date" name="desde" id="desde" class="form-control" value="<?php echo $fecha_hoy; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="hasta" class="col-sm-5 col-form-label">Fecha hasta <span class="badge border-danger border-1 text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="date" name="hasta" id="hasta" class="form-control" value="<?php echo $fecha_hoy; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="estado" class="col-sm-5 col-form-label">Estatus</label>
                            <div class="col-sm-6">
                                <select name="estado" id="estado" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="Cerrada" selected>Cerradas</option>
                                    <option value="Anulada">Anuladas</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn_buscar">Generar Reporte</button>
                    </form>
                </div>
            </div>
        </div>


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