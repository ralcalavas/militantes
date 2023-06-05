<?php
error_reporting(E_ALL);
include("classes/FuncionesDao.php");
include('classes/NotificacionDao.php');
include("classes/EnumRol.php");
include("classes/Encrypter.php");

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Title -->
      <title>Solicitud Aval AICO</title>
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
      <style type="text/css">
<!--
.Estilo1 {
	color: #000000;
	font-size: 13px;
}
.Estilo3 {font-size: 16px}
.Estilo4 {color: #FF0000}
.Estilo6 {color: #FF0000; font-weight: bold; }
-->
      </style>
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
						
			$directorio="archivos/";	
						
			$id = 0;
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			} 
			if($id==0 && isset($_POST["idMilitante"]) != ""){
				$id=$_POST["idMilitante"];
			}	
			
			$estado = 0;
			if (isset($_GET['est'])) {
				$estado = $_GET['est'];
			} 
			if($id==0 && isset($_POST["estado"]) != ""){
				$estado=$_POST["estado"];
			}	
			
			if(isset($_POST["guardar"])){			 	
				$adjuntos=$_POST["urlArchivos"];
				if($adjuntos != ""){
				    FuncionesDao::ActualizarMilitanteDoc($id,1);
					FuncionesDao::ActualizarAdjuntos($id,$adjuntos);
				}		
										
				echo "<script> alert('Se enviaron los archivos correctamente, para más información comuníquese con la Organización Política'); window.location.href='sdocumentos.php?id=".$id."&est=2'</script>";																			
			}		
			
			if(isset($_POST["enviar"])){
			    $id=FuncionesDao::ConsultarMilitanteNumId($_POST["numero_identificacion"],$_POST["correo_electronico"]);
				if($id>0){			 											
					echo "<script>window.location.href='sdocumentos.php?id=".$id."&est=1'</script>";
				}
				else{
					echo "<script> alert('El numero de identificacion y/o el correo electrónico no se encuentran registrados en el sistema, para más información comuníquese con la Organización Política');</script>";
				}																	
			}			
			
			$row=FuncionesDao::ConsultarMilitanteId($id,2);	
			$rowa=FuncionesDao::ConsultarAdjuntos($id);
			$counta=count($rowa);
															  			
		?>
                   
          
         <!-- Right Side Content Start -->
	    <section id="content" class="seipkon-content-wrapper">
            <div class="page-content">
               <div class="container-fluid">   
			     <form id="sdocumentos" class="step-wizard" method="post" action="sdocumentos.php?id=<?=$id?>">
			       <p>
			         <!-- Form Wizards Row Start -->
		           <div class="row">				  		
			         <div class="col-md-12"> 						 
		           </p>
			     
			       <div class="page-box">
				   
				   <table width="69%" border="1" align="center" cellpadding="1" cellspacing="1">
                     <tr>
                       <td width="62%" height="48" bgcolor="#CCCCCC" class="titulo"><span class="Estilo4">Paso 1: </span> Diligenciar Formulario en línea Solicitud Aval Elecciones 2023</td>
                       <td width="38%" bgcolor="#CCCCCC"> <div align="left"><strong><a href="https://www.movimientodeautoridadesindigenasaico.org/militantes/solicituda.php" target="_blank" class="Estilo4">Clic aquí si no ha realizado el proceso </a></strong></div></td>
                     </tr>
                     <tr>
                       <td height="64" bgcolor="#CCCCCC"><span class="Estilo6">Paso 2:</span> <span class="titulo">Descargue, imprima, diligencie, firme y escaneé los formatos oficiales para solicitud del Aval</span></td>
                       <td bgcolor="#CCCCCC"><div align="left"><span class="Estilo4"><strong><a href="https://www.movimientodeautoridadesindigenasaico.org/wp-content/uploads/2023/05/FORMULARIOS-FINAL-1.pdf" target="_blank">Clic aquí para descargar los formatos oficiales </a></strong></span> </div></td>
                     </tr>
                     <tr>
                       <td height="62" bgcolor="#CCCCCC"><span class="Estilo6">Paso 3: </span><span class="titulo">Cargue los formatos escaneados ingresando los siguientes datos de acceso: </span></td>
                       <td bgcolor="#CCCCCC">&nbsp;</td>
                     </tr>
                   </table>
				   <br><br>
                           <div class="form-example">						    
						     <center> <label> <h4 class="label-bordered-danger"> Cargue de Documentos solicitud Aval</h4></center> 
						      <BR>
						      </label>
							   <input id="idMilitante" name="idMilitante" value="<?=$row["id_militante"]?>" type="hidden" />
							   <input id="id_candidatura" name="id_candidatura" value="<?=$row["id_cnd"]?>" type="hidden" />							   
							   <input id="urlArchivos" name="urlArchivos" value="" type="hidden" />
							   <input id="urlUpload" value="endpoint.php?id=<?=$id?>" type="hidden" />							  
							   <input id="estado" name="estado" value="<?=$val?>" type="hidden" /> 							  
							   <div id="result-username"></div>						   
					           <div class="form-wrap">						  		
							       	   <div class="form-group">
											  <div class="row">
													 <div class="col-md-12 col-sm-12">
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
													<tr>													  
													 <td>
													<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
													     <tr>													  
														   <td width="40%" height="60">
															<center><label class="titulo">Digite el número de identificación registrado (*)</label></center>
														   </td>
															<td width="30%">
															<center><input type="text" id="numero_identificacion" name="numero_identificacion" class="soloNumeros" value="<?=$row["numero_identificacion"]?>" /></center>														
															</td>
															<td colspan="2" rowspan="2" width="30%">
															<label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label>
															<input type="submit" name="enviar" id="enviar" value="Consultar" style="width:115px; height:45px; border:0px; color:#FFFFFF; background-color:#02A0D1" onClick="iniciarCandidatura();" />
															</td>
													   </tr>
													   <tr>		
															<td height="39">
															<center><label class="titulo">Digite el correo electrónico registrado (*)</label></center>
													     </td>
															<td>
															<center><input type="text" id="correo_electronico" name="correo_electronico" style="width:90%" value="<?=$row["email"]?>" /></center>														
															</td>
													   </tr>														  																
													</table>	
													 </td>
													 </tr>
													 <tr>													  
													 <td> 
													 <table id="datos" class="oculto" width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
													    <tr>
															<td colspan="4">															   
														    	<label class="titulo">&nbsp; &nbsp; Información Militante:
														    	</label>			
														   </td>	
														</tr>
														<tr>	
													   <tr>
														   <td width="20%" height="36">
															<center><label class="titulo">Primer Nombre</label>
															</center>
														  </td>
															<td width="31%">
															<center><label class="text" id="primer_nombre"><?=$row["primer_nombre"]?></label></center>
														  </td>													   
														   <td width="23%">
															<center><label class="titulo">Segundo Nombre</label></center>
														  </td>
															<td width="26%">
															<center><label class="text" id="segundo_nombre"><?=$row["segundo_nombre"]?></label></center>
														  </td>
												       </tr>
														<tr>
														   <td height="38">
															<center><label class="titulo">Primer Apellido</label>
															</center>
														  </td>
															<td>
															<center><label class="text" id="primer_apellido"><?=$row["primer_apellido"]?></label></center>
															</td>													   
														   <td>
															<center><label class="titulo">Segundo Apellido</label></center>
														  </td>
															<td>
															<center><label class="text" id="segundo_apellido"><?=$row["segundo_apellido"]?></label></center>
															</td>
													    </tr>											  
														 <tr>
															<td colspan="4">															   
														    	<label class="titulo">&nbsp; &nbsp; Corporación a la que aspira:
														    	</label>			
														   </td>	
														</tr>
														<tr>
														   <td height="60">
															<center><label class="titulo">Corporación o Cargo</label>
															</center>
														  </td>
															<td>
															<center>
																<label class="text" id="candidatura"><?=$row["candidatura"]?></label>
															</center>
															</td>													  
														   <td>
															<center><label class="titulo">Departamento</label></center>
														  </td>
															<td>
															<center>
															<label class="text" id="departamento"><?=$row["departamento"]?></label>
															</center>
															</td>	
													   </tr>	
													    <tr>
														    <td height="40">
															<center><label id="lbl_municipio" class="titulo">Municipio</label></center>
														  </td>
															<td>
															<center>
															<label class="text" id="municipio"><?=$row["municipio"]?></label>
															</center>
															</td>												  
														   <td>
															<center><label id="lbl_localidad" class="titulo">Localidad</label></center>
														  </td>
															<td>
															<center>
															<label class="text" id="localidad"><?=$row["localidad"]?></label>
															</center>
															</td>
													   </tr>
													   <tr>
															<td>
																<center> <label>Adjuntar Documentos *</label> </center>				
															</td>	
														  <td colspan="3">		
															 <div id='contenedorArchivo-1' class='contenedorArchivo'>	
																<? 
																if($estado!=2){ ?>
																<label for=''>Selecciona el(los) archivo(s) a cargar: </label>
																<div id='botonArchivo-1' class='seleccionarArchivo'></div>
																<? } ?>
																<ul id='listaArchivosCargue-1' class='listaArchivosCargue'>
																 <? for($num=0;$num<$counta;$num++){ ?>
																<li><? if($estado!=2){?><span class='trash' href='javascript: void(0)' title='Eliminar registro' onclick='return eliminarArchivoDeLista(this,<?=$rowa[$num]["id_adjunto"]?>)'></span><? } ?><a href='<?=$directorio.$rowa[$num]["archivo"]?>' class='archivoUploader' data-id='<?=$rowa[$num]["id_adjunto"]?>' target='_bank'><?=$rowa[$num]["nombre_archivo"]?></a>
																</li>
																<? } ?>
																</ul> 																			 			
															</div>	
														 </td>
													  </tr>																	
													</table>	
													</td>
													</tr>																	
													</table>												
													<br />												
												 </div>
											  </div>										
									</div>	
                           </div>
                        </div>
                   
					<center> 
					  <div class="col-md-12 col-sm-12">
					   <br />			
					   <center>	
					   <? if($estado!=2){	 ?>
					   <input type="submit" name="guardar" id="guardar" value="Enviar" class="oculto" style="width:115px; height:45px; border:0px; color:#FFFFFF; background-color:#02A0D1" onClick="return inicializarValidaciones();" />
					   <? } else{ ?>
					   	  <label class="titulo">Se enviaron los archivos correctamente, verifique que aparecen todos los documentos (incluyendo cédula de ciudadanía), de lo contrario adjuntelos nuevamemente, para más información comuníquese con la Organización Política</label>
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
	  <script src="js/validar_sdocumentos.js"></script>	
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