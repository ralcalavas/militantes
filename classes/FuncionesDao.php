<?php

include("Conexion.php");
include("EnumRolF.php");
		
class FuncionesDao {

	//consulta el usuario
	public static function ConsultarUsuarioIngreso($usuario){
		
		//select tipo_formulario
		$sql =  "select u.* from usuario u where u.usuario='$usuario'";		
				
		$sel = Conexion::EjecutarSQL($sql);
	   
	   return $sel;
	}	
	
	//consulta el usuario
	public static function ConsultarClaveIngreso($clave){
		
		//select tipo_formulario
		$sql =  "select u.* from usuario u where u.usuario='' and u.clave='$clave'";		
				
		$sel = Conexion::EjecutarSQL($sql);
	   
	   return $sel;
	}	
	
	//consulta el usuario
	public static function ConsultarUsuarios(){
		
		//select tipo_formulario
		$sql =  "select u.*, r.nombre rol_nombre from usuario u inner join rol r on u.id_rol=r.id_rol where 1";		
				
		$sel = Conexion::EjecutarSQL($sql);
	   
	   return $sel;
	}	
		
	//consulta el usuario
	public static function ConsultarUsuariosRol($idRol){
		
		//select tipo_formulario
		$sql =  "select u.*, r.nombre rol_nombre, r.descripcion from usuario u inner join rol r on u.id_rol=r.id_rol where 1";	
				
		$sel = Conexion::EjecutarSQL($sql);
	   
	   return $sel;
	}	
	
	//consulta el usuario
	public static function ConsultarUsuariosSistema($idRol){
		
		//select tipo_formulario
		$sql =  "select u.*, r.nombre rol_nombre, r.descripcion from usuario u inner join rol r on u.id_rol=r.id_rol where u.id_rol<>".EnumRolF::admin;	
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	}	
		
	//consulta el usuario
	public static function ConsultarUsuario($id){
		
		//select tipo_formulario
		$sql =  "select u.* from usuario u where u.id_usuario=$id";		
				
		$sel = Conexion::EjecutarDB($sql);
	   
	   return $sel;
	}	
	
	//consulta el usuario
	public static function ConsultarUsuariosSis($id){
		
		//select tipo_formulario
		$sql =  "select u.* from usuario u where usuario='$id'";		
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	}	
	
	public static function ConsultarUsuariosSisId($id,$usuario){
		
		//select tipo_formulario
		$sql =  "select u.* from usuario u where usuario='$usuario' and id_usuario<>'$id'";		
		if($id>0){
			$sql=$sql." and id_usuario<>'$id'";	
		}		
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	}	
	
	//consulta los roles
	public static function ConsultarRoles(){
		
		//select departamento
		$sql = "select * from rol where 1 order by id_rol desc";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	
	}
	
	//consulta los roles
	public static function ConsultarRol($idRol){
		
		//select departamento
		$sql = "select * from rol where 1 ";
		
		$sql = $sql."order by nombre";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	
	}
	
	//consulta los roles
	public static function ConsultarRolUsuario($idRol){
		
		//select departamento
		$sql = "select * from rol where id_rol <> ".EnumRolF::usuario." order by nombre";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	
	}
	
	//consulta el usuario
	public static function ConsultarUsuariosxRol($idRol){
		
		//select tipo_formulario
		$sql =  "select u.*, r.nombre rol_nombre from usuario u inner join rol r on u.id_rol=r.id_rol where u.id_rol = $idRol";	
			
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	}	
					
	//actualiza los intentos o bloquea el usuario el usuario
	public static function ActualizarUsuarioIntentos($usuario,$intentos){
		//si existe error se debe aumentar el contador y si es mayor a 5 bloquear
		$intentos=$intentos+1;
		$sql = "update usuario set clave_errada='".$intentos."'";		
		if($intentos > 5){
			$sql=$sql.", bloqueado='2'";	
		}
		$sql=$sql." where usuario='".$usuario."'";
		Conexion::Ejecutar($sql);						
	}
	
	//actualiza los intentos o bloquea el usuario el usuario
	public static function ActualizarUsuarioIngreso($usuario){
		//Se actualiza el usuario intentos a cero
		$sql = "update usuario set clave_errada='0' where usuario='".$usuario."'";
		Conexion::Ejecutar($sql);						
	}
	
