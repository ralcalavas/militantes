
var fechaInicio = {
    altFormat: "yy-mm-dd",
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    buttonImage: "img/gifs/018.gif",
    buttonImageOnly: true,
    autoSize: true,
    dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
    monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    yearRange: "1930:2100",
    onClose: function(selectedDate) {
        $("#fechaFinal").datepicker("option", "minDate", selectedDate);
    }

};
var fechaFinal = {
    altFormat: "yy-mm-dd",
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    buttonImage: "img/gifs/018.gif",
    buttonImageOnly: true,
    autoSize: true,
    dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
    monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    yearRange: "1930:2100",
    onClose: function(selectedDate) {
        $("#fechaInicial").datepicker("option", "maxDate", selectedDate);
    }

};
var fecha = {
    altFormat: "yy-mm-dd",
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    buttonImage: "img/gifs/018.gif",
    buttonImageOnly: true,
    autoSize: true,
    dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
    monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    yearRange: "1930:2100"

};

function seleccionar_todos(forma) {
    elementos = forma.elements.length;
    if (document.getElementById('seleccionar').checked == true) {
        marcar = true;
    } else {
        marcar = false;
    }
    for (i = 0; i < elementos; i++) {
        if (forma.elements[i].type == 'checkbox') {
            forma.elements[i].checked = marcar;
        }
    }

}
var ciudades = function(control, control2) {
    //alert($(control).val());
    $.ajax({
        type: "POST",
        data: "padre=" + $(control).val(),
        url: "include/ajaxCiudades.php",
        success: function(a) {
            $("#ciudad" + control2).html(a);

        }

    });
}


function popup(url, w, h) {

    window.open(url, '', 'Top=10,titlebar=NO,location=NO,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=' + w + ',height=' + h);
}


function calcular_dv(nit, id_div) {
    arr = new Array();
    arr[1] = 3;
    arr[4] = 17;
    arr[7] = 29;
    arr[10] = 43;
    arr[13] = 59;
    arr[2] = 7;
    arr[5] = 19;
    arr[8] = 37;
    arr[11] = 47;
    arr[14] = 67;
    arr[3] = 13;
    arr[6] = 23;
    arr[9] = 41;
    arr[12] = 53;
    arr[15] = 71;
    x = 0;
    y = 0;
    z = nit.length;
    dv = '';

    for (i = 0; i < z; i++) {

        y = nit.substring(i, i + 1);


        x = parseFloat(x) + parseFloat((y * arr[z - i]));
    }


    y = x % 11;

    if (y > 1) {
        dv = 11 - y;
        //return dv;
    } else {
        dv = y;
        //return $dv;
    }

    document.getElementById(id_div).value = dv;
}

var nav4 = window.Event ? true : false;
var key;
function acceptNum(evt){



	var key = nav4 ? evt.which : evt.keyCode;
	return (key == 0 || key == 8 || key == 13 || (key >= 48 && key <= 57));



}

function soloLetras(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}

	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

/* Indica que si se trata de una cadena vacía o null */
function isEmpty(valor) {
	return (valor == null || valor == '');
}

function convertStringToNumberCero(texto) {
	if (isEmpty(texto)) {
		return 0;
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

function leerNumero(control) {
    return convertStringToNumber($(control).val());
}

function leerNumeroCero(control) {
    return convertStringToNumberCero($(control).val());
}

function confirmar_borrar() {
	return confirm('¿Esta seguro que desea eliminar el registro seleccionado?');
}

function formatDouble(num) {
    num = num.toString().replace(/\$|,/g, '');
    if (isNaN(num)) num = "0";
    cents = Math.floor((num * 100 + 0.5) % 100);
    num = Math.floor(num).toString();
    if (cents < 10) cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
	if(cents != "00")
		num = num + '.' + cents;	
    if (num == "0.00")
        num = "0";
    return (num);
}

function formatNumDouble(num) {
	var valnum = num.toString().replaceAll(',', '').replaceAll('.', '');
	if (isNaN(valnum)){
		num = "0";
	}	
	else{
		//1.234,23
		var val=0;
		let arr = num.toString().split(',');
		num = arr[0];
		var cents = "0";
		if(arr.length > 1) cents = arr[1];			
		num = num.toString().replaceAll(".", '');		
		if (isNaN(num)){
			num = "0";
		}
		else if (cents != "0"){
			cents = cents.toString().replaceAll(".", '');		
			if (isNaN(cents)) num = "0";
			if (cents.length > 2) cents = cents.substring(0,2);			
		}
		if(num!="0"){
			num = Math.floor(num).toString();
			for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
				num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
			if(cents != "00" && cents != "0") num = num + ',' + cents;			
			if (num == "0,00") num = "0";
		}			
	}
    return (num);
}

function formatNumValor(num) {
	var valnum = num.toString().replaceAll(',', '').replaceAll('.', '');
	if (isNaN(valnum)){
		num = "0";
	}	
	else{		
		var val=0;
		let arr = num.toString().split(',');
		num = arr[0];
		var cents = "0";
		if(arr.length > 1) cents = arr[1];			
		num = num.toString().replaceAll(".", '');		
		if (isNaN(num)){
			num = "0";
		}
		else if (cents != "0"){
			cents = cents.toString().replaceAll(".", '');		
			if (isNaN(cents)) num = "0";
			if (cents.length > 2) cents = cents.substring(0,2);			
		}
		if(num!="0"){		
			if(cents != "00" && cents != "0") num = num + '.' + cents;			
			if (num == "0.00") num = "0";
		}			
	}
    return (num);
}


function formatDoubleNum(num) {
	num = formatDouble(num);	
    num = num.toString().replaceAll('.',';');
	num = num.toString().replaceAll(',','.');
	num = num.toString().replaceAll(';',',');    
    return (num);
}

function llenarComboChosenSeleccione(control, mensajeSeleccione) {
    var combo = $(control).get(0);
    combo.options.length = 0;
    combo.options[0] = new Option(mensajeSeleccione, "0");    
    $(control).trigger("chosen:updated");
}

function llenarCombo(control, lista) { 
    var combo = $(control).get(0);
	combo.options.length = 0;	
    combo.options[combo.options.length] = new Option("Seleccione", "0");	
    if (lista != null && lista != "") {	        
		let arr = lista.split('*');	
		for (var i = 0; i < arr.length ; i++){
			if(arr[i] != ""){
				let val = arr[i].split('-');	
				combo.options[combo.options.length] = new Option(val[1], val[0]);
			}		
		}
    }
    $(control).trigger("chosen:updated");
}

function inicializar() {	
  $(".soloNum").numeric();	 
  //oculta el menu de la izquierda
  if(document.getElementById("idRol").value == 3){
	document.body.classList.add('hide-left');
  }	
}

$(document).ready(inicializar);	
