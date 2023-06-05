function exportar(idRep){ 
	location.href = "exportar_reporte.php?id=" + idRep + "&fi="+ document.getElementById("fecha_ini").value + "&ff="+ document.getElementById("fecha_fin").value;
	return false;
}   

function inicializar(){ 

}

$(document).ready(inicializar);