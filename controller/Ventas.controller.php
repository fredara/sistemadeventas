<?php 
    session_start();
    extract($_REQUEST);
    require_once("../clases/ventas.php");
    require_once("../clases/utilidades.php");
    require_once("../clases/log.php");

    switch ($operacion) {

        case "reg_venta": 
            if (!empty($fecha_venta) and !empty($moneda) and !empty($tasa_cambio) and !empty($tipo_identidad) and !empty($cod_producto[0]) and !empty($cantidad[0]) and !empty($precioxuni[0]) and !empty($precio[0]) and !empty($moneda_pago[0]) and !empty($instru_p[0]) and !empty($monto_p[0])) {

                $vent = new Ventas();

                //Guarda el documento del cliente asociado a los datos
                if ($tipo_identidad=='cedula')	$num_identificacion = $num_cedula;
				if ($tipo_identidad=='rif')	$num_identificacion = $rif_cliente;
				if ($tipo_identidad=='pasaporte')	$num_identificacion = $num_pasaporte;

                $ClienteYaGuardado = $vent->ExisteCliente($tipo_identidad, $num_identificacion);
                //codigo del cliente viene del conseguido

                if ($ClienteYaGuardado == 's') {
                    $dataCliente = $vent->ModClienteData($tipo_identidad, $num_identificacion, $nombre_cliente, $direccion_cliente);
                }else{
                    $dataCliente = $vent->SaveClienteData($tipo_identidad, $num_identificacion, $nombre_cliente, $direccion_cliente);
                    //cod cliente viene del cliente creado
                }
                $cod_cliente = $vent->cod_cliente;
                if ($dataCliente != 'OK') {
                    $err = "No se Guardo la data del cliente , Contacte al administrador del sistema";
                    header("Location:../registro_ventas.php?err=$err");  
                    break;
                }

                
                
                $tasa_cambio = str_replace(',', '.', $tasa_cambio);
                //atualiza la tasa de cambio a la ultima que se registró 
                $actualiza_tasa = $vent->ActualizarTasaCambio($tasa_cambio);
                if($actualiza_tasa!='OK'){
                    $err = "No se pudo realizar la actualizacion de la tasa de cambio, Contacte al administrador del sistema";
                    header("Location:../registro_ventas.php?err=$err");  
                    break;
                }


                //guarda la venta general
                $dataVenta = $vent->SaveVenta($fecha_venta, $moneda, $tasa_cambio, $cod_cliente, $observacion);
                if ($dataVenta!='OK') {
                    $err = "No se Guardo la data del cliente, Contacte al administrador del sistema";
                    header("Location:../registro_ventas.php?err=$err");  
                    break;
                }else{

                    //guarda el detalle de la venta
                    $iva = 16;
                    $iva_r = 10;
                    $i=count($cod_producto);
                    for ($j=0;$j<$i;$j++) {
                        if (!empty($cod_producto[$j]) and !empty($cantidad[$j]) and !empty($precioxuni[$j])) {

                            $cantidad_precio = $precioxuni[$j]*$cantidad[$j];

                            $total_pedido += $cantidad_precio;
                            if ($iva[$j]==$iva) {
                                $subtotal=$subtotal+$cantidad_precio;
                                $porcentaje_iva=$iva;
                            } elseif ($iva[$j] == $iva_r) {
                                $subtotal_r=$subtotal_r+$cantidad_precio;
                                $porcentaje_iva=$iva_r;
                            } else{
                                $exento=$exento+$cantidad_precio;
                                $porcentaje_iva="";
                            }
                            $vent->saveDetalleVenta($vent->cod_venta, $cod_producto[$j], $cantidad[$j], $precioxuni[$j], $porcentaje_iva);
                        }
                    }
                    
                    $iva=($subtotal*$iva)/100;
                    $iva=round($iva,2);
                    $iva_r=($subtotal_r*$iva_r)/100;
                    $iva_r=round($iva_r,2);
                    $subtotal=round($subtotal,2);
                    $exento=round($exento,2);
                    $total=$subtotal+$iva+$subtotal_r+$iva_r+$exento;


                    $vent->modMontosVenta($vent->cod_venta, $iva, $subtotal, $iva_r, $subtotal_r, $total, $exento);

                    //guarda el detalle de los pagos
                    $i=count($moneda_pago);
                    for ($j=0;$j<$i;$j++) {
                        if (!empty($moneda_pago[$j]) and !empty($instru_p[$j]) and !empty($monto_p[$j])) {
                            $vent->saveVentaPago($vent->cod_venta, $moneda_pago[$j], $instru_p[$j], $banco_p[$j], $numero_p[$j], $monto_p[$j]);
                        }
                    }

                    $log = new Log();
                    $uti = new Utilidades();
                    // REGISTRO Log
                    $descripcion="Se registró la Venta numero $vent->cod_venta";
                    $fecha_hora=date("Y-m-d H:i:s");
                    $ip=$uti->getIP();
                    $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, "Ventas");
                    $err="La Venta se ha Creado  de forma exitosa";
                    header("Location:../listar_ventas.php?err=$err&tp=e");

                }
            }else{
                $err = "Faltan datos obligatorios para registrar la venta Por favor, Ingrese todos los datos requeridos";
                header("Location:../registro_ventas.php?err=$err");    
            }
        break;


        default:
            header("Location:../index.php");
	    break; 
    }
?>