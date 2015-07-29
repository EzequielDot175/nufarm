<?php 
  require_once('Connections/conexion.php');
  require_once(dirname(__FILE__).'/TempStock.php');

 ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

require_once('/control/resources/pdo.php');
require_once('/control/productos/classes/class.tallesColores.php');

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





  $deleteGoTo = "mi_cuenta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}elseif (   isset($_GET['talle_colores'])  ) {
 
    $productos = new tallesColores();
    $sub = $_GET['sub'];
    $talle = $_GET['talle'];
    
    $delete = $productos->deleteItem($_GET['recordID'],$sub,$talle);
    header('Location: mi_cuenta.php?activo=2');
}
?>
<?php include("includes/header.php"); ?>
<div id="menu">
 <div class="link"><p><a href="index.php">Inicio</a></p></div>
             <div class="link"><p><a href="productos.php">Canjes</a></p></div>
              <div class="link-activo"><p><a href="mi_cuenta.php">Mi Cuenta</a></p></div>
                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>
 </ul>
</div>
<div id="buscador"></div>

<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
 <h3>Eliminado</h3>
 
  </article>
</section>
</div></div></div></div>
<?php include("includes/footer.php"); ?>
</body>
</html>
