<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
	
	include_once("includes/class.carrito.php");
	$carrito= new carrito();
	$resultado = $carrito->select_by_user($_SESSION["MM_IdUsuario"],$tipoDePago, ObtenerIVA());
	
		

}
?>





<?php include("includes/header.php"); ?>
<div id="menu">
 <div class="link"><p><a href="index.php">Inicio</a></p></div>
             <div class="link-activo"><p><a href="canjes.php">Canjes</a></p></div>
              <div class="link"><p><a href="mi_cuenta.php">Mi Cuenta</a></p></div>
                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>
 </ul>
</div>
<div id="buscador"></div>
</nav>
<section>
<aside>
<?php include("includes/catalogo.php") ?>
</aside>
<article>
<div class="bar-green2"><h4>CANJES REALIZADOS.</h4></div>
<div class="finalcompra">
<?php  
	
	echo $resultado;
	
	
?>
 </div>
  </article>
</section>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
