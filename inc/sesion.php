<?php 
session_start();
if (empty($_SESSION['cod_usuario_log'])){
	header("Location:index.php");
}
date_default_timezone_set('America/Caracas');
?>