var _sistema = "Mensaje";
var _locale = "us";
var _formatoMoneda = "#,##0.##";
var _formatoDecimal = "#,##0.#####";
var _formatoEntero = "#,##0";
var _panelProcesandoTodo = '#contenido';
var _panelProcesando = _panelProcesandoTodo;
var _formatoFecha = 'yyyy/mm/dd';
var _extensionesNoPermitidas = ['exe', 'com', 'bat', 'cmd'];
var _sizeLimit = 25000000;
var _nRegistrosPagina = 20;

var _msgVerifiqueDatos = "Por favor verifique los datos: ";
var _msgObligatorio = 'El campo {1} es obligatorio';
var _msgCambiarCaptcha = "Haga clic para cambiar";
var _msgSeleccionarArchivos = "Adjuntar Archivo...";
var _msgProcesando = "Procesando...";
var _msgNoExistenRegistros = "No existen registros que coincidan con los parámetros de búsqueda definidos, Por favor ingrese nuevos parámetros e inténtelo  nuevamente";
var _msgExtensionesNoPermitidas = "{file} tiene una extensión incorrecta. Las extensiones NO permitidas son: {extensions}.";

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

function mensajesIngles() {
	_msgVerifiqueDatos = "Please check the data: \n";
	_msgObligatorio = '{1} field is required';
	_msgCambiarCaptcha = "Click to change";
	_msgSeleccionarArchivos = "Choose files...";
	_msgProcesando = "Procesing...";
	_msgNoExistenRegistros = "No records that match the search parameters defined Please enter new parameters and try again there";
	_msgExtensionesNoPermitidas = "{file} has an incorrect extension. The allowed extensions are: {extensions}.";
	$.alerts.okButton = "Ok";
	$.alerts.cancelButton = "Cancel";
}

function noExistenRegistros() {
	mostrarMensaje(_msgNoExistenRegistros);
}

function getIdioma() {
	var idioma = leerTexto('#idioma');
	if (isEmpty(idioma)) {
		idioma = "es";
	}
	return idioma;
}

function espanol() {
	return getIdioma() == "es";
}

/* Funciones utilitarias para Comprobantes */
function mostrarErrorInesperado() {
	$.alerts.alert("Ocurrió un error inesperado. Por favor comuníquese con el administrador del sistema.", _sistema);
}

/* Funciones utilitarias para Comprobantes */
function mostrarMensaje(mensaje, callback) {
	var mensajes = mensaje == null ? [] : mensaje.split("\n");
	if (mensajes.length > 15) {
		mensajes.length = 15;
		mensaje = mensajes.join("\n") + "...";
	}
	$.alerts.alert(mensaje, _sistema, callback);
}

/* Funciones utilitarias para Comprobantes */
function mostrarMensajeInfo(mensaje, callback) {
	$.alerts.alertInfo(mensaje, _sistema, callback);
}
/* Funciones utilitarias para Comprobantes */
function mostrarMensajeConfirmacion(mensaje, callback) {
	jConfirm(mensaje, _sistema, callback);
}
/* Funciones utilitarias para Comprobantes */
function mostrarMensajeConfirmacionOk(mensaje, callback) {
    jConfirm(mensaje, _sistema, function (confirm) {
        if (confirm) {
            callback();
        }
    });
}
/* Funciones utilitarias para Comprobantes */
function mostrarMensajeVerificarDatos(mensaje, callback) {
    $.alerts.alert(_msgVerifiqueDatos + mensaje, _sistema, callback);
}
/* Da formato a la url para hacer el llamado ajax */
function formatForm(strValor) {
	if (strValor.indexOf('?') != -1) {
		strValor = strValor.substring(0, strValor.indexOf('?'));
	}
	return strValor;
};

//Configura el control de calendario con el formato
function configurarCalendario() {
	agregarValidadorFormatoFecha();
	asignarDatePicker('.fecha');
}

/* Asigna el estilo de fecha al control de texto . */
function asignarDatePicker(control) {
	$(control).wrap('<span class="picker-container" />');
	$(control).pickadate({
		format: _formatoFecha
	});
	$(control).mask("9999/99/99");
}

/* Convierte la fecha a una cadena con formato. */
function convertDateToStringFormato(fecha, formato) {
    if (fecha == null) { return ""; }
    if (typeof fecha == "string") {
    	return dateFormat(fecha.replace(new RegExp('-', 'g'), '/'), formato);
    } else {
    	return dateFormat(fecha, formato);
    }
}

/* Convierte la fecha a una cadena que se asigna al control. */
function convertDateToStringFechaHora(fecha) {
    return convertDateToStringFormato(fecha, _formatoFecha + " h:MM:ss TT");
}

/* Convierte la fecha a una cadena que se asigna al control. */
function convertDateToString(fecha) {
    return convertDateToStringFormato(fecha, _formatoFecha);
}

/* Convierte el texto ingresado por el usuario a formato Date de javascript. */
function convertStringToDate(date) {
	if (date == null || date == "") {
		return null;	//Internet explorer no regresa bien las fechas vacías.  Este código soluciona el problema.
	}
	var elem = date.split('/');
	var d, m, y;
	d = elem[0];
	m = elem[1];
	y = elem[2];
	var resultado = new Date(y, m - 1, d, 0, 0, 0, 0);
	return resultado;
}

/* Indica si el texto recibido es una fecha válida */
function esFechaValida(value) {
	if (value == null || value == "") {
		return true;
	}
	var fecha = convertStringToDate(value);
	var textoFechaConvertido = dateFormat(fecha, _formatoFecha);
	return textoFechaConvertido == value;
}

