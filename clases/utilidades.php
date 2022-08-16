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
    }
?>