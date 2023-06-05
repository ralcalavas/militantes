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
	  
	  <!-- DataTables CSS -->
      <link rel="stylesheet" href="assets/plugins/datatables/css/dataTables.bootstrap.min.css" >
      <link rel="stylesheet" href="assets/plugins/datatables/css/buttons.bootstrap.min.css" >
      <link rel="stylesheet" href="assets/plugins/datatables/css/responsive.bootstrap.min.css" >
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
		
			if(isset($_GET['del']))
			{
			  $id = $_GET['del'];
			  if($id>0){
				FuncionesDao::EliminarUsuario($id);
				echo "<script>alert('La información fué eliminada con éxito.');</script>";	
			  }
			}
						
			$row=FuncionesDao::ConsultarUsuariosSistema($idRol);
				
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
                                 <form id="usuarios" class="step-wizard" method="post" action="usuarios.php">								 	
									<!-- Advance Table Row Start -->									
									   <div class="datatables-example-heading">
										  <h3>Lista Usuarios</h3>
									   </div>
									   <div class="form-group">
										<div class="row">
										 <div class="col-md-9 col-sm-9">
											<a href="usuario.php?id=0" class="btn btn-success">
												Agregar Usuario <i class="fa fa-plus"></i>
											</a>	
										 </div> 
										</div>
									  </div> 							  
									   <div class="table-responsive advance-table">
										  <table id="datatables_example_1" class="table display table-bordered">
											 <thead>
												<tr>								
													<th style="text-align:center">
														 Nombre Usuario
													</th>
													<th style="text-align:center">
														 Usuario
													</th>
													<th style="text-align:center">
														 Rol
													</th>
													<th style="text-align:center">
														 Estado
													</th>
													<th style="text-align:center">
														 Editar
													</th>													
												</tr>
											 </thead>
											 <tbody>
												<?	for($i=0;$i<count($row);$i++){ ?>
												<tr>								
													<td class="center"><?=$row[$i]["nombre"]?></td>
													<td class="center"><?=$row[$i]["usuario"]?></td>
													<td class="center"><?=utf8_decode($row[$i]["descripcion"])?></td>
													<td class="center">
													<? if($row[$i]["activo"] == 1){ ?>
													<span class='label label-success'>Activo</span>
													<? } else{ ?>
													<span class='label label-danger'>Inactivo</span>
													<? } ?>
													</td>
													<td class="center"><a href="usuario.php?id=<?=$row[$i]["id_usuario"]?>"><img style="width:20px" src="assets/edit.png"></img></td>												
												</tr>
											<? } ?>										
											 </tbody>
										  </table>
									</div>
								  <!-- End Advance Table Row -->
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
	  
	  <!-- Datatables -->
      <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
      <script src="assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
      <script src="assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
      <script src="assets/plugins/datatables/js/buttons.bootstrap.min.js"></script>
      <script src="assets/plugins/datatables/js/buttons.flash.min.js"></script>
      <script src="assets/plugins/datatables/js/buttons.html5.min.js"></script>
      <script src="assets/plugins/datatables/js/buttons.print.min.js"></script>
      <script src="assets/plugins/datatables/js/dataTables.responsive.min.js"></script>
      <script src="assets/plugins/datatables/js/responsive.bootstrap.min.js"></script>
      <script src="assets/plugins/datatables/js/jszip.min.js"></script>
      <script src="assets/plugins/datatables/js/pdfmake.min.js"></script>
      <script src="assets/plugins/datatables/js/vfs_fonts.js"></script>
      <!-- Form Wizard Custom JS For Only This Page -->
      <script src="assets/js/advance_table_custom.js"></script>
	  
      <!-- Custom JS -->
      <script src="assets/js/funciones.js"></script>
	  <script src="js/FuncionesJs.js"></script>
   </body>
</html>