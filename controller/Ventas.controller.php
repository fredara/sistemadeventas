<?php 
    session_start();
    extract($_REQUEST);
    require_once("../clases/ventas.php");
    require_once("../clases/utilidades.php");
    require_once("../clases/log.php");

    switch ($operacion) {

        case "reg_venta": 
            echo "entra en registra";
        break;


        default:
            header("Location:../index.php");
	    break; 
    }
?>