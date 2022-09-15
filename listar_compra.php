<?php
extract($_REQUEST);
require_once("./inc/sesion.php");
require_once("./clases/compra.php");
if (empty($regxpag))  $regxpag=30;
if (empty($pag)) $pag=1;
$comp = new Compra();
$objCompras= $comp->listaCompras($numero_compra, $pag, $regxpag);
$total_paginas=ceil($vent->total/$regxpag);

$grupo= $_SESSION['cod_grupo_usuario_log'];
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

    function abrirVentana(url) {
      window.open(url, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=350, height=660 left=600 top=80");
    }

    function cambiaBuscar(val){
      if (val=='Numero') {
        document.getElementById('numero_compra').style.display = 'inline';
      }else{
        document.getElementById('numero_compra').style.display = 'none';
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
      <h1>Lista de Productos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="listar_compra.php">Lista de Compras</a></li>
        </ol>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="registro_compra.php">Registrar Compra</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="container breadcrumb">
      <div class="row mb-12">
        <div class="col-lg-12">
          <form action="listar_compra.php" method="post"> 
            <label class="breadcrumb-item active">Buscar por:</label>

            <select class="form-select" name="buscar_por" id="buscar_por" onchange="cambiaBuscar(this.value);" style="display: inline !important; width: auto !important;">
              <option value="Seleccione">Seleccione</option>
              <option value="Numero">N&uacute;mero de Compra</option>
            </select>

            <input class="form-control" type="text" name="numero_compra" id="numero_compra" style="display: none; width: auto !important;">


            <button type="submit" class="btn btn-primary" id="btn_buscar">Buscar</button>
          </form>
        </div>
      </div>
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
                        <th style="width: 5%; text-align: center;">Nro Compra</th>
                        <th style="width: 20%; text-align: center;">Proveedor</th>
                        <th style="width: 20%; text-align: center;">Fecha</th>
                        <th style="width: 5%; text-align: center;">Estatus</th>
                        <th style="width: 15%; text-align: center;">Total</th>
                        <th style="width: 5%; text-align: center;">Creado Por</th>
                        <th style="width: 10%; text-align: center;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(!empty($objCompras)) {
				                  foreach ($objCompras as $obj) {
                            if ($obj->estado=='Cerrada') {
                              $class = 'table-success';
                            }else{
                              $class = 'table-danger';
                            }
                    ?>
                        <tr>
                            <th scope="row" style="text-align: center;" class="<?php echo $class; ?>"> <?php echo $obj->cod_compra; ?></th>
                            <td style="text-align: center;" class="<?php echo $class; ?>"><?php echo $obj->nombre_proveedor; ?></td>
                            <td style="text-align: center;" class="<?php echo $class; ?>"><?php echo $obj->fecha_comp; ?></td>
                            <td style="text-align: center;" class="<?php echo $class; ?>"><?php echo $obj->estado; ?></td>
                            <td style="text-align: center;" class="<?php echo $class; ?>"><?php echo @number_format($obj->total, 2, ',', '.'); if ($obj->moneda == 'BS') {echo " BS";}else{echo " $";} ?></td>
                            <td style="text-align: center;" class="<?php echo $class; ?>"><?php echo $obj->nombre_usuario; echo " "; echo $obj->apellido_usuario; ?></td>
                            <td style="text-align: center;" class="<?php echo $class; ?>">
                              <div class="card ventacenamiento-card">
                                <div class="filter centrar1">
                                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                      <h6>Opciones</h6>
                                    </li>
                                    <li><?php echo "<a class='dropdown-item' href='ver_compra.php?cod_compra=".$obj->cod_compra."'>Ver</a>"; ?></li>

                                    <?php  if ($obj->estado=='Cerrada') { ?>
                                      <li><?php //echo "<a class='dropdown-item' href='javascript:abrirVentana('venta_imprimir.php?cod_venta=".$obj->cod_venta."')'>Imprimir</a>"; ?>
                                        <a class='dropdown-item' href="javascript:abrirVentana('venta_imprimir.php?cod_venta=<?php echo $obj->cod_venta;?>')">Imprimir</a>
                                      </li>
                                    <?php } ?>

                                    <?php if ($obj->estado=='Cerrada') {
                                      //href="./controller/Ventas.controller.php?cod_venta=<?php echo $obj->cod_ventaoperacion=anulaVenta" 
                                    ?>
                                    <li>
                                      <a class='dropdown-item' href="./anular_venta.php?cod_venta=<?php echo $obj->cod_venta;?>">Anular</a>
                                    </li>
                                    <?php } ?>
                                    
                                  </ul>
                                </div>
                              </div>
                            </td>
                        </tr>
                    <?php
				                }
				              }
                    ?>
                    </tbody>
                    </table>
                    <?php 
                      if ($total_paginas) { 
                        $display_pages=5;
                    ?>
                        <nav aria-label="Page navigation example" class="d-flex align-items-center justify-content-center">
                          <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="listar_ventas.php?pag=1" title='Ir a Inicio de la Lista'>Primero</a></li>
                            <?php if ($pag>1) echo "<li class='page-item'><a class='page-link' href='listar_ventas.php?pag=".($pag-1)."'>Anterior</a></li>";

                                for ($i = $pag; $i <= $total_paginas && $i<=($pag+$display_pages); $i++) {
                                  if ($i == $pag) echo "<strong class='page-link'>$i - </strong>";//not printing the link
                                  else echo " <li class='page-item'><a class='page-link' href='listar_ventas.php?pag=$i' title='page $i'>$i</a></li> - ";//link
                                }

                                if (($pag+$display_pages)< $total_paginas) echo "..."; //etcetera...
                                if ($pag<$total_paginas) echo " <a class='page-link' title='Next' href='listar_ventas.php?pag=".($pag+1)."'> Pr&oacute;ximo >></a> ";//Next
                                echo "<a class='page-link' title='Ultima Pagina' href='listar_ventas.php?pag=$total_paginas'>&Uacute;ltimo >></a> ";
                            ?>
                          </ul>
                        </nav>
                    <?php 
                      } 
                    ?>

                    <span class="d-flex align-items-center justify-content-center pagination">
                      <label class="page-link">
                        <?php 
                          if (!empty($objCompras)) {
                            echo $vent->primero?>
                            -<?php echo $vent->ultimo?> de <?php echo $vent->total; 
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