
function inicializarValidaciones() {	
	
	if(document.getElementById("numero_identificacion").value == "" || document.getElementById("numero_identificacion").value=="0"){
		 alert("El numero de identificación es requerido.");
		 return false;
	}
	else if (document.getElementById("numero_identificacion").value.length < 6){
		alert("El numero de identificación debe tener mas de seis (6) digitos.");
		return false;
	}		
	 	 
	return true;
}

function inicializar(){ 
	$("#content").addClass("active");   
	document.getElementById('sidebarCollapse').style.display="none";	        
}

$(document).ready(inicializar);