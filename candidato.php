<?php
session_start();
error_reporting(E_ALL);

include ("valida_sesion.php");	
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
      <title>Candidatos AICO</title>
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
			
			require_once("menu.php");
			
			$directorio="archivos/";	
			
			$idUser=0;
			if($idRol!=EnumRol::admin){
				$idUser=$idUsuario;
			}		
							
			$id = 0;
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			} 
			if($id==0 && isset($_POST["idMilitante"]) != ""){
				$id=$_POST["idMilitante"];
			}	
			$idUsu = 0;
			if (isset($_GET['us'])) {
				$idUsu = $_GET['us'];
			} 
			if(($idUsu==0 || $idUsu=='') && $idUser>0){
				$idUsu = $idUser;
			}	
			if(($idUsu==0 || $idUsu=='') && isset($_POST["idUsuMil"]) != ""){
				$idUsu = $_POST["idUsuMil"];
			}	
			$id_tipo=2;		
				
			if(isset($_POST["guardar"])){
				$val=0;
			    if($id==0 || $_POST["numero_identificacion"] != $_POST["usuariosis"]){
					$val=FuncionesDao::ValidarUsuarioSisId($idUsu,$_POST["numero_identificacion"]);
				}
				if($val==0){
					$clave="";
					if(isset($_POST["numero_identificacion"]) && ($idUsu==0 || $_POST["numero_identificacion"] != $_POST["usuariosis"])){
						$clave=Encrypter::Encrypt($_POST["numero_identificacion"]);
					}
					$estado=$_POST["id_estado"];
					if(isset($_POST["estado"])){
						$estado=$_POST["estado"];
					}
					$fecha_aprobacion="";
					if(isset($_POST["fecha_aprobacion"]) != ""){
						$fecha_aprobacion=$_POST["fecha_aprobacion"];
					}
					if($fecha_aprobacion=="" && $_POST["id_estado"]!=$estado && $estado!=1){
						$fecha_aprobacion=date("Y-m-d");
					} 						
					$id_cir=0;					
					if(isset($_POST["id_circunscripcion"]) && $_POST["id_circunscripcion"]!="" && $_POST["id_circunscripcion"]!="0"){
						$id_cir=$_POST["id_circunscripcion"];
					}	
					$idCandidatura="0";
					if(isset($_POST["combo_candidatura"]) && $_POST["combo_candidatura"]!="" && $_POST["combo_candidatura"]!="Seleccione"){
						$idCandidatura=$_POST["combo_candidatura"];
					}
					$idDepartamento="0";
					if(isset($_POST["combo_departamento"]) && $_POST["combo_departamento"]!="" && $_POST["combo_departamento"]!="Seleccione"){
						$idDepartamento=$_POST["combo_departamento"];						
					}	
					$idMunicipio="0";
					if(isset($_POST["combo_municipio"]) && $_POST["combo_municipio"]!="" && $_POST["combo_municipio"]!="Seleccione"){
						$idMunicipio=$_POST["combo_municipio"];
					}
					$idLocalidad="0";
					if(isset($_POST["combo_localidad"]) && $_POST["combo_localidad"]!="" && $_POST["combo_localidad"]!="Seleccione"){
						$idLocalidad=$_POST["combo_localidad"];						
					}
					
					//se actualiza el id de la solicitud en el adjunto
					$idMil=FuncionesDao::GuardarMilitante($id,$idUsu,"",$_POST["tipo_identificacion"],$_POST["numero_identificacion"],$_POST["fecha_identificacion"],$_POST["fecha_nacimiento"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["genero"],$_POST["grupo_etnico"],$_POST["ocupacion"],$_POST["profesion"],$_POST["telefono"],$_POST["celular"],$_POST["correo_electronico"],$_POST["whatsapp"],$_POST["direccion"],$_POST["municipio"],$_POST["lugar_votacion"],$estado,$fecha_aprobacion,$_POST["correo"],$clave,$_POST["usuariosis"],$idRol,$id_tipo,$id_cir,$idCandidatura,$idDepartamento,$idMunicipio,$idLocalidad);
					if($id==0){
						$id=$idMil;
					}	
				
					$adjuntos=$_POST["urlArchivos"];
					if($adjuntos != ""){
						FuncionesDao::ActualizarAdjuntos($id,$adjuntos);
					}		
					if($_POST["estado"] != $_POST["id_estado"] && $_POST["estado"] > 1){
						$exito_email=NotificacionDao::EnviarCorreoSolicitudEstado($_POST["correo_electronico"], $estado);	
					}									
					echo "<script> alert('Se almacenaron los datos correctamente'); window.location.href='candidato.php?id=".$id."&us=".$idUsu."'</script>";												
				}	
				else{
					echo "<script> alert('El numero de identificacion ya se encuentra registrado en el sistema');</script>";
				}			
			}
			$row=FuncionesDao::ConsultarMilitante($id,$idUsu,$id_tipo);	
			$rowa=FuncionesDao::ConsultarAdjuntos($id);
			$counta=count($rowa);
			
			$id_estado=0;
			if($row["id_estado"]!=""){
				$id_estado=$row["id_estado"];
			}				
			if($row["id_tipo_militante"]!=""){
				$id_tipo=$row["id_tipo_militante"];
			}	
			$trash="trash";
			if($id>0){
				$trash="item";
			}
		  	$desc="Candidato";
												  			
		?>
                   
          
         <!-- Right Side Content Start -->
	    <section id="content" class="seipkon-content-wrapper">
            <div class="page-content">
               <div class="container-fluid">   
			     <form id="candidato" class="step-wizard" method="post" action="candidato.php?id=<?=$id?>&us=<?=$idUsu?>">
			    <!-- Form Wizards Row Start -->
                  <div class="row">				  		
                     <div class="col-md-12"> 						 
                        <div class="page-box">
                           <div class="form-example">						    
						      <label> <h4>Información del <?=$desc?></h4> </label>
							   <input id="idMilitante" name="idMilitante" value="<?=$row["id_militante"]?>" type="hidden" />
							   <input id="idUsuMil" name="idUsuMil" value="<?=$row["id_usuario"]?>" type="hidden" />
							   <input id="usuariosis" name="usuariosis" value="<?=$row["usuario"]?>" type="hidden" />
							   <input id="urlArchivos" name="urlArchivos" value="" type="hidden" />
							   <input id="urlUpload" value="endpoint.php?id=<?=$id?>" type="hidden" />
							   <input id="correo" name="correo" value="<?=$row["email"]?>" type="hidden" />
							   <input id="id_estado" name="id_estado" value="<?=$row["id_estado"]?>" type="hidden" />
							   <input id="tipo" name="tipo" value="<?=$id_tipo?>" type="hidden" />
							   <input id="id_circunscripcion" name="id_circunscripcion" value="<?=$row["id_circunscripcion"]?>" type="hidden" /> 
					           <div class="form-wrap">						  		
							       	   <div class="form-group">
											  <div class="row">
												 <div class="col-md-12 col-sm-12">
													<table width="98%" border="1" align="center">	
														<tr>
														   <td width="20%">
															<center><label class="text">Primer Nombre (*)</label></center>
															</td>
															<td width="30%">
															<center><input type="text" id="primer_nombre" name="primer_nombre" value="<?=$row["primer_nombre"]?>" /></center>
															</td>													   
														   <td width="20%">
															<center><label class="text">Segundo Nombre</label></center>
															</td>
															<td width="30%">
															<center><input type="text" id="segundo_nombre" name="segundo_nombre" value="<?=$row["segundo_nombre"]?>" /></center>
															</td>
													    </tr>
														<tr>
														   <td>
															<center><label class="text">Primer Apellido (*)</label></center>
															</td>
															<td>
															<center><input type="text" id="primer_apellido" name="primer_apellido" value="<?=$row["primer_apellido"]?>" /></center>
															</td>													   
														   <td>
															<center><label class="text">Segundo Apellido</label></center>
															</td>
															<td>
															<center><input type="text" id="segundo_apellido" name="segundo_apellido" value="<?=$row["segundo_apellido"]?>" /></center>
															</td>
													    </tr>
														<tr>
														   <td>
															<center><label class="text">Tipo de Identificación (*)</label></center>
															</td>
															<td>
															<center>
															<select name="tipo_identificacion" id="tipo_identificacion">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarTipoRespuestaId(3) as $key => $value) {
																	echo "<option " . (($row["tipo_identificacion"] == $value["valor"]) ? "selected" : "") . " value='" . $value["valor"] . "' > " . $value["descripcion"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>													  
														   <td>
															<center><label class="text">Número de identificación (*)</label></center>
															</td>
															<td>
															<center><input type="text" id="numero_identificacion" name="numero_identificacion" class="soloNumeros" value="<?=$row["numero_identificacion"]?>" <? if($idRol!=EnumRol::admin){ ?> style="background-color:#EAEAEA" readonly="readonly" <? }?> onBlur="validadUsuarios();" /></center>
															<center><div id="result-username" style="width:100%"></div></center>
															</td>
													   </tr>									  
													   <tr>
														   <td>
															<center><label class="text">Fecha Expedición Documento (*)</label></center>
															</td>
															<td>
															<center><input type="text" id="fecha_identificacion" name="fecha_identificacion" class="fecha" value="<?=$row["fecha_identificacion"]?>" /></center>
															</td>
															<td>
															<center><label class="text">Fecha Nacimiento (*)</label></center>
															</td>
															<td>
															<center><input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="fecha" value="<?=$row["fecha_nacimiento"]?>" /></center>
															</td>
													   </tr>	
													   <tr>
														   <td>
															<center><label class="text">Género (*)</label></center>
															</td>
															<td>
															<center>
															<select name="genero" id="genero">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarTipoRespuestaId(2) as $key => $value) {
																	echo "<option " . (($row["genero"] == $value["valor"]) ? "selected" : "") . " value='" . $value["valor"] . "' > " . $value["descripcion"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>													  
														   <td>
															<center><label class="text">Pertenece a algún grupo étnico</label></center>
															</td>
															<td>
															<center>
															<select name="grupo_etnico" id="grupo_etnico">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarTipoRespuestaId(1) as $key => $value) {
																	echo "<option " . (($row["grupo_etnico"] == $value["valor"]) ? "selected" : "") . " value='" . $value["valor"] . "' > " . $value["descripcion"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>
													   </tr>	
													   <tr>
														   <td>
															<center><label class="text">Ocupación</label></center>
															</td>
															<td>
															<center><input type="text" id="ocupacion" name="ocupacion" value="<?=$row["ocupacion"]?>" /></center>
															</td>													   
														   <td>
															<center><label class="text">Profesión</label></center>
															</td>
															<td>
															<center><input type="text" id="profesion" name="profesion" value="<?=$row["profesion"]?>" /></center>
															</td>
													    </tr>	
														 <tr>
														   <td>
															<center><label class="text">Teléfono</label></center>
															</td>
															<td>
															<center><input type="text" id="telefono" name="telefono" class="soloNumeros" value="<?=$row["telefono"]?>" /></center>
															</td>													   
														   <td>
															<center><label class="text">Celular (*)</label></center>
															</td>
															<td>
															<center><input type="text" id="celular" name="celular" class="soloNumeros" value="<?=$row["celular"]?>" /></center>
															</td>
													    </tr>	
														 <tr>
														   <td>
															<center><label class="text">WhatsApp</label></center>
															</td>
															<td>
															<center><input type="text" id="whatsapp" name="whatsapp" class="soloNumeros" value="<?=$row["whatsapp"]?>" /></center>
															</td>													   
														   <td>
															<center><label class="text">Correo Electrónico (*)</label></center>
															</td>
															<td>
															<center><input type="text" id="correo_electronico" name="correo_electronico" value="<?=$row["email"]?>" /></center>
															</td>
													    </tr>	
														<tr>
														   <td>
															<center><label class="text">Dirección de Notificación (*)</label></center>
															</td>
															<td>
															<center><input type="text" id="direccion" name="direccion" value="<?=$row["direccion"]?>" /></center>
															</td>													   
														   <td>
															<center><label class="text">Lugar de Votación</label></center>
															</td>
															<td>
															<center><input type="text" id="lugar_votacion" name="lugar_votacion" value="<?=$row["lugar_votacion"]?>" /></center>
															</td>
													    </tr>	
														<tr>
														   <td>
															<center><label class="text">Departamento Dirección (*)</label></center>
															</td>
															<td>
															<center>
															<select name="departamento" id="departamento">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarDepartamento() as $key => $value) {
																	echo "<option " . (($row["id_departamento"] == $value["id_departamento"]) ? "selected" : "") . " value='" . $value["id_departamento"] . "' > " . $value["nombre"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>													  
														   <td>
															<center><label class="text">Municipio Dirección (*)</label></center>
															</td>
															<td>
															<center>
															<select name="municipio" id="municipio">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarMunicipio($row["id_departamento"]) as $key => $value) {
																	echo "<option " . (($row["id_municipio"] == $value["id_municipio"]) ? "selected" : "") . " value='" . $value["id_municipio"] . "' > " . $value["nombre"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>
													   </tr>
													   <? if($id_tipo==2){ ?>
													    <tr>
															<td colspan="4">
															    <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label>	
														    	<label>Corporación a la que aspira:</label>			
															</td>	
														</tr>
														<tr>
														   <td>
															<center><label class="text">Corporación o Cargo (*)</label></center>
															</td>
															<td>
															<center>
															<select name="combo_candidatura" id="combo_candidatura">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarCandidatura() as $key => $value) {
																	echo "<option " . (($row["id_cnd"] == $value["id_candidatura"]) ? "selected" : "") . " value='" . $value["id_candidatura"] . "' > " . $value["nombre"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>													  
														   <td>
															<center><label class="text">Departamento (*)</label></center>
															</td>
															<td>
															<center>
															<select name="combo_departamento" id="combo_departamento">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarDepartamento() as $key => $value) {
																	echo "<option " . (($row["id_dep"] == $value["id_departamento"]) ? "selected" : "") . " value='" . $value["id_departamento"] . "' > " . $value["nombre"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>	
													   </tr>	
													    <tr>
														    <td>
															<center><label id="lbl_municipio" class="text">Municipio (*)</label></center>
															</td>
															<td>
															<center>
															<select name="combo_municipio" id="combo_municipio">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarMunicipio($row["id_dep"]) as $key => $value) {
																	echo "<option " . (($row["id_mun"] == $value["id_municipio"]) ? "selected" : "") . " value='" . $value["id_municipio"] . "' > " . $value["nombre"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>												  
														   <td>
															<center><label id="lbl_localidad" class="text">Localidad (*)</label></center>
															</td>
															<td>
															<center>
															<select name="combo_localidad" id="combo_localidad">
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarLocalidad($row["id_mun"]) as $key => $value) {
																	echo "<option " . (($row["id_loc"] == $value["id_localidad"]) ? "selected" : "") . " value='" . $value["id_localidad"] . "' > " . $value["nombre"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>
													   </tr>	
													  <? } ?>
													    <tr>
															<td>
																<center> <label>Adjuntar Documentos </label> </center>				
															</td>	
														  <td colspan="3" >		
															 <div id='contenedorArchivo-1' class='contenedorArchivo'>	
																<? 
																if($id_estado==2 || $idRol==EnumRol::admin){ ?>
																<label for=''>Selecciona el(los) archivo(s) a cargar: </label>
																<div id='botonArchivo-1' class='seleccionarArchivo'></div>
																<? } ?>
																<ul id='listaArchivosCargue-1' class='listaArchivosCargue'>
																 <? for($num=0;$num<$counta;$num++){ ?>
																<li><? if($idRol==EnumRol::admin){?> <span class='trash' href='javascript: void(0)' title='Eliminar registro' onclick='return eliminarArchivoDeLista(this,<?=$rowa[$num]["id_adjunto"]?>)'></span> <? } else { ?><span class='item' href='#'></span><? } ?><a href='<?=$directorio.$rowa[$num]["archivo"]?>' class='archivoUploader' data-id='<?=$rowa[$num]["id_adjunto"]?>' target='_bank'><?=$rowa[$num]["nombre_archivo"]?></a>
																</li>
																<? } ?>
																</ul> 																			 			
															</div>	
															</td>
														</tr>	
														<tr>
														   <td>
															<center><label class="text">Estado</label></center>
															</td>
															<td>
															<center>
															<select name="estado" id="estado" <? if($idRol!=EnumRol::admin){ ?> disabled="disabled" <? }?>>
															    <option value='0' >Seleccione</option>
																<?php
																foreach (FuncionesDao::ConsultarEstados() as $key => $value) {
																	echo "<option " . (($row["id_estado"] == $value["id_estado"]) ? "selected" : "") . " value='" . $value["id_estado"] . "' > " . $value["descripcion"] . "</option>";
																}
																?>
															</select>
															</center>
															</td>													  
														   <td>
															<center><label class="text">Fecha Estado</label></center>
															</td>
															<td>
															<center>
															<?
															 $fecha_aprob=$row["fecha_aprobacion"];
															 if($fecha_aprob=="0000-00-00"){
																$fecha_aprob="";
															 }
															 ?>
															<input type="text" id="fecha_aprobacion" name="fecha_aprobacion" value="<?=$fecha_aprob?>" <? if($idRol!=EnumRol::admin){ ?> style="background-color:#EAEAEA" readonly="readonly" <? }?>/>
															</center>
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
					   <? if($id_estado==2 || $idRol==EnumRol::admin){	 ?>
					   <input type="submit" name="guardar" id="guardar" value="" style="background-image:url(iconos/guardar.png); width:115px; height:45px; border:0px;" onClick="return inicializarValidaciones();" />
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
	  <script src="js/validar_candidato.js"></script>	
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