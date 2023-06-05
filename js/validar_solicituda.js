var _msgSeleccionarArchivos = "Adjuntar Archivo...";
_msgExtensionesNoPermitidas = "{file} has an incorrect extension. The allowed extensions are: {extensions}.";


function inicializarValidaciones() {	
	if(document.getElementById("desc_nombre").value == ""){
	   alert("La solicitud aval es requerida.");
	   return false;
	}	
	if(document.getElementById("contrasena").value == ""){
	   alert("La contraseña es requerida.");
	   return false;
	}
	else if(document.getElementById("contrasena").value != document.getElementById("contrasena_con").value){
	   alert("La contraseña y la confirmación de la contraseña son distintas, verifique.");
	   return false;
	}
	else if (document.getElementById("contrasena").value.length < 6){
		alert("La contraseña debe tener mas de seis (6) digitos.");
		return false;
	}		 
	if(document.getElementById("primer_nombre").value == ""){
		 alert("El primer nombre es requerido.");
		 return false;
	}		
	if(document.getElementById("primer_apellido").value == ""){
		alert("El primer apellido es requerido.");
	    return false;
	}
	if(document.getElementById("tipo_identificacion").value == "" || document.getElementById("tipo_identificacion").value=="0"){
		 alert("El tipo de identificación es requerido.");
		 return false;
	}
	if(document.getElementById("numero_identificacion").value == "" || document.getElementById("numero_identificacion").value=="0"){
		 alert("El numero de identificación es requerido.");
		 return false;
	}
	else if (document.getElementById("numero_identificacion").value.length < 6){
		alert("El numero de identificación debe tener mas de seis (6) digitos.");
		return false;
	}	
	else if(document.getElementById("numero_identificacion").value != document.getElementById("numero_identificacion_con").value){
	   alert("El numero de identificación y la confirmación del numero de identificación son distintos, verifique.");
	   return false;
	}	
	if(document.getElementById("fecha_identificacion").value == "" || document.getElementById("fecha_identificacion").value == "0000-00-00"){
		 alert("La fecha de expedicion del documento es requerida.");
		 return false;
	}
	if(document.getElementById("fecha_nacimiento").value == "" || document.getElementById("fecha_nacimiento").value == "0000-00-00"){
		 alert("La fecha de nacimiento es requerida.");
		 return false;
	}
	if(document.getElementById("genero").value == "" || document.getElementById("genero").value=="0"){
		 alert("El género es requerido.");
		 return false;
	}
	if(document.getElementById("celular").value == "" || document.getElementById("celular").value=="0"){
		 alert("El número celular es requerido.");
		 return false;
	}
	if(document.getElementById("correo_electronico").value == ""){
		 alert("El correo electrónico es requerido.");
		 return false;
	}
	else if(validarEmail(document.getElementById("correo_electronico").value) == false){
		alert("El correo electrónico es incorrecto.");
		return false;
	}
	else if(document.getElementById("correo_electronico").value != document.getElementById("correo_electronico_con").value){
	   alert("El correo electrónico y la confirmación delcorreo electrónico son distintos, verifique.");
	   return false;
	}		
	if(document.getElementById("direccion").value == ""){
		 alert("La direccion de notificación es requerida.");
		 return false;
	}
	if(document.getElementById("departamento").value == "" || document.getElementById("departamento").value=="0"){
		 alert("El departamento es requerido.");
		 return false;
	}
	if(document.getElementById("municipio").value == "" || document.getElementById("municipio").value=="0"){
		 alert("El municipio es requerido.");
		 return false;
	}
	
	var idCandidatura=leerNumeroCero("#combo_candidatura"); 
	if(idCandidatura==0){
		 alert("La corporacion o cargo a la que aspira es requerida.");
		 return false;
	}
    if(document.getElementById("combo_candidatura").value == "" || document.getElementById("combo_candidatura").value=="0" || document.getElementById("combo_candidatura").value=="Seleccione"){
		 alert("La corporacion o cargo a la que aspira es requerida.");
		 return false;
	}	
	if(document.getElementById("combo_departamento").value == "" || document.getElementById("combo_departamento").value=="0" || document.getElementById("combo_departamento").value=="Seleccione"){
		 alert("El departamento de la corporacion a la que aspira es requerido.");
		 return false;
	}	
	if(idCandidatura>2){
		if(document.getElementById("combo_municipio").value == "" || document.getElementById("combo_municipio").value=="0" || document.getElementById("combo_municipio").value=="Seleccione"){
			 alert("El municipio de la corporacion a la que aspira es requerido.");
			 return false;
		}
		if(idCandidatura>4){
			if(document.getElementById("combo_localidad").value == "" || document.getElementById("combo_localidad").value=="0" || document.getElementById("combo_localidad").value=="Seleccione"){
				 alert("La localidad de la corporacion a la que aspira es requerida.");
				 return false;
			}
		}	
	}
	
	guardarMilitante();
	
	var idTipo = 1;	 
	$("#urlArchivos").val(leerArchivosAdj("#contenedorArchivo-"+idTipo+" .listaArchivosCargue"));	
	
	if(document.getElementById("urlArchivos").value == ""){
	   alert("Debe adjuntar los documentos requeridos (cedula de ciudadania).");
	   return false;
	}
		 	 
 return true;
}

