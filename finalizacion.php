<?php
if (!isset($_SESSION)) {
  session_start();
}



$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";


// require_once('QueryConstants.php');
// require_once('PDOConfig.php');
// require_once('TempStock.php'); 
require_once('libs.php'); 
require_once('includes/class.compras.php');

$checkVencimiento = new TempStock();
$can = $checkVencimiento->fechaVencimiento($_SESSION['MM_IdUsuario']);
if($can):
	header('Location: index.php?activo=1');
	exit();
endif;



// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>

<?php require_once('Connections/conexion.php'); ?>

<?php if ($_POST["radio"]==2)
{
	#ConfirmacionPago($_POST["radio"]);
	


}


//este checkout y mensaje ponerlo dentro de la confirmacion!

$checkout = TRUE;
$msg_final = '
<h3>Selecciona el metodo de pago</h3>
 <p>Medios de pago:</p>
 <h3>Finalizacion de pago</h3>
 <p>Pago por transferencia Bancaria</p>
 <strong>Enviar un Email con la certificación de tu pago a correo@mail.com o a este Nro de cuenta XXXXXXXXXXXXX</strong>
 
 ';
 
 
//Aqui comienza el proceso posterior al pago, si existe la como TRUE la variable checkout se realiza la tarea de ingresar pago a la tabla, descontar credito del usuario, etc.
 
if($checkout){
	
	//HAY PAGO REALIZADO
	$tipoDePago = 2; //cambiar el valor a los medios de pagos posibles. puede pasarse el valor directamente a la clase en su llamado de la funcion.
	
	require_once("includes/class.carrito.php");
	$carrito= new carrito();
	$resultado = $carrito->select_by_user($_SESSION["MM_IdUsuario"],$tipoDePago, ObtenerIVA());
	
	
	#informacion del usuario
	

	require_once("includes/class.usuarios.php");
	$dtuser = new usuarios();
	$dtuser->select($_SESSION["MM_IdUsuario"]);
	$nombre_user = $dtuser->getstrNombre();
	$apellido_user = $dtuser->getstrApellido();
	$empresa_user = $dtuser->getstrEmpresa();
	$email_user = $dtuser->getstrEmail();
	

	$info_usuario = '
				<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa"><strong>Cliente: </strong>'.$nombre_user.', '.$apellido_user.' | <strong>Empresa:</strong>'.$empresa_user.'<br>
	<br /><strong>Fecha:</strong>'.date('d-m-Y').'<br />

</td>
    <td width="4">&nbsp;</td>
  </tr>
	

	';
	
	if($resultado!=""){
		#envio correo al admin
		require("classes/PHPMailerAutoload.php");
		$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<style type="text/css">
			body { font-family:verdana;
			font-size: 12px;
			}
			
			A.btn-micuenta77 SPAN {
				width: 200px;
				height: 19px;
				color: #8e3289;
				font-weight: bold;
				background-image: url(http://www.productosnufarm.com.ar/imagenes/bg-sidebar-08.png);
				background-repeat: repeat-x;
				background-position: 0px -4px;
				background-size: 103% 122%;
				margin: 40px  0px 29px 0px;
				padding: 0px 10px 14px 10px;
				display: block;
				line-height: 37px;
				float: left;
				text-align: center;
				text-transform: uppercase;
				box-shadow: 0px 0px 8px #ccc;
				cursor: pointer;
				font-size: 12px;
				text-decoration: none;
				display:none;
			}
			.purchase_end{
				font-weight: bold;
			}
			.miniatura {
			font-size: 9px;
			margin-top: 60px;
			}
			.miniatura img{
				margin-top: -3px;
				margin-right: 5px;
			}

			.purchase {
			width: 100%;
			float: left;
			padding: 23px 0px 23px 0px;
			border-bottom: 1px solid #eee;
			border-top: 1px solid #eee;
			height: 18px;
			}
			.purchase span {
			margin: 10px 26px 10px 0px;
			font-size: 13px;
			}
			.purchase_end {
				font-weight: bold;
				text-transform: uppercase;
				font-size: 15px;
				color: #008b3a;
			}


			.finalizado {
			display: none;
			}


		</style>
		</head>
		<body>';
		$msg .=$info_usuario;
		$msg .=
		
	'<tr>
    <td height="39">&nbsp;</td>
    <td>'.$resultado.'</td>
    <td>&nbsp;</td>
    </tr>';
		
		
		$msg .='
		  <tr>
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>
		</body>
		</html>';
		
		
		$mail = new PHPMailer;
	
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.productosnufarm.com';  // Specify main and backup server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'mknet@productosnufarm.com';                            // SMTP username
		$mail->Password = 'mkn1243';                           // SMTP password
		$mail->SMTPSecure = 'tls';                              // Enable encryption, 
		$mail->From = 'mknet@productosnufarm.com';
		$mail->FromName = 'MarketingNet ';
		// $mail->addAddress('mknet@productosnufarm.com', '--');
		$mail->addAddress('ezequiel@dot175.com', '--');
		 // $mail->addAddress('facundo@dot175.com', '--');		// Add a recipient
		$mail->addBCC($email_user, '--');
		$mail->isHTML(true);                                  // Set email format to 
		
		$mail->Subject = $enviado_desde.'Mknet site - Canje realizado.';
		$mail->Body    = $msg;
		
		
		$mail->send();	
	}	

}


header('location: confirmacion-carrito.php');
exit();
?>
<?php include("includes/header.php"); ?>

<section>
<?php $activo = $_GET['activo']; include("includes/menu.php"); ?>
<div class="gp"></div>	
    <aside class="animated bounce">
      <?php include("includes/catalogo_micuenta.php"); ?>
    </aside>
<article>

<div class="inicio">
<?php  
	
	echo $resultado;
	
	
?>
 </div><?php include("includes/footer.php"); ?>  
 </div> </div>
  </article>
 
</section>
</body>
</html>