/* Agrega la función para validar el formato de fecha */
function agregarValidadorFormatoFecha() {
	$.validator.addMethod("fecha", function(value, element, param) {
		 if (value == "__/__/____") {
			 return true;
		 } else {
			 return esFechaValida(value);
		 }
	});
}

function mostrarEnTabla(tabla, columns, ordenar) {
	if ($(tabla).length == 0) {
		return;
	}
	// Se inicializa el cargue del dataTable, para volver asignarlo.
	// De lo contrario genera error duplicando los encabezados de la tabla.
	var oTable = $(tabla).dataTable({
		//"sScrollY" : 200,
		"bRetrieve" : true,
		"bFilter" : false,
		"bAutoWidth": false
	});
	if (oTable) {
		oTable.fnDestroy();
		oTable = undefined;
	}
	$.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper";
	$(tabla).dataTable({
        "bRetrieve" : true,
        "bFilter" : false,
        "bStateSave": false,
        "bLengthChange": false,
        "bAutoWidth": false,
        "sDom" : 'T<"clear">lfrtip',
        "aoColumns" : columns,
		"bSort": ordenar,
		"aaSorting": [],
		aLengthMenu: [[20 , -1], [20, "Todos"]],
		iDisplayLength: _nRegistrosPagina
	});
	
	$('.dataTables_scrollBody').css('height', '400px');
};

/*
 * Muestra un conjunto de registros en la tabla especificada usando el template
 * El parámetro encabezados es un array con los títulos de los encabezados de
 * cada columna.
 * El callback es una función que debe ser llamada después de crear los controles y antes de la paginación 
 */
function mostrarRegistrosENTabla(registros, contenedor, tabla, template, encabezados, callback) {
	if ($(tabla).length == 0) {
		return;
	}
	$(tabla).empty();
	if (registros == null || registros.length < 1) {
		$(contenedor).hide();
	} else {
		$(tabla).empty();
		$(contenedor).show();
		$(tabla).parent().show();
		$(tabla).append(generarEncabezadoTabla(encabezados));
		$(tabla + " tbody").remove();
		$(template).tmpl(registros).appendTo(tabla);
		var columnas = detectarColumnasOrdenamiento(encabezados);
		var ordenar = false;
		for (var i = 0; i < columnas.length; i++) {
			var columna = columnas[i];
			if (columna == null || columna["sType"] != null) {
				ordenar = true;
				break;
			}
		}
		invocar(callback);
		mostrarEnTabla(tabla, columnas, ordenar);
	}
}

/*
 * Utilizado por MostrarRegistrosENTabla para generar los encabezados de la
 * tabla a partir de una lista
 */
function generarEncabezadoTabla(encabezados) {
	var resultado = '<thead><tr>';
	if (encabezados == null) {
		resultado += '<th>&nbsp</th>';
	} 
	else { 		
		for (var i = 0; i < encabezados.length; i++) {
			var encabezado = encabezados[i];
			var texto = '&nbsp';
			resultado += '<th';
	
			for ( var propiedad in encabezado) {
				if (propiedad != 'h') {
					if (propiedad != 'sort') {
						resultado += ' ' + propiedad + '="' + encabezado[propiedad]
								+ '"';
					}
				} else {
					texto = encabezado[propiedad];
				}
			}
			// Cierra el tag de apertura th
			resultado += '>' + texto + '</th>';
		}
	}
	resultado += '</tr></thead>';
	return resultado;
}

/* Regresa un array que será enviado a datatables para el ordenamiento con la propiedad aoColumns */
function detectarColumnasOrdenamiento(encabezados) {
	var columns = new Array();
	var columnaOrdenada;
	for (var i = 0; i < encabezados.length; i++) {
		var encabezado = encabezados[i];
		columnaOrdenada = false;
		for ( var propiedad in encabezado) {
			var valor = encabezado[propiedad];
			if (propiedad == 'sort') {				
				var metodoOrdenar = valor;
				if (metodoOrdenar == 'fecha' || metodoOrdenar == 'numero' || metodoOrdenar == 'capacidad') {
					columns.push({"sType": metodoOrdenar});
					columnaOrdenada = true;
				} else if (metodoOrdenar == 'none') {
					columns.push({"bSortable": false});
					columnaOrdenada = true;
				}
			}
		}
		if (!columnaOrdenada) {
			columns.push(null);
		}
	}
	return columns;
}

/*
 * Debido a que el formato numérico agrega caracteres, la longitud final puede
 * llegar a se superior a la permitida para el control. Si esto ocurre, la
 * función borra el contenido del control.
 */
function verificarLongitudMaxima(control) {
	if ($(control).val().length > control.maxLength) {
		mostrarMensaje("El texto es demasiado largo");
		$(control).val("");
	}
}

//Regresa el valor del control. Si el control no existe (está oculto) regresa
//cadena vacía.
function leerCheck(nombre) {
	return $(nombre).is(':checked');
}

//Regresa el valor del control. Si el control no existe regresa null.
function leerFecha(nombre) {
	return convertStringToDate(leerTexto(nombre));
}

/*
 * Regresa un número a partir del contenido del texto. Si está vacío regresa
 * null.
 */
function leerNumero(control) {
    return convertStringToNumber($(control).val());
}
/*
 * Regresa un número a partir del contenido del texto. Si está vacío regresa
 * null.
 */
function leerNumeroDesdeTexto(control) {
    return convertStringToNumber($(control).text());
}

/*
 * Regresa un número a partir del contenido del texto. Si está vacío regresa
 * null.
 */
function convertStringToNumber(texto) {
	if (isEmpty(texto)) {
		return null;
	}
	var sinTokens = texto.replace("\$", "");
	sinTokens = sinTokens.replace(/,/g, "");
	if (isEmpty(sinTokens)) {
		return null;
	} else {
		return parseFloat(sinTokens);
	}
}
/*
 * Regresa un número a partir del contenido del texto. Si está vacío regresa
 * cero.
 */