/* funciones cargar y guardar archivo */

function mensajesFineUploader() {	
	    return {
	        typeError: "{file} tiene una extensión incorrecta. Las extensiones permitidas son: {extensions}."
	        , sizeError: "{file} es demasiado grande, el tamaño máximo permitido es {sizeLimit}."
	        , minSizeError: "{file} es demasiado pequeño, el tamaño mínimo es {minSizeLimit}."
	        , emptyError: "{file} está vacío, por favor seleccione otro archivo."
	        , noFilesError: "No hay archivos para enviar."
	        , tooManyItemsError: "Demasiados elementos ({netItems}) serán enviados.  El límite es {itemLimit}."
	        , retryFailTooManyItems: "Reintento fallido - ha alcanzado el límite máximo."
	        , onLeave: "Los archivos se están enviando, el proceso será cancelado."
	    };
}


function eliminarArchivoDeLista(control, idAdjunto) { 
  	var r = confirm("Esta seguro de eliminar el archivo?");
	if (r == true) {	
		$.ajax({
			type:"POST",
			data:"id="+idAdjunto,
			url:"ajaxAdjuntos.php",
			success:function(a){				
				var element = $(control);
				do{
					element = element.parent();
					className = element.get(0).tagName;								
				} while(className != 'LI');
				var li = element;
				li.remove();
			}
		});	
	}  
}

//Verifica que la extensión del archivo no esté dentro de las no permitidas
function verificarExtensionNoPermitida(data, buttonContainer) {
	var permitir = !verificarExtension(data.name, _extensionesNoPermitidas);
	if (!permitir) {
		alert(_msgExtensionesNoPermitidas.replace("{file}", data.name).replace("{extensions}", _extensionesNoPermitidas));
	}
	return permitir;
}


function leerArchivosAdj(lista) {   
    var archivos = "";
    $("li", lista).each(function () {
	     archivos = archivos + leerArchivoAdj(this) + ",";
    });
	if(archivos.length >1){
		archivos = archivos.substr(0,(archivos.length - 1));
	}
	return archivos;
}

function leerArchivoAdj(li) {
	var idArchivo = null;
    var item = $(".archivoUploader", li);
    if (item != null && item.length > 0) {
        idArchivo = $(item).data("id");
    }
    return idArchivo;
}


function leerArchivosUnico(lista) {
    var archivos = leerArchivos(lista);
    var id;
    if (archivos.length > 0) {
    	id = archivos[0];
    } else {
    	id = null;
    }
    return id;
}

function leerArchivos(lista) {
    
    var archivos = [];
    $("li", lista).each(function () {
        archivos.push(leerArchivo(this));
    });
    return archivos;
}

