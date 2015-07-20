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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuarios SET strNombre=%s, strApellido=%s, strEmail=%s, strEmpresa=%s, strCargo=%s, strPassword=%s, direccion=%s, telefono=%s, cumpleanos=%s, ciudad=%s, cp=%s, provincia=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strApellido'], "text"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['strEmpresa'], "text"),
                       GetSQLValueString($_POST['strCargo'], "text"),
                       GetSQLValueString($_POST['strPassword'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),							   
                       GetSQLValueString($_POST['telefono'], "text"),	
					   GetSQLValueString($_POST['fechanac'], "date"),
					   GetSQLValueString($_POST['ciudad'], "text"),
					   GetSQLValueString($_POST['cp'], "text"),
					   GetSQLValueString($_POST['provincia'], "text"),
                       GetSQLValueString($_POST['idUsuario'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "usuario_modificacion_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varDatoUsuario_DatoUsuario = "0";
if (isset($_SESSION["MM_IdUsuario"])) {
  $varDatoUsuario_DatoUsuario = $_SESSION["MM_IdUsuario"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatoUsuario = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($varDatoUsuario_DatoUsuario, "int"));
$DatoUsuario = mysql_query($query_DatoUsuario, $conexion) or die(mysql_error());
$row_DatoUsuario = mysql_fetch_assoc($DatoUsuario);
$totalRows_DatoUsuario = mysql_num_rows($DatoUsuario);
?>
<?php include("includes/header.php"); ?>

<section>
<?php $activo = $_GET['activo']; include("includes/menu.php"); ?>
<aside>
<?php include("includes/catalogo2.php"); ?>
</aside>
<article>
<div class="inicio">
<h2>Modificar tus datos</h2>
     <div id="registrocentrado">
     <div class="colform coledit">
 	<form id="registroform" method="post" name="form1" action="<?php echo $editFormAction; ?>">
		
		<label id="label2">Empresa</label>
		<input type="text" id="empresa" name="strEmpresa" value="<?php echo htmlentities($row_DatoUsuario['strEmpresa'], ENT_COMPAT, 'utf-8'); ?>" size="32">
       
		<label id="label2">Nombre</label>
		<input type="text" id="empresa" name="strNombre" value="<?php echo htmlentities($row_DatoUsuario['strNombre'], ENT_COMPAT, 'utf-8'); ?>" size="32">
		
		<label id="label2">Apellido</label>
		<input type="text" id="empresa" name="strApellido" value="<?php echo htmlentities($row_DatoUsuario['strApellido'], ENT_COMPAT, 'utf-8'); ?>" size="32">
     	
		<label id="label2">Teléfono</label>
    	<input id="empresa"  name="telefono" type="text" value="<?php echo htmlentities($row_DatoUsuario['telefono'], ENT_COMPAT, 'utf-8'); ?>" required/>
			
	</div>
	
     <div class="colform coledit">
			<label id="label2">Dirección</label>
			<input type="text" id="empresa" name="direccion" value="<?php echo htmlentities($row_DatoUsuario['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			 
			<label id="label2">Ciudad</label>
			<input type="text" id="empresa" name="ciudad" value="<?php echo htmlentities($row_DatoUsuario['ciudad'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			
			<label id="label2">Codigo Postal</label>
			<input type="text" id="empresa" name="cp" value="<?php echo htmlentities($row_DatoUsuario['cp'], ENT_COMPAT, 'utf-8'); ?>" size="32">
<?php $provincia_selected = htmlentities($row_DatoUsuario['provincia'], ENT_COMPAT, 'utf-8'); ?>		   
		    <label id="label2">Provincia</label>
			<select name="provincia" id="empresa" class="ajuste_select">
			<option value="Buenos Aires" <?if($provincia_selected =="Buenos Aires"){echo" selected";}?>>Buenos Aires</option>
			<option value="Buenos Aires Capital"<?if($provincia_selected =="Buenos Aires Capital"){echo" selected";}?>>Buenos Aires Capital</option>
			<option value="Catamarca"<?if($provincia_selected =="Catamarca"){echo" selected";}?>>Catamarca</option>
			<option value="Chaco"<?if($provincia_selected =="Chaco"){echo" selected";}?>>Chaco</option>
			<option value="Chubut"<?if($provincia_selected =="Chubut"){echo" selected";}?>>Chubut</option>
			<option value="Cordoba"<?if($provincia_selected =="Cordoba"){echo" selected";}?>>Cordoba</option>
			<option value="Corrientes"<?if($provincia_selected =="Corrientes"){echo" selected";}?>>Corrientes</option>
			<option value="Entre Rios"<?if($provincia_selected =="Entre Rios"){echo" selected";}?>>Entre Rios</option>
			<option value="Formosa"<?if($provincia_selected =="Formosa"){echo" selected";}?>>Formosa</option>
			<option value="Jujuy"<?if($provincia_selected =="Jujuy"){echo" selected";}?>>Jujuy</option>
			<option value="La Pampa"<?if($provincia_selected =="La Pampa"){echo" selected";}?>>La Pampa</option>
			<option value="La Rioja"<?if($provincia_selected =="La Rioja"){echo" selected";}?>>La Rioja</option>
			<option value="Mendoza"<?if($provincia_selected =="Mendoza"){echo" selected";}?>>Mendoza</option>
			<option value="Misiones"<?if($provincia_selected =="Misiones"){echo" selected";}?>>Misiones</option>
			<option value="Neuquen"<?if($provincia_selected =="Neuquen"){echo" selected";}?>>Neuquen</option>
			<option value="Rio Negro"<?if($provincia_selected =="Rio Negro"){echo" selected";}?>>Rio Negro</option>
			<option value="Salta"<?if($provincia_selected =="Salta"){echo" selected";}?>>Salta</option>
			<option value="San Juan"<?if($provincia_selected =="San Juan"){echo" selected";}?>>San Juan</option>
			<option value="San Luis"<?if($provincia_selected =="San Luis"){echo" selected";}?>>San Luis</option>
			<option value="Santa Cruz"<?if($provincia_selected =="Santa Cruz"){echo" selected";}?>>Santa Cruz</option>
			<option value="Santa Fe"<?if($provincia_selected =="Santa Fe"){echo" selected";}?>>Santa Fe</option>
			<option value="Santiago del Estero"<?if($provincia_selected =="Santiago del Estero"){echo" selected";}?>>Santiago del Estero</option>
			<option value="Tierra del Fuego"<?if($provincia_selected =="Tierra del Fuego"){echo" selected";}?>>Tierra del Fuego</option>
			<option value="Tucuman"<?if($provincia_selected =="Tucuman"){echo" selected";}?>>Tucuman</option>
			</select>

   </div>
        <div class="colform coledit">
			<label id="label2">E-mail / Usuario</label>
			<input type="text" id="empresa" name="strEmail" value="<?php echo htmlentities($row_DatoUsuario['strEmail'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			 
			 <label id="label2">Contraseña</label>
			<input type="text" id="empresa" name="strPassword" value="<?php echo htmlentities($row_DatoUsuario['strPassword'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			 
			<label id="label2">Fecha de Nac</label>
			<input type="date" value="<?php echo htmlentities($row_DatoUsuario['cumpleanos'], ENT_COMPAT, 'utf-8'); ?>" name="fechanac" id="apellido" required/>
   
			<label id="label2">Cargo</label>
			<input type="text" id="empresa" name="strCargo" value="<?php echo htmlentities($row_DatoUsuario['strCargo'], ENT_COMPAT, 'utf-8'); ?>" size="32">
   </div>
   
   
 </div>
  <div class="btn-content"><a class="btn-micuenta-edit" ><input type="submit" id="button3" value="Actualizar Datos"></a></div>
 <input type="hidden" name="MM_update" value="form1">
   <input type="hidden" name="idUsuario" value="<?php echo $row_DatoUsuario['idUsuario']; ?>">
 </form>
</div>
  </article>
  <?php include("includes/footer.php"); ?>
</section>
</div>
</body>
</html>
<?php
mysql_free_result($DatoUsuario);
?>
