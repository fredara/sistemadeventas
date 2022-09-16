<?php
extract($_REQUEST);
require_once("./inc/sesion.php");
require_once("./clases/almacen.php");
$alm = new Almacen();
$objProductos = $alm->ReporteVentas($tipo_reporte);
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


        <div class="pagetitle text-center">
            <h1>Reporte de Ventas</h1>

            <?php if (!empty($desde)) { ?>
                <h5>Ventas desde: <?php echo $desde; ?></h5>
            <?php } ?>
            <?php if (!empty($hasta)) { ?>
                <h5>Ventas hasta: <?php echo $hasta; ?></h5>
            <?php } ?>
          
        </div><!-- End Page Title -->

        <div class="container breadcrumb">
            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
                <tr>
                    <td class="borde_gris_bottom"><strong>Nombre Producto</strong></td>
                    <td class="borde_gris_bottom"><strong>C&oacute;digo Producto</strong></td> 
                    <td class="borde_gris_bottom"><strong>Marca</strong></td>
                    <td class="borde_gris_bottom"><strong>Descripcion</strong></td>
                    <td class="borde_gris_bottom"><strong>Existencia</strong></td>
                </tr>
                <?php 
                    $pro=0;
                    $proFalla=0;
                    if(!empty($objProductos)) {
                        foreach ($objProductos as $obj) { 
                            $pro++;
                            if ($obj->cantidad<=0) {
                                $proFalla++;
                                $class = 'table-danger';
                            }else{
                                $class = '';
                            }
                ?>
                            <tr>
                                <td class="<?php echo $class; ?>"><?php echo $obj->nombre_producto; ?></td>
                                <td class="<?php echo $class; ?>"><?php echo $obj->codigo_producto; ?></td> 
                                <td class="<?php echo $class; ?>"><?php echo $obj->marca; ?></td>
                                <td class="<?php echo $class; ?>"><?php echo $obj->descripcion; ?></td>
                                <td class="<?php echo $class; ?>"><?php echo $obj->cantidad; ?></td>
                            </tr>
                <?php   }
                    }
                ?>

                <tr>
                    <td colspan="7" align="right">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="6" align="right"><strong>Total Productos:</strong></td>
                    <td style="padding: 5px;"> <?php echo $pro; ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right"><strong>Total Productos con Falla:</strong></td>
                    <td style="padding: 5px;"> <?php echo $proFalla;?></td>
                </tr>
            </table>
        </div>

        <div class="pagetitle text-center">
            <br>
            <a href="javascript:window.print()" id="imprimir">[ Imprimir ]</a>
            <a href="#" onclick="window.close();" id="imprimir">[ Cerrar ]</a>
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