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
<?php include("includes/header.php"); ?>
<nav></nav>
<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
 <h3>Selecciona el metodo de pago</h3>
 <p>Medios de pago:</p>
 <form name="form1" method="post" action="finalizacion.php">
   <p>
     <input name="radio" type="radio" id="radio" value="1" checked="CHECKED">
     <label for="radio"></label>
     PayPal
   </p>
   <p>
     <input type="radio" name="radio" id="radio2" value="2">
     <label for="radio2"></label> 
     Transferencia Bancaria
</p>
   <p>
     <input type="radio" name="radio" id="radio3" value="3">
     <label for="radio3"></label>
VISA/MasterCard </p>
   <p>
     <input type="submit" name="button" id="button" value="Realizar Pago">
   </p>
 </form>
 <p>&nbsp;</p>
  </article>
</section>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
