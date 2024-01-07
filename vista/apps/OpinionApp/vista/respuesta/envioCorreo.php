<?php

require '../../source/controller/EvidenciaController.php';
require '../../resources/PHPMailer/PHPMailer.php';
require '../../resources/PHPMailer/Exception.php';
require '../../resources/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$idUsuario = $_POST['idUsuario'];
$idOpinion = $_POST['idOpinion'];
$estatus = 1;
$datos = 1;
$clasificacion = $_POST['clasificacion'];
date_default_timezone_set('America/Mexico_City');
$fechaAtendio = date("Y-m-d H:i");
$archivo = '';


$respuesta = str_replace(PHP_EOL,"<br>",$_POST['respuesta']);
$email = $_POST['email'];

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
/*$mail->Username = 'mortiz@museokaluz.org';
$mail->Password = 'xpkomsznkyblswpu';
*/
$mail->Username = 'atencion_opiniones@museokaluz.org';
$mail->Password = 'zsdvsitdfngktdpt';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail ->CharSet = "utf-8";

$mail->setFrom('atencion_opiniones@museokaluz.org','Museo Kaluz');
$mail->addAddress($email, $name);
$mail->Subject = 'Seguimiento a tu opinión sobre el Museo Kaluz';
$mail->isHTML(true);
$mail->Body = '<!DOCTYPE html> <html>
<head>
</head>
<body style="background-color: #ffffff; font-family: Arial, sans-serif;">
   <p>
   	'.$respuesta.'
	<br><br>
   Esperamos darle la bienvenida nuevamente en nuestra próxima actividad la cual puede consultar en el siguiente enlace.
   <br>
   </p>
   <br>
   <a  href="https://museokaluz.org/actividades/"><img src="https://siekaluz.com/sie/vista/apps/OpinionApp/resources/imgCorreo/inferior.jpg" /></a>
   <br><br>
   </body>
</html>';


if (!$mail->send()) {
	echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;
}else{
	//echo "correo enviado correctamente";
   $act = new EvidenciaController();
	echo ($act -> almacenarRespuesta($idOpinion,$respuesta,$archivo,$idUsuario,$fechaAtendio,$estatus,$datos,$clasificacion));
   
}

?>

