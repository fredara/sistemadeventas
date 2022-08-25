<?php
extract($_REQUEST);
require_once("../clases/almacen.php");
$alm = new Almacen();

if ($cod_producto) {
	$alm->getProducto($cod_producto);
	
	header('Content-Type: application/json');
	$datos = array(
		'existencia' => $alm->existencia,
		'precio_almacen' => $alm->precio,
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);
}else{
	echo $mensaje_respuesta = "No Selecciono Producto";
}
?>