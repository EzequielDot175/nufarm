<?php require_once('Connections/conexion.php'); ?>
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

$DatoUsuario_consulta = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $DatoUsuario_consulta = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_consulta = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($DatoUsuario_consulta, "int"));
$consulta = mysql_query($query_consulta, $conexion) or die(mysql_error());
$row_consulta = mysql_fetch_assoc($consulta);
$totalRows_consulta = mysql_num_rows($consulta);

$varResultado_consulta2 = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varResultado_consulta2 = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_consulta2 = sprintf("SELECT * FROM compra WHERE compra.idUsuario = %s", GetSQLValueString($varResultado_consulta2, "int"));
$consulta2 = mysql_query($query_consulta2, $conexion) or die(mysql_error());
$row_consulta2 = mysql_fetch_assoc($consulta2);
$totalRows_consulta2 = mysql_num_rows($consulta2);
?>
<?php include("includes/header.php"); ?>

<div id="menu">
 <div class="link"><p><a href="index.php">Inicio</a></p></div>
             <div class="link"><p><a href="canjes.php">Canjes</a></p></div>
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

    
<div class="bar-green2"><h4>Mis canjes realizados</h4></div>
<div class="micuenta">
              
<table width="97%" align="center" style="margin-top:15px">
    <!-- <tr height="21" bgcolor="#DDE99E" style="color:#008752;text-align:center; text-transform:uppercase">
     
 <td width="10%">Canjeados</td>
    <td width="32%">Detalle</td>
    <td width="10%">Fecha y hora</td>-->
    
    <!--<td width="20%">Creditos</td>-->
  </tr>
    <?php  include_once('includes/class.compras.php'); ?>
  
  <?php  include_once('includes/class.productos.php'); ?>
  <?php do { ?>
    <tr bgcolor="#FFFFFF" style="font-size:12px;">
      <!--<td><?php echo $row_consulta2['idCompra']; ?></td>-->
     
      <td colspan="4" height="21" bgcolor="#DDE99E" style="color:#008752;text-align:left; text-transform:uppercase; padding-left:10px;">CANJE <?php echo $row_consulta2['fthCompra']; ?></td>
      
    </tr><tr>
      <td align="center" style="font-size:22px; color:#008752">$<?php echo $row_consulta2['dblTotal']; ?></td>
      <td align="center" style="font-size:12px;">X</td>
     <td style="padding-left:10px;">
     
     <?php 
     
     		# echo $row_MisCompras['detalle']; 
     	if($row_consulta2['idCompra']){
     	$det = new compras();
     		echo $det->bring_detalle_compra($row_consulta2['idCompra']);
     }
     #echo '$id_compra'.$row_MisCompras['idCompra'];
     #echo '<p>Total con IVA $'.$row_consulta2['dblTotal'].'</p>';
     
     ?>
     
     </td>
      <td align="center" style="font-size:12px;">Entrega: <?php  
      
      if($row_consulta2['estado'] == 1){$estado = "Pendiente";}
      if($row_consulta2['estado'] == 2){$estado = "En proceso";}
      if($row_consulta2['estado'] == 3){$estado = "Entregado";}
      echo $estado?></td>
      
      <!---<td><?php echo $row_consulta2['idCredito']; ?></td>--->
    </tr>
    <?php } while ($row_consulta2 = mysql_fetch_assoc($consulta2)); ?>
</table>
</div>  

  <div class="mod-datos">  <a class="btn-micuenta" href="canjes.php"><span>Realizar canje</span></a></div>  
           
<!--<div class="bar-green2"><h4>Mis consultas</h4></div>         
<div class="micuenta">No tiene consultas realizadas</div>-->

   <div class="mod-datos">  <a class="btn-micuenta" href="mis_consultas.php"><span>Realizar consulta</span></a></div>

               
   <div class="bar-green2"><h4>Mis datos</h4></div>
<div class="micuenta">

 <div class="misdatos">
   <h4><?php echo $row_consulta['strNombre']; ?> <?php echo $row_consulta['strApellido']; ?></h4><h6>Nombre y Apellido</h6>
   <h5><?php echo $row_consulta['strEmail']; ?> </h5><h6>Email</h6>
    </div>
    <div class="misdatos">
    <h5><?php echo $row_consulta['strEmpresa']; ?></h5> <h6>Empresa</h6>
    <h5><?php echo $row_consulta['strCargo']; ?></h5><h6>Cargo</h6>
           </div>
           
           
          
        
</div>
     
        
         <div class="mod-datos">  <a class="btn-micuenta" href="modificar_perfil.php"><span>Modificar Datos</span></a></div>
        
            
</article>
</section>
</div>
</div></div></div></div>
<?php include("includes/footer.php"); ?>
<?php
mysql_free_result($consulta);

mysql_free_result($consulta2);
?>
