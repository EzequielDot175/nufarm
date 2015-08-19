<?php
  

function redirect(){
  echo('<script>window.location.href="carrito.php";</script>');
}

  error_reporting(0);
  ini_set('display_errors', 'off');

  require_once('Connections/conexion.php');
  // require_once(dirname(__FILE__).'/TempStock.php');
  require_once('libs.php');

 ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// require_once('/control/resources/pdo.php');
require_once('control/productos/classes/class.tallesColores.php');

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

$MM_restrictGoTo = "login.php";
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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$cond =  (  isset($_GET['recordID']) && !empty($_GET['recordID']) && !isset($_GET['talle_colores'])  );


$tempMaxCompra = new TempMaxCompra();
$tempMaxCompra->storeRemains($_GET['recordID']);

if ( isset($_GET['require'])) {
    switch ($_GET['require']) {
      case '1':
         try {
          $x = new TempStock();
          $x->liberarStockTalle($_GET['recordID'],$_SESSION['MM_IdUsuario']);
        } catch (Exception $e) {
          echo($e->getMessage());
        }

        break;
      case '2':
        try {
          $x = new TempStock();
          $x->liberarStockColor($_GET['recordID'],$_SESSION['MM_IdUsuario']);
        } catch (Exception $e) {
          echo($e->getMessage());
        }

        break;
      case '3':
        try {
          $x = new TempStock();
          $x->liberarStockColorTalle($_GET['recordID'],$_SESSION['MM_IdUsuario']);
        } catch (Exception $e) {
          echo($e->getMessage());
        }
        break;
      
      default:
         try {
          $x = new TempStock();
          $x->liberarStockComunes($_GET['recordID'],$_SESSION['MM_IdUsuario']);
        } catch (Exception $e) {
          echo($e->getMessage());
        }
        break;
    }
}


if ($cond) {
  $deleteSQL = sprintf("DELETE FROM carrito WHERE intContador=%s LIMIT 1",
                       GetSQLValueString($_GET['recordID'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());


 //Reintegro al stock el producto.
  include_once("includes/class.productos.php");
  
  //Traigo stock actual
  // $productos= new productos();
  // $productos->select($_GET['recordID']);
  // $StockActual=$productos->getintStock();

  //actualizo el stock
  // $productos= new productos();
  // $productos->select($_GET['recordID']);
  // $productos->intStock=$intStock = $StockActual + 1;
  // $productos->update($_GET['recordID']);





  
  redirect();
  exit();
}elseif (   isset($_GET['talle_colores'])  ) {
 
    $productos = new tallesColores();
    $sub = $_GET['sub'];
    $talle = $_GET['talle'];
    
    $delete = $productos->deleteItem($_GET['recordID'],$sub,$talle);
    redirect();
}




redirect();
exit();

?>
