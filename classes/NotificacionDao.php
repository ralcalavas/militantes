<?php
 error_reporting(E_ERROR);
require("phpMailerv5/PHPMailerAutoload.php");

class NotificacionDao {
	const usuarionot = "militantes@movimientodeautoridadesindigenasaico.org";
	const clave = "LImi21*co";
	const servidor = "smtp.hostinger.co";
	const puerto = 587;
	const nombre = "Movimiento de Autoridades Indígenas de Colombia";
	
	function EnviarCorreoSolicitud($email, $identificacion, $nombre, $fecha){
	  	$exito="ok";
	    try {		
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls"; 		
			$mail->Host = self::servidor; 
			$mail->Username = self::usuarionot;
			$mail->Password = self::clave;
			$mail->Port = self::puerto;
			$mail->From = self::usuarionot;
			$mail->FromName = self::nombre;
			$mail->CharSet = 'UTF-8';
			$mail->Debugoutput = 'html';
			$mail->SMTPDebug = 0;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->AddAddress($email);
			$mail->IsHTML(true);
			$mail->Subject = "Nueva solicitud de afiliación recibida ".$identificacion; // Este es el titulo del email.
			$body = "Se ha recibido una nueva solicitud de afiliación con la siguiente información: <br /><br />";
			$body .= "Fecha: ".$fecha."<br /><br />";
			$body .= "Número identificación: ".$identificacion."<br /><br />";
			$body .= "Nombre: ".$nombre."<br /><br />";
			$body .= "Por favor ingrese al panel de control para consultar la información de la solicitud de afiliación en el siguiente enlace: <a href='http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php'> http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php</a>";
					
			$mail->Body = $body; // Mensaje a enviar	
			
		if(!$mail->send()) {
      	 $exito=$mail->ErrorInfo;
		}else{
			$exito="enviado";
		}
				
		} catch (Exception $e) {
			$exito=$mail->ErrorInfo;
		}
		
		return $exito;
	}	
	
	function EnviarCorreoSolicitudEstado($email, $estado){
	   $exito="ok";
	     try {
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls"; 		
			$mail->Host = self::servidor; 
			$mail->Username = self::usuarionot;
			$mail->Password = self::clave;
			$mail->Port = self::puerto;
			$mail->From = self::usuarionot;
			$mail->FromName = self::nombre;
			$mail->CharSet = 'UTF-8';
			$mail->Debugoutput = 'html';
			$mail->SMTPDebug = 0;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->AddAddress($email);
			$mail->IsHTML(true);
			$asunto = "Solicitud aceptada";
			if($estado == 3){
				$asunto = "Solicitud rechazada"; // Este es el titulo del email.
			}
			$mail->Subject = $asunto;
			$body = "";
			if($estado == 3){			
				$body = "Su solicitud de afiliación ha sido rechazada: <br /><br />";
				$body .= "Para más información comuníquese con la Organización Política";
			}
			else{	
				$body = "Su solicitud de afiliación ha sido aceptada: <br /><br />";			
				$body .= "Para más información ingrese a su perfil en el siguiente enlace: <a href='http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php'> http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php</a>";	
			}
			$mail->Body = $body; // Mensaje a enviar	
			
		if(!$mail->send()) {
      	 $exito=$mail->ErrorInfo;
		}else{
			$exito="enviado";
		}
				
		} catch (Exception $e) {
			$exito=$mail->ErrorInfo;
		}
		
		return $exito;
	}	
	
	function EnviarCorreoRecordarClave($email, $identificacion, $clave){
	   $exito="ok";
	     try {
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls"; 		
			$mail->Host = self::servidor; 
			$mail->Username = self::usuarionot;
			$mail->Password = self::clave;
			$mail->Port = self::puerto;
			$mail->From = self::usuarionot;
			$mail->FromName = self::nombre;
			$mail->CharSet = 'UTF-8';
			$mail->Debugoutput = 'html';
			$mail->SMTPDebug = 0;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->AddAddress($email);
			$mail->IsHTML(true);			
			$mail->Subject = "Recordar Clave";
			$body = "Su clave ha sido reiniciada: <br /><br />";
			$body .= "Número identificación: ".$identificacion."<br /><br />";
			$body .= "Clave: ".$clave."<br /><br />";		
			$body .= "Ingrese a su perfil en el siguiente enlace: <a href='http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php'> http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php</a><br />";	
			$body .= "Para más información comuníquese con la Organización Política";		
			$mail->Body = $body; // Mensaje a enviar	
			
		if(!$mail->send()) {
      	 $exito=$mail->ErrorInfo;
		}else{
			$exito="enviado";
		}
				
		} catch (Exception $e) {
			$exito=$mail->ErrorInfo;
		}
		
		return $exito;
	}	
	
