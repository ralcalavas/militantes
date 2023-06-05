function inicializarValidaciones() {	
	//valida clave
	if(document.getElementById("nueva").value == ""){
	   alert("La clave es requerida.");
	   return false;
	}
	else if(document.getElementById("nueva").value != document.getElementById("confirmar").value){
	   alert("La clave nueva y la confirmación de la clave son distintas, verifique.");
	   return false;
	}
	
   return true;
}

function inicializar(){  
}

$(document).ready(inicializar);