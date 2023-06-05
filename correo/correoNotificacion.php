<?php
require 'PHPMailer/PHPMailerAutoload.php';
$repositorio = new correoNotificacion;
$repositorio -> enviarNotificacionDenuncia(1,"ayesgb@gmail.com");

class correoNotificacion{
    public function enviarNotificacionDenuncia($idDenuncia, $para){
        date_default_timezone_set('Etc/UTC');
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "info.soporte.arcortes@gmail.com";
        $mail->Password = "octubre31";
        $mail->setFrom('info.soporte.arcortes@gmail.com', 'Notificación Monitor Corrupción');
        $mail->addAddress($para);
        $mail->Subject = 'Nueva alerta de denuncia';
        $html= "Señor administrador, <br/><br/> Se ha generado una nueva denuncia, con el código de seguimiento número <b>".$idDenuncia."</b>.<br/><br/>
        Para conocer más detalles, por favor ingrese al monitor de corrupción, sección denucias.<br/><br/>Cordialmente,<br/><br/><b>Notificaciones Monitor de Corrupción</b>";
        $htmlNo= "Señor administrador, Se ha generado una nueva denuncia, con el código de seguimiento número ".$idDenuncia.".
        Para conocer mas detalles, por favor ingrese al monitor de corrupción, sección denuncias.";
        $mail->msgHTML($html);
        $mail->AltBody = $htmlNo;
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
}
?>