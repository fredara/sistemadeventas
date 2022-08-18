<?php

class Archivo{
	var $varhost, $vardb, $varlogin, $varpass;
	var $cod_foto, $nombre_archivo, $extension_archivo, $directorio_archivo, $directorio, $tipo_archivo;

	//constructor de la clase
	function Archivo(){
		$this->cod_foto=$this->nombre_archivo=$this->extension_archivo=$this->directorio_archivo=$this->tipo_archivo="";
		include ("conexion.php");
	}
	
    function addFotoProd($nombre_archivo, $nombretmp_archivo, $directorio_archivo, $extension_archivo, $tipo_archivo){
		$err="OK";
		if (!is_dir($directorio_archivo)) {
			$this->mkdir_r($directorio_archivo,0777);
		}
		move_uploaded_file($nombretmp_archivo, $directorio_archivo.'/'.$nombre_archivo);
		$query="insert into tbl_foto_producto (nombre_archivo, extension_archivo, directorio_archivo, tipo_archivo) values ('$nombre_archivo', '$extension_archivo', '$directorio_archivo', '$tipo_archivo')";
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