function leerArchivo(li) {
    var href = $(li).find("a").prop('href');
    var idArchivo = null;
    if (!isEmpty(href)) {
        var ultimo = href.lastIndexOf("/");
        if (ultimo >= 0) {
        	idArchivo = convertStringToNumber(href.substr(ultimo + 1));
        }
    }
    return idArchivo;
}


function crearUploader(control, listaArchivos, extensiones, sizeLimit, urlSubida) {				
	sizeLimit = sizeLimit || _sizeLimit;	
    new qq.FineUploader({
        element: $(control)[0],
        request: {
            endpoint: urlSubida
        },
        editFilename: {
            enabled: false
        },
        autoUpload: true,
        text: {
            uploadButton: '<i class="icon-attach"></i> <span>' + _msgSeleccionarArchivos + "</span>"
        },
        validation: {
            allowedExtensions: extensiones,
            sizeLimit: sizeLimit
        },
        messages: mensajesFineUploader(),
        callbacks: {   
            onComplete: function (id, name, response) {		
            	if (response.success) {
            		$(listaArchivos).append("<li><span class='trash' href='javascript: void(0)' title='Eliminar registro' onclick='return eliminarArchivoDeLista(this,"+response.idAdjunto+");' /></span><a class='archivoUploader' data-id='" + response.idAdjunto + "' href='" + response.ruta + "' target='_blank'>" + name + "</a></li>");
            	}				
            }
        }
    });
}

function crearOpcionAdjuntar(idTipo){
	
	var controlSubida = '#botonArchivo-' + idTipo;
	var contenedorSubida = '#contenedorArchivo-' + idTipo;
	var subir = true;
			
	crearUploader(controlSubida, contenedorSubida + ' .listaArchivosCargue', ['doc','docx','xls','xlsx','ppt','pptx','pdf','png','jpg','zip','7zip','txt','eml','rar','ai','jpeg','gif','mp4','mp3'], 40000000, leerTexto('#urlUpload'));	
		
	$(contenedorSubida).css("display","inline-block");
	$(contenedorSubida).toggle(subir);
	
}


function popup(url, w, h) {

    window.open(url, '', 'Top=10,titlebar=NO,location=NO,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=' + w + ',height=' + h);
}

function consultarMunicipio(callback) {
	var url='FuncionesApi.php?flag=ciudadesPorDepartamento&idDepartamento='+leerTexto("#departamento");
	comboChange(url, '#departamento', '#municipio', null, callback);		
}


function guardarMilitante() {	
    var url='FuncionesApi.php?flag=guardarNombreMilitante&nombre='+leerTexto("#numero_identificacion")+","+leerTexto("#desc_nombre");	
	 ajaxJsonApi(url, 'GET', null, function (response) {
		 url=response;
	  });
}


function consultarMunicipioCir(callback) {
	$("#txt_departamento").val($("#combo_departamento :selected").text());
	$("#txt_municipio").val("");
	$("#txt_localidad").val("");	
	var url='FuncionesApi.php?flag=ciudadesPorDepartamento&idDepartamento='+leerTexto("#combo_departamento");
	comboChange(url, '#combo_departamento', '#combo_municipio', null, callback);		
	llenarComboSeleccione('#combo_localidad', null, "id", "nombre");
}

function consultarLocalidad(callback) {
	$("#txt_municipio").val($("#combo_municipio :selected").text());
	$("#txt_localidad").val("");
	var url='FuncionesApi.php?flag=localidadPorMunicipio&idMunicipio='+leerTexto("#combo_municipio");
	comboChange(url, '#combo_municipio', '#combo_localidad', null, callback);	
}

function opcionLocalidad(callback) {
	$("#txt_localidad").val($("#combo_localidad :selected").text());	
}

