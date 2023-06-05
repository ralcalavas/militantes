<?php

include_once 'classes/FuncionesDao.php';

$idMunicipio = "0";
if ($_POST["idMunicipio"] != ""){
	$idMunicipio = $_POST["idMunicipio"];
}
echo "<option>Seleccione</option>";
foreach (FuncionesDao::ConsultarLocalidad($idMunicipio) as $key => $value) {
    echo "<option value='" . $value["id_localidad"] . "' > " . $value["nombre"] . "</option>";
}
?>
