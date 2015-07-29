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

mysql_select_db($database_conexion, $conexion);
$query_RecordProductos = "SELECT * FROM productos ORDER BY productos.strNombre ASC";
$RecordProductos = mysql_query($query_RecordProductos, $conexion) or die(mysql_error());
$row_RecordProductos = mysql_fetch_assoc($RecordProductos);
$totalRows_RecordProductos = mysql_num_rows($RecordProductos);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

// comprueba mediante cookies recordar email
if(isset($_POST['recordar'])){
    if($_POST['recordar'] == true){
      setcookie("strEmail", $_POST["strEmail"], time()+(60*60*24*365));
    }
}
// termina condicion de cookies

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['strEmail'])) {
  $loginUsername= addslashes($_POST['strEmail']);
  $password=addslashes($_POST['strPassword']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "acceso_error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion, $conexion);
  
  $LoginRS__query=sprintf("SELECT idUsuario, strEmail, strPassword FROM usuarios WHERE strEmail=%s AND strPassword=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $row_LoginRS = mysql_fetch_assoc($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$_SESSION['MM_IdUsuario'] = $row_LoginRS["idUsuario"];	      


//verifico si se vencio su credito personal y lo vuelvo a cero


include_once('includes/class.usuarios.php');

$ver_credito = new usuarios();
$ver_credito->select($row_LoginRS["idUsuario"]);
$id_usuario = $ver_credito->getidUsuario();
$credito_actual = $ver_credito->getdblCredito();
$vigencia = $ver_credito->getvigencia_credito();


$fecha_hoy = strtotime('now');

$fecha_vigencia = strtotime($vigencia);


if ($fecha_hoy >= $fecha_vigencia) { 
	#SI CAMBIA
	//cambio el credito actual a 0 (cero)
	$upd = new usuarios();
	$upd->select($id_usuario);
	$upd->dblCredito = 0;
	$upd->update($id_usuario);	
	
	
	//Guardo la modificacion en historial de credito
	include_once('includes/class.historiales.php');
	$hist = new historiales();
	$hist->id_usuario = $id_usuario;
	$hist->fecha = date("Y-m-d");
	$hist->realizado_por = "Vencimiento vigencia";
	$hist->tipo_modificacion = $modificacion ="Descuento de $credito_actual";
	$hist->monto_modificado = 0;
	$hist->insert();

}




    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}


$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['strEmail'])) {
  $loginUsername=$_POST['strEmail'];
  $password=$_POST['strPassword'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php?activo=1&animation=1";
  $MM_redirectLoginFailed = "acceso_error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion, $conexion);
  
  $LoginRS__query=sprintf("SELECT strEmail, strPassword FROM usuarios WHERE strEmail=%s AND strPassword=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      





    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
   header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
   header("Location: ". $MM_redirectLoginFailed );
  }
}

?>

<!doctype html>
<html>

<!--
<script language="JavaScript">  
var navegador = navigator.appName  
if (navegador == "Microsoft Internet Explorer")  
direccion=("http://nufarm-maxx.com/redir/index.html");  

window.location=direccion;  
</script>  
-->
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
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' Vuelve a ingresarlo.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('No es un correo valido\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
</head>

<body class="bg-login">
<div id="contenedor-login">
<div class="logo-login"></div>

  <div id="login">
  <div id="menu">
      <a href="login.php"><div class="link-login-activo"><span class="home_icon_login-green"></span>INICIAR SESIÓN</div></a>
			 <a href="recover.php"><div class="link-login"><span class="home_icon_login2"></span><div style="margin-left:25px">RECUPERAR PASS</div></div></a>
  </div>
  <div id="logincaja">
  <div style="height:80px;"></div>
  <label><?php $resultado= (isset($_GET['res'])? $_GET['res']:''); echo $resultado;?></label>
    <form id="loginform" name="form1" method="post" action="">
        <label>Correo Electronico</label>
      
        <input name="strEmail" type="text" id="email" />
       
        <label>Clave</label>
     
        <input type="password" name="strPassword" id="password" required/>       

               <center class="center"> 
	   <a class="btn-login">
		<input type="submit" name="button" id="button-login" value="Entrar">
		</a>
        </center>

         <center><input type="radio" name="recordar" id="radio" value="radio"/>
      Recordarme</center><br />
        

    </form>
  </div>
         </div>

</body>
</html>
<?php
mysql_free_result($RecordProductos);
?>