function leerNumeroCeroSiVacio(control) {
	if ($(control).val() == "") {
		return 0;
	}
	var resultado = $(control).parseNumber({
		format : _formatoMoneda,
		locale : _locale
	}, false);
	return resultado;
}

function formatoMonedaAplicar() {
	if (leerNumero(this) == null) {
		//No hace nada cuando recibe null porque el formato lo como cero
		$(this).val("");
		return;
	}
	$(this).parseNumber({
		format : _formatoMoneda,
		locale : _locale
	});
	$(this).formatNumber({
		format : _formatoMoneda,
		locale : _locale
	});
	verificarLongitudMaxima(this);
}

/* Regresa true si se trata de un caracter especial como backspace */
function esCaracterEspecial(event)
{
    var whichCode = !event.charCode ? event.which : event.charCode;

    if(whichCode == 0) return true;
    if(whichCode == 8) return true;
    if(whichCode == 9) return true;
    if(whichCode == 13) return true;
    if(whichCode == 16) return true;
    if(whichCode == 17) return true;
    if(whichCode == 27) return true;
    return false;
}


/* Formato Moneda */
function formatoMoneda(control) {
	limitarCaracteres(control, "^[0-9\,\.]+$");
	$(control).blur(formatoMonedaAplicar);
	$(control).blur();
}

/* Da el formato de moneda a un número */
function monedaAString(valor) {
	if (valor == null) {
		return "";
	}
	return '$' + $.formatNumber(valor, {
		format : _formatoMoneda,
		locale : _locale
	});
}

/* Da el formato decimal a un número */
function decimalAString(valor) {
	if (valor == null) {
		return "";
	}
	return $.formatNumber(valor, {
		format : _formatoDecimal,
		locale : _locale
	});
}

function formatoEnteroAplicar() {
	if (leerNumero(this) == null) {
		//No hace nada cuando recibe null porque el formato lo como cero
		$(this).val("");
		return;
	}
	$(this).parseNumber({
		format : _formatoEntero,
		locale : _locale
	});
	$(this).formatNumber({
		format : _formatoEntero,
		locale : _locale
	});
	verificarLongitudMaxima(this);
}

/* Únicamente permite digitar los caracteres que cumplan la expresión regular */
function limitarCaracteres(control, expresion) {
	$(control).bind('keypress', function (event) {
	    var regex = new RegExp(expresion);
	    if (esCaracterEspecial(event)) {
	    	return true;
	    }
	    else {
		    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		    if (!regex.test(key)) {
		       event.preventDefault();
		       return false;
		    }
		}
	});		
}

/* Formato Entero */
function formatoEntero(control) {
	limitarCaracteres(control, "^[0-9\,]+$");
	$(control).blur(formatoEnteroAplicar);
	$(control).blur();
}

/* Permite digitar únicamente números en el texto */
function soloNumeros(control) {
	limitarCaracteres(control, "^[0-9]+$");
}

function soloNumerosPunto(control) {
	limitarCaracteres(control, "^[0-9\.]+$");
}

/* Permite digitar únicamente letras en el texto */
function soloLetras(control) {
	limitarCaracteres(control, "^[ a-zñA-ZÑ]+$");
}

/* Permite digitar únicamente letras en el texto */
function soloLetrasONumeros(control) {
	limitarCaracteres(control, "^[ a-zñA-ZÑ0-9]+$");
}

/* Permite digitar únicamente letras mayúsculas en el texto */
function soloMayusculas(control) {
	soloLetras(control);
	$(control).keyup(function(){
	    this.value = this.value.toUpperCase();
	});
}

/* Permite digitar únicamente letras mayúsculas en el texto */
function soloMayusculasSinTilde(control) {
	$(control).keyup(function(){
		var mayus = this.value.toUpperCase();
		mayus = mayus.replace(/Á/g, "A");
		mayus = mayus.replace(/É/g, "E");
		mayus = mayus.replace(/Í/g, "I");
		mayus = mayus.replace(/Ó/g, "O");
		mayus = mayus.replace(/Ú/g, "U");		
	    this.value = mayus;
	});
}

/* Da el formato entero a un número */
function numeroAString(valor) {
	if (valor == null) {
		return "";
	}
	return $.formatNumber(valor, {
		format : _formatoEntero,
		locale : _locale
	});
}

/* Muestra un mensaje Sí / No */
function booleanAString(valor) {
	if (valor == null) {
		return "";
	}
	return valor ? "Sí" : "No";
}

/* Muestra un mensaje Sí / No */
function booleanANumero(valor) {
	if (valor == null) {
		return null;
	}
	return valor ? 1 : 0;
}

/* Muestra un mensaje Sí / No */
function numeroABoolean(valor) {
	if (valor == null) {
		return null;
	}
	return valor != 0;
}

/* Muestra un enlace */
function urlAString(url, texto) {
	if (url == null || url == "") {
		return "";
	}
	return '<a href="' + url + "'>" + texto + "</a>";
}

/* Remplaza los fin de línea por br */
function remplazarFinLinea(texto) {
	if (texto == null) {
		return "";
	}
	return texto.replace(/\n/g, "<br />");
}

