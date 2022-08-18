<?php
	class Almacen{

		var $cod_producto, $nombre_producto, $descripcion, $existencia, $codigo_producto, $cod_foto, $marca;
		var $primero,$ultimo,$total,$proximo,$anterior;

		//constructor de la clase
		function Almacen(){
			$this->cod_producto=$this->nombre_producto=$this->descripcion=$this->cantidad="";
			$this->primero=$this->ultimo=$this->total=$this->proximo=$this->anterior="";
			include ("conexion.php");
		}

		

		//agrega un Producto
		function addProducto($codigo_producto, $nombre_producto, $descripcion, $marca, $existencia, $precio, $cod_foto) {
			$err="OK";
			if (empty($cod_foto)) $cod_foto=0;
			$query="INSERT INTO tbl_producto (codigo_producto, nombre_producto, descripcion, marca, cantidad, precio, cod_foto, cod_usuario_creo, fecha_registro) values ('$codigo_producto','$nombre_producto', '$descripcion', '$marca','$existencia','$precio', '$cod_foto', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_producto=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

		//funcion para las fechas seleccionadas con calendarios
		function FechaOriginal($fecha) {
			$mifecha = explode("/",$fecha);
			$lafecha = $mifecha[2]."-".$mifecha[1]."-".$mifecha[0];
			return $lafecha;
		}

		function FechaNormal($fecha) {
			$mifecha = explode("-",$fecha);
			$lafecha = $mifecha[2]."/".$mifecha[1]."/".$mifecha[0];
			return $lafecha;
		}
		function mysqli_result($res, $row, $field=0) { 
			$res->data_seek($row); 
			$datarow = $res->fetch_array(); 
			return $datarow[$field]; 
		}
	}
?>
