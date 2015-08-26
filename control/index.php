<?php  session_start();
// Requires 
// 
$_SESSION['basecontrol'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$_SESSION['baseurl'] = str_replace('/control/', '', $_SESSION['basecontrol']);
$_SESSION['root'] = dirname(__FILE__);

// session controller
if (isset($_SESSION['logged_id'])) {
  if($_SESSION['logged_id'] != ""){
  header('Location: compras/v_compras.php?activo=1&sub=c');

  }
}







?>
<!--[if !IE]> CONTENT <![endif]-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tienda Nufarm</title>
<link href="../css/main.css" rel="stylesheet" type="text/css">
<link href="layout/main.css" rel="stylesheet" type="text/css">	
</head>
<body class="bg-login">
<div id="contenedor-login">
<div class="logo-login"></div>
<?php 
define('ROOT_PATH', realpath(__DIR__.'/../includes/'));
?>
  <div id="login">
   
  <div id="logincaja3">
  <div class="login-admin">Administrador</div>
   <form id="login2" name="login" method="POST" action="verification.php" class="formvalid">
        <center class="center2"><label>CORREO ELECTRÓNICO</label></center>
      
        <center class="center2">
          <input type="text" name="nickname" id="campo" value="<?php echo(isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : '' ) ?>"/></center>
       
        <center class="center2"><label> clave</label></center>
     
        <center class="center2"><input type="password" name="password" id="campo" value=""/></center>
      

       <center class="center2">
       <br>
	   <a class="btn-login-admin">
		<input type="submit" name="button" id="button-login-admin" value="Entrar">
		</a>
        </center>

         <center id="radio-remember"><input type="checkbox" name="remember" id="radio" value="1" />
      Recordarme</center><br />

    </form>
  </div>
         </div>
		 </div>

</body>
</html>
