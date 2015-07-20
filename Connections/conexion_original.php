<?php if (!isset($_SESSION)) {
  session_start();
}?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
/*$hostname_conexion = "localhost";
$database_conexion = "nufarm";
$username_conexion = "root";
$password_conexion = "ashley69";*/

/*$hostname_conexion = "localhost";
$database_conexion = "nufarm";
$username_conexion = "root";
$password_conexion = "dot175";*/


$hostname_conexion = "localhost";
$database_conexion = "pnufarm_productosnufarm";
$username_conexion = "pnufarm_pnufarm";
$password_conexion = "pnufarm123";

$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php 
if (is_file ("includes/funciones.php")){
    include("includes/funciones.php"); 
}
else 
{
	include("../includes/funciones.php"); 
}
?>