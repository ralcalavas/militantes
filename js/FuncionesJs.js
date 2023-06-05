
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

function eliminarRegistro() { 
	var r = confirm("Esta seguro de eliminar el registro?");
	return r;
}

function inicializar() {	
}

$(document).ready(inicializar);	
