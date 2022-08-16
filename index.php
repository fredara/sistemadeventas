<?php
  extract($_REQUEST);
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
  <link href="assets/vendor/Miarchivoccs.css" rel="stylesheet">
  <link href="./css/estilos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <!--<img src="./image/barca.jpg">-->
                  <span class="d-none d-lg-block"><strong>Recarval</strong></span>
                </a>
              </div><!-- End Logo -->
              <!-- Error -->
              <?php if(!empty($err)){ ?> 
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $err; ?> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?> 
              <!-- End Error -->

              <div class="card mb-3 borderEspecial">

                <div class="card-body loginIndex">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"><strong> </strong></h5>
                  </div>
                    <!-- todos los form debe tener action method -->
                  <form class="row g-3 needs-validation" novalidate method="POST" action="./controller/Usuario.controller.php"  >

                  <!-- Cuando no tiene form(input) se trabaja con <a><a/> <a href="almacen.php">Ir a almacen</a> -->
                    <div class="col-12">
                      <div class="input-group has-validation">
                        <input type="text" name="login_usuario" class="form-control" id="yourUsername" placeholder="Usuario" required>
                        <div class="invalid-feedback">Por Favor ingrese el usuario.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <input type="password" name="clave_usuario" class="form-control" id="yourPassword" placeholder="Clave" required>
                      <div class="invalid-feedback">Por Favor Ingrese la Clave</div>
                    </div>

                    <div class="col-12">
                      <button class="botonIngresar-primary w-100 botonIngresar" type="submit">Entrar</button>
                      <input type="hidden" name="operacion" id="operacion" value="is">
                    </div>
                  </form>

                </div>

            </div>
          </div>
        </div>

      </section>

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