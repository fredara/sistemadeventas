<?php 
    session_start();
    extract($_REQUEST);
    require_once("../clases/almacen.php");
    require_once("../clases/utilidades.php");
    require_once("../clases/log.php");
    require_once("../clases/archivo.php");

    switch ($operacion) {

        case "cpro": 
            if (!empty($codigo_producto) && !empty($nombre_producto) && !empty($cantidad_inicial)) {
                $log = new Log();
                $uti = new Utilidades();
                $alm = new Almacen();

                $existeCodigo = $alm->getProductoExisteCodigo($codigo_producto);

                if($existeCodigo=='s'){
                    $err="El código del producto que intenta registrar ya existe para otro Producto";
                    header("Location:../registrar_producto.php?err=$err");
                    break;
                }


                if (!empty($err)) {
                    header("Location:../registrar_producto.php?err=$err");
                    break;
                }else{
                    $error=$alm->addProducto($codigo_producto, $nombre_producto, $descripcion, $marca, $cantidad_inicial, $precio, $cod_foto, $precio_costo);

                    if ($error!='OK') {
                        $err="Hubo problemas para conectarse con la base de Datos, por favor contacte al administrador del sistema";
                        header("Location:../registrar_producto.php?err=$err");
                        break;
                    } else {
                        //Historico de cantidades
                        $fecha_hoy= date("Y-m-d");
                        $alm->addAjusteProd($alm->cod_producto, $fecha_hoy, 'Incremento', $cantidad_inicial, 'Ajuste Inicial por Creacion del Producto');

                        //Guarda Foto del Producto
                        $arch = new Archivo();	
                        $i = count($_FILES['archivo']['name']);
                        $noguardados = $guardados = 0;
                        for ($j=0;$j<$i;$j++) {
                            $archivo_name=strtolower($_FILES['archivo']['name'][$j]);
                            $archivo_tmp=$_FILES['archivo']['tmp_name'][$j];
                            $archivo_tamano=$_FILES['archivo']['size'][$j];
                            $directorio='../images/productos';
                            if (!empty($archivo_name)) {
                                $varrand = substr(md5(uniqid(rand())),0,10);        
                                $extension = substr($archivo_name, (strrpos($archivo_name,'.') + 1));
                                
                                if ($extension=="jpg" or $extension=="gif" or $extension=="png") {
                                    $nombre=$varrand.$archivo_name;
                                    $nombre=str_replace(' ', '', $nombre);
                                    $arch->addFotoProd($nombre, $archivo_tmp, $directorio, $extension, 'i', $alm->cod_producto);
                                    $cod_foto=$arch->cod_foto;
                                    $guardados = $guardados+1;
                                } else {
                                    $noguardados = $noguardados +1;
                                }
                                
                            }
                        }
                        //Fin del Guardar Foto


                        // información del log
                        $descripcion="Se Registro un nuevo producto en el sistema $nombre_producto";
                        $fecha_hora=date("Y-m-d H:i:s");
                        $ip=$uti->getIP();
                        $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, 'Almacen - Productos');
                        $err="Se ha Creado el Producto Exitosamente, con $guardados Imagenes";
                        if ($noguardados>0) {
                            $err.=" No se Pudo Guardar Alguna imagen, Debe Verificar que el formato sea (.jpg .gif o .png)";
                        }
                        $tp="e";
                        header("Location:../lista_productos.php?err=$err&tp=$tp");
                        break;
                    }
                }

               
                
            } else {
                $err="Debe Ingresar todos los datos obligatorios (Codigo del producto, nombre, existencia, PVP)";
                header("Location:../index.php?err=$err");
                break;
            }
        break;

        case "mod_pro":
            if (empty($cod_producto)) {
                $err="Contacte al Administrador del sistema, Cod.1424";
                header("Location:../lista_productos.php?err=$err");
                break;
            }
            if (!empty($codigo_producto) and !empty($nombre_producto)) {
                $alm = new Almacen();
                $alm->getProducto($cod_producto);

                $existeCodigoMod = $alm->getProductoExisteCodigoMod($cod_producto, $codigo_producto);
                if ($existeCodigoMod=='s') {
                    $err="El código del producto que intenta Ingresar ya existe para otro Producto";
                    header("Location:../modificar_producto.php?err=$err&cod_producto=$cod_producto");
                    break;
                }

                //Guarda Foto del Producto
                $arch = new Archivo();	
                $i = count($_FILES['archivo']['name']);
                $noguardados = $guardados = 0;
                for ($j=0;$j<$i;$j++) {
                    $archivo_name=strtolower($_FILES['archivo']['name'][$j]);
                    $archivo_tmp=$_FILES['archivo']['tmp_name'][$j];
                    $archivo_tamano=$_FILES['archivo']['size'][$j];
                    $directorio='../images/productos';
                    if (!empty($archivo_name)) {
                        $varrand = substr(md5(uniqid(rand())),0,10);        
                        $extension = substr($archivo_name, (strrpos($archivo_name,'.') + 1));
                        
                        if ($extension=="jpg" or $extension=="gif" or $extension=="png") {
                            $nombre=$varrand.$archivo_name;
                            $nombre=str_replace(' ', '', $nombre);
                            $arch->addFotoProd($nombre, $archivo_tmp, $directorio, $extension, 'i', $cod_producto);
                            $guardados = $guardados+1;
                        } else {
                            $noguardados = $noguardados +1;
                        }
                        
                    }
                }
                //Fin del Guardar Foto
                
                $error2=$alm->modProducto($cod_producto, $codigo_producto, $nombre_producto, $descripcion, $marca, $cod_foto, $precio_costo);
                if ($error2!='OK') {
                    $err="No se pudo guardar la información del producto, por favor contacte al administrador del sistema";
                    header("Location:../lista_productos.php?err=$err&pag=$pag");
                } else {
                    $log = new Log();
                    $uti = new Utilidades();
                    // REGISTRO Log
                    $descripcion="modificó los datos del producto $nombre_producto";
                    $fecha_hora=date("Y-m-d H:i:s");
                    $ip=$uti->getIP();
                    $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, "Productos - Actualizar");
                    $err.="La información del producto se actualizó de forma exitosa";
                    header("Location:../modificar_producto.php?err=$err&pag=$pag&tp=e&cod_producto=$cod_producto");
                }
            } else {
                $err="No se pudo completar la operación, por favor completar toda la información requerida";
                header("Location:../modificar_producto.php?err=$err&pag=$pag&cod_producto=$cod_producto");
            }
        break;

        case "elimFoto":
            if (!empty($cod_producto)) {
                if (!empty($cod_foto)) {
                    $arch = new Archivo();
                    $error=$arch->elimFotoPro($cod_foto);

                    if ($error!='OK') {
                        $err="No se pudo eliminar la foto del producto, por favor contacte al administrador del sistema";
                        header("Location:../modificar_producto.php?err=$err&cod_producto=$cod_producto");
                    } else {
                        $log = new Log();
                        $uti = new Utilidades();
                        $alm = new Almacen();
                        $alm->getProducto($cod_producto);
                        // REGISTRO Log
                        $descripcion="Eliminado foto del producto $alm->nombre_producto";
                        $fecha_hora=date("Y-m-d H:i:s");
                        $ip=$uti->getIP();
                        $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, "Productos - Actualizar");
                        $err.="Foto Eliminada";
                        header("Location:../modificar_producto.php?err=$err&tp=e&cod_producto=$cod_producto");
                    }
                }else{
                    $err="Seleccionado Foto de forma incorrecta, Contacte al administrador";
                    header("Location:../modificar_producto.php?err=$err&cod_producto=$cod_producto");
                }
            }else{
                $err="Seleccionado de forma incorrecta, Contacte al administrador";
                header("Location:../lista_productos.php?err=$err");
            }
        break;

        case "ajus_op":
            if (empty($cod_producto)) {
                $err="Contacte al Administrador del sistema, Cod.1424";
                header("Location:../lista_productos.php?err=$err");
                break;
            }
            if (!empty($option)) {
                if ($option=='registrar') {
                    header("Location:../ajuste_producto_registrar.php?cod_producto=$cod_producto");
                }else{
                    header("Location:../ajuste_producto_ver.php?cod_producto=$cod_producto");
                }
            }else{
                $err="Debe Seleccionar una Opcion válida";
                header("Location:../ajustar_producto.php?err=$err&cod_producto=$cod_producto");
                break;
            }

        break;

        case "ajus_pre":
            if (empty($cod_producto)) {
                $err="Contacte al Administrador del sistema, Cod.1424";
                header("Location:../lista_productos.php?err=$err");
                break;
            }
            if (!empty($option)) {
                if ($option=='Cambiar Precio') {
                    header("Location:../precio_producto_crear.php?cod_producto=$cod_producto");
                }else{
                    header("Location:../precio_producto_historico.php?cod_producto=$cod_producto");
                }
            }else{
                $err="Debe Seleccionar una Opcion válida";
                header("Location:../precio_producto.php?err=$err&cod_producto=$cod_producto");
                break;
            }

        break;

        

        case "reg_ajuste":
            $log = new Log();
            $uti = new Utilidades();
            $alm = new Almacen();
            $alm->getProducto($cod_producto);

            $cant_actual = $alm->existencia;
            if ($cant_actual<$cant_ajuste && $tipo_ajuste=='Decremento') {
                $err="La cantidad a descontar del producto excede la existencia. Verifique e intente de nuevo";
                header("Location:../ajuste_producto_registrar.php?cod_producto=$cod_producto&err=$err&pag=$pag");
            } else {
                if (!empty($fecha_ajuste) and !empty($tipo_ajuste) and !empty($cant_ajuste) and !empty($concepto_ajuste)) {
                        $error=$alm->addAjusteProd($cod_producto, $fecha_ajuste, $tipo_ajuste, $cant_ajuste, $concepto_ajuste);
                        if ($error!='OK') {
                            $err="No se pudo guardar la información del Ajuste, por favor contacte al administrador del sistema";
                            header("Location:../ajuste_producto_registrar.php?cod_producto=$cod_producto&err=$err&pag=$pag");
                        } else {
                            //modificar la existencia del producto de acuerdo al tipo de ajuste seleccionado
                            if ($tipo_ajuste=='Incremento')		$cant_actual = $cant_actual+$cant_ajuste;
                            if ($tipo_ajuste=='Decremento')		$cant_actual = $cant_actual-$cant_ajuste;
                            $alm->modExistProducto($cod_producto, $cant_actual);
                            // REGISTRO Log
                            $descripcion="registró el Ajuste $alm->cod_ajuste del Producto $alm->nombre_producto $tipo_ajuste $cant_ajuste";
                            $fecha_hora=date("Y-m-d H:i:s");
                            $ip=$uti->getIP();
                            $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, "Almacen");
                            $err="El Ajuste del Producto se guardó de forma exitosa";
                            header("Location:../ajuste_producto_ver.php?err=$err&pag=$pag&tp=e&cod_producto=$cod_producto");
                        }
                } else {
                    $err="Todos los campos son obligatorios, por favor completar toda la información requerida";
                    header("Location:../ajuste_producto_registrar.php?cod_producto=$cod_producto&err=$err&pag=$pag");
                }
            }
        break;


        case "mod_precio":
            if (empty($cod_producto)) {
                $err="Contacte al Administrador del sistema, Cod.1424";
                header("Location:../lista_productos.php?err=$err");
                break;
            }
            if (!empty($precio)) {
                $log = new Log();
                $uti = new Utilidades();
                $alm = new Almacen();
                $alm->getProducto($cod_producto);

                $error=$alm->addPrecio($cod_producto, $precio);
                if ($error!='OK') {
                    $err="No se pudo guardar la información del Ajuste, por favor contacte al administrador del sistema";
                    header("Location:../ajuste_producto_registrar.php?cod_producto=$cod_producto&err=$err&pag=$pag");
                } else {
                    $alm->modPrecioProducto($cod_producto, $precio);

                    // REGISTRO Log
                    $descripcion="registró el Ajuste de precio del Producto $alm->nombre_producto precio $precio";
                    $fecha_hora=date("Y-m-d H:i:s");
                    $ip=$uti->getIP();
                    $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, "Almacen");
                    $err="El Precio del Producto se guardó de forma exitosa";
                    header("Location:../precio_producto_historico.php?err=$err&pag=$pag&tp=e&cod_producto=$cod_producto");
                }
               
            }else{
                $err="Debe Ingresar el precio";
                header("Location:../precio_producto_crear.php?err=$err&cod_producto=$cod_producto");
                break;
            }

        break;
        default:
            header("Location:../index.php");
	    break; 
    }
?>