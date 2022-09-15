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
     $(document).ready(function() {
        //window.print();
    });
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
    <section class="section dashboard" style="padding: 15px; font-size: 14px;">
        <div class="row text-center">
            <label class="col-sm-8 col-form-label" style="padding-top: 1px;"><strong>RECARVAL</strong></label>
        </div>
        <div class="row text-center">
            <label class="col-sm-8 col-form-label" style="padding-top: 1px;">J-123456789</label>
        </div>
        <div class="row text-center">
            <label class="col-sm-8 col-form-label" style="padding-top: 1px;"> ------------Datos del Consumidor------------ </label>
        </div>
        <div class="row">
            <label class="col-sm-8 col-form-label" style="padding-top: 1px;"><strong>Fecha de Venta:</strong>  <?php echo $vent->fecha_ven; ?></label>
        </div>
        
        <div class="row">
            <label class="col-sm-8 col-form-label" style="padding-top: 1px;"><strong>Nombre Cliente:</strong>  <?php echo $vent->nombre_cliente; ?></label>
        </div>
        <div class="row">
            <label class="col-sm-8 col-form-label" style="padding-top: 1px;"><strong>Identificaci&oacute;n:</strong>  <?php echo $vent->num_identificacion; ?></label>
        </div>
        <div class="row">
            <label class="col-sm-8 col-form-label" style="padding-top: 1px;"><strong>Direcci&oacute;n:</strong>  <?php echo $vent->direccion_cliente; ?></label>
        </div>

        <!--<div class="row">
            <label class="col-sm-8 col-form-label"><strong>Tasa de Cambio:</strong>  <?php echo @number_format($vent->tasa_cambio, 2, ',', '.'); ?>    <strong>Moneda:</strong>  <?php echo $vent->moneda; ?></label>
        </div>-->

        <div class="row text-center" style="font-size: 18px;">
            <label class="col-sm-8 col-form-label"><strong>Factura</strong></label>
        </div>

        <div class="row">
            <div class="col">
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 4px;">
                    <tr>
                        <td colspan="4"><hr style="border: 1px dashed; margin: 0rem 0;"></td>
                    </tr>
                    <tr>
                        <td><strong>CANT</strong></td>
                        <td><strong>DESCRIP</strong></td>
                        <td><strong>P/UNI</strong></td>
                        <td><strong>Valor</strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr style="border: 1px dashed; margin: 0rem 0;"></td>
                    </tr>
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
                    ?>          <tr>
                                    <td><?php echo $obj->cantidad; ?></td>
                                    <td><?php echo $obj->nombre_producto; ?></td>
                                    <td><?php echo @number_format($obj->precioxuni, 2, ',', '.');?></td>
                                    <td><?php echo @number_format($cantidad_precio, 2, ',', '.');?></td>
                                </tr>
                    <?php 
                                $iva=($subtotal*16)/100;
                                $total=$subtotal+$subtotal_r+$exento+$iva;
                                $total_neto = $subtotal+$subtotal_r+$exento;
                            }
                        }
                    ?>
                    <tr>
                        <td colspan="4"><hr style="border: 1px dashed; margin: 0rem 0;"></td>
                    </tr>

                    <tr>
                        <td colspan="3" align="left">Total Neto</td>
                        <td align="rigth"><?php echo @number_format($total_neto, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left">Base Gravable</td>
                        <td align="rigth"><?php echo @number_format($subtotal, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left">IVA 16,00%</td>
                        <td align="rigth"><?php echo @number_format($iva, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left">Exento</td>
                        <td align="rigth"><?php echo @number_format($exento, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left">TOTAL</td>
                        <td align="rigth"><?php echo @number_format($total, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr style="border: 1px dashed; margin: 0rem 0;"></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="left">FORMA DE PAGO</td>
                        <?php 
                            $efectivo = 0;
                            $debito = 0;
                            $trans_pagom = 0;
                            $divisa = 0;
                            $pagosRealizados = $vent->detallePAGO($cod_venta);
                            if (!empty($pagosRealizados)) {
                                foreach ($pagosRealizados as $pag) {
                                    if ($pag->moneda_pago=='BS') {
                                        if($pag->instru=='Efectivo'){
                                            $efectivo += $pag->monto;
                                        }elseif ($pag->instru=='Tarjeta de Debito') {
                                            $debito += $pag->monto;
                                        }elseif($pag->instru=='Transferencia' || $pag->instru=='Pago Movil'){
                                            $trans_pagom += $pag->monto;
                                        }
                                    }else{
                                        $divisa += $pag->monto;
                                    }
                                    
                                
                                }
                            }
                            ?>
                    </tr>


                    <tr>
                        <td colspan="3" align="left">EFECTIBO (Bs):</td>
                        <td align="rigth"><?php echo @number_format($efectivo, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left">DIVISA ($):</td>
                        <td align="rigth"><?php echo @number_format($divisa, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left">TARJETA DEBITO (Bs):</td>
                        <td align="rigth"><?php echo @number_format($debito, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left">Pago Movil o Transferencia (Bs):</td>
                        <td align="rigth"><?php echo @number_format($trans_pagom, 2, ',', '.');?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr style="border: 1px dashed; margin: 0rem 0;"></td>
                    </tr>

                    <tr>
                        <td><?php echo $cod_venta; ?></td>
                        <td></td>
                        <td>CAJA 1</td>
                    </tr>

                    
                    <tr>
                        <td colspan="4" align="center">
                            <br>
                            <a href="javascript:window.print()" id="imprimir">[ Imprimir ]</a>
                            <a href="#" onclick="window.close();" id="imprimir">[ Cerrar ]</a>
                        </td>
                    </tr>



                </table>
            </div>
        </div>




    </section>


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