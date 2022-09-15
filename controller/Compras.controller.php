<?php 
    session_start();
    extract($_REQUEST);
    require_once("../clases/compra.php");
    require_once("../clases/ventas.php");
    require_once("../clases/almacen.php");
    require_once("../clases/utilidades.php");
    require_once("../clases/log.php");

    switch ($operacion) {

        case "reg_comp": 
            if (!empty($fecha_compra) and !empty($moneda) and !empty($tasa_cambio) and !empty($cod_proveedor) and !empty($cod_producto[0]) and !empty($cantidad[0]) and !empty($precioxuni[0]) and !empty($precio[0])) {
                $vent = new Ventas();
                $comp = new Compra();
                if ($cod_proveedor == 'newPro') {
                    if (!empty($tipo_identidad) and !empty($nombre_proveedor)) {
                        if ($tipo_identidad=='cedula')	$num_identificacion = $num_cedula;
                        if ($tipo_identidad=='rif')	$num_identificacion = $rif_proveedor;
                        if ($tipo_identidad=='pasaporte')	$num_identificacion = $num_pasaporte;

                        

                        $ProveedorYaGuardado = $comp->ExisteProveedor($tipo_identidad, $num_identificacion);

                        if ($ProveedorYaGuardado == 's') {
                            $dataProveedor = $comp->ModProveedorData($tipo_identidad, $num_identificacion, $nombre_proveedor, $direccion_proveedor);
                        }else{
                            $dataProveedor = $comp->SaveProveedorData($tipo_identidad, $num_identificacion, $nombre_proveedor, $direccion_proveedor);
                        }
                        $cod_proveedor = $comp->cod_proveedor;

                        if ($dataProveedor != 'OK') {
                            $err = "No se Guardo la data del Proveedor, Contacte al administrador del sistema";
                            header("Location:../registro_compra.php?err=$err");  
                            break;
                        }
                        $tasa_cambio = str_replace(',', '.', $tasa_cambio);
                        //atualiza la tasa de cambio a la ultima que se registró 
                        $actualiza_tasa = $vent->ActualizarTasaCambio($tasa_cambio);
                        if($actualiza_tasa!='OK'){
                            $err = "No se pudo realizar la actualizacion de la tasa de cambio, Contacte al administrador del sistema";
                            header("Location:../registro_compra.php?err=$err");  
                            break;
                        }
                        
                        $guardaCompra = $comp->SaveCompra($fecha_compra, $moneda, $tasa_cambio, $cod_proveedor, $observacion);
                        
                    }else{
                        $err = "Faltan datos obligatorios del proveedor para registrar la Compra Por favor, Ingrese todos los datos requeridos";
                        header("Location:../registro_compra.php?err=$err");    
                    }
                }else{
                    $tasa_cambio = str_replace(',', '.', $tasa_cambio);
                    //atualiza la tasa de cambio a la ultima que se registró 
                    $actualiza_tasa = $vent->ActualizarTasaCambio($tasa_cambio);
                    if($actualiza_tasa!='OK'){
                        $err = "No se pudo realizar la actualizacion de la tasa de cambio, Contacte al administrador del sistema";
                        header("Location:../registro_compra.php?err=$err");  
                        break;
                    }
                    
                    $guardaCompra = $comp->SaveCompra($fecha_compra, $moneda, $tasa_cambio, $cod_proveedor, $observacion);
                }

                
                if ($guardaCompra!='OK') {
                    $err = "No se Guardo la data de Compra, Contacte al administrador del sistema";
                    header("Location:../registro_compra.php?err=$err");  
                    break;
                }else{
                    $fecha_ajuste = date("Y-m-d");
                    $tipo_ajuste = 'Incremento';
                    $concepto_ajuste = 'Compra Numero '.$comp->cod_compra.' Registrada, Suma en inventario';
                    $alm = new Almacen();

                    $iva_n = 16;
                    $iva_r = 10;
                    $i=count($cod_producto);
                    for ($j=0;$j<$i;$j++) {
                        if (!empty($cod_producto[$j]) and !empty($cantidad[$j]) and !empty($precioxuni[$j])) {

                            $cantidad_precio = $precioxuni[$j]*$cantidad[$j];

                            $total_pedido += $cantidad_precio;
                            if ($iva[$j]==$iva_n) {
                                $subtotal=$subtotal+$cantidad_precio;
                                $porcentaje_iva=$iva_n;
                            } elseif ($iva[$j] == $iva_r) {
                                $subtotal_r=$subtotal_r+$cantidad_precio;
                                $porcentaje_iva=$iva_r;
                            } else{
                                $exento=$exento+$cantidad_precio;
                                $porcentaje_iva="";
                            }
                            $guardaDetalle = $comp->saveDetalleCompra($comp->cod_compra, $cod_producto[$j], $cantidad[$j], $precioxuni[$j], $porcentaje_iva);
                            if ($guardaDetalle=='OK') {
                                $incrementa = $alm->incrementaExistencia($cod_producto[$j], $cantidad[$j]);
                                if ($incrementa=='OK') {
                                    $alm->addAjusteProd($cod_producto[$j], $fecha_ajuste, $tipo_ajuste, $cantidad[$j], $concepto_ajuste);
                                }
                            }
                        }
                    }
                    
                    $iva=($subtotal*$iva_n)/100;
                    $iva=round($iva,2);
                    $iva_r=($subtotal_r*$iva_r)/100;
                    $iva_r=round($iva_r,2);
                    $subtotal=round($subtotal,2);
                    $exento=round($exento,2);
                    $total=$subtotal+$iva+$subtotal_r+$iva_r+$exento;


                    $comp->modMontosCompra($comp->cod_compra, $iva, $subtotal, $iva_r, $subtotal_r, $total, $exento);

                   

                    $log = new Log();
                    $uti = new Utilidades();
                    // REGISTRO Log
                    $descripcion="Se registró una Compra numero $comp->cod_compra";
                    $fecha_hora=date("Y-m-d H:i:s");
                    $ip=$uti->getIP();
                    $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, "Compras");
                    $err="La Compra se ha Creado  de forma exitosa";
                    header("Location:../listar_compra.php?err=$err&tp=e");
                }

                
            }else{
                $err = "Faltan datos obligatorios para registrar la Compra Por favor, Ingrese todos los datos requeridos";
                header("Location:../registro_compra.php?err=$err");    
            }
        break;


        case "anulaComp":
            if (!empty($cod_compra)) {
                $comp = new Compra();	
                $comp->getcompra($cod_compra);

                $anulado = $comp->AnulaCompra($cod_compra, $motivo);
                if ($anulado!='OK') {
                    $err = "Error al Anular la Compra, Contacte al administrador del sistema";
                    header("Location:../listar_compra.php?err=$err");  
                    break;
                }else{
                    $alm = new Almacen();	
                    $fecha_ajuste = date("Y-m-d");
                    $tipo_ajuste = 'Decremento';
                    $concepto_ajuste = 'Compra Numero '.$cod_compra.' Anulada, Reposicion de inventario';
                    $listaDetalle = $comp->detallecompra($cod_compra);
                    if (!empty($listaDetalle)) {
                        foreach ($listaDetalle as $obj) {
                            $decrementa = $alm->decrementaExistencia($obj->cod_producto, $obj->cantidad);
                            if ($decrementa=='OK') {
                                $alm->addAjusteProd($obj->cod_producto, $fecha_ajuste, $tipo_ajuste, $obj->cantidad, $concepto_ajuste);
                            }
                        }
                    }
                    // REGISTRO Log
                    $log = new Log();
                    $uti = new Utilidades();
                    $descripcion="Se Anuló la Compra numero $cod_compra";
                    $fecha_hora=date("Y-m-d H:i:s");
                    $ip=$uti->getIP();
                    $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, "Compra");
                    $err="La Compra se ha Anulado de forma exitosa";
                    header("Location:../listar_compra.php?err=$err&tp=e");
                }

            }else{
                $err = "Falla al Seleccionar Compra, Contacte al administrador del sistema";
                header("Location:../listar_compra.php?err=$err");    
            }
        break;


       


        default:
            header("Location:../index.php");
	    break; 
    }
?>