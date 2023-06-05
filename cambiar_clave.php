<?php
session_start();
error_reporting(E_ALL);

include ("valida_sesion.php");	
include("classes/FuncionesDao.php");
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
				
			require_once("menu.php");
				
			
			if(isset($_POST["guardar"])){ 		    
				$clave=Encrypter::Encrypt($_POST["nueva"]);
				$actual=Encrypter::Encrypt($_POST["actual"]);
				$id=FuncionesDao::CambiarClave($user,$clave,$actual);
				if($id==1){
					echo "<script>alert('La clave ha sido cambiada correctamente.');</script>";	
				}
				else{
					echo "<script>alert('La clave ha no sido cambiada, verifique la clave actual.');</script>";	
				}					
			}		
				
		?>
                   
          
         <!-- Right Side Content Start -->
	    <section id="content" class="seipkon-content-wrapper">
            <div class="page-content">
               <div class="container-fluid">   
                  <!-- Form Wizards Row Start -->
                  <div class="row">				  		
                     <div class="col-md-12"> 						 
                        <div class="page-box">
                           <div class="form-example">
                              <div class="form-wrap">
                                 <form id="cambiar_clave" class="step-wizard" method="post" action="cambiar_clave.php">								 	
										<div class="datatables-example-heading">
										  <h3>Datos Clave</h3>
									   </div>
										<div class="form-group">
										  <div class="row">
											 <div class="col-md-9 col-sm-9">
											 	<table width="90%" border="0" align="center">
												 <tr><td width="20%">
												<label class="text">Clave Actual</label>
												</td><td>										
												<input type="text" id="actual" name="actual" placeholder="Clave Actual" value="">		
										        </td></tr>
												 <tr><td><br />
												</td></tr>												
												 <tr><td>
												<label class="text">Clave Nueva</label>	
												</td><td>										
												<input type="text" id="nueva"  name="nueva" placeholder="Clave Nueva" value="">
											    </td></tr>
												 <tr><td><br />
												</td></tr>												
												 <tr><td>
												<label class="text">Confirmar Clave</label>
												</td><td>	
												<input type="text" id="confirmar" name="confirmar" placeholder="Confirmar Clave" value="">
												 </td></tr>
												 </table>
											 </div>                                            
										  </div>
									  </div> 
									  <br />
									  <div class="form-group">
										<div class="row">
										 <div class="col-md-9 col-sm-9">
											<center><input type="submit" name="guardar" id="guardar" value="" style="background-image:url(iconos/clave.png); width:191px; height:54px; border:0px;" onClick="return inicializarValidaciones();"/></center>	
										 </div> 
										</div>
									  </div> 
						          </form>
                              </div>
                           </div>
                        </div>
                     </div>					 	
                  </div>
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
      <!-- Select2 JS -->
      <script src="assets/plugins/select2/js/select2.full.js"></script>
      <!-- Color Picker JS -->
      <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
      <!-- Jquery Steps JS -->
      <script src="assets/plugins/jquery-steps/js/jquery.steps.min.js"></script>
      <!-- Jquery parsley JS -->
      <script src="assets/plugins/parsley/js/parsley.min.js"></script>
      <!-- Custom JS -->
      <script src="assets/js/funciones.js"></script>
	  <script src="js/FuncionesJs.js"></script>
	  <script src="js/validar_cambiar_clave.js"></script>
   </body>
</html>