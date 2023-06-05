<?php
error_reporting(E_ALL);
include("classes/FuncionesDao.php");
include('classes/NotificacionDao.php');
include("classes/Encrypter.php");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Title -->
      <title>Militantes AICO</title>
      <!-- Favicon -->
      <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
      <!-- Animate CSS -->
      <link rel="stylesheet" href="assets/css/animate.min.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap.min.css">
      <!-- Font awesome CSS -->
      <link rel="stylesheet" href="assets/plugins/font-awesome/font-awesome.min.css">
      <!-- Themify Icon CSS -->
      <link rel="stylesheet" href="assets/plugins/themify-icons/themify-icons.css">
      <!-- Perfect Scrollbar CSS -->
      <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css">
      <!-- Jvector CSS -->
      <link rel="stylesheet" href="assets/plugins/jvector/css/jquery-jvectormap.css">
      <!-- Daterange CSS -->
      <link rel="stylesheet" href="assets/plugins/daterangepicker/css/daterangepicker.css">
      <!-- Bootstrap-select CSS -->
      <link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css">
      <!-- Summernote CSS -->
      <link rel="stylesheet" href="assets/plugins/summernote/css/summernote.css">
	  <link href="css/bootstrap-datepicker3.min.css" rel="stylesheet">  
      <!-- Main CSS -->
      <link rel="stylesheet" href="assets/css/estilos.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="assets/css/responsive.css">
   </head>
   <body>
       
      <!-- Start Page Loading 
      <div id="loader-wrapper">
         <div id="loader"></div>
         <div class="loader-section section-left"></div>
         <div class="loader-section section-right"></div>
      </div>-->
      <!-- End Page Loading -->
       
      <!-- Wrapper Start -->
      <div class="wrapper">
          
         <?php
			require_once("encabezado.php");
						
		    $estado=0;	
			
			if(isset($_POST["guardar"])){
				$identificacion=$_POST["numero_identificacion"];
			 	$sel=FuncionesDao::ConsultarUsuarioIngreso($identificacion);
				if (mysqli_num_rows($sel) > 0) {
					$row=mysqli_fetch_array($sel);
					$clave=Encrypter::Encrypt($identificacion);	
					FuncionesDao::ReiniciarClave($row["id_usuario"],$clave);				
					$exito_email=NotificacionDao::EnviarCorreoRecordarClave($row["email"],$identificacion,$identificacion);
				}						
				echo "<script> alert('Se ha enviado una clave al correo electrónico registrado, para más información comuníquese con la Organización Política');</script>";
				$estado=1;														
			}	
			
			if(isset($_POST["regresar"])){
				echo "<script>window.location.href='login.php'</script>";				
			}		
										  			
		?>
                   
          
         <!-- Right Side Content Start -->
	    <section id="content" class="seipkon-content-wrapper">
            <div class="page-content">
               <div class="container-fluid">   
			     <form id="recordar_clave" class="step-wizard" method="post" action="recordar_clave.php">
			    <!-- Form Wizards Row Start -->
                  <div class="row">				  		
                     <div class="col-md-12"> 						 
                        <div class="page-box">
                           <div class="form-example">						   
						      <label> <h4>Recordar Clave</h4> </label>							   
							   <div id="result-username"></div>						   
					           <div class="form-wrap">						  		
							       	   <div class="form-group">
											  <div class="row">
												 <div class="col-md-12 col-sm-12">													
													<center><label class="text">Digíte el número de identificación</label></center>
													<center><input type="text" id="numero_identificacion" name="numero_identificacion" class="soloNumeros" value="" /></center>
												 </div>
											  </div>										
									</div>	
                           </div>
                        </div>
                   
					<center> 
					  <div class="col-md-12 col-sm-12">
					   <br />			
					   <center>	
					   <input type="submit" name="guardar" id="guardar" value="Enviar" style="width:115px; height:45px; border:0px; color:#FFFFFF; background-color:#02A0D1" onClick="return inicializarValidaciones();" />
					   <input type="submit" name="regresar" id="regresar" value="Regresar" style="width:115px; height:45px; border:0px; color:#FFFFFF; background-color:#02A0D1" />
					   <? if($estado==1){ ?>
					      <br /> <br />
					   	  <label class="text">Se ha enviado una clave al correo electrónico registrado, para más información comuníquese con la Organización Política</label>
					   <? } ?>
						   </center>						  															  	
					  </div>
					 </center>
                  </div>
				  
				 </form>
                          
                  <!-- End Form Wizards Row -->
                   
                  <!-- Form Wizards Row Start -->
               
                  <!-- End Form Wizards Row -->
               </div>
            </div>
             
           <?php
				require_once("pie.php");			
		  ?>
         </section>
         <!-- End Right Side Content -->
      </div>
      <!-- End Wrapper -->
       
       
      <!-- jQuery -->
	  <script src="assets/js/jquery-3.1.0.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
      <!-- Perfect Scrollbar JS -->
      <script src="assets/plugins/perfect-scrollbar/jquery-perfect-scrollbar.min.js"></script>
      <!-- Toggles JS -->
      <script src="assets/plugins/masked-input/js/jquery.maskedinput.min.js"></script>
      <!-- Jquery Steps JS -->
      <script src="assets/plugins/jquery-steps/js/jquery.steps.min.js"></script>
      <!-- Jquery parsley JS -->
      <script src="assets/plugins/parsley/js/parsley.min.js"></script>
	  <script src="js/jquery.numeric.js" type="text/javascript" ></script>
	  <script src="js/jquery.number.js" type="text/javascript" ></script>
	  <script src="js/jquery.validate.min.js" type="text/javascript" ></script>	  
	  
	   <!-- Daterange JS -->
      <script src="assets/plugins/daterangepicker/js/moment.min.js"></script>
      <script src="assets/plugins/daterangepicker/js/daterangepicker.js"></script>
      <!-- Select2 JS -->
      <script src="assets/plugins/select2/js/select2.full.js"></script>
      <!-- Color Picker JS -->
      <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
      <!-- Jquery Knob JS -->
      <script src="assets/plugins/jquery-knob/js/jquery.knob.min.js"></script>
      <!-- Advance Component Form JS For Only This Page -->
      <script src="assets/js/advance_component_form.js"></script>
      <!-- Custom JS -->
       <script src="js/ajax.js" type="text/javascript"></script>
	  <script src="js/bootstrap-datepicker.min.js"></script>
	  <script src="js/bootstrap-datepicker.es.min.js"></script>
	  <script src="js/fineuploader.min.js" type="text/javascript" ></script>
      <!-- Custom JS -->
      <script src="assets/js/funciones.js"></script>
	  <script src="js/base.js"></script>
	  <script src="js/funciones.js"></script>
	  <script src="js/validar_recordar_clave.js"></script>	 
   </body>
</html>