/* Regresa la clase CSS para ocultar campos en caso que aplique */
function claseMostrar(mostrar) {
	var clase;
	if (mostrar == null || !mostrar) {
		clase = "oculto";
	}
	else {
		clase = "";
	}
	return clase;
}
//Envía el usuario al home
function goToHome() {
	location = leerTexto('#baseUrl');
}
/* Verifica el error en la llamada ajax y muestra un mensaje */
function procesarErrorAjax(jqXHR, textStatus) {
	if (textStatus == "timeout") {
		mostrarMensaje('El tiempo de espera en la comunicación se ha superado. Por favor intente de nuevo.');
	}
	else if (textStatus == "abort") {
		mostrarMensaje('Se detuvo la operación con el servidor. Por favor intente de nuevo.');
	}
	else if (jqXHR.status == 404) {
    	mostrarMensaje('El recurso no existe en el servidor.');
    }
	else if (jqXHR.status == 403) {
		mostrarMensaje("No tiene privilegios suficientes para realizar esta acción.");
    }
	else if (jqXHR.status == 500) {
		mostrarMensaje('Ha ocurrido un error en el servidor. Por favor comuníquese con el administrador del sistema.');
    }
	else if (jqXHR.status == 200) {
		mostrarMensaje('Su sesión ha expirado, por favor haga clic en Cerrar Sesión e ingrese de nuevo.', goToHome);
    }
	else if (jqXHR.status == 0) {
		mostrarMensaje('El servidor no está disponible en este momento.  Por favor haga clic en Cerrar Sesión e intente más tarde.', goToHome);
    }
	else {
		mostrarMensaje('Ha ocurrido un error desconocido. Por favor comuníquese con el administrador del sistema. ' + jqXHR.status + ' ' + jqXHR.getAllResponseHeaders());
	}
}

/* Abre el popup con los parámetros indicados. */
function mostrarPopup(div, titulo, ancho, alto) {
    $(div).dialog({
        width: ancho,
        height: alto,
        resizable: false,
        modal: true,
        title: titulo,
        open: function () {
            $(this).parent().appendTo($('body'));
        }
    });
}

/* Indica que si se trata de una cadena vacía o null */
function isEmpty(valor) {
	return (valor == null || valor == '');
}

/* Indica que si se trata de una cadena vacía o null */
function isBlank(valor) {
	return (valor == null || $.trim(valor) == '');
}

/* Establece un objeto en el SessionStorage */
function setSessionStorage(key, value) {
	if (window.sessionStorage){
		sessionStorage[key] = JSON.stringify(value);
	}	
}

/* Lee un objeto del SessionStorage */
function getSessionStorage(key) {
	var resultado = null;
	if (window.sessionStorage){
		var valor = sessionStorage[key];
		if (valor != null && valor != "") {
			resultado = JSON.parse(valor);
		}
	}
	return resultado;
}

//Verifica que la extensión del archivo corresponda al array de extensiones permitidas
function verificarExtension(value, extensionesPermitidas) {
	var ext = '';
	if (!isEmpty(value) && value.indexOf('.') >= 0) {
		ext = value.split('.').pop().toLowerCase();
	}
	var resultado = (isEmpty(value) || $.inArray(ext, extensionesPermitidas) >= 0);
	return resultado;
}

//Agrega la función para validar la extensión del archivo
function agregarValidadorExtension(extensionEsperada) {
	$.validator.addMethod("archivoExtension", function(value, element, param) {
		return verificarExtension(value, extensionEsperada.split(','));
	});
}

//Agrega la función para validar la extensión del archivo
function agregarValidadorExtensionXlsx() {
	agregarValidadorExtension('xlsx');
}

//Ubica los mensajes de validación
function errorPlacement(error, element) {
	var parent;
	var tagName;
	do{
		element = element.parent();
		tagName = element.get(0).tagName;
	}while(tagName != 'P' && tagName != 'TABLE');
    error.insertAfter(element);
}

/* Envía una llamada ajax con el prefijo de Web API*/
function ajaxJsonApi(url, type, data, success, panelProcesando, propiedades) {
    //ajaxJson(leerTexto('#UrlBase') + "api/" + url, type, data, success, panelProcesando, propiedades);
	ajaxJson("classes/" + url, type, data, success, panelProcesando, propiedades);
}

//Muestra el indicador de progreso
function mostrarProcesando() {
	var panel = _panelProcesando || _panelProcesandoTodo;
	$(panel).loadmask(_msgProcesando);
	return true;
}

//Muestra el indicador de progreso
function mostrarProcesandoTodo(mostrar) {
	if (mostrar == null || mostrar) {
		mostrarProcesando(_panelProcesandoTodo);
	} else {
		$(_panelProcesandoTodo).unloadmask();
	}
	
}
/* Función estándar para el complete de una invocación ajax */
function completeAjax(jqXHR, textStatus) {
	var panel = _panelProcesando || _panelProcesandoTodo;
	$(panel).unloadmask();
	$(_panelProcesandoTodo).unloadmask();
	if (textStatus != "success") {
		procesarErrorAjax(jqXHR, textStatus);
	}	
}

/* Asigna valores por defecto a propiedades */
function setDefault(objeto, propiedad, defaultValue) {	
	if (objeto[propiedad] == null) {
		objeto[propiedad] = defaultValue;
	}
}

/* Envía una llamada ajax */
function ajaxJson(url, type, data, success, panelProcesando, propiedades) {
	_panelProcesando = panelProcesando;
	if (propiedades == null) {
		propiedades = {};
	}
	propiedades.url = url;
	propiedades.type = type;
	propiedades.success = success;
	if (data != null) {
		propiedades.data = JSON.stringify(data);
	}
	//Propiedades fijas
	propiedades.dataType = 'json';
	propiedades.contentType = "application/json; charset=utf-8";
	
	//Propiedades por defecto
	setDefault(propiedades, 'cache', false);
	setDefault(propiedades, 'async', true);	
	setDefault(propiedades, 'beforeSend', mostrarProcesando);
	setDefault(propiedades, 'complete', completeAjax);
	
	$.ajax(propiedades);	
}

