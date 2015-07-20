<?php require_once('Connections/conexion.php'); ?>
<?php 
$_SESSION['MM_Username'] = "";
    $_SESSION['MM_UserGroup'] = "";
	$_SESSION['MM_IdUsuario'] = "";
	header ("Location: login.php"); 
exit;
?>
