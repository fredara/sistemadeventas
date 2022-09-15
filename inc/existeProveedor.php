<?php
extract($_REQUEST);
require_once("../clases/ventas.php");
$vent = new Ventas();

if ($num_identificacion && $tipo_identi) {
	$vent->getProveedor_identificacion($num_identificacion, $tipo_identi);
	
	header('Content-Type: application/json');
	$datos = array(
		'nombre_proveedor' => $vent->nombre_proveedor,
		'direccion_proveedor' => $vent->direccion_proveedor,
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);
}
?>