/* Envía una llamada ajax */
function ajaxJsonSinIndicadorProcesando(url, type, data, success, propiedades) {
	if (propiedades == null) {
		propiedades = {};
	}
	propiedades.beforeSend = function(objeto) {};
	ajaxJson(url, type, data, success, null, propiedades);
}

/* Configura la opción autocompletar para el texto */
function autocompletar(nombre, url) {	
	$(nombre).autocomplete({
		minLength: 0,
	    source : function(request, response) {
	    	var data = {term: request.term};
	    	ajaxJsonSinIndicadorProcesando(url, 'POST', data, response);
	    }
	});
}

/* Configura la opción autocompletar URL variable */
function autocompletarConUrlProvider(nombre, urlProvider) {
        $(nombre).autocomplete({
                minLength: 0,
            source : function(request, response) {
            	var url = urlProvider(this.element);
                if (!isEmpty(url)) {
                        var data = {term: request.term};
                        ajaxJsonSinIndicadorProcesando(url, 'POST', data, response);
                }
            }
        });
}

/* Cierra el diálogo */
function botonCancelar(control, dialogo) {
    $(control).click(function () {
        cerrarPopup(dialogo);
        return false;
    });
}
/* Cierra el diálogo */
function cerrarPopup(dialogo) {
    $(dialogo).unloadmask();
    $(dialogo).dialog("close");
    $(".hasDatepicker").datepicker("hide");
    return false;
}
/* Quita el submit del formulario */
function noSubmit(control) {
    $(control).submit(function () {
        return false;
    });
}

/* Ubica el error de Validate en la pobogotaión correcta */
function pobogotaionarError(error, element) {
    var parent;
    var tagName;
    do {
        element = element.parent();
        tagName = element.get(0).tagName;
    } while (tagName != 'P' && tagName != 'FIELDSET');
    error.insertAfter(element);
}

/* Mostrar errores de validación */
function mostrarErrores(form, validator) {
	var numeroErrores = validator.numberOfInvalids();
    if (numeroErrores) {
        var errores = "";
        if (validator.errorList.length > 0) {
            for (var x = 0; x < validator.errorList.length; x++) {
            	errores += "\n\u25CF " + validator.errorList[x].message;
            }
        }
        mostrarMensaje(_msgVerifiqueDatos + errores);
    }
	validator.focusInvalid();
}

/* Inicializa la validación. Es necesario establecer la propiedad name de cada campo para que los mensajes se vean bien. */
function validar(formulario, validaciones) {
	if (validaciones == null) {
		validaciones = {};
	}
	setDefault(validaciones, 'highlight', function(element) {
        $(element).addClass('error');
    });
	setDefault(validaciones, 'unhighlight', function(element) {
		$(element).removeClass('error');
    });
	setDefault(validaciones, 'errorPlacement', function(error, element) {});
	setDefault(validaciones, 'invalidHandler', mostrarErrores);
	$(formulario).validate(validaciones);
}

//Limpia las validaciones del formulario
function limpiarValidaciones(formulario) {
	$(formulario).find('.error').removeClass('error');
}

function padLeft(i,l,s) {
	var o = i.toString();
	if (!s) { s = '0'; }
	while (o.length < l) {
		o = s + o;
	}
	return o;
}
function trim(texto) {
    return texto.replace(/^\s+|\s+$/g, ''); 
}

if ($.fn.dataTableExt != null) {
	//Declara el ordenamiento para números
	$.extend( $.fn.dataTableExt.oSort, {
	    "numero-pre": function ( a ) {
	        a = (a==="-") ? 0 : a.replace( /[^\d\-\.]/g, "" );
	        return parseFloat( a );
	    },
	 
	    "numero-asc": function ( a, b ) {
	        return a - b;
	    },
	 
	    "numero-desc": function ( a, b ) {
	        return b - a;
	    }
	} );
	//Declara el ordenamiento para fechas
	$.extend( $.fn.dataTableExt.oSort, {
	    "fecha-pre": function ( a ) {
	    	var x;
	        if (trim(a) != '') {
	            var frDatea = trim(a).split(' ');
	            var frDatea2 = frDatea[0].split('/');
	            if (frDatea.length > 1) {
	            	//Si la fecha contiene horas
		            var frTimea = frDatea[1].split(':');
		            if (frDatea[2] == 'PM') {
		            	frTimea[0] += 12;
		            }
		            x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + padLeft(frTimea[0], 2, '0') + frTimea[1] + frTimea[2]) * 1;
	            }
	            else {
	            	x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + "000000") * 1;
	            }
	        } else {
	            x = 0; // = l'an 1000 ...
	        }
	         
	        return x;
	    },
	 
	    "fecha-asc": function ( a, b ) {
	    	return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	    },
	 
	    "fecha-desc": function ( a, b ) {
	    	return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	    }
	} );
	// Agrega la función fnGetTrs a DataTables para obtener todas las filas aunque estén ocultas
	$.fn.dataTableExt.oApi.fnGetTrs = function ( oSettings ) {
		return this.oApi._fnGetTrNodes( oSettings );
	};	
}

function isDataTable ( nTable )
{
    var settings = $.fn.dataTableSettings;
    for ( var i=0, iLen=settings.length ; i<iLen ; i++ )
    {
        if ( settings[i].nTable == nTable )
        {
            return true;
        }
    }
    return false;
}

//Desactiva el backspace para que IExplore no regrese a la página anterior
$(document).keydown(function(e) {
	var element = e.target.nodeName.toLowerCase();
	if (element != 'input' && element != 'textarea') {
	    if (e.keyCode === 8) {
	        return false;
	    }
	}
	});
/*
$("'[placeholder]'").focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr("'placeholder'")) {
	    input.val("''");
	    input.removeClass("'placeholder'");
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == "''" || input.val() == input.attr("'placeholder'")) {
	    input.addClass("'placeholder'");
	    input.val(input.attr("'placeholder'"));
	  }
	}).blur();
*/

