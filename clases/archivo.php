<?php

class Archivo{
	var $varhost, $vardb, $varlogin, $varpass;
	var $cod_foto, $nombre_archivo, $extension_archivo, $directorio_archivo, $directorio, $tipo_archivo;

	//constructor de la clase
	function Archivo(){
		$this->cod_foto=$this->nombre_archivo=$this->extension_archivo=$this->directorio_archivo=$this->tipo_archivo="";
		include ("conexion.php");
	}
	
    function addFotoProd($nombre_archivo, $nombretmp_archivo, $directorio_archivo, $extension_archivo, $tipo_archivo, $cod_producto){
		$err="OK";
		if (!is_dir($directorio_archivo)) {
			$this->mkdir_r($directorio_archivo,0777);
		}
		move_uploaded_file($nombretmp_archivo, $directorio_archivo.'/'.$nombre_archivo);
		$query="insert into tbl_foto_producto (nombre_archivo, extension_archivo, directorio_archivo, tipo_archivo, cod_producto) values ('$nombre_archivo', '$extension_archivo', '$directorio_archivo', '$tipo_archivo', '$cod_producto')";
		echo $query;
		$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
        mysqli_set_charset($con, "utf8");
		@mysqli_select_db($con,$this->vardb);
		$rs=@mysqli_query($con,$query);	
		if ($rs) {
			$this->cod_foto=@mysqli_insert_id($con);
		}else { 
			$err='X'; 
		}
		@mysqli_close($con);		
		return $err;
	} 

	function elimFotoPro($cod_pro){
		$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
		mysqli_set_charset($con, "utf8");
		@mysqli_select_db($con,$this->vardb);	
		$query="select cod_foto from tbl_foto_producto where cod_foto='$cod_pro' and tipo_archivo='i'";
		$rs=@mysqli_query($con,$query);
		if (@mysqli_num_rows($rs)){
			while($obj = @mysqli_fetch_object($rs)) {
				   $this->delArchivo($obj->cod_foto);
			}
			$return = "OK";
		}else{
			$return = "X";
		}
		@mysqli_close($con);
		return $return;
	}

	function getImagenesProducto($cod_producto){
		$query="SELECT t1.* FROM tbl_foto_producto t1 where t1.cod_producto='$cod_producto' ORDER BY t1.cod_foto ASC";
		$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
		@mysqli_select_db($con,$this->vardb);	
		mysqli_set_charset($con, "utf8");
		$rs=@mysqli_query($con,$query);
		$this->t_prod_categ=@mysqli_num_rows($rs);
		if (@mysqli_num_rows($rs)){
			while($obj = @mysqli_fetch_object($rs)) {
				$return[] = $obj;
			}
		}
		@mysqli_close($con);
		return $return;
	}

	function delArchivo($cod_foto){
		$err="OK";
		$query="select directorio_archivo, nombre_archivo from tbl_foto_producto where cod_foto='$cod_foto'";
		$con=@mysqli_connect($this->varhost,$this->varlogin,$this->varpass,$this->vardb);
		mysqli_set_charset($con, "utf8");
		@mysqli_select_db($con,$this->vardb);
		$rs=@mysqli_query($con,$query);
		// tomo los datos del archivo id
		if (@mysqli_num_rows($rs)>0){
			$this->directorio_archivo=$this->mysqli_result($rs,0,'directorio_archivo');
			$this->nombre_archivo=$this->mysqli_result($rs,0,'nombre_archivo');
		}
		// elimino el archivo del directorio
		if ($handle=opendir("$this->directorio_archivo")){ 
			@unlink("$this->directorio_archivo/$this->nombre_archivo");
			@unlink("$this->directorio_archivo/mini/$this->nombre_archivo");
			@closedir($handle); 
		}
		// elimino el archivo de la BD
		$query="delete from tbl_foto_producto where cod_foto=$cod_foto";
		//echo $query;
		$rs=@mysqli_query($con,$query);
		
		if ($rs) {}
		else { $err="X"; }
		@mysqli_close($con);
		return $err;
	}

    function mkdir_r($dirName, $rights=0755){
	  
		$dirs = explode('/', $dirName);
		$dir='';
		foreach ($dirs as $part) {
		$dir.=$part.'/';
		if (!is_dir($dir) && strlen($dir)>0)
		mkdir($dir, $rights);
		}
	}

	
	function mysqli_result($res, $row, $field=0) { 
		$res->data_seek($row); 
		$datarow = $res->fetch_array(); 
		return $datarow[$field]; 
	}
}
?>