<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php require_once('Connections/conexion.php'); ?>
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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="alta_emailrepit.php";
  $loginUsername = $_POST['strEmail'];
  $LoginRS__query = sprintf("SELECT strEmail FROM usuarios WHERE strEmail=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_conexion, $conexion);
  $LoginRS=mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuarios (strNombre, strApellido, strEmail, strEmpresa, strCargo, strPassword, cumpleanos) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strApellido'], "text"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['strEmpresa'], "text"),
                       GetSQLValueString($_POST['strCargo'], "text"),
                       GetSQLValueString($_POST['strPassword'], "text"),
					   GetSQLValueString($_POST['fechanac'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_RecordProductos = "SELECT * FROM productos ORDER BY productos.strNombre ASC";
$RecordProductos = mysql_query($query_RecordProductos, $conexion) or die(mysql_error());
$row_RecordProductos = mysql_fetch_assoc($RecordProductos);
$totalRows_RecordProductos = mysql_num_rows($RecordProductos);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tienda Nufarm</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' Debes ingresar un correo valido \n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('Surgio un error \n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
</head>

<body>
<div id="contenedor">
<?php include("includes/header.php"); ?>
<div id="login">

  <div id="menu">
 <a href="login.php"><div class="link">INICIAR SESIÓN</div></a>
            <a href="registrar.php"><div class="link activo">REGISTRARSE</div></a>
			 <a href="recover.php"><div class="link">RECUPERAR PASS</div></a>
  </div>

 
  <div id="logincaja2">
   <div class="logincaja2">
  <h2>Registrarse</h2>
    <form id="registroform" name="form1" method="post" action="<?php echo $editFormAction; ?>">
    
      <div class="colform">

 

              <label>Nombre</label>
          <input type="text" name="strNombre" id="nombre" required/>
              
              <label>Apellido</label>
              <input type="text" name="strApellido" id="apellido" required/>
              
              <label>Email</label>
              <input name="strEmail" type="text" id="email" onChange="MM_validateForm('email','','RisEmail');return document.MM_returnValue" />

			  <label>Fecha de Nac</label>
              <input type="date" name="fechanac" id="apellido" required/>

      </div>
      
       <div class="colform">
            <label>Empresa</label>
           <input type="text" name="strEmpresa" id="empresa" required/>
           

           <label>Cargo</label>
           <input type="text" name="strCargo" id="cargo" required/>

           <label>Contraseña</label>
           <input type="password" name="strPassword" id="password" required/>

       </div>
        <center><input name="radio" id="radio" type="radio" value="Acepto" /> Acepto Términos y condiciones de Nufarm</center><br />       <input type="submit" name="button" id="button" value="Enviar" /><br />
   <input type="hidden" name="MM_insert" value="form1">
 </form>
 </div></div></div>

</body>
</html>
<?php
mysql_free_result($RecordProductos);
?>