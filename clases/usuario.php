<?php
    class Usuario{

        var $varhost, $vardb, $varlogin, $varpass;
        var $cod_usuario, $login_usuario, $clave_usuario, $nombre_usuario, $apellido_usuario, $ced_usuario, $email_usuario, $cod_usuario_creo, $cod_grupo_usuario, $fregistro_usuario;
        var $primero,$ultimo,$total,$proximo,$anterior;

        //constructor de la clase
        function Usuario(){
            $this->cod_usuario=$this->login_usuario=$this->clave_usuario=$this->nombre_usuario=$this->apellido_usuario=$this->ced_usuario=$this->email_usuario=$this->cod_usuario_creo=$this->cod_grupo_usuario=$this->fregistro_usuario="";
            $this->primero=$this->ultimo=$this->total=$this->proximo=$this->anterior="";
            include ("conexion.php");
        }


        function getUsuarioLogin($login_usuario, $clave_usuario){
            $err="OK";
            $query="select t1.* from tbl_usuario t1 where t1.login_usuario='$login_usuario'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            mysqli_set_charset($con, "utf8");
            @mysqli_select_db($con,$this->vardb);		
            $rs=@mysqli_query($con,$query);
            if (@mysqli_num_rows($rs)>0){
                $this->cod_usuario=$this->mysqli_result($rs,0,'cod_usuario');
                $this->login_usuario=$this->mysqli_result($rs,0,'login_usuario');
                $this->clave_usuario=$this->mysqli_result($rs,0,'clave_usuario');
                $this->cod_grupo_usuario=$this->mysqli_result($rs,0,'cod_grupo_usuario');
                $this->nombre_usuario=$this->mysqli_result($rs,0,'nombre_usuario');
                $this->apellido_usuario=$this->mysqli_result($rs,0,'apellido_usuario');
                $this->fultima_sesion=$this->mysqli_result($rs,0,'fultima_sesion');
                $this->estatus=$this->mysqli_result($rs,0,'estatus');
                if ($this->clave_usuario!=$clave_usuario){
                    // password incorrecto
                    $err='passwordFallido';
                } else {
                    // password correcto
                    $err='OK';
                }
            } else {
                // login incorrecto
                 $err='LoginFallido';
            }
            if ($rs) {}
            else { $err="X"; }
            @mysqli_close($con);
            return $err;
        }
        
        function updFechaSesion($fultima_sesion, $cod_usuario) {
            $err="OK";	
            $query="UPDATE tbl_usuario SET fultima_sesion='$fultima_sesion' where cod_usuario = '".$cod_usuario."'";
            $con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
            mysqli_set_charset($con, "utf8");
            @mysqli_select_db($con,$this->vardb);
            $rs=@mysqli_query($con,$query);
            if ($rs) {
            }else { 
                $err='X'; 
            }
            @mysqli_close($con);
            return $err;
        }

        function cryptPassword($password){
            $cryptPassword=md5($password);
            return $cryptPassword;
        }

        function mysqli_result($res, $row, $field=0) { 
            $res->data_seek($row); 
            $datarow = $res->fetch_array(); 
            return $datarow[$field]; 
        }
    }

?>