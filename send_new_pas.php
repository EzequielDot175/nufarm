<?php
require('Connections/conexion.php');
$newpassword = isset($_POST['newpass'])? $_POST['newpass']:'';
$entrykey = isset($_GET['entrykey'])? $_GET['entrykey']:'';
$emailconfirmado = isset($_GET['emailconfirmation'])? $_GET['emailconfirmation']:'';
$strEmail=isset($_POST['strEmail'])? $_POST['strEmail']:'';
if(!$entrykey)
	{


				$sql="Select * FROM usuarios WHERE strEmail='$strEmail' ";
				$consulta=mysql_query($sql,$conexion);
				$campo=mysql_fetch_array($consulta);
				$emailbase = $campo['strEmail'];
				if($emailbase)
				{
										$sql2="UPDATE usuarios SET entrykey=1 WHERE strEmail='$strEmail'";
										mysql_query($sql2,$conexion);
										
										$fecha=date("d/m/Y H:I");
										$headers .= "MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: no-reply@nufarm.com\nReply-To: no-reply@nufarm.com \nX-Mailer: PHP/". phpversion();
										$subject.= "recuperacion de contraseña Marketing Net";
										$content='
											  <html>
											  <head>
											  <meta charset="UTF-8">
<style type="text/css">
body {

}
body {
font-family:"verdana";
	font-size: 13px;
}
.miniatura {
	font-size: 10px;
}
.BOLD {
	font-weight: bold;
	margin-bottom: -20px;
	padding-bottom: -20px;
	font-size: 12px;
}
hr{
	background-color:#eee !important;
	color:#eee !important;
	height: 0px;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #eee;
	border-right-color: #eee;
	border-bottom-color: #eee;
	border-left-color: #eee;
}
.total {
	font-weight: bold;
	color: #099642;
}
.emmpresa {
	font-size: 18px;
}
.td{
	font-size: 12px;
}
</style>
										</head>
												<body>

												<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.nufarm-maxx.com/marketingNet/imagenes/marketingnet-mail_rp.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
    <tr>
    <td height="39">&nbsp;</td>
    <td>Este mail es generado automaticamente por el sistema de nufarm-maxx.com</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td>Si usted solicitó reestablecer su contraseña haga click en el siguiente<a href="http://www.nufarm-maxx.com/marketingNet/reset_password.php?entrykey=1&emailconfirmation='.$strEmail.'">link</a>
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">No responder a esta direccion de e-mail.</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>
												
												
												

												
												</body>
											  </html>';

											

									   if(mail($strEmail,$subject,$content,$headers)){
										  header("Location: login.php?res=Correo enviado con éxito, revise su cuenta de correo: $strEmail ");
										}
										else
										{
										  header("Location: login.php?res='error en la recuperacion del password");
										}
				}else
				{
				header("Location: login.php?res=Su cuenta de correo no existe.");
				}
  }
  if ($entrykey==1)
  {
		$sql="UPDATE usuarios SET password='$newpassword' WHERE entrykey=1 AND email1='$emailconfirmado'";
		mysql_query($sql,$conexion);
		$sql2="UPDATE usuarios SET entrykey=0 WHERE email1='$emailconfirmado'";
		mysql_query($sql,$conexion);
		header("Location: login.php?res=password modificado exitosamente");
  }
?>