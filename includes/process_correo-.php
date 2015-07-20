<?php 
if(strtoupper($_REQUEST["captcha"]) == $_SESSION["captcha"]){
// REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
$_SESSION["captcha"] = md5(rand()*time());
// INSERTA EL CﾓDIGO EXITOSO AQUI
require("classes/class.phpmailer.php");
$nombreapellido =$_POST['nombreapellido'];
$telefono= $_POST['telefono'];
$email= $_POST['email'];
$mensaje =$_POST['mensaje'];

$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
</style>
</head>
<body>';
$msg .="<p><strong>De: </strong>$nombreapellido</p>";
$msg .="<p><strong>Telefono: </strong>$telefono</p>";
$msg .="<p><strong>email: </strong>$email</p>";
$msg .="<p><strong>Mensaje: </strong></p><p>$mensaje</p>";
$msg .='</body>
</html>';

/* ----------------------------------------------------  */   
$mail = new PHPMailer();
$mail->Host = "localhost";
$mail->From = "contacto_web@cmlobos.com.ar";
$mail->FromName = "Web cmlobos.com.ar";
$mail->Subject = "Contacto desde cmlobos.com.ar";
$mail->AddAddress("hubermann@gmail.com","info@hubermann.com");
$mail->AddBCC("poloinfinity@gmail.com");
$mail->Body = $msg;
$mail->AltBody = $message2;
$mail->IsHTML(true);
$mail->Send();
echo '<p>Mensaje enviado</p>';

}else{
// REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
$_SESSION["captcha"] = md5(rand()*time());
// INSERTA EL CﾓDIGO DE ERROR AQUﾍ
echo '<p>Mensaje no enviado, Captcha invalido</p>';
}









?>