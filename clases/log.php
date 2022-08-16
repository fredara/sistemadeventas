<?php
    class Log {

        var $varhost, $vardb, $varlogin, $varpass;
        var $cod_log, $cod_usuario, $descripcion, $fecha_hora, $ip;
        var $primero,$ultimo,$total,$proximo,$anterior;

        function Log(){
            $this->cod_log=$this->cod_usuario=$this->descripcion=$this->fecha_hora=$this->ip="";
            $this->primero=$this->ultimo=$this->total=$this->proximo=$this->anterior="";
            include ("conexion.php");
        }

        function addLog($cod_usuario, $descripcion, $fecha_hora, $ip, $modulo){
            $err="OK";	
            $query="insert into tbl_log (cod_usuario, descripcion, fecha_hora, ip, modulo) values ('$cod_usuario', '$descripcion', '$fecha_hora', '$ip', '$modulo')";		
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            mysqli_set_charset($con, "utf8");
            @mysqli_select_db($con,$this->vardb);
            $rs=@mysqli_query($con,$query);
            if ($rs) {
                $this->cod_log=@mysqli_insert_id($con);
            }else { 
                $err='X'; 
            }
            @mysqli_close($con);
            return $err;
        }	
    }

?>