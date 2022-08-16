<?php 
    session_start();
    extract($_REQUEST);
    require_once("../clases/usuario.php");
    require_once("../clases/utilidades.php");
    require_once("../clases/log.php");

    switch ($operacion) {

        case "is": 
            if (!empty($login_usuario) && !empty($clave_usuario)) {
                $usu = new Usuario();
                $log = new Log();
                $uti = new Utilidades();
                $error=$usu->getUsuarioLogin($login_usuario, $usu->cryptPassword($clave_usuario));
                if ($error!='OK') {
                    if ($error=='LoginFallido'){
                        $err="No existe un administrador con ese login de usuario";
                        header("Location:../index.php?err=$err");
                        break;
                    } elseif ($error=='passwordFallido') {
                        $err="La clave proporcionada es incorrecta";
                        header("Location:../index.php?err=$err");
                        break;
                    } else {
                        $err="Hubo problemas para conectarse con la base de Datos, por favor contacte al administrador del sistema";
                        header("Location:../index.php?err=$err");
                        break;
                    }
                } else {
                    if ($usu->estatus=='s') {
                        session_start();
                        $_SESSION['cod_usuario_log']=$usu->cod_usuario;
                        $_SESSION['login_usuario_log']=$login_usuario;
                        $_SESSION['cod_grupo_usuario_log']=$usu->cod_grupo_usuario;
                        $_SESSION['nombre_usuario_log']=$usu->nombre_usuario;
                        $_SESSION['apellido_usuario_log']=$usu->apellido_usuario;
                        $_SESSION['fultima_sesion_log']=$usu->fultima_sesion;
                        //Iniciar Sesion del Chat
                        
                        //guardar fecha de la sesión
                        $fultima_sesion=date("Y-m-d H:i:s");
                        $usu->updFechaSesion($fultima_sesion, $_SESSION['cod_usuario_log']);
                        
                        // información del log
                        $descripcion="inició sesión";
                        $fecha_hora=date("Y-m-d H:i:s");
                        $ip=$uti->getIP();
                        $log->addLog($_SESSION['cod_usuario_log'], $descripcion, $fecha_hora, $ip, 'Usuarios');
                        
                        header("Location:../home.php");
                        break;
                    } else {
                        $err="El usuario se encuentra inactivo por favor comuniquese con el administrador del sistema";
                        header("Location:../index.php?err=$err");
                        break;
                    }
                }
            } else {
                $err="Debe colocar un login de usuario y la clave";
                header("Location:../index.php?err=$err");
                break;
            }
        break;

        default:
            header("Location:../index.php");
	    break; 
    }
?>