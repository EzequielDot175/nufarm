<?php include_once('../resources/control.php'); header('Content-Type: text/html; charset=utf-8');

$id = $_POST['idpersonal'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$login=$_POST['login'];
$password=$_POST['password'];
$role=$_POST['role'];



/* UPDATE */
include_once("classes/class.personal.php");
$personal= new personal();

$personal->select($id);
$personal->id=$id;
$personal->nombre=$nombre;
$personal->apellido=$apellido;
$personal->login=$login;
$personal->password=$password;
$personal->role=$role;
$personal->update($id);


#echo '<div class="notify"><p>personal actualizada!</p><p><a href="v_personal.php">Regresar</a></p></div>';
$_SESSION['msg_ok'] = 'personal, actualizado!';
header('Location: '.BASEURL.'/personal/v_personal.php');
?>