function stringFormat(texto) {
    var args = arguments;
    return texto.replace(/{(\d+)}/g, function(match, number) { 
      return typeof args[number] != 'undefined'
        ? args[number]
        : match
      ;
    });
  };
  
//Mensaje estándar para campos obligatorios
function mensajeObligatorio(nombreCampo) {
    return stringFormat(_msgObligatorio, nombreCampo);
}
//Cambia el estado de un checkbox
function check(control, checked) {
	$(control).prop('checked', checked);
}
/* Muestra el mensaje indicando que el registro se ha creado / actualizado exitosamente */
function mostrarMensajeAlmacenado(descripcionUsuario, reg, callback) {
	var estado = reg.id == null ? "se creó" : "se ha modificado";
	var mensaje = descripcionUsuario + " " + estado + " exitosamente";
	$.alerts.alertInfo(mensaje, _sistema, callback);
}
//Verifica que la respuesta del servidor sea Ok o muestra el mensaje de verificar datos
//Si se especifica descripcionUsuario y reg, intenta mostrar un mensaje al usuario indicando que se creó / actualizó el registro
function respuestaOk(response, callback, descripcionUsuario, reg) {
	if (response.ok) {
		if (!isEmpty(descripcionUsuario) && reg != null) {
			mostrarMensajeAlmacenado(descripcionUsuario, reg, callback);
		} else {
			invocar(callback);
		}
	} else {
		mostrarMensajeVerificarDatos(response.mensaje);
	}
}

//Indica si el control es visible
function visible(control) {
  return $(control).is(':visible');
}

function habilitar(control, habilitar) {
  if (habilitar) {
      $(control).prop('disabled', false);
  } else {
      $(control).prop('disabled', 'disabled');
  }
}
function habilitado(control) {
	return !$(control).is(':disabled');
}
//Actualiza la lista
function llenarComboSeleccione(control, lista, valorId, nombre, mensajeSeleccione) {	
    var labelSeleccione = mensajeSeleccione || 'Seleccione';
    var combo = $(control).get(0);
    if (combo != null) {
	    combo.options.length = 0;
	    if (labelSeleccione != "-") {
	    	combo.options[0] = new Option(labelSeleccione, "");
	    }
	    if (lista != null) {				
	        $.each(lista, function () {
	            combo.options[combo.options.length] = new Option(this[nombre], this[valorId]);
	        });
	    }
    }
}
//Actualiza la lista
function llenarComboListaSeleccione(control, lista, valorId, nombre, mensajeSeleccione) {
    var labelSeleccione = mensajeSeleccione || '(Seleccione)';
    var combo = $(control).get(0);
    if (combo != null) {
	    combo.options.length = 0;
	    if (labelSeleccione != "-") {
	    	combo.options[0] = new Option(labelSeleccione, "");
	    }
	    if (lista != null) {
	        $.each(lista, function () {
	            combo.options[combo.options.length] = new Option(this[nombre], this[valorId]);
	        });
	    }
		$(control).trigger("chosen:updated");
    }
}
function llenarLista(valor){
  var lista = valor.split(",");  
  var arrayLista= new Array(lista.length);
  for(var i = 0 ; i < lista.length; i++){
	  var valLista = lista[i].split("~");        
      arrayLista[i] = new Array(2);
	  arrayLista[i][0] = valLista[0];
	  arrayLista[i][1] = valLista[1];       
  }   
  return arrayLista;
}

function comboChange(url, control, controlDependiente, dependienteChange, callback) {

    var id = leerNumero(control);

    var idDependienteAntes = leerNumero(controlDependiente);

    if (id == null) {
    
        llenarComboSeleccione(controlDependiente);

        $(controlDependiente).val(idDependienteAntes);

        invocar(dependienteChange);

        invocar(callback);

    } else {

        ajaxJsonApi(url, 'GET', null, function (response) {
            	
            llenarComboSeleccione(controlDependiente, response, "id", "nombre");
			
            $(controlDependiente).val(idDependienteAntes);

            invocar(dependienteChange);

            invocar(callback);

        });

    }

}


//Cambia el estado de selección para un option
function seleccionarRadio(name, valor) {
	if (isEmpty(valor)) {
		//Si está vacío, no se debe seleccionar ninguna opción del control
		$('input[name="' + name + '"]').prop('checked', false);
	} else {
		$('input[name="' + name + '"][value="' + valor + '"]').prop('checked', true);
	}
}
//Lee un control por nombre
function leerTextoPorNombre(name) {
	return $('input[name="' + name + '"]').val();
}
//Establece un control por nombre
function setPorNombre(name, valor) {
	$('input[name="' + name + '"]').val(valor);
}
//Lee un control por nombre
function leerTextoRadio(name) {
	return $('input[name="' + name + '"]:checked').val();
}
//Lee un control por nombre
function leerNumeroRadio(name) {
	return convertStringToNumber(leerTextoRadio(name));
}
//Lee un control por nombre
function leerCheckRadio(name) {
	var texto = leerTextoRadio(name);
	return texto == "1" || texto == "true";
}
//Lee un control por nombre
function leerBoolean(control) {
	var texto = leerTexto(control);
	return texto == "1" || texto == "true";
}
//Asigna una lista de valores al control multiselect
function asignarValoresMulti(control, valores, seleccione) {
	valores = valores || [];
	 $(control + " option" ).each(function() {
		 $(this).prop('selected', false);
	 });
	$.each(valores, function(i, val) {
		$(control + ' option[value="' + val + '"]').prop('selected', true);
	});
	$(control).multiselect('destroy');
	asignarMulti(control, seleccione || "(Seleccione)");
}
//Inicializa el control multiselect
function asignarMulti(control, ninguno, seleccionarTodos, seleccionarNinguno) {
	$(control).multiselect({
	    selectedList: 100,
	    checkAllText: seleccionarTodos || "Todos",
	    uncheckAllText: seleccionarNinguno || "Ninguno",
	    noneSelectedText: ninguno
	});
}

