/*SweetAlert Init*/

$(function() {
	"use strict";
	
	var SweetAlert = function() {};

    //Examples 
    SweetAlert.prototype.init = function() {
        
    //Default
    $('#alerts_default').click(function(){
        swal("Texto Mensaje");
    });
        
    //Title With Text
    $('#alerts_title_text').click(function(){
        swal("Texto Mensaje", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.")
    });
        
    //Success Message
    $('#alert_success').click(function(){
        swal("Texto mensaje!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.", "success")
    });
        
    //Warning Message
    $('#alert_warning').click(function(){
        swal({   
            title: "Titulo Texto",   
            text: "Texto, texto, texto, texto",   
            type: "Alerta",   
            showCancelButton: true,   
            confirmButtonColor: "#DE3823",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Mensaje!", "Texto borrado.", "success"); 
        });
    });
        
    //Custom Image
    $('#alert_image').click(function(){
        swal({   
            title: "Govinda!",   
            text: "Texto de prueba",   
            imageUrl: "assets/img/avatar.jpg" 
        });
    });
       
    //Auto Close
    $('#auto_close_alert').click(function(){
         swal({   
            title: "Ventana con autocerrado",   
            text: "Se cierra en 2 segundos.",   
            timer: 2000,   
            showConfirmButton: false 
        });
    });

    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert;
	
	$.SweetAlert.init();
});