	//actualiza los intentos o bloquea el usuario el usuario
	public static function CambiarClave($usuario,$clave,$actual){
		//si existe error se debe aumentar el contador y si es mayor a 5 bloquear
		$val=0;
		$sel=self::ConsultarUsuarioIngreso($usuario);
		$row=mysqli_fetch_array($sel);
		if($row["clave"]==$actual){
			$sql = "update usuario set clave='".$clave."' where id_usuario=".$row["id_usuario"];
			Conexion::Ejecutar($sql);	
			$val=1;
		}
		return $val;					
	}
	
	//actualiza los intentos o bloquea el usuario el usuario
	public static function ReiniciarClave($usuario,$clave){
		$sql = "update usuario set clave='".$clave."' where id_usuario=".$row["id_usuario"];
		Conexion::Ejecutar($sql);						
	}
	
	//guarda la informacion del usuario
	public static function AdicionarUsuario($id,$nombre,$usuario,$clave,$email,$activo,$bloqueado,$id_rol){
	
	   if($id > 0){
	   		//Se actualiza la información del usuario
			$sql = "update usuario set nombre='$nombre', email='$email', activo=$activo, bloqueado=$bloqueado, id_rol=$id_rol where id_usuario=$id";
			Conexion::Ejecutar($sql);
		}
		else{
		    $fecha=date("Y-m-d H:i:s");
			//Se adiciona la información del usuario
			$sql = "insert into usuario (nombre, usuario, clave, email, activo, bloqueado, id_rol, clave_errada, fecha) values ('$nombre', '$usuario', '$clave', '$email', $activo, $bloqueado, $id_rol, 0, '$fecha')";
			$id=Conexion::InsertarDB($sql);			
		}	
		return $id;				
	}
	
	//guarda la informacion del usuario
	public static function ActualizarUsuario($id,$nombre,$usuario,$email,$clave,$id_rol,$idRol){
	
	   if($id > 0){
	   	    if($idRol==EnumRolF::admin){
				//Se actualiza la información del usuario
				$sql = "update usuario set nombre='$nombre', email='$email', usuario='$usuario', clave='$clave' where id_usuario=$id";				
			}
			else{
	   			//Se actualiza la información del usuario
				$sql = "update usuario set nombre='$nombre', email='$email' where id_usuario=$id";
			}	
			Conexion::Ejecutar($sql);
		}
		else{
		    $fecha=date("Y-m-d H:i:s");
			//Se adiciona la información del usuario
			$sql = "insert into usuario (nombre, usuario, clave, email, activo, bloqueado, id_rol, clave_errada, fecha) values ('$nombre', '$usuario', '$clave', '$email', 1, 1, $id_rol, 0, '$fecha')";
			$id=Conexion::InsertarDB($sql);			
		}	
		return $id;				
	}
					
	//elimina el usuario
	public static function EliminarUsuario($id){
		//Se elimina el usuario
		$sql = "delete from usuario where id_usuario=$id";
		Conexion::Ejecutar($sql);						
	}
	
	//elimina la militante
	public static function EliminarMilitante($id){		
		$row=self::ConsultarMilitante($id,0,0);
		//Se elimina la militante		
		$sql = "delete from militante where id_militante=$id";
		Conexion::Ejecutar($sql);
		$identificacion=$row["numero_identificacion"];	
		$sql = "delete from militante_cir where numero_identificacion='$identificacion'";
		Conexion::Ejecutar($sql);	
		
		self::EliminarUsuario($row["id_usuario"]);
		self::EliminarAdjuntos($id);
	}
	
	public static function ObtenerNombreArchivo($archivo,$periodo,$tipo) {
		$nombre_doc="";
		$ext=explode(".",$archivo);
		//se obtiene el nombre del archivo	
		$count=count($ext);
		while($count>1){
			$nombre_doc=$ext[count($ext)-$count];
			$count--;
		}			
		$nombre_ext=$ext[$count];
		//se genera nombre
		$ext=explode("_",$nombre_doc);
		$nombre=$ext[0];
		if(count($ext) > 1){
			for($count=1;$count<(count($ext)-1);$count++){
				$nombre=$nombre."_".$ext[$count];				
			}			
			if(!is_numeric($ext[$count])){
				$nombre=$nombre."_".$ext[$count];	
			}
			else if($tipo==0){
			 	$nombre=$nombre."_".$ext[$count];	
			}			
		}	
		/*if($tipo>0){
			if(strrpos($nombre, $periodo) === false){
				$nombre=$nombre."_".$periodo.".".$nombre_ext;
			}
			else{
				$nombre=$nombre.".".$nombre_ext;
			}	
	    }
		else{*/
			$nombre=$nombre.".".$nombre_ext;
		//}
		return $nombre;
	}	
	