	function EnviarCorreoSolicitudAval($email, $identificacion, $nombre, $fecha, $candidatura, $circunscripcion){
	  	$exito="ok";
	    try {		
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls"; 		
			$mail->Host = self::servidor; 
			$mail->Username = self::usuarionot;
			$mail->Password = self::clave;
			$mail->Port = self::puerto;
			$mail->From = self::usuarionot;
			$mail->FromName = self::nombre;
			$mail->CharSet = 'UTF-8';
			$mail->Debugoutput = 'html';
			$mail->SMTPDebug = 0;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->AddAddress($email);
			//$mail->AddBCC("ayesgb@gmail.com");			
			$mail->IsHTML(true);
			$mail->Subject = "Nueva solicitud de aval ".$identificacion; // Este es el titulo del email.
			$body = "Se ha recibido una nueva solicitud de afiliación con la siguiente información: <br /><br />";
			$body .= "Fecha: ".$fecha."<br /><br />";
			$body .= "Número identificación: ".$identificacion."<br /><br />";
			$body .= "Nombre: ".$nombre."<br /><br />";
			$body .= "Corporación o Cargo: ".$candidatura."<br /><br />";
			$body .= "Circunscripción: ".$circunscripcion."<br /><br />";
			$body .= "Descargue, diligencie y firme los formatos oficiales requeridos haciendo clic en el siguiente enlace: <a href='https://www.movimientodeautoridadesindigenasaico.org/wp-content/uploads/2023/05/FORMULARIOS-FINAL-1.pdf'> https://www.movimientodeautoridadesindigenasaico.org/wp-content/uploads/2023/05/FORMULARIOS-FINAL-1.pdf</a><br /><br />";
			$body .= "Una vez imprima, diligencie, firme y escanee los formatos oficiales por favor ingrese a la web para completar la solicitud de aval donde debe adjuntar la documentación requerida haciendo clic en el siguiente enlace: <a href='https://www.movimientodeautoridadesindigenasaico.org/militantes/sdocumentos.php'> https://www.movimientodeautoridadesindigenasaico.org/militantes/sdocumentos.php</a>";
					
			$mail->Body = $body; // Mensaje a enviar	
			
		if(!$mail->send()) {
      	 $exito=$mail->ErrorInfo;
		}else{
			$exito="enviado";
		}
				
		} catch (Exception $e) {
			$exito=$mail->ErrorInfo;
		}
		
		return $exito;
	}	
		
	function EnviarCorreoPrueba($email){
	     $exito="ok";
	     try {
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls"; 		
			$mail->Host = self::servidor; 
			$mail->Username = self::usuarionot;
			$mail->Password = self::clave;
			$mail->Port = self::puerto;
			$mail->From = self::usuarionot;
			$mail->FromName = self::nombre;
			$mail->CharSet = 'UTF-8';
			$mail->Debugoutput = 'html';
			$mail->SMTPDebug = 0;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->AddAddress($email);
			$mail->IsHTML(true);
			$mail->Subject = "Nueva solicitud prueba"; // Este es el titulo del email.
			$body = "Se le ha asignado una nueva solicitud con la siguiente información: <br /><br />";
			$body .= "Por favor ingrese al panel de control para consultar la información de la solicitud asignada en el siguiente enlace: <a href='http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php'> http://www.movimientodeautoridadesindigenasaico.org/militantes/login.php</a>";
					
			$mail->Body = $body; // Mensaje a enviar	
			//$exito=$mail->Send(); // Envía el correo.
		
		if(!$mail->send()) {
      	 $exito=$mail->ErrorInfo;
		}else{
			$exito="enviado";
		}
				
		} catch (Exception $e) {
			$exito=$mail->ErrorInfo;
		}
		
		return $exito;
	}	
}
?>