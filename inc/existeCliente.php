<?php
extract($_REQUEST);
require_once("../clases/ventas.php");
$vent = new Ventas();

if ($num_identificacion && $tipo_identi) {
	$vent->getCliente_identificacion($num_identificacion, $tipo_identi);
	
	header('Content-Type: application/json');
	$datos = array(
		'nombre_cliente' => $vent->nombre_cliente,
		'direccion_cliente' => $vent->direccion_cliente,
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);
}
?>