function opcionCandidatura(callback) {
	$("#txt_candidatura").val($("#combo_candidatura :selected").text());
	$("#txt_departamento").val("");
	$("#txt_municipio").val("");
	$("#txt_localidad").val("");	  
    var idCandidatura=leerNumeroCero("#combo_candidatura"); 
	$("select#combo_departamento").prop('selectedIndex', 0);
	llenarComboSeleccione('#combo_municipio', null, "id", "nombre");
	llenarComboSeleccione('#combo_localidad', null, "id", "nombre");
	$("#combo_municipio").removeClass("oculto");
	$("#combo_localidad").removeClass("oculto");
	$("#lbl_municipio").removeClass("oculto");
	$("#lbl_localidad").removeClass("oculto");		
	//consultarCircunscripcion();
	if(idCandidatura<3){
		$("#combo_municipio").addClass("oculto");
		$("#combo_localidad").addClass("oculto");
		$("#lbl_municipio").addClass("oculto");
		$("#lbl_localidad").addClass("oculto");		
	}
	else if(idCandidatura<5){
		$("#combo_localidad").addClass("oculto");	
		$("#lbl_localidad").addClass("oculto");			
	}
}

function iniciarCandidatura(callback) {
	var tipo = $("#tipo").val();
	if(tipo==2){
		var idCandidatura=leerNumeroCero("#combo_candidatura"); 
		$("#combo_municipio").removeClass("oculto");
		$("#combo_localidad").removeClass("oculto");
		$("#lbl_municipio").removeClass("oculto");
		$("#lbl_localidad").removeClass("oculto");		
		if(idCandidatura<3){
			$("#combo_municipio").addClass("oculto");
			$("#combo_localidad").addClass("oculto");
			$("#lbl_municipio").addClass("oculto");
			$("#lbl_localidad").addClass("oculto");		
		}
		else if(idCandidatura<5){
			$("#combo_localidad").addClass("oculto");	
			$("#lbl_localidad").addClass("oculto");			
		}
	}	
}

function consultarCircunscripcion() {
	var idCandidatura = $("#combo_candidatura :selected").val();	
	var idDepartamento = $("#combo_departamento :selected").val();
    var idMunicipio = $("#combo_municipio :selected").val();		
	var idLocalidad = $("#combo_localidad :selected").val();	
	$.ajax({
		type:"POST",
		data:"idCandidatura="+idCandidatura+"&idDepartamento="+idDepartamento+"&idMunicipio="+idMunicipio+"&idLocalidad="+idLocalidad,
		url:"ajaxCircunscripcion.php",
		success:function(a){			
			$("#id_circunscripcion").val(a);
		}
	});	
}

function validadUsuarios() {
	$('#result-username').html('<img src="images/loader.gif" />').fadeOut(1000);
 
	var username = $('#numero_identificacion').val();		
	var dataString = 'username='+username;

	$.ajax({
		type: "POST",
		url: "ajaxUsuarios.php",
		data: dataString,
		success: function(data) {
			$('#result-username').fadeIn(1000).html(data);
		}
	});
}

function validadUsuarios() {
	$('#result-username').html('<img src="images/loader.gif" />').fadeOut(1000);
 
	var username = $('#numero_identificacion').val();		
	var dataString = 'username='+username;

	$.ajax({
		type: "POST",
		url: "ajaxUsuarios.php",
		data: dataString,
		success: function(data) {
			$('#result-username').fadeIn(1000).html(data);
		}
	});
}

function validarEmail(valor) {	
	if (/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(valor)){
		return true; 
	} else {
		return false;
	} 
}

function inicializar(){ 
    iniciarCandidatura();
	$("#departamento").change(consultarMunicipio);
	$("#combo_candidatura").change(opcionCandidatura);
	$("#combo_departamento").change(consultarMunicipioCir);
	$("#combo_municipio").change(consultarLocalidad);
	$("#combo_localidad").change(opcionLocalidad);	
	crearOpcionAdjuntar(1);	
	$("#content").addClass("active");   
	document.getElementById('sidebarCollapse').style.display="none";	        
}

$(document).ready(inicializar);