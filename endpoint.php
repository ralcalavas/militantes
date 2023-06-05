<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
session_start();

include("classes/FuncionesDao.php");

//include ("valida_sesion.php");

require_once "handler.php";

$uploader = new UploadHandler();

// Specify max file size in bytes.

$uploader->sizeLimit = 40000000; // default is 10 MiB

$id = $_REQUEST['id'];

$method = $_SERVER["REQUEST_METHOD"];

$uploaddir = "archivos/";

if(!is_dir($uploaddir)){ 

	@mkdir($uploaddir, 0755, true); 

}

if ($method == "POST") {

    header("Content-Type: text/plain");

    // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
	
	$nombreArchivoMostrar = $_FILES['qqfile']['name'];

    $result = $uploader->handleUpload($uploaddir, limpiar_caracteres_especiales($nombreArchivoMostrar));

    // To return a name used for uploaded file you can use the following line.

    $result["uploadName"] = $uploader->getUploadName();

	$nombreArchivo = $result["uploadName"];

	$url = dameURL().$uploaddir.$nombreArchivo;
	
	$ext=explode(".",$nombreArchivoMostrar);
	$nombre_archivo="";
	$count=count($ext);
	while($count>1){
		$nombre_archivo=$nombre_archivo.$ext[count($ext)-$count];
		$count--;
	}

	if($result["success"]){	
			
		$result["idAdjunto"] = FuncionesDao::AdicionarAdjunto($id,$nombre_archivo,$nombreArchivo);
	
		$result["ruta"] = $url;		

	}	
	
    echo json_encode($result);

}

else {

    header("HTTP/1.0 405 Method Not Allowed");

}

function limpiar_caracteres_especiales($string) {
	 $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç', ' '),
        array('n', 'N', 'c', 'C', '_'),
        $string
    );
	
   
	//Esta parte se encarga de eliminar cualquier caracter extraño
	$string = preg_replace('([^A-Za-z0-9/.-_()/])', '', $string);
	
    return $string;
}

function dameURL(){

	$url="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER["REQUEST_URI"])."/";

	return $url;

}

?>

