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
      </div> -->
      <!-- End Page Loading -->
       
      <!-- Wrapper Start -->
      <div class="wrapper">
          
         <?php
			require_once("encabezado.php");
				require_once("menu.php");
			
			$id = 0;
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			} 
			if($id==0 && isset($_POST["idUsuario"]) != ""){
				$id=$_POST["idUsuario"];
			}	
			if(isset($_POST["guardar"])){ 
				$clave="";
				if(isset($_POST["clave"])){
					$clave=Encrypter::Encrypt($_POST["clave"]);
				}
				$idUser=FuncionesDao::AdicionarUsuario($id,$_POST["nombre"],$_POST["usuario"],$clave,$_POST["email"],$_POST["activo"],$_POST["bloqueado"],$_POST["combo_rol"]);
				if($id==0){
					$id=$idUser;
				}	
				echo "<script>alert('La información fué guardada con éxito.');</script>";				
			}
			
			$row=FuncionesDao::ConsultarUsuario($id);
				
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
                                 <form id="usuario" class="step-wizard" method="post" action="usuario.php?id=<?=$id?>">								 	
										<div class="datatables-example-heading">
										  <h3>Datos Usuario</h3>
									   </div>
										<div class="form-group">
										  <div class="row">
											 <div class="col-md-9 col-sm-9">
											 	<div class="form-group">
												<input id="idUsuario" name="idUsuario" value="<?=$row["id_usuario"]?>" type="hidden" />		
												<label class="text">Nombre Usuario</label>										
												<input type="text" id="nombre" name="nombre" class="form-control input-lg" placeholder="Nombre Usuario" value="<?=$row["nombre"]?>">										
											</div>
											<div class="form-group">
												<label class="text">Usuario</label>										
												<input type="text" id="usuario"  name="usuario" class="form-control input-lg" placeholder="Usuario" value="<?=$row["usuario"]?>">										
											</div>
											<? if($id == 0){ ?>
											<div class="form-group">
												<label class="text">Clave</label>
												<input type="text" id="clave" name="clave" class="form-control input-lg" placeholder="Clave" value="<?=$row["clave"]?>">										
											</div>
											<? } ?>
											<div class="form-group">
												<label class="text">Correo Electrónico</label>
												<input type="text" id="email" name="email" class="form-control input-lg" placeholder="Correo Electronico" value="<?=$row["email"]?>">										
											</div>
											<div class="form-group">
												<label class="text">Rol</label>
												<select class="form-control input-lg" id="combo_rol" name="combo_rol" style="width:30%">
													<?php
														foreach (FuncionesDao::ConsultarRolUsuario($idRol) as $key => $value) {
														echo "<option " . ((isset($row["id_rol"]) && $row["id_rol"] == $value[0]) ? "selected" : "") . " value='" . $value[0] . "' > " . $value[2] . "</option>";
													}
														?>
												</select>										
											</div>
											<div class="form-group">
												<label class="text">Bloqueado</label>
												<select class="form-control input-lg" id="bloqueado" name="bloqueado" style="width:20%">
													<option <? if($row["bloqueado"] == 1){ ?> selected <? } ?> value="1" style='color:green'>No</option>
													<option <? if($row["bloqueado"] == 2){ ?> selected <? } ?> value="2" style='color:red'>Si</option>										
												</select>										
											</div>
											<div class="form-group">
												<label class="text">Estado</label>
												<select class="form-control input-lg" id="activo" name="activo" style="width:20%">
													<option <? if( $row["activo"] == 1){ ?> selected <? } ?> value="1" style='color:green'>Activo</option>
													<option <? if($row["activo"] == 2){ ?> selected <? } ?> value="2" style='color:red'>Inactivo</option>											
												</select>										
											</div>
											<? if($id > 0){ ?>
											<div class="form-group">
												<label class="text">Fecha Registro</label>
												<input type="text" name="fecha" id="fecha" class="form-control input-lg" readonly="readonly" value="<?=$row["fecha"]?>">	
											</div>	
											<? } ?>
											<br />
											<div class="form-group">
												 <label></label>
												  <input type="submit" name="guardar" id="guardar" value="Guardar Usuario" class="btn btn-success" onClick="return inicializarValidaciones();" />	
												 <a href="usuario.php?id=0" class="btn btn-success">
													Nuevo Usuario <i class="fa fa-plus"></i>
												 </a>
												 <a href="usuarios.php" class="btn btn-success">
													Regresar >>
												 </a>									 
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
	  <script src="js/validar_usuario.js"></script>
   </body>
</html>