	public static function ObtenerMes($id) {
		$nombre="";
	    if($id==1){
		 $nombre="ENERO";
		}
		else if($id==2){
		 $nombre="FEBRERO";
		}
		else if($id==3){
		 $nombre="MARZO";
		}
		else if($id==4){
		 $nombre="ABRIL";
		}
		else if($id==5){
		 $nombre="MAYO";
		}
		else if($id==6){
		 $nombre="JUNIO";
		}
		else if($id==7){
		 $nombre="JULIO";
		}
		else if($id==8){
		 $nombre="AGOSTO";
		}
		else if($id==8){
		 $nombre="SEPTIEMBRE";
		}
		else if($id==10){
		 $nombre="OCTUBRE";
		}
		else if($id==11){
		 $nombre="NOVIEMBRE";
		}
		else if($id==12){
		 $nombre="DICIEMBRE";
		}
		return $nombre;
	}	
		
	public static function LimpiarCaracteresEspeciales($string) {
		$string = trim(utf8_decode($string));
	
		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);
	
		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);
	
		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);
	
		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);
	
		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);
		
		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);		
		
		$string = str_replace(' ', '_',	$string);
			
		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("\\", "¨", "º", "*", "~",
				 "#", "@", "|", "!", "\"",
				  "$", "%", "&", "/",
				 "(", ")", "?", "'", "¡",
				 "¿", "[", "^", "`", "]",
				 "+", "}", "{", "¨", "´",
				 ">", "<", ";", ",", ":"),
			'',
			$string
		);
	
		return $string;
	}
	
	public static function LimpiarCaracteresEspecialesNom($string) {
	 	$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);
	
		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);
	
		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);
	
		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);
	
		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);
	
		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C'),
			$string
		);
		
	   
		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = preg_replace('([^A-Za-z0-9 /.-_()/])', '', $string);
		
		return $string;
	}


	public static function  DownloadFile($archivo, $downloadfilename = null) { 
		if (file_exists($archivo)) {
			$downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $downloadfilename);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public static ');
			header('Content-Length: ' . filesize($archivo));
	 
			ob_clean();
			flush();
			readfile($archivo);
			exit;
		}     
	}
	
	 public static function ObtenerCeldaXls($col,$fila) {
	    $num=64;
		$num=$num+$col;
		$letra=chr($num);
	    $nombre=$letra.$fila;	    
		return $nombre;
	}	
	
	public static function ObtenerCeldaXlsC($col,$fila) {
	    $num=64;
		if($col<=26){
			$num=$num+$col;
			$letra=chr($num);
			$nombre=$letra.$fila;	 
		}
		else{
			$val1=$col/26;
			$val2=intval($val1);
			if($val1==$val2){
				$val2--;
			}
			$num1=$num+$val2;
			$num2=$num+($col-(26*$val2));
			$letrac=chr($num1);
			$letra=chr($num2);			
			$nombre=$letrac.$letra.$fila;	 
		}	      
		return $nombre;
	}	
	
	public static function ObtenerCeldasXls($col,$fila) {
	    $numIni=64;	   
		$num=$numIni+$col;
		$letra=chr($num);
	    $nombre=$letra.$fila;	
		$num=$numIni+($col+1);
		$letra=chr($num);  
		$nombre=$nombre.":".$letra.$fila;	  
		return $nombre;
	}	
	public static function ObtenerCeldasXlsC($col,$fila) {
	    $letra=self::ObtenerCeldaXlsC($col,$fila);
		$col++;
		$letrac=self::ObtenerCeldaXlsC($col,$fila);
		$nombre=$letra.":".$letrac;  
		return $nombre;		
	}	
	
	//consulta los sectores
	public static function ConsultarCandidatura(){
		
		//select departamento
		$sql = "select * from candidatura where 1 order by nombre";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;	
	}
		
	//consulta los sectores
	public static function ConsultarDepartamento(){
		
		//select departamento
		$sql = "select * from departamento where 1 order by nombre";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;	
	}
	
	//consulta los municipios
	public static function ConsultarMunicipio($id){
		
		//select departamento
		$sql = "select * from municipio where id_departamento='$id' order by nombre";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;	
	}
	
	//consulta las localidades
	public static function ConsultarLocalidad($id){
		
		//select departamento
		$sql = "select * from localidad where id_municipio='$id' order by nombre";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;	
	}
	
	//consulta la circunscripcion
	public static function ConsultarCircunscripcion($idCandidatura,$idDepartamento,$idMunicipio,$idLocalidad){
		
		//select departamento
		$sql = "select * from circunscripcion where id_candidatura='$idCandidatura' and id_departamento='$idDepartamento' and id_municipio='$idMunicipio' and id_localidad='$idLocalidad'";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   	$id=0;
	   	if(count($sel)>0){
	   	 	$id=$sel[0]["id_circunscripcion"];
	   	}
	  	 return $id;	
	}
	
	//consulta la circunscripcion
	public static function GuardarMilitanteNombre($numero_identificacion,$nombre){
	   $sql = "insert into militante_cir (numero_identificacion, nombre) values ('$numero_identificacion','$nombre')";
		Conexion::InsertarDB($sql);	
	}
		
	//consulta los sectores
	public static function ConsultarEstados(){
		
		//select departamento
		$sql = "select * from estado where 1 order by descripcion";
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;	
	}
			
	public static function ConsultarTipoRespuesta(){
		
		$sql =  "select * from tipo_respuesta where 1";	
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	}	
	
	public static function ConsultarTipoRespuestaId($id){
		
		$sql =  "select * from tipo_respuesta where id_tipo_pregunta=$id";	
				
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	}	
		
	//guarda la militante
	public static function GuardarMilitante($id,$id_usuario,$desc_cnd,$tipo_identificacion,$numero_identificacion,$fecha_identificacion,$fecha_nacimiento,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$genero,$grupo_etnico,$ocupacion,$profesion,$telefono,$celular,$email,$whatsapp,$direccion,$id_municipio,$lugar_votacion,$id_estado,$fecha_aprobacion,$correo,$clave,$usuario,$idRol,$tipo,$desc_cir,$id_cnd,$id_dep,$id_mun,$id_loc){	
	    //si el usuario no existe o cambia el email
		if($id_usuario==0 || $email != $correo || $numero_identificacion != $usuario){
		    $nombre=$primer_nombre." ".$primer_apellido;
	   		$id_usuario=self::ActualizarUsuario($id_usuario,$nombre,$numero_identificacion,$email,$clave,EnumRolF::usuario,$idRol);
		}
		if($id > 0){
	   		//Se actualiza la información de la militante
			$sql = "update militante set tipo_identificacion='$tipo_identificacion', numero_identificacion='$numero_identificacion', fecha_identificacion='$fecha_identificacion', fecha_nacimiento='$fecha_nacimiento', primer_nombre='$primer_nombre', segundo_nombre='$segundo_nombre', primer_apellido='$primer_apellido', segundo_apellido='$segundo_apellido', genero='$genero', grupo_etnico='$grupo_etnico', ocupacion='$ocupacion', profesion='$profesion', telefono='$telefono', celular='$celular', whatsapp='$whatsapp', direccion='$direccion', id_municipio='$id_municipio', lugar_votacion='$lugar_votacion', id_estado='$id_estado', fecha_aprobacion='$fecha_aprobacion', id_cnd='$id_cnd', id_dep='$id_dep', id_mun='$id_mun', id_loc='$id_loc' where id_militante=$id";
			Conexion::Ejecutar($sql);
		}
		else{
		   /* if($id_cnd==0 || $id_dep=="0"){
			  $sql = "select * from militante_cir where numero_identificacion='$numero_identificacion' order by id_militante desc";
			  $row=Conexion::EjecutarArray($sql);
			  if(count($row)>0){
				  if($row[0]["numero_identificacion"]!=""){
					$id_cnd=$row[0]["id_cnd"];
					$id_dep=$row[0]["id_dep"];
					$id_mun=$row[0]["id_mun"];
					$id_loc=$row[0]["id_loc"];
				  }
			  }
			}*/
			$sql = "insert into militante (id_usuario, tipo_identificacion, numero_identificacion, fecha_identificacion, fecha_nacimiento, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, genero, grupo_etnico, ocupacion, profesion, telefono, celular, whatsapp, direccion, id_municipio, lugar_votacion, id_estado, fecha_aprobacion, activo, desc_cnd, desc_cir, id_tipo_militante, id_cnd, id_dep, id_mun, id_loc) values ('$id_usuario', '$tipo_identificacion', '$numero_identificacion', '$fecha_identificacion', '$fecha_nacimiento', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$genero', '$grupo_etnico', '$ocupacion', '$profesion', '$telefono', '$celular', '$whatsapp', '$direccion', '$id_municipio', '$lugar_votacion', '$id_estado', '$fecha_aprobacion', '1', '$desc_cnd', '$desc_cir', '$tipo', '$id_cnd', '$id_dep', '$id_mun', '$id_loc')";
			$id=Conexion::InsertarDB($sql);	
		}	
		
		return $id;					
	}
	
	//guarda la militante
	public static function ActualizarMilitanteDoc($id,$completo){		  
		//Se actualiza la información de la militante
		$sql = "update militante set completo='$completo' where id_militante=$id";
		Conexion::Ejecutar($sql);								
	}
	
		
	//valida que la clave no exista en el sistema
	public static function ValidarClaveUsuario($clave){
		$sql =  "select * from usuario where usuario='' and clave='$clave'";				
		$row = Conexion::EjecutarArray($sql);
		
		$val=1;
		if(count($row) > 0){
			$val=0;
		}
		
		return $val;
	}
	
	//consulta militantes
	public static function ConsultarMilitantes($id,$tipo){
		
		$sql =  "select u.usuario, u.email, u.fecha, m.*, e.descripcion, tm.descripcion as descripcion_mil from militante m inner join usuario u on m.id_usuario=u.id_usuario inner join estado e on m.id_estado=e.id_estado left join tipo_militante tm on m.id_tipo_militante=tm.id_tipo_militante where 1 ";	
		if($tipo==2){
			$sql =  "select u.usuario, u.email, u.fecha, m.*, e.descripcion, tm.descripcion as descripcion_mil, ca.nombre as candidatura, de.nombre as departamento, mu.nombre as municipio, l.nombre as localidad from militante m inner join usuario u on m.id_usuario=u.id_usuario inner join estado e on m.id_estado=e.id_estado left join tipo_militante tm on m.id_tipo_militante=tm.id_tipo_militante left join candidatura ca on m.id_cnd=ca.id_candidatura left join departamento de on m.id_dep=de.id_departamento left join municipio mu on m.id_mun=mu.id_municipio left join localidad l on m.id_loc=l.id_localidad where 1 ";
		}
		if($id>0){
			$sql =  $sql."and u.id_usuario=$id ";	
		}
		if($tipo>0){		
			$sql =  $sql." and m.id_tipo_militante=$tipo ";	
		}	
		$sql =  $sql."order by u.fecha desc, u.usuario";	
				
		$sel = Conexion::EjecutarArray($sql);
	   
	    return $sel;
	}	
	
	//consulta militantes
	public static function ConsultarMilitantesReporte($id,$fini,$ffin){
		
		$sql =  "select u.usuario, u.email, u.fecha, m.*, e.descripcion, mun.nombre as municipio_direccion, d.nombre as departamento_direccion, mun.id_departamento, tm.descripcion as tipo_militante from militante m inner join usuario u on m.id_usuario=u.id_usuario inner join estado e on m.id_estado=e.id_estado left join municipio mun on m.id_municipio=mun.id_municipio left join departamento d on m.id_municipio=mun.id_municipio and mun.id_departamento=d.id_departamento left join tipo_militante tm on m.id_tipo_militante=tm.id_tipo_militante where 1";
	    if($id==2){
			$sql =  "select u.usuario, u.email, u.fecha, m.*, e.descripcion, mun.nombre as municipio_direccion, d.nombre as departamento_direccion, mun.id_departamento, tm.descripcion as tipo_militante, ca.nombre as candidatura, de.nombre as departamento, mu.nombre as municipio, l.nombre as localidad from militante m inner join usuario u on m.id_usuario=u.id_usuario inner join estado e on m.id_estado=e.id_estado left join municipio mun on m.id_municipio=mun.id_municipio left join departamento d on m.id_municipio=mun.id_municipio and mun.id_departamento=d.id_departamento left join tipo_militante tm on m.id_tipo_militante=tm.id_tipo_militante left join candidatura ca on m.id_cnd=ca.id_candidatura left join departamento de on m.id_dep=de.id_departamento left join municipio mu on m.id_mun=mu.id_municipio left join localidad l on m.id_loc=l.id_localidad where 1";
		}					
		if($fini != ""){
			$sql = $sql . " and u.fecha >= '$fini'";
		}      
		if($ffin != ""){
			$sql = $sql . " and u.fecha <= '$ffin'";
		}  
		if($id == 3){
			$sql = $sql . " and m.id_estado = 2";
		} 
		else{
			$sql = $sql . " and m.id_tipo_militante = '$id'";
		}  
		$sql = $sql . " order by u.fecha desc, u.usuario";							
		
		$sel = Conexion::EjecutarArray($sql);
	   
	   return $sel;
	}	
	
	//consulta militantes
	public static function ConsultarMilitante($id,$usuario,$tipo){
		if($id==0 && $usuario==0){
			$sql =  "select u.usuario, u.email, u.fecha, m.*, mun.id_departamento from militante m inner join usuario u on m.id_usuario=u.id_usuario left join municipio mun on m.id_municipio=mun.id_municipio where m.id_militante=0";					
		}
		else{
			$sql =  "select u.usuario, u.email, u.fecha, m.*, mun.id_departamento from militante m inner join usuario u on m.id_usuario=u.id_usuario left join municipio mun on m.id_municipio=mun.id_municipio where 1";
			if($id>0){		
				$sql =  $sql." and m.id_militante=$id";	
			}	
			if($usuario>0){		
				$sql =  $sql." and m.id_usuario=$usuario";	
			}	
		}
		
		if($tipo>0){		
			$sql =  $sql." and m.id_tipo_militante=$tipo";	
		}	
			
		$sel = Conexion::EjecutarDB($sql);
	   
	   return $sel;
	}		
	
	//consulta militantes
	public static function ConsultarMilitanteId($id,$tipo){
	  	$sql = "select m.*, u.email from militante m inner join usuario u on m.id_usuario=u.id_usuario where m.id_militante='$id'";		
		if($tipo==2){	
			$sql = "select m.*, u.email, ca.nombre as candidatura, d.nombre as departamento, mu.nombre as municipio, l.nombre as localidad from militante m inner join usuario u on m.id_usuario=u.id_usuario left join candidatura ca on m.id_cnd=ca.id_candidatura left join departamento d on m.id_dep=d.id_departamento left join municipio mu on m.id_mun=mu.id_municipio left join localidad l on m.id_loc=l.id_localidad where m.id_militante='$id'";	
		}
		if($tipo>0){		
			$sql =  $sql." and m.id_tipo_militante=$tipo";	
		}	
		$sel = Conexion::EjecutarDB($sql);
	   
	   return $sel;
	}	
	
	
	//consulta militantes
	public static function ConsultarMilitanteNumId($id,$email){
		$sql =  "select m.* from militante m inner join usuario u on m.id_usuario=u.id_usuario where m.numero_identificacion='$id' and u.email='$email'";	
		$sel = Conexion::EjecutarDB($sql);
	   
	   return $sel["id_militante"];
	}		
	
	//guarda la informacion de la circunscripcion
	public static function AdicionarCircunscripcion($idCandidatura,$idDepartamento,$idMunicipio,$idLocalidad){	
	    $idCir=self::ConsultarCircunscripcion($idCandidatura,$idDepartamento,$idMunicipio,$idLocalidad);
		if($idCir>0){
			$id=$idCir;
		}
		else{
			//Se adiciona la información de la circunscripcion
			$sql = "insert into circunscripcion (id_circunscripcion, id_candidatura, id_departamento, id_municipio, id_localidad) values ('', '$idCandidatura', '$idDepartamento', '$idMunicipio', '$idLocalidad')";
			$id=Conexion::InsertarDB($sql);	
		}		
		return $id;	
	}
	public static function ConsultarNombreCandidatura($id){		
		//select lista
		$sql = "select * from candidatura where id_candidatura = '$id'";		
		$row = Conexion::EjecutarArray($sql);
		
		$nombre="";
	   	if(count($row)>0){
	   	 	$nombre=$row[0]["nombre"];
	   	}	  	
	    return $nombre;	
	}	
	
	public static function ConsultarNombreCircunscripcion($id_dep,$id_mun,$id_loc){	
	    //departamento	
		$sql = "select * from departamento where id_departamento = '$id_dep'";		
		$rowd = Conexion::EjecutarArray($sql);		
		$nombre="";
	   	if(count($rowd)>0){
	   	 	$nombre=$rowd[0]["nombre"];
	   	}	 
		//municipio	
		$sql = "select * from municipio where id_municipio = '$id_mun'";		
		$rowm = Conexion::EjecutarArray($sql);		
	   	if(count($rowm)>0){
	   	 	$nombre=$nombre." - ".$rowm[0]["nombre"];
	   	}	
		//localidad	
		$sql = "select * from localidad where id_localidad = '$id_loc'";		
		$rowl = Conexion::EjecutarArray($sql);		
	   	if(count($rowl)>0){
	   	 	$nombre=$nombre." - ".$rowl[0]["nombre"];
	   	}	  		 	
	    return $nombre;	
	}	
			
	//consulta la solicitud por id
	public static function ConsultarAdjuntos($id){		
		//select lista		
		$sql = "select * from adjunto where id_militante=$id and $id > 0";			
		$row = Conexion::EjecutarArray($sql);						
			   
	    return $row;	
	}	
	
	//consulta la solicitud por id
	public static function ConsultarAdjunto($id){		
		//select lista		
		$sql = "select * from adjunto where id_adjunto=$id";			
		$row = Conexion::EjecutarDB($sql);						
			   
	    return $row;	
	}	
	
	//guarda la informacion del adjunto
	public static function AdicionarAdjunto($id,$nombre,$archivo){	   
	    //Se adiciona la información del archivo
		$sql = "insert into adjunto (id_militante, archivo, nombre_archivo) values ('$id', '$archivo', '$nombre')";
		$idVal=Conexion::InsertarDB($sql);			
		return $idVal;	
	}
	
	//se actualiza el id de la solicitud en el adjunto
	public static function ActualizarAdjuntos($id,$adjuntos){	
	    $archivos=explode(",",$adjuntos);	
		for($i=0;$i<count($archivos);$i++){
			$idAdjunto=$archivos[$i];
			 //Se actualiza la información del archivo
			$sql = "update adjunto set id_militante='$id' where id_adjunto = '$idAdjunto' and id_militante = 0";
			Conexion::EjecutarSQL($sql);		
		}		   
	}
	
	//consulta la solicitud por id
	public static function EliminarAdjunto($id){		
		//select lista		
		$sql = "delete from adjunto where id_adjunto='$id'";			
		Conexion::EjecutarSql($sql);	
	}	

	function EliminaAdjunto($id){

		$sql="delete from adjunto where id_adjunto='$id'";
		Conexion::EjecutarSQL($sql);	
	
	}
	
	public static function EliminarAdjuntos($id){		
		//select lista		
		$sql = "delete from adjunto where id_militante='$id'";			
		Conexion::EjecutarSql($sql);	
	}	
	
	//consulta el usuario
	public static function ValidarUsuario($usuario){
	   $row=FuncionesDao::ConsultarUsuariosSis($usuario);		
	   return count($row);
	}	
	public static function ValidarUsuarioSisId($id,$usuario){
	   $row=FuncionesDao::ConsultarUsuariosSisId($id,$usuario);		
	   return count($row);
	}	
	
	//consulta la solicitud por id
	public static function ConsultarReporte($id){		
		//select lista		
		$sql = "select * from reporte where tipo=$id order by id_reporte";			
		$row = Conexion::EjecutarArray($sql);						
			   
	    return $row;	
	}	
}
?>