<?php

include_once 'classes/FuncionesDao.php';

$idDepartamento = "0";
if ($_POST["idDepartamento"] != ""){
	$idDepartamento = $_POST["idDepartamento"];
}
echo "<option>Seleccione</option>";
foreach (FuncionesDao::ConsultarMunicipio($idDepartamento) as $key => $value) {
    echo "<option value='" . $value["id_municipio"] . "' > " . $value["nombre"] . "</option>";
}
?>
