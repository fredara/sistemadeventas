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

                //AGREGAR FOTO DEL PRODUCTO
                $arch = new Archivo();	
                $archivo_name=strtolower($_FILES['archivo']['name']);
                $archivo_tmp=$_FILES['archivo']['tmp_name'];
                $archivo_tamano=$_FILES['archivo']['size'];
                $directorio='../images/productos';
                if (!empty($archivo_name)) {
                    $varrand = substr(md5(uniqid(rand())),0,10);        
                    $extension = substr($archivo_name, (strrpos($archivo_name,'.') + 1));
                    if ($archivo_tamano>2000000) {
                        $err="El tamaño de la foto del producto no debe exceder los 2MB<br>";
                    } else {
                        if ($extension=="jpg" or $extension=="gif" or $extension=="png") {
                            $nombre=$varrand.$archivo_name;
                            $nombre=str_replace(' ', '', $nombre);
                            $arch->addFotoProd($nombre, $archivo_tmp, $directorio, $extension, 'i');
                            $cod_foto=$arch->cod_foto;
                        } else {
                            $err="El formato de la foto del producto no es válido. Sólo se permiten .jpg, .png y .gif<br>";
                        }
                    }
                }
                //FIN AGREGAR FOTO	
                if (!empty($err)) {
                    header("Location:../registrar_producto.php?err=$err");
                    break;
                }else{
                    $error=$alm->addProducto($codigo_producto, $nombre_producto, $descripcion, $marca, $cantidad_inicial, $precio, $cod_foto);

                    if ($error!='OK') {
                        $err="Hubo problemas para conectarse con la base de Datos, por favor contacte al administrador del sistema";
                        header("Location:../registrar_producto.php?err=$err");
                        break;
                    } else {
                        // información del log
                        $descripcion="Se Registro un nuevo producto en el sistema $nombre_producto";
                        $fecha_hora=date("Y-m-d H:i:s");
                        $ip=$uti->getIP();
                        $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, 'Almacen - Productos');
                        $err="Se ha Creado el Producto Exitosamente";
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

                //AGREGAR IMAGEN
                $arch = new Archivo();	
                $archivo_name=strtolower($_FILES['archivo']['name']);
                $archivo_tmp=$_FILES['archivo']['tmp_name'];
                $archivo_tamano=$_FILES['archivo']['size'];
                $directorio='../images/productos';
                if (!empty($archivo_name)) {
                    $varrand = substr(md5(uniqid(rand())),0,10);        
                    $extension = substr($archivo_name, (strrpos($archivo_name,'.') + 1));
                    if ($archivo_tamano>2000000) {
                        $err="El tamaño de la foto del producto no debe exceder los 2MB<br>";
                        $cod_foto=$alm->cod_foto;
                    } else {
                        if ($extension=="jpg" or $extension=="gif" or $extension=="png") {
                            $error=$arch->elimFotoPro($alm->cod_foto);
                            if ($error!='OK' and !empty($pred->cod_foto)) {
                                $err="No se pudo actualizar la foto del producto por favor contacte al administrador del sistema";
                                header("Location:../modificar_producto.php?err=$err&cod_producto=$cod_producto&pag=$pag");
                            } else {
                                $nombre=$varrand.$archivo_name;
                                $nombre=str_replace(' ', '', $nombre);
                                $arch->addFotoProd($nombre, $archivo_tmp, $directorio, $extension, 'i');
                                $cod_foto=$arch->cod_foto;
                            }
                        } else {
                            $err="El formato de la foto del producto no es válido. Sólo se permiten .jpg, .png y .gif<br>";
                            $cod_foto=$alm->cod_foto;
                        }
                    }	
                } else {	
                    $cod_foto=$alm->cod_foto;
                }
                
                $error2=$alm->modProducto($cod_producto, $codigo_producto, $nombre_producto, $descripcion, $marca, $cod_foto);
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
                    header("Location:../lista_productos.php?err=$err&pag=$pag&tp=e");
                }
            } else {
                $err="No se pudo completar la operación, por favor completar toda la información requerida";
                header("Location:../modificar_producto.php?err=$err&pag=$pag&cod_producto=$cod_producto");
            }
        break;

        default:
            header("Location:../index.php");
	    break; 
    }
?>