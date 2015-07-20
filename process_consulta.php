<?php session_start(); ob_start();
date_default_timezone_set('America/Buenos_Aires');
$id_usuario = $_SESSION['MM_IdUsuario'];

//si tiene session le permito enviar consulta, sino lo envio a la recalcada pagina de consultas again.
if($_SESSION['MM_IdUsuario']){
	$asunto = $_POST['strAsunto'];
	$mensaje = $_POST['strCampo'];
	
	
	include_once("includes/class.usuarios.php");
	$user_info= new usuarios();
	$user_info->select($_SESSION['MM_IdUsuario']);
	$nombre_usuario = $user_info->getstrNombre();
	$apellido_usuario = $user_info->getstrApellido();
	$email_usuario = $user_info->getstrEmail();
	$empresa_usuario = $user_info->getstrEmpresa();

	
	
	/* INSERT */
	include_once("includes/class.consultas.php");
	$consultas= new consultas();
	$consultas->idUsuario=$id_usuario;
	$consultas->strAsunto=$asunto;
	$consultas->strCampo=$mensaje;
	$consultas->fecha=date("Y-m-d H:i:s");
	$consultas->respondido=0;
	$consultas->tipo=1; //enviado desde usuario
	$consultas->insert();
	
	//envio email
	$finalizado=0;
	require("classes/PHPMailerAutoload.php");



	$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	</head>
	<body>';
	$msg .="<p><strong>Consulta: </strong>$asunto</p>";
	$msg .="<p><strong>Mensaje: </strong>$mensaje</p>";
	$msg .="<p><br>Usuario: ".$nombre_usuario." ".$apellido_usuario.", <a href=\"mailto:$email_usuario\">".$email_usuario."</a> - Empresa: ".$empresa_usuario."</p>";

	$msg .='</body>
	</html>';


	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.productosnufarm.com.ar';  				  // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'mknet@productosnufarm.com.ar';               // SMTP username
	$mail->Password = 'pnu1243';               // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

	/*
	$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'jswan';                            // SMTP username
	$mail->Password = 'secret';                           // SMTP password
	$mail->SMTPSecure = 'tls';
	*/

	$mail->From = 'mknet@productosnufarm.com.ar';
	$mail->FromName = 'Nombre visible de quien llega';
	$mail->addAddress('estudio@dot175.com', '--');  // Add a recipient
	// Name is optional
	#$mail->addReplyTo('hubermann@gmail.com', 'Information');
	#$mail->addCC('cc@example.com');
	#$mail->addBCC('bcc@example.com');

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'MarketingNet [System Alert]';
	$mail->Body    = $msg;
	#$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	   $msg_error =  'El mensaje no pudo ser enviado!.';
	   #$msg_error =  'Mailer Error: ' . $mail->ErrorInfo;
	   #exit;
	
	$_SESSION['mensaje'] =$msg_error;

	}

	$_SESSION['mensaje'] = 'Mensaje enviado';



	header("location: mi_cuenta.php?activo=2&del=1");
	
}else{
	header("Location: /");
}

?>