/* Permite digitar únicamente números en el texto */
function soloNumeros(control) {
    limitarCaracteres(control, "^[0-9]+$");
}

/* Permite digitar únicamente letras en el texto */
function soloLetras(control) {
    limitarCaracteres(control, "^[ a-zA-Z]+$");
}

/* Regresa true si se trata de un caracter especial como backspace */
function esCaracterEspecial(event) {
    var whichCode = !event.charCode ? event.which : event.charCode;

    if (whichCode == 0) return true;
    if (whichCode == 8) return true;
    if (whichCode == 9) return true;
    if (whichCode == 13) return true;
    if (whichCode == 16) return true;
    if (whichCode == 17) return true;
    if (whichCode == 27) return true;
    return false;
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

function inicializar() {
	$(".soloNumeros").numeric();
}

$(document).ready(inicializar);