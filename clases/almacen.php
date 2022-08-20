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

		function listarProductos($pag, $regxpag){
			if (empty($pag)) $pag=1;
			if (empty($regxpag)) $regxpag=15;
			$inic = ($pag * $regxpag) - $regxpag;
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);	
			mysqli_set_charset($con, "utf8");
			$query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, t4.nombre_usuario, t4.apellido_usuario FROM tbl_producto t1 left join tbl_usuario t4 on (t1.cod_usuario_creo=t4.cod_usuario)  ORDER BY t1.nombre_producto asc LIMIT $inic, $regxpag";
			$rs=@mysqli_query($con,$query);
			if (@mysqli_num_rows($rs)){
			$query="SELECT FOUND_ROWS()";
			$rss=@mysqli_query($con,$query);
			$this->total=$this->mysqli_result($rss,0,'FOUND_ROWS()');
			while($obj = @mysqli_fetch_object($rs)) {
			       $return[] = $obj;
			}
			$this->proximo = $pag + 1;
			$this->anterior = $pag - 1;
			$this->primero = $inic + 1;
			$this->ultimo=$inic + $regxpag;
			
			if ($this->total < $this->ultimo) $this->ultimo=$this->total;
			}
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
