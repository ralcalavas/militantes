<?php

include_once 'classes/FuncionesDao.php';

$circunscripcion = "0-0-0-0-0";
if ($_POST["circunscripcion"] != ""){
	$circunscripcion = $_POST["circunscripcion"];
}
$arrayCir=explode("-",$circunscripcion);
$id_mun = "0";
if ($arrayCir[3] != "" && $arrayCir[3] != "Seleccione"){
	$id_mun = $arrayCir[3];
}
$id_loc = "0";
if ($arrayCir[4] != "" && $arrayCir[4] != "Seleccione"){
	$id_loc = $arrayCir[4];
}

FuncionesDao::GuardarMilitanteId($arrayCir[0],$arrayCir[1],$arrayCir[2],$id_mun,$id_loc); 

echo "1";

?>
