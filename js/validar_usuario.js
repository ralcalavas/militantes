function inicializarValidaciones() {			
	//valida nombre
	if(document.getElementById("nombre").value == ""){
	   alert("El nombre del usuario es requerido.");
	   return false;
	}
	//valida usuario
	if(document.getElementById("usuario").value == ""){
	   alert("El usuario es requerido.");
	   return false;
	}	
	//valida clave
	if(document.getElementById("idUsuario").value == "" && document.getElementById("clave").value == "" ){
	   alert("La clave es requerida.");
	   return false;
	}	
	
   return true;
}

function inicializar(){  
}

$(document).ready(inicializar);