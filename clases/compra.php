<?php
	class Compra{

		var $cod_compra, $cod_proveedor, $observacion, $existencia, $codigo_producto, $cod_foto, $marca;
		var $primero,$ultimo,$total,$proximo,$anterior;

		//constructor de la clase
		function Compra(){
			$this->cod_compra=$this->cod_proveedor=$this->observacion=$this->cantidad="";
			$this->primero=$this->ultimo=$this->total=$this->proximo=$this->anterior="";
			include ("conexion.php");
		}

		function getcompra($cod_compra){
            $err="OK";
            $query="SELECT t1.*, date_format(t1.fecha_compra, '%d/%m/%Y') as fecha_comp, t2.num_identificacion, t2.nombre_proveedor, t2.direccion_proveedor from tbl_compra t1 left join tbl_proveedor t2 on (t1.cod_proveedor=t2.cod_proveedor) where t1.cod_compra='$cod_compra'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);		
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $this->fecha_comp=$this->mysqli_result($rs,0,'fecha_comp');
                $this->moneda=$this->mysqli_result($rs,0,'moneda');
                $this->num_identificacion=$this->mysqli_result($rs,0,'num_identificacion');
                $this->nombre_proveedor=$this->mysqli_result($rs,0,'nombre_proveedor');
                $this->direccion_proveedor=$this->mysqli_result($rs,0,'direccion_proveedor');
                $this->tasa_cambio=$this->mysqli_result($rs,0,'tasa_cambio');
                $this->observacion=$this->mysqli_result($rs,0,'observacion');
                $this->estado=$this->mysqli_result($rs,0,'estado');
                $this->motivo_anulacion=$this->mysqli_result($rs,0,'motivo_anulacion');
                
            } else {
            }
            if ($rs) {}
            else { $err="X"; }
            @mysqli_close($con);
            return $err;
        }

		function detallecompra($cod_compra){
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);	
            $query="SELECT t1.*, t2.nombre_producto FROM tbl_compra_detalle t1 left join tbl_producto t2 on (t1.cod_producto=t2.cod_producto) where t1.cod_compra='$cod_compra' order by t1.cod_compra_detalle ASC";
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)){ 
                while($obj = @mysqli_fetch_object($rs)) {
                       $return[] = $obj;
                }
            }		
            @mysqli_close($con);
            return $return;
        }

		function AnulaCompra($cod_compra, $motivo) {	
			$err="OK";	
			$query="UPDATE tbl_compra set estado='Anulada', motivo_anulacion='$motivo' where cod_compra='$cod_compra'";	
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

		

		function comboProveedor($cod_proveedor){
			$err="OK";
			$query="SELECT t1.* from tbl_proveedor t1 order by t1.nombre_proveedor asc";
			//echo "$query";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);		
			$rs=@mysqli_query($con,$query);
				while($obj = @mysqli_fetch_object($rs)){
					echo "<option value=\"$obj->cod_proveedor\" ";
					if($cod_proveedor==$obj->cod_proveedor)
						echo "selected";

					$texto = $obj->nombre_proveedor;

					echo ">$texto</option>\n";
				}

				@mysqli_close($con);
		}

		function ExisteProveedor($tipo_identidad, $num_identificacion){
            $err="OK";
            $query="SELECT t1.* FROM tbl_proveedor t1  WHERE t1.tipo_identidad='$tipo_identidad' and t1.num_identificacion='$num_identificacion'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            mysqli_set_charset($con, "utf8");
            @mysqli_select_db($con,$this->vardb);
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $err="s";
                $this->cod_proveedor=$this->mysqli_result($rs,0,'cod_proveedor');
            } else {
                $err="n";
            }
            @mysqli_close($con);
            return $err;
        }

		function ModProveedorData($tipo_identidad, $num_identificacion, $nombre_proveedor, $direccion_proveedor) {	
			$err="OK";	
			$query="UPDATE tbl_proveedor set nombre_proveed$nombre_proveedor='$nombre_proveedor', direccion_proveedor='$direccion_proveedor', cod_usuario_creo='".$_SESSION['cod_usuario_log']."', fecha_registro='".date('Y-m-d H:i:s')."' WHERE tipo_identidad='$tipo_identidad' and num_identificacion='$num_identificacion'";	
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

		function SaveProveedorData($tipo_identidad, $num_identificacion, $nombre_proveedor, $direccion_proveedor) {
			$err="OK";
			if (empty($cod_foto)) $cod_foto=0;
			$query="INSERT INTO tbl_proveedor (tipo_identidad, num_identificacion, nombre_proveedor, direccion_proveedor, cod_usuario_creo, fecha_registro) values ('$tipo_identidad','$num_identificacion', '$nombre_proveedor', '$direccion_proveedor', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_proveedor=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

		function SaveCompra($fecha_compra, $moneda, $tasa_cambio, $cod_proveedor, $observacion) {
			$err="OK";
			$query="INSERT INTO tbl_compra (fecha_compra, moneda, tasa_cambio, cod_proveedor, observacion, estado, cod_usuario_creo, fecha_registro) values ('$fecha_compra','$moneda', '$tasa_cambio', '$cod_proveedor', '$observacion', 'Cerrada', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_compra=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

		function saveDetalleCompra($cod_compra, $cod_producto, $cantidad, $precioxuni, $porcentaje_iva) {
			$err="OK";
			if (empty($cod_foto)) $cod_foto=0;
			$query="INSERT INTO tbl_compra_detalle (cod_compra, cod_producto, cantidad, precioxuni, porcentaje_iva, cod_usuario_creo, fecha_registro) values ('$cod_compra','$cod_producto', '$cantidad', '$precioxuni', '$porcentaje_iva', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_compra_detalle=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

		function modMontosCompra($cod_compra, $iva, $subtotal, $iva_r, $subtotal_r, $total, $exento) {
            $err="OK";
            $query="UPDATE tbl_compra set valor_iva='$iva', subtotal='$subtotal', total='$total', exento='$exento', valor_iva_r = '$iva_r', subtotal_r='$subtotal_r' WHERE cod_compra='$cod_compra'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);
            $rs=@mysqli_query($con,$query);		
            if ($rs) {}
            else { $err='X'; }
            @mysqli_close($con);
            return $err;
        }


		function listaCompras($cod_compra, $pag, $regxpag){
            if (empty($pag)) $pag=1;
            if (empty($regxpag)) $regxpag=15;
            $inic = ($pag * $regxpag) - $regxpag;
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);	
            mysqli_set_charset($con, "utf8");
            if(!empty($cod_compra)){
                $query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, date_format(t1.fecha_compra, '%d/%m/%Y') as fecha_comp, t2.nombre_usuario, t2.apellido_usuario, t3.nombre_proveedor FROM tbl_compra t1 left join tbl_usuario t2 on (t1.cod_usuario_creo=t2.cod_usuario) left join tbl_proveedor t3 on (t1.cod_proveedor=t3.cod_proveedor) WHERE t1.cod_compra = '$cod_compra' ORDER BY t1.cod_compra desc LIMIT $inic, $regxpag";
            }else{
                $query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, date_format(t1.fecha_compra, '%d/%m/%Y') as fecha_comp, t2.nombre_usuario, t2.apellido_usuario, t3.nombre_proveedor FROM tbl_compra t1 left join tbl_usuario t2 on (t1.cod_usuario_creo=t2.cod_usuario) left join tbl_proveedor t3 on (t1.cod_proveedor=t3.cod_proveedor)  ORDER BY t1.cod_compra desc LIMIT $inic, $regxpag";
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
