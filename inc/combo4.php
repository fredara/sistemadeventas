<?php
extract($_REQUEST);
require_once("../clases/almacen.php");
$alm = new Almacen();

if ($operacion==1) {
    $alm->getProducto($cod_producto);

    if (!empty($alm->precio)){
        echo round($alm->precio, 2);
    }else{
        echo $mensaje_respuesta = "Producto sin Precio";
    }
}
?>