//Cambia el estado de un checkbox
function check(control, checked) {
	$(control).prop('checked', checked);
}

//Regresa a la página anterior
function regresar() {
	var regresarUrl = leerTexto('#regresarUrl');
	if (isEmpty(regresarUrl)) {
		history.back();
	} else {
		location = regresarUrl;
	}
}

//Verifica si el rango de fechas es válido o regresa false
function verificarRangoFechas(fechaInicial, fechaFinal) {
	return (fechaInicial == null || fechaFinal == null || fechaInicial <= fechaFinal);
}

/* Establece el botón por defecto para el formulario */
function defaultButton(form, control) {
	$(form).keypress(function (e) {
	    if (e.keyCode == 13) {
	    	$(control).trigger('click');
	    	e.preventDefault();
	    	return false;
	    }
	});
}

/* Cambia el scroll a la pobogotaión del control */
function scrollTop(control) {
	$('html, body').scrollTop($(control).offset().top);
}

function agregarValidadorCheckUrl() {
    $.validator.addMethod("checkurl", function (value, element) {
        // now check if valid url
        return isEmpty(value) || /^(https?:\/\/)?[A-Za-z0-9_-]+\.+[A-Za-z0-9.\/%&=\?_:;-]+$/.test(value);
    }, "La URL no es válida."
    );

    // connect it to a css class
    $.validator.addClassRules({
        checkurl: { checkurl: true }
    });
}

//Regresa el valor que ve el usuario.
function leerTextoMostrado(nombre) {
    return $(nombre + " option:selected").text();
}

//Invoca el callback si está definido
function invocar(callback) {
	if (callback != null) {
		callback();
	}
}

function agregarValidadorTelefonoFijo() {
    $.validator.addMethod("telefonoFijo", function (value, element) {
        // now check if valid url
        return isEmpty(value) || /^\d-\d{7}$/.test(value);
    }, "El teléfono fijo no es válido."
    );

    // connect it to a css class
    $.validator.addClassRules({
    	telefonoFijo: { telefonoFijo: true }
    });
}

function agregarValidadorTelefonoMovil() {
    $.validator.addMethod("telefonoMovil", function (value, element) {
        // now check if valid url
        return isEmpty(value) || /^\d{10}$/.test(value);
    }, "El teléfono móvil no es válido."
    );

    // connect it to a css class
    $.validator.addClassRules({
    	telefonoMovil: { telefonoMovil: true }
    });
}

function agregarValidadorFax() {
    $.validator.addMethod("fax", function (value, element) {
        // now check if valid url
        return isEmpty(value) || /^\d{7}$/.test(value);
    }, "El fax no es válido."
    );

    // connect it to a css class
    $.validator.addClassRules({
    	fax: { fax: true }
    });
}

/* Asigna el estilo de teléfono fijo */
function formatoTelefonoFijo(control) {
	$(control).mask("9-9999999");
}

function mensajesFineUploader() {
	if (espanol()) {
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
	} else {
	    return {
	        typeError: "{file} has an incorrect extension. The allowed extensions are: {extensions}."
	        , sizeError: "{file} it is too big, maximum allowed size is {sizeLimit}."
	        , minSizeError: "{file} is too small, the minimum size is {minSizeLimit}."
	        , emptyError: "{file} is empty, please select another file."
	        , noFilesError: "No files to send."
	        , tooManyItemsError: "Too many elements ({netItems}) will be sent. The limit is {itemLimit}."
	        , retryFailTooManyItems: "Retry failed - has reached the maximum limit."
	        , onLeave: "The files are being sent, the process will be canceled."
	    };
	}
}

function calcularDigitoVerificacionNit(nit1) {
	var dv1;
	if (isNaN(nit1))
	{
		dv1 = null;
	} else {
		var vpri = new Array(16);
		var x=0 ; 
		var y=0 ; 
		var z=nit1.length ;
	    vpri[1]=3;
	    vpri[2]=7;
	    vpri[3]=13;
	    vpri[4]=17;
	    vpri[5]=19;
	    vpri[6]=23;
	    vpri[7]=29;
	    vpri[8]=37;
	    vpri[9]=41;
	    vpri[10]=43;
	    vpri[11]=47;  
	    vpri[12]=53;  
	    vpri[13]=59;
	    vpri[14]=67;
	    vpri[15]=71;
	    for(var i=0 ; i<z ; i++)
	    {
	    	y=(nit1.substr(i,1));
	    	x+=(y*vpri[z-i]);
	    }
	    y=x%11;
	    if (y > 1)
	    {
	    	dv1=11-y;
	    } else {
	    	dv1=y;	
	    }
	}
	return dv1;
}

function eliminarArchivoDeLista(control) {
    mostrarMensajeConfirmacionOk("¿Está seguro de eliminar el archivo?", function () {
        $(control).parent().remove();
    });
}

function asignarUploader(listaArchivos, listaIdDescripcion) {
	$(listaArchivos).empty();
	if (listaIdDescripcion != null) {
		for (var i = 0; i < listaIdDescripcion.length; i++) {
			var reg = listaIdDescripcion[i];
			var idArchivo = reg.id;
			var name = reg.descripcion;
			$(listaArchivos).append("<li><span class='boton-opcion sprite-trash ui-corner-all' href='javascript: void(0)' title='Eliminar registro' onclick='return eliminarArchivoDeLista(this);' /><a href='" + leerTexto('#urlDownload') + idArchivo + "'>" + name + "</a></li>");
		}
	}	
}
//Verifica que la extensión del archivo no esté dentro de las no permitidas
function verificarExtensionNoPermitida(data, buttonContainer) {
	var permitir = !verificarExtension(data.name, _extensionesNoPermitidas);
	if (!permitir) {
		mostrarMensaje(_msgExtensionesNoPermitidas.replace("{file}", data.name).replace("{extensions}", _extensionesNoPermitidas));
	}
	return permitir;
}

