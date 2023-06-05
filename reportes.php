<?php
session_start();
error_reporting(E_ALL);

include ("valida_sesion.php");	
include("classes/FuncionesDao.php");

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Title -->
      <title>Reportes AICO</title>
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
      </div> -->
      <!-- End Page Loading -->
       
      <!-- Wrapper Start -->
      <div class="wrapper">
          
         <?php
			require_once("encabezado.php");				
			require_once("menu.php");	
			
			$id = 1;
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			} 
			if($id==0 && isset($_POST["idReporte"]) != ""){
				$id=$_POST["idReporte"];
			}	
			
			$nombre="Militantes";	
			if($id==2){
				$nombre="Canidatos";	
			}	
			else if($id==3){
				$nombre="CNE";	
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
						    <label> <h4>Reporte <?=$nombre?></h4> </label>
							<input id="idReporte" name="idReporte" value="<?=$id?>" type="hidden" />
							<br /> <br /> <br />
                              <div class="form-wrap">
                                 <form id="reportes" class="step-wizard" method="post" action="reportes.php?id=<?=$id?>">
									<div class="form-wrap">						  		
							       	   	<div class="form-group">
											  <div class="row">
													 <div class="col-md-12 col-sm-12">
													 	<div class="form-group">
															<label>Fecha Inicial</label>	&nbsp; 									
															<input type="text" id="fecha_ini" name="fecha_ini" class="fecha" value="">	
															&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
															<label>Fecha Final</label>	&nbsp; 									
															<input type="text" id="fecha_fin" name="fecha_fin" class="fecha" value="">											
														</div>
														<br />
														<div class="btn-group">											
															<input type="submit" name="generar" id="generar" value="Generar Reporte" style="width:115px; height:45px; border:0px; color:#FFFFFF; background-color:#02A0D1" onClick="return exportar(<?=$id?>);" />
														</div>
													 </div>
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
	  <script src="js/validar_reporte.js"></script>	
	  <script>
		$(".fecha").datepicker({
			format:  'yyyy-mm-dd',
			language: "es",
			orientation: "auto",
			todayHighlight: true,
			clearBtn: true
		});	
	</script>  
   </body>
</html>