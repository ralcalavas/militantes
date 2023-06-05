 <!-- Main Header Start -->
 <header class="main-header">
    <?			
	  include("classes/EnumRolM.php");
	  
	  $user="";
	  if(isset($_SESSION['usuario'])){
		$user=$_SESSION['usuario'];
	  }  
	  $idRol=0;
	  if(isset($_SESSION['id_rol'])){
		$idRol=$_SESSION['id_rol'];
	  } 
	  $idUsuario=0;
	  if(isset($_SESSION['id_usuario'])){
		$idUsuario=$_SESSION['id_usuario'];
	  }
	  ?>
	   <input id="idRol" name="idRol" value="<?=$idRol?>" type="hidden" />
		
	<!-- Logo Start -->
	<div class="sigu-logo">
	   <a href="http://www.movimientodeautoridadesindigenasaico.org">
	   <img src="assets/img/logo.png" alt="logo">
	   </a>
	</div>
	<!-- Logo End -->
	 
	<!-- Header Top Start -->
	<nav class="navbar navbar-default">
	   <div class="container-fluid">
		  <div class="header-top-section">
			 <div class="pull-left">
				 
				<!-- Collapse Menu Btn Start -->
				<button type="button" id="sidebarCollapse" class=" navbar-btn">
				<i class="fa fa-bars"></i>
				</button>
				<!-- Collapse Menu Btn End -->
				 
				<!-- Header Top Search Start -->
				<div class="header-top-search">
				   
					 <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					  Movimiento Autoridades Ind&iacute;genas de Colombia - AICO</p>	
					   <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; 
					  Formulario en L&iacute;nea Solicitud Aval Elecciones 2023</p>				   
				</div>
				<!-- Header Top Search End -->
				 
			 </div>
			 <div class="header-top-right-section pull-right">
				<ul class="nav nav-pills nav-top navbar-right">
					
				   <!-- Full Screen Btn Start -->
				   <li>
					  <a href="#"  id="fullscreen-button">
					  <i class="fa fa-arrows-alt"></i>
					  </a>
				   </li>
				   <!-- Full Screen Btn End -->
					
				   <!-- Profile Toggle Start -->
				   <li class="dropdown">				   	
						 <img src="assets/img/avatar.png" class="profile-avator" alt="admin profile"/>
						 <div class="profile-avatar-txt">
							<p><?=$user?></p>
							<i class="fa fa-angle-down"></i>
						 </div>					 
				   </li>
				   <!-- Profile Toggle End -->					
				</ul>
			 </div>
		  </div>
	   </div>
	</nav>
	<!-- Header Top End -->
	 
 </header>
 <!-- Main Header End -->