function crearUploader(control, listaArchivos, extensiones, sizeLimit) {
	sizeLimit = sizeLimit || _sizeLimit;
    new qq.FineUploader({
        element: $(control)[0],
        request: {
            endpoint: leerTexto('#urlUpload')
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
        	onValidate: verificarExtensionNoPermitida,
            onComplete: function (id, name, response) {
            	var idArchivo = response.idArchivo;
            	if (idArchivo != null) {
            		$(listaArchivos).append("<li><span class='boton-opcion sprite-trash ui-corner-all' href='javascript: void(0)' title='Eliminar registro' onclick='return eliminarArchivoDeLista(this);' /><a href='" + leerTexto('#urlDownload') + idArchivo + "'>" + name + "</a></li>");
            	} else if (!isEmpty(response.error)) {
            		mostrarMensaje(response.error);
            	}
            }
        }
    });
}

function asignarUploaderUnico(listaArchivos, idDescripcion) {
	$(listaArchivos).empty();
	if (idDescripcion != null && idDescripcion.id != null) {
		var reg = idDescripcion;
		var idArchivo = reg.id;
		var name = reg.descripcion;
		$(listaArchivos).append("<li><span class='boton-opcion sprite-trash ui-corner-all' href='javascript: void(0)' title='Eliminar registro' onclick='return eliminarArchivoDeLista(this);' /><a href='" + leerTexto('#urlDownload') + idArchivo + "'>" + name + "</a></li>");
	}
}

function crearUploaderUnico(control, listaArchivos, extensiones, sizeLimit) {
	sizeLimit = sizeLimit || _sizeLimit;
    new qq.FineUploader({
        element: $(control)[0],
        request: {
            endpoint: leerTexto('#urlUpload')
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
            	$(listaArchivos).empty();
            	var idArchivo = response.idArchivo;
            	if (idArchivo != null) {
            		$(listaArchivos).append("<li><span class='boton-opcion sprite-trash ui-corner-all' href='javascript: void(0)' title='Eliminar registro' onclick='return eliminarArchivoDeLista(this);' /><a href='" + leerTexto('#urlDownload') + idArchivo + "'>" + name + "</a></li>");
            	} else if (!isEmpty(response.error)) {
            		mostrarMensaje(response.error);
            	}
            }
        }
    });
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

/* Convierte una lista de int a lista de IdDescripcion.  
 * Se usa para los métodos guardar con lista de archivos que también se debe leer.
 */
function getListaIdDescripcion(listaId) {
	var listaIdDescripcion = [];
	if (listaId != null) {
		for (var i = 0; i < listaId.length; i++) {
			listaIdDescripcion.push({id: listaId[i]});
		}
	}
	return listaIdDescripcion;
}
//Calcula un id único para registros nuevos 
function calcularNuevoId(lista) {
	var min = 0;
	for (var i = 0; i < lista.length; i++) {
		if (lista[i].id < min) {
			min = lista[i].id;
			break;
		}
	}
	return min - 1;
}

function verificarRangoFechasMensaje(fechaInicial, fechaFinal, nombre) {
	var mensaje = "";
	if (!verificarRangoFechas(fechaInicial, fechaFinal)) {
		mensaje = "\n- El rango de " + nombre + " es incorrecto";
	}
	return mensaje;
}

function existe(control) {
	return $(control).length > 0;
}

// Asigna al texto una lista y queda separado por comas
function asignarLista(control, lista) {
    if (lista == null) {
    	$(control).val("");
    } else {
    	$(control).val(lista.join());
    }
}
//Establece el idioma a inglés si se necesita
$(document).ready(function () {
	var _idioma = getIdioma();
	if (_idioma == "en") {
		mensajesIngles();
	}	
});

function localizarTitulos(lista, control) {
	var texto = leerTexto(control);
	if (lista != null && !isEmpty(texto)) {
		var split = texto.split(",");
		for (var i = 0; i < lista.length && i < split.length; i++) {
			var localizado = split[i];
			if (!isEmpty(localizado)) {
				lista[i].h = split[i];
			}
		}
	}
	
}

function isListaVacia(lista) {
	return lista == null || lista.length == 0;
}

function onEnter(control, callback) {
    $(control).keypress(function (e) {
        if (e.keyCode == 13) { 
        	invocar(callback);
        	return false;
        }
    });	
}

//Si la consulta no regresó registros muestra el mensaje al usuario
function mensajeSinDatos(registros) {
    if (registros == null || registros.length < 1) {
        mostrarMensaje("No existen registros que coincidan con los criterios de búsqueda.");
    }
}

function formatCurrency(num) {
	num = num.toString().replace(/\$|,/g,'');
	if(isNaN(num)) num = "0";
	cents = Math.floor((num*100+0.5)%100);
	num = Math.floor(num).toString();
	if(cents < 10) cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));
	return ('$' + num + '.' + cents);
}

function formatValor(num) {
	num = num.toString().replace(/\$|,/g,'');
	if(isNaN(num)) num = "0";
	cents = Math.floor((num*100+0.5)%100);
	num = Math.floor(num).toString();
	if(cents < 10) cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));
	return (num + '.' + cents);
}

//Invoca el callback si está definido

function invocar(callback) {
	if (callback != null) {
		callback();
	}
}
