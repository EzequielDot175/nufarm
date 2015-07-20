<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');


$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$login=$_POST['login'];
$password=$_POST['password'];
$role=$_POST['role'];



/* INSERT */
include_once("classes/class.personal.php");
$personal= new personal();
$personal->nombre=$nombre;
$personal->apellido=$apellido;
$personal->login=$login;
$personal->password=$password;
$personal->role=$role;

$personal->insert();

#echo '<div class="notify"><p>personal Creada!</p><p><a href="v_personal.php">Regresar</a></p></div>';
$_SESSION['msg_ok'] = 'personal Creado!';
header('Location: '.BASEURL.'/personal/v_personal.php');
?>