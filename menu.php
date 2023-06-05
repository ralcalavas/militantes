
<!-- Sidebar Start -->
 <aside class="seipkon-main-sidebar">
	<nav id="sidebar">
	   <!-- Sidebar Profile Start -->
	   
	   <!-- Sidebar Profile End -->
		
	   <!-- Menu Section Start -->
	  
	   <!-- Menu Section End -->
		
	   <!-- Menu Section Start -->
	   <div class="menu-section">
	   <br />
	    <ul class="list-unstyled components">
		   	<? if($idRol==EnumRolM::admin){ ?>		
		     <li>
				<a href="usuarios.php">
				<i class="fa fa-users"></i>
				Usuarios
				</a>				
			 </li>
		   <? } ?>			 		 
			  <li>
				<a href="militantes.php">
				<i class="fa fa-address-book"></i>
				Militantes
				</a>				
			 </li>	
			 <li>
				<a href="candidatos.php">
				<i class="fa fa-address-book"></i>
				Candidatos
				</a>				
			 </li>		
			 <li>
				<a href="cambiar_clave.php">
				<i class="fa fa-user-plus"></i>
			   Cambiar Clave
				</a>			
			 </li>	
			 <? if($idRol==EnumRolM::admin){ ?>		
			  <li>
				<a href="reportes.php?id=1">
				<i class="fa fa-download"></i>
			   Reporte Militantes
				</a>			
			 </li>
			 <li>
				<a href="reportes.php?id=2">
				<i class="fa fa-download"></i>
			   Reporte Candidatos
				</a>			
			 </li>
			 <li>
				<a href="reportes.php?id=3">
				<i class="fa fa-download"></i>
			   Reporte CNE
				</a>			
			 </li>					
			 <? } ?>		 
			 <li>
				<a href="logout.php">
				<i class="fa fa-sign-in"></i>
			   Salir
				</a>			
			 </li>
		  </ul>
	   </div>
	   <!-- Menu Section End -->
		
	   <!-- Menu Section Start -->
	  
	   <!-- Menu Section End -->
		
	</nav>
 </aside>
 <!-- End Sidebar -->