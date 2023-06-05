<?php

session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

//include ("../valida_sesion.php");	
include("FuncionesDao.php");


extract($_POST);

$json = file_get_contents('php://input');

$data=json_decode($json);

$repositorio = new FuncionesApi;	

	
if($_GET['flag'] == "ciudadesPorDepartamento"){
	echo json_encode($repositorio->consultarMunicipioJson($_GET['idDepartamento']));
}

if($_GET['flag'] == "localidadPorMunicipio"){
	echo json_encode($repositorio->consultarLocalidadJson($_GET['idMunicipio']));
}

if($_GET['flag'] == "guardarNombreMilitante"){
	echo json_encode($repositorio->guardarNombreMilitanteJson($_GET['nombre']));
}

class FuncionesApi{	
	
	//Consulta ciudades por departamento
	function consultarMunicipioJson($idDepartamento){		  
		$row = FuncionesDao::ConsultarMunicipio($idDepartamento);
		$array = array();
		for($i=0;$i<count($row);$i++){	
			$bus = array('id' => $row[$i]["id_municipio"], 'nombre' => $row[$i]["nombre"]);
			array_push($array, $bus);
		}
		return $array;
	}
	
	//Consulta localidad por municipio
	function consultarLocalidadJson($idMunicipio){		  
		$row = FuncionesDao::ConsultarLocalidad($idMunicipio);
		$array = array();
		for($i=0;$i<count($row);$i++){	
			$bus = array('id' => $row[$i]["id_localidad"], 'nombre' => $row[$i]["nombre"]);
			array_push($array, $bus);
		}
		return $array;
	}
	
	//Guardar nombre militante
	function guardarNombreMilitanteJson($nombre){	
	    $arrayNom=explode(",",$nombre); 
		$desc=$arrayNom[1]; 
		if(count($arrayNom)>1){
			for($i=2;$i<count($arrayNom);$i++){	
				$desc=$desc.$arrayNom[$i];
			}
		}
		FuncionesDao::GuardarMilitanteNombre($arrayNom[0],$desc);
		return "1";
	}
}


?>