<?php
    class Ventas {

        var $varhost, $vardb, $varlogin, $varpass;
        var $cod_log, $cod_usuario, $descripcion, $fecha_hora, $ip;
        var $primero,$ultimo,$total,$proximo,$anterior;

        function Ventas(){
            $this->cod_log=$this->cod_usuario=$this->descripcion=$this->fecha_hora=$this->ip="";
            $this->primero=$this->ultimo=$this->total=$this->proximo=$this->anterior="";
            include ("conexion.php");
        }

        function getCodigoUltimoPedido(){
            $err="OK";
            $query="SELECT nro_venta from tbl_venta  order by nro_venta+0 desc limit 0,1";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);		
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $this->nro_venta=$this->mysqli_result($rs,0,'nro_venta');
            } else {
            }
            if ($rs) {}
            else { $err="X"; }
            @mysqli_close($con);
            return $err;
        }

        function getCliente_identificacion($num_identificacion, $tipo_identi){
            $err="OK";
            $query="SELECT t1.* from tbl_cliente t1 where t1.tipo_identidad='$tipo_identi' and  t1.num_identificacion='$num_identificacion' ";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);		
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $this->nombre_cliente=$this->mysqli_result($rs,0,'nombre_cliente');
                $this->direccion_cliente=$this->mysqli_result($rs,0,'direccion_cliente');
            } else {
            }
            if ($rs) {}
            else { $err="X"; }
            @mysqli_close($con);
            return $err;
        }

        function getProveedor_identificacion($num_identificacion, $tipo_identi){
            $err="OK";
            $query="SELECT t1.* from tbl_proveedor t1 where t1.tipo_identidad='$tipo_identi' and  t1.num_identificacion='$num_identificacion' ";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);		
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $this->nombre_cliente=$this->mysqli_result($rs,0,'nombre_cliente');
                $this->direccion_cliente=$this->mysqli_result($rs,0,'direccion_cliente');
            } else {
            }
            if ($rs) {}
            else { $err="X"; }
            @mysqli_close($con);
            return $err;
        }

        function getVenta($cod_venta){
            $err="OK";
            $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_ven, t2.num_identificacion, t2.nombre_cliente, t2.direccion_cliente from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) where t1.cod_venta='$cod_venta'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);		
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $this->fecha_ven=$this->mysqli_result($rs,0,'fecha_ven');
                $this->moneda=$this->mysqli_result($rs,0,'moneda');
                $this->num_identificacion=$this->mysqli_result($rs,0,'num_identificacion');
                $this->nombre_cliente=$this->mysqli_result($rs,0,'nombre_cliente');
                $this->direccion_cliente=$this->mysqli_result($rs,0,'direccion_cliente');
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


        function ActualizarTasaCambio($tasa_cambio) {	
			$err="OK";	
			$query="UPDATE tbl_tasa_cambio set tasa_cambio='$tasa_cambio', cod_usuario='".$_SESSION['cod_usuario_log']."', fecha_registro='".date('Y-m-d H:i:s')."' where cod_tasa_cambio='1'";	
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

        function AnulaVenta($cod_venta, $motivo) {	
			$err="OK";	
			$query="UPDATE tbl_ventas set estado='Anulada', motivo_anulacion='$motivo' where cod_venta='$cod_venta'";	
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}

        function SaveVenta($fecha_venta, $moneda, $tasa_cambio, $cod_cliente, $observacion) {
			$err="OK";
			if (empty($cod_foto)) $cod_foto=0;
			$query="INSERT INTO tbl_ventas (fecha_venta, moneda, tasa_cambio, cod_cliente, observacion, estado, cod_usuario_creo, fecha_registro) values ('$fecha_venta','$moneda', '$tasa_cambio', '$cod_cliente', '$observacion', 'Cerrada', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_venta=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

        function saveDetalleVenta($cod_venta, $cod_producto, $cantidad, $precioxuni, $porcentaje_iva) {
			$err="OK";
			if (empty($cod_foto)) $cod_foto=0;
			$query="INSERT INTO tbl_ventas_detalle (cod_venta, cod_producto, cantidad, precioxuni, porcentaje_iva, cod_usuario_creo, fecha_registro) values ('$cod_venta','$cod_producto', '$cantidad', '$precioxuni', '$porcentaje_iva', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_venta_detalle=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

        function ReporteVentas($desde, $hasta, $estado){
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);	
            
            if (!empty($desde) and !empty($hasta) and !empty($estado)) {
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) where t1.fecha_venta>='$desde' and t1.fecha_venta<='$hasta' and t1.estado='$estado' order by t1.fecha_venta asc";
            }elseif (empty($desde) and !empty($hasta) and !empty($estado)) {
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) where t1.fecha_venta<='$hasta' and t1.estado='$estado' order by t1.fecha_venta asc";
            }elseif (!empty($desde) and empty($hasta) and !empty($estado)) {
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) where t1.fecha_venta>='$desde' and t1.estado='$estado' order by t1.fecha_venta asc";
            }elseif (!empty($desde) and !empty($hasta) and empty($estado)) {
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) where t1.fecha_venta>='$desde' and t1.fecha_venta<='$hasta' order by t1.fecha_venta asc";
            }elseif (empty($desde) and empty($hasta) and !empty($estado)) {
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) where t1.estado='$estado' order by t1.fecha_venta asc";
            }elseif (!empty($desde) and empty($hasta) and empty($estado)) {
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) where t1.fecha_venta>='$desde' order by t1.fecha_venta asc";
            }elseif (empty($desde) and !empty($hasta) and empty($estado)) {
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) where t1.fecha_venta<='$hasta' order by t1.fecha_venta asc";
            }else{
                $query="SELECT t1.*, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_cliente, t3.nombre_usuario, t3.apellido_usuario from tbl_ventas t1 left join tbl_cliente t2 on (t1.cod_cliente=t2.cod_cliente) left join tbl_usuario t3 on (t1.cod_usuario_creo=t3.cod_usuario) order by t1.fecha_venta asc";
            }

            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)){ 
                while($obj = @mysqli_fetch_object($rs)) {
                       $return[] = $obj;
                }
            }
            @mysqli_close($con);
            return $return;
        }

        

        function listarProductos($cod_venta, $pag, $regxpag){
            if (empty($pag)) $pag=1;
            if (empty($regxpag)) $regxpag=15;
            $inic = ($pag * $regxpag) - $regxpag;
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);	
            mysqli_set_charset($con, "utf8");
            if(!empty($cod_venta)){
                $query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_usuario, t2.apellido_usuario, t3.nombre_cliente FROM tbl_ventas t1 left join tbl_usuario t2 on (t1.cod_usuario_creo=t2.cod_usuario) left join tbl_cliente t3 on (t1.cod_cliente=t3.cod_cliente) WHERE t1.cod_venta = '$cod_venta' ORDER BY t1.cod_venta desc LIMIT $inic, $regxpag";
            }else{
                $query="SELECT SQL_CALC_FOUND_ROWS t1.*, date_format(t1.fecha_registro, '%d/%m/%Y') as fecha_1, date_format(t1.fecha_venta, '%d/%m/%Y') as fecha_vent, t2.nombre_usuario, t2.apellido_usuario, t3.nombre_cliente FROM tbl_ventas t1 left join tbl_usuario t2 on (t1.cod_usuario_creo=t2.cod_usuario) left join tbl_cliente t3 on (t1.cod_cliente=t3.cod_cliente)  ORDER BY t1.cod_venta desc LIMIT $inic, $regxpag";
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

        function saveVentaPago($cod_venta, $moneda_pago, $instru, $banco, $numero, $monto) {
			$err="OK";
			if (empty($cod_foto)) $cod_foto=0;
			$query="INSERT INTO tbl_ventas_pago (cod_venta, moneda_pago, instru, banco, numero, monto, cod_usuario_creo, fecha_registro) values ('$cod_venta','$moneda_pago', '$instru', '$banco', '$numero', '$monto', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_venta_pago=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

        function modMontosVenta($cod_venta, $iva, $subtotal, $iva_r, $subtotal_r, $total, $exento) {
            $err="OK";
            $query="UPDATE tbl_ventas set valor_iva='$iva', subtotal='$subtotal', total='$total', exento='$exento', valor_iva_r = '$iva_r', subtotal_r='$subtotal_r' WHERE cod_venta='$cod_venta'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);
            $rs=@mysqli_query($con,$query);		
            if ($rs) {}
            else { $err='X'; }
            @mysqli_close($con);
            return $err;
        }

        








        //Clases Cliente
        function ExisteCliente($tipo_identidad, $num_identificacion){
            $err="OK";
            $query="SELECT t1.* FROM tbl_cliente t1  WHERE t1.tipo_identidad='$tipo_identidad' and t1.num_identificacion='$num_identificacion'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            mysqli_set_charset($con, "utf8");
            @mysqli_select_db($con,$this->vardb);
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $err="s";
                $this->cod_cliente=$this->mysqli_result($rs,0,'cod_cliente');
            } else {
                $err="n";
            }
            @mysqli_close($con);
            return $err;
        }


        function SaveClienteData($tipo_identidad, $num_identificacion, $nombre_cliente, $direccion_cliente) {
			$err="OK";
			if (empty($cod_foto)) $cod_foto=0;
			$query="INSERT INTO tbl_cliente (tipo_identidad, num_identificacion, nombre_cliente, direccion_cliente, cod_usuario_creo, fecha_registro) values ('$tipo_identidad','$num_identificacion', '$nombre_cliente', '$direccion_cliente', '".$_SESSION['cod_usuario_log']."', '".date('Y-m-d')."')";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);
			if ($rs) {
				$this->cod_cliente=@mysqli_insert_id($con);
			}else {
				$err='X';
			}
			@mysqli_close($con);
			return $err;
		}

        function ModClienteData($tipo_identidad, $num_identificacion, $nombre_cliente, $direccion_cliente) {	
			$err="OK";	
			$query="UPDATE tbl_cliente set nombre_cliente='$nombre_cliente', direccion_cliente='$direccion_cliente', cod_usuario_creo='".$_SESSION['cod_usuario_log']."', fecha_registro='".date('Y-m-d H:i:s')."' WHERE tipo_identidad='$tipo_identidad' and num_identificacion='$num_identificacion'";	
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			@mysqli_select_db($con,$this->vardb);
			$rs=@mysqli_query($con,$query);		
			if ($rs) {}
			else { $err='X'; }
			@mysqli_close($con);
			return $err;
		}
        //Fin clases Clientes


        function detalleVenta($cod_venta){
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);	
            $query="SELECT t1.*, t2.nombre_producto FROM tbl_ventas_detalle t1 left join tbl_producto t2 on (t1.cod_producto=t2.cod_producto) where t1.cod_venta='$cod_venta' order by t1.cod_venta_detalle ASC";
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)){ 
                while($obj = @mysqli_fetch_object($rs)) {
                       $return[] = $obj;
                }
            }		
            @mysqli_close($con);
            return $return;
        }

        function detallePAGO($cod_venta){
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);	
            $query="SELECT t1.*, t2.nombre_banco FROM tbl_ventas_pago t1 left join tbl_banco t2 on (t1.banco=t2.cod_banco)  where t1.cod_venta='$cod_venta' order by t1.cod_venta_pago ASC";
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)){ 
                while($obj = @mysqli_fetch_object($rs)) {
                       $return[] = $obj;
                }
            }		
            @mysqli_close($con);
            return $return;
        }

        

        

        function mysqli_result($res, $row, $field=0) { 
			$res->data_seek($row); 
			$datarow = $res->fetch_array(); 
			return $datarow[$field]; 
		}
    }

?>