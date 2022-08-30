<?php
    class Utilidades {

        var $varhost, $vardb, $varlogin, $varpass;
        var $ip_visitante;
        var $primero,$ultimo,$total,$proximo,$anterior;

        function Utilidades(){
            $this->ip_visitante="";
            $this->primero=$this->ultimo=$this->total=$this->proximo=$this->anterior="";
            include ("conexion.php");
        }
        
        function getIP(){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_visitante = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            elseif (isset($_SERVER['HTTP_VIA'])) {
                $ip_visitante = $_SERVER['HTTP_VIA'];
            }
            elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip_visitante = $_SERVER['REMOTE_ADDR'];
            }
            else {
                $ip_visitante = "unknown";
            } 
            return $ip_visitante;
        }


        function comboBanco($id_banco){
            $err="OK";						
            //$query="SELECT t1.*, t2.nombre_banco FROM tbl_banco_pagos t1 LEFT JOIN tbl_banco t2 ON (t1.cod_banco = t2.cod_banco) ORDER BY t2.nombre_banco ASC";
            $query="SELECT t1.* FROM tbl_banco t1 ORDER BY t1.nombre_banco ASC";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            @mysqli_select_db($con,$this->vardb);
            $rs=@mysqli_query($con,$query);
            while($obj = @mysqli_fetch_object($rs)) {
                echo "<option value=\"$obj->cod_banco\" ";
                if ($id_banco==$obj->cod_banco)
                    echo "selected";
                echo ">$obj->nombre_banco</option>\n";
            }
            @mysqli_close($con);
        }

        function getTasaCambio(){
            $err="OK";
            $query="select t1.* from tbl_tasa_cambio t1";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            mysqli_set_charset($con, "utf8");
            @mysqli_select_db($con,$this->vardb);		
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $this->tasa_cambio=$this->mysqli_result($rs,0,'tasa_cambio');
            } else {
            }
            if ($rs) {}
            else { $err="X"; }
            @mysqli_close($con);
            return $err;
        }

        function ListacomboBanco(){
			$err="OK";
			$cadena='';
            $query="SELECT t1.* FROM tbl_banco t1 ORDER BY t1.nombre_banco ASC";
			$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
			mysqli_set_charset($con, "utf8");
			@mysqli_select_db($con,$this->vardb);		
			$rs=@mysqli_query($con,$query);
			while($obj = @mysqli_fetch_object($rs)) {
				$cadena= $cadena."<option value=$obj->cod_banco>$obj->nombre_banco</option>";
			}
			@mysqli_close($con);
			return $cadena;
		}

        function mysqli_result($res, $row, $field=0) { 
            $res->data_seek($row); 
            $datarow = $res->fetch_array(); 
            return $datarow[$field]; 
        }
    }
?>