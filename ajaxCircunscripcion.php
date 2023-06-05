<?php

include_once 'classes/FuncionesDao.php';

$idCandidatura = "0";
if ($_POST["idCandidatura"] != ""){
	$idCandidatura = $_POST["idCandidatura"];
}
$idDepartamento = "0";
if ($_POST["idDepartamento"] != "" && $_POST["idDepartamento"] != "0"){
	$idDepartamento = $_POST["idDepartamento"];
}
$idMunicipio = "0";
if ($_POST["idMunicipio"] != "" && $_POST["idMunicipio"] != "0"){
	$idMunicipio = $_POST["idMunicipio"];
}
$idLocalidad = "0";
if ($_POST["idLocalidad"] != "" && $_POST["idLocalidad"] != "0"){
	$idLocalidad = $_POST["idLocalidad"];
}

echo FuncionesDao::ConsultarCircunscripcion($idCandidatura,$idDepartamento,$idMunicipio,$idLocalidad); 

?>
