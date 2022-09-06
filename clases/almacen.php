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

		function listarProductos($nombre_producto, $codigo_producto, $pag, $regxpag){
				if (empty($pag)) $pag=1;
				if (empty($regxpag)) $regxpag=15;
				$inic = ($pag * $regxpag) - $regxpag;
				$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
				@mysqli_select_db($con,$this->vardb);	
				mysqli_set_charset($con, "utf8");
				if (!empty($nombre_producto)) {
					$query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, t4.nombre_usuario, t4.apellido_usuario FROM tbl_producto t1 left join tbl_usuario t4 on (t1.cod_usuario_creo=t4.cod_usuario) where t1.nombre_producto like '%$nombre_producto%'  ORDER BY t1.nombre_producto asc LIMIT $inic, $regxpag";
				}elseif (!empty($codigo_producto)) {
					$query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, t4.nombre_usuario, t4.apellido_usuario FROM tbl_producto t1 left join tbl_usuario t4 on (t1.cod_usuario_creo=t4.cod_usuario) where t1.codigo_producto='$codigo_producto'  ORDER BY t1.nombre_producto asc LIMIT $inic, $regxpag";
				}else{
					$query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, t4.nombre_usuario, t4.apellido_usuario FROM tbl_producto t1 left join tbl_usuario t4 on (t1.cod_usuario_creo=t4.cod_usuario)  ORDER BY t1.nombre_producto asc LIMIT $inic, $regxpag";
				}
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
				
				if ($this->total < $this->ultimo)
					$this->ultimo=$this->total;
			}
			
			@mysqli_close($con);
			return $return;
		}


		function getProducto($cod_producto){
			$err="OK";
			$query="SELECT t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, t2.nombre_archivo, t3.nombre_usuario as nombre_creo, t3.apellido_usuario as apellido_creo FROM tbl_producto t1 left join tbl_foto_producto t2 on (t1.cod_foto=t2.cod_foto) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) WHERE t1.cod_producto='$cod_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);				
			$rs=@mysqli_query($con,$query);
			if (@mysqli_num_rows($rs)>0){
				$err='s';
				$this->cod_producto=$cod_producto;
				$this->nombre_producto=$this->mysqli_result($rs,0,'nombre_producto');
				$this->descripcion=$this->mysqli_result($rs,0,'descripcion');
				$this->existencia=$this->mysqli_result($rs,0,'cantidad');
				$this->marca=$this->mysqli_result($rs,0,'marca');
				$this->cod_foto=$this->mysqli_result($rs,0,'cod_foto');
				$this->nombre_archivo=$this->mysqli_result($rs,0,'nombre_archivo');
				$this->precio=$this->mysqli_result($rs,0,'precio');

				$this->codigo_producto=$this->mysqli_result($rs,0,'codigo_producto');

				$this->nombre_creo=$this->mysqli_result($rs,0,'nombre_creo');
				$this->apellido_creo=$this->mysqli_result($rs,0,'apellido_creo');
				} else {
			}
			if ($rs) {}
			else { $err="X"; }
			@mysqli_close($con);
			return $err;
		}

		function addAjusteProd($cod_producto, $fecha_ajuste, $tipo_ajuste, $cant_ajuste, $concepto_ajuste) {
			$err="OK";
			$query="INSERT INTO tbl_producto_ajuste (cod_producto, fecha_ajuste, tipo_ajuste, cant_ajuste, concepto_ajuste, cod_usuario_creo, fecha_registro) values ('$cod_producto', '$fecha_ajuste', '$tipo_ajuste', '$cant_ajuste', '$concepto_ajuste', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_ajuste=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

		function addPrecio($cod_producto, $precio) {
			$err="OK";
			$query="INSERT INTO tbl_producto_precios (cod_producto, precio, cod_usuario_creo, fecha_registro) values ('$cod_producto', '$precio', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_precio=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

		function listarAjustesProd($cod_producto, $pag, $regxpag){
			if (empty($pag)) $pag=1;
			if (empty($regxpag)) $regxpag=15;
			$inic = ($pag * $regxpag) - $regxpag;
			$inic = ($pag * $regxpag) - $regxpag;
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);	
			mysqli_set_charset($con, "utf8");
			$query="SELECT t1.*, date_format(t1.fecha_ajuste, '%d/%m/%Y') as fecha_1, t2.nombre_usuario, t2.apellido_usuario FROM tbl_producto_ajuste t1 left join tbl_usuario t2 on (t1.cod_usuario_creo=t2.cod_usuario) WHERE t1.cod_producto='$cod_producto' ORDER BY t1.cod_ajuste DESC";
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
				
				if ($this->total < $this->ultimo)
					$this->ultimo=$this->total;
			}
			
			@mysqli_close($con);
			return $return;
		}

		function listarPreciosHistorico($cod_producto, $pag, $regxpag){
			if (empty($pag)) $pag=1;
			if (empty($regxpag)) $regxpag=15;
			$inic = ($pag * $regxpag) - $regxpag;
			$inic = ($pag * $regxpag) - $regxpag;
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);	
			mysqli_set_charset($con, "utf8");
			$query="SELECT t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_reg, t2.nombre_usuario, t2.apellido_usuario FROM tbl_producto_precios t1 left join tbl_usuario t2 on (t1.cod_usuario_creo=t2.cod_usuario) WHERE t1.cod_producto='$cod_producto' ORDER BY t1.cod_precio DESC";
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
				
				if ($this->total < $this->ultimo)
					$this->ultimo=$this->total;
			}
			
			@mysqli_close($con);
			return $return;
		}

		function comboProductos($cod_producto){
			$err="OK";
			$query="SELECT t1.* from tbl_producto t1 order by t1.nombre_producto asc";
			//echo "$query";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);		
			$rs=@mysqli_query($con,$query);
				while($obj = @mysqli_fetch_object($rs)){
					echo "<option value=\"$obj->cod_producto\" ";
					if($cod_producto==$obj->cod_producto)
						echo "selected";

					$texto = $obj->nombre_producto;

					echo ">$texto</option>\n";
				}

				@mysqli_close($con);
		}

		function getListaProductos($cod_producto){
			$err="OK";
			$cadena='';
			$query="select t1.* from tbl_producto t1  order by t1.nombre_producto asc";
			//$query="select t1.* from tbl_producto t1 order by t1.nombre_producto";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);		
			$rs=@mysqli_query($con,$query);
			while($obj = @mysqli_fetch_object($rs)) {
				$cadena= $cadena."<option value=$obj->cod_producto>$obj->nombre_categoria  $obj->nombre_producto</option>";
			}
			@mysqli_close($con);
			return $cadena;
		}


		function modExistProducto($cod_producto, $cant_ajuste) {
			$err="OK";
			$query="UPDATE tbl_producto set cantidad='$cant_ajuste' WHERE cod_producto='$cod_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

		function modPrecioProducto($cod_producto, $precio) {
			$err="OK";
			$query="UPDATE tbl_producto set precio='$precio' WHERE cod_producto='$cod_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

		function getProductoExisteCodigo($codigo_producto){
			$err="OK";
			$query="SELECT t1.* FROM tbl_producto t1  WHERE t1.codigo_producto='$codigo_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if (@mysqli_num_rows($rs)>0){
				$err="s";
				$this->cod_producto=$this->mysqli_result($rs,0,'cod_producto');
			} else {
				$err="n";
			}
			@mysqli_close($con);
			return $err;
		}

		function getProductoExisteCodigoMod($cod_producto, $codigo_producto){
			$err="OK";
			$query="SELECT t1.* FROM tbl_producto t1 WHERE t1.codigo_producto='$codigo_producto' and t1.cod_producto!='$cod_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if (@mysqli_num_rows($rs)>0){
				$err="s";
				$this->cod_producto=$this->mysqli_result($rs,0,'cod_producto');
			} else {
				$err="n";
			}
			@mysqli_close($con);
			return $err;
		}


		function modProducto($cod_producto, $codigo_producto, $nombre_producto, $descripcion, $marca, $cod_foto) {
			$err="OK";
			$query="UPDATE tbl_producto set codigo_producto='$codigo_producto', nombre_producto='$nombre_producto', descripcion='$descripcion', marca='$marca', cod_foto='$cod_foto', cod_foto='$cod_foto'  WHERE cod_producto='$cod_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

		function decrementaExistencia($cod_producto, $cantidad) {
			$err="OK";
			$query="UPDATE tbl_producto set cantidad=cantidad - $cantidad WHERE cod_producto='$cod_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

		function incrementaExistencia($cod_producto, $cantidad) {
			$err="OK";
			$query="UPDATE tbl_producto set cantidad=cantidad + $cantidad WHERE cod_producto='$cod_producto'";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

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
