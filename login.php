<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
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
      <!-- Main CSS -->
      <link rel="stylesheet" href="assets/css/estilos.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="assets/css/responsive.css">
   </head>
   <body class="body_white_bg">
       
      <!-- Start Page Loading 
      <div id="loader-wrapper">
         <div id="loader"></div>
         <div class="loader-section section-left"></div>
         <div class="loader-section section-right"></div>
      </div>-->
      <!-- End Page Loading -->
       
      <!-- Login Page Header Area Start -->
      <div class="seipkon-login-page-header-area">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-4 col-sm-4">
                 
               </div>
               <div class="col-md-8 col-sm-8">
                 
               </div>
            </div>
         </div>
      </div>
      <!-- Login Page Header Area End -->
       
      <!-- Login Form Start -->
   <div class="sigumv-login-form-area">
         <div class="container-fluid">
           <div class="row">
             <div class="col-md-4 col-md-offset-4">
               <div class="login-form-box"><img src="assets/img/fondo_login1.png">
                 <form class="login-form" action="login.php" method="post">
					<?php		
						include("classes/FuncionesDao.php");
						include("classes/Encrypter.php");			
					
						$error = $_REQUEST['error'];
						if($error > 0){
							$mensaje="";
							if($error == 1 || $error == 2){
								$mensaje="El usuario no existe o la contraseña es inválida.";
							}
							else if($error == 3){
								$mensaje="El usuario se encuentra inactivo.";
							}
							else if($error == 4){
								$mensaje="El usuario se encuentra bloqueado.";
							}
							echo "<script>alert('".$mensaje."'); </script>";
						?>		
							<label style="color:#BD2424"><?=$mensaje?></label>	
							<br />	
						<?		
						}
						
						if (isset($_POST["enviar"])) {   
							$clave= Encrypter::Encrypt($_POST["password"]);
							$usuario=$_POST["username"];
							$sel = FuncionesDao::ConsultarUsuarioIngreso($usuario);
							$error=0;
							$count=mysqli_num_rows($sel);
							
							if ($count > 0) {
								$row=mysqli_fetch_array($sel);       
								//se valida la informacion
								if($row["clave"] != $clave)
								{
									$error = 2;
								}
								else if($row["activo"] == 2)
								{
									$error = 3;
								}
								else if($row["bloqueado"] == 2)
								{
									$error = 4;
								}
											
								//si existe error se debe aumentar el contador
								if($error == 2 && $row["bloqueado"] == 1){
								   FuncionesDao::ActualizarUsuarioIntentos($usuario,$row["clave_errada"]);
								}
								else if($error == 0 && $row["clave_errada"] > 0){
									FuncionesDao::ActualizarUsuarioIngreso($usuario);	
								}
							}	
							else{
								$error = 1;
							}	
							//si no existe error
							if ($error == 0) {	
								@session_start();
								$_SESSION["usuario"] = $row["usuario"];
								$_SESSION["id_usuario"] = $row["id_usuario"]; 
								$_SESSION["id_rol"] = $row["id_rol"];  
								echo " <script>window.location.href='index.php';</script>";			
							}
							else{
								echo " <script>window.location.href='login.php?error=".$error."';</script>";
							}	
						}	
						?>
					Digite Usuario:
                     <div class="form-group">
                       <input name="username" type="text" class="form-control" placeholder="Usuario" required >
                     </div>	
                     Digite Clave:
                     <div class="form-group">
                       <input name="password" type="password" class="form-control" placeholder="Clave" required >
                     </div>                    
                     <div class="form-group">
                       <div class="row">
                         <div class="col-md-12">
                           <div class="form-layout-submit">
                             <button type="submit" name="enviar" >Ingresar</button>
                           </div>
						   <div class="form-layout-submit">
                             <a href="solicitud.php?id=0&us=0" class="btn btn-success">Si no tiene usuario asignado Regístrese aquí</a>
							&nbsp; 
							<a href="recordar_clave.php" class="btn btn-success">Olvidó su clave?</a>
							<br><br>
                           </div>
                         </div>						 
                       </div>
                     </div>					 
                 </form>
               </div>
             </div>
           </div>
         </div>
	  <footer class="umv-footer-area">
	    <p></p>
           
         </footer>
     </div>
      <!-- Login Form End -->
       
      <!-- jQuery -->
      <script src="assets/js/jquery-3.1.0.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
      <!-- Perfect Scrollbar JS -->
      <script src="assets/plugins/perfect-scrollbar/jquery-perfect-scrollbar.min.js"></script>
      <!-- Custom JS -->
      <script src="assets/js/funciones.js"></script>
   </body>
</html>