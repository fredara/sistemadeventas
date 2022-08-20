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

        default:
            header("Location:../index.php");
	    break; 
    }
?>