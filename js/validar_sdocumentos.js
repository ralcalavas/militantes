var _msgSeleccionarArchivos = "Adjuntar Archivo...";
_msgExtensionesNoPermitidas = "{file} has an incorrect extension. The allowed extensions are: {extensions}.";


function inicializarValidaciones() {	
	
	if(document.getElementById("idMilitante").value == "" || document.getElementById("idMilitante").value=="0"){
		 alert("El numero de identificación y/o el correo electronico son requeridos.");
		 return false;
	}
		
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


//Regresa el valor del control. Si el control no existe (está oculto) regresa
//cadena vacía.
function leerTexto(nombre) {
	var control = $(nombre);
	var resultado = "";
	if (control != null) {
		resultado = control.val();
	    if (resultado == control.attr("'placeholder'")) {
	    	resultado = "";
	    }		
	}
	return resultado;
}


function popup(url, w, h) {

    window.open(url, '', 'Top=10,titlebar=NO,location=NO,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=' + w + ',height=' + h);
}

function iniciarCandidatura() {
	var id = $("#idMilitante").val(); 	
    $("#datos").addClass("oculto");	
	$("#guardar").addClass("oculto");	
    if(id>0){
		var idCandidatura = $("#id_candidatura").val();	
		$("#datos").removeClass("oculto");	
		$("#guardar").removeClass("oculto");	
		$("#municipio").removeClass("oculto");
		$("#localidad").removeClass("oculto");
		$("#lbl_municipio").removeClass("oculto");
		$("#lbl_localidad").removeClass("oculto");		
		if(idCandidatura<3){
			$("#municipio").addClass("oculto");
			$("#localidad").addClass("oculto");
			$("#lbl_municipio").addClass("oculto");
			$("#lbl_localidad").addClass("oculto");		
		}
		else if(idCandidatura<5){
			$("#localidad").addClass("oculto");	
			$("#lbl_localidad").addClass("oculto");			
		}			
	}
}

function inicializar(){     
    iniciarCandidatura();
	crearOpcionAdjuntar(1);	
	$("#content").addClass("active");   
	document.getElementById('sidebarCollapse').style.display="none";	        
}

$(document).ready(inicializar);