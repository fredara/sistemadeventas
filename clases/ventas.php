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

        function mysqli_result($res, $row, $field=0) { 
			$res->data_seek($row); 
			$datarow = $res->fetch_array(); 
			return $datarow[$field]; 
		}
    }

?>