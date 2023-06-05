<?php

include_once 'classes/FuncionesDao.php';
$directorio="archivos/";

$id = 0;
if ($_POST["id"] != ""){
	$id = $_POST["id"];
}

$row=FuncionesDao::ConsultarAdjunto($id);

FuncionesDao::EliminaAdjunto($id);	
							
if(file_exists($directorio.$row["archivo"])){		
	unlink($directorio.$row["archivo"]);		
}


?>


