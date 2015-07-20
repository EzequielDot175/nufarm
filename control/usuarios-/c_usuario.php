<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');


$strNombre=$_POST['strNombre'];
$strApellido=$_POST['strApellido'];
$strEmail=$_POST['strEmail'];
$strEmpresa=$_POST['strEmpresa'];
$strCargo=$_POST['strCargo'];
$strPassword=$_POST['strPassword'];
$dblCredito=$_POST['dblCredito'];


$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];

$nombre_contacto1=$_POST['nombre_contacto1'];
$apellido_contacto1=$_POST['apellido_contacto1'];
$email_contacto1=$_POST['email_contacto1'];

$nombre_contacto2=$_POST['nombre_contacto2'];
$apellido_contacto2=$_POST['apellido_contacto2'];
$email_contacto2=$_POST['email_contacto2'];

$logo=$_POST['logo'];


list($dia, $mes, $anio) = explode('-', $_POST['vigencia_credito']);
$vigencia_credito = $anio.'-'.$mes.'-'.$dia;  



$vendedor=$_POST['vendedor'];

/* INSERT */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->idUsuario=$idUsuario;
$usuarios->strNombre=$strNombre;
$usuarios->strApellido=$strApellido;
$usuarios->strEmail=$strEmail;
$usuarios->strEmpresa=$strEmpresa;
$usuarios->strCargo=$strCargo;
$usuarios->strPassword=$strPassword;
$usuarios->dblCredito=$dblCredito;

$usuarios->direccion=$direccion;
$usuarios->telefono=$telefono;
$usuarios->nombre_contacto1=$nombre_contacto1;
$usuarios->apellido_contacto1=$apellido_contacto1;
$usuarios->email_contacto1=$email_contacto1;
$usuarios->nombre_contacto2=$nombre_contacto2;
$usuarios->apellido_contacto2=$apellido_contacto2;
$usuarios->email_contacto2=$email_contacto2;
$usuarios->logo=$logo;
$usuarios->vigencia_credito=$vigencia_credito;
$usuarios->vendedor=$vendedor;



$usuarios->insert();

#echo '<div class="notify"><p>usuario Creada!</p><p><a href="v_usuarios.php">Regresar</a></p></div>';
$_SESSION['msg_ok'] = 'Cliente Creado!';
header('Location: '.BASEURL.'/usuarios/v_usuarios.php');
?>