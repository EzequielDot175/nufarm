<?php include_once('../resources/control.php'); header('Content-Type: text/html; charset=utf-8');

#include_once('helper_titulos.php');

$idUsuario = $_POST['idUsuario'];
$strNombre=$_POST['strNombre'];
$strApellido=$_POST['strApellido'];
$strEmail=$_POST['strEmail'];
$strEmpresa=$_POST['strEmpresa'];
$strCargo=$_POST['strCargo'];
$strPassword=$_POST['strPassword'];
$dblCredito=$_POST['dblCredito'];


/* 
	Verifico el monto actual del usuario para ver si tengo q guardar
 	alguna modificacion en historial de credito 
*/

include_once("classes/class.usuarios.php");
$usua= new usuarios();
$usua->select($idUsuario);
$credito_actual = $usua->getdblCredito();

if($credito_actual != $dblCredito){
	include_once("../historiales/classes/class.historiales.php");
	#guardo historial
	
	if($credito_actual > $dblCredito){ 
		$diferencia = $credito_actual - $dblCredito;
		$monto_quedo_en = $credito_actual - $diferencia;
		$modificacion = "descuento de $$diferencia por Admin";
	}else{
		$diferencia = $dblCredito - $credito_actual;
		$monto_quedo_en = $credito_actual + $diferencia;
		$modificacion = "agregado de $$diferencia por Admin. ";
	}
	
	$hist = new historiales();
	$hist->id_usuario = $idUsuario;
	$hist->fecha = date("Y-m-d");
	$hist->realizado_por = "Administracion";
	$hist->tipo_modificacion = $modificacion;
	$hist->monto_modificado = $monto_quedo_en;
	$hist->insert();

}

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

/* UPDATE */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();

$usuarios->select($idUsuario);
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




$usuarios->update($idUsuario);


#echo '<div class="notify"><p>usuario actualizada!</p><p><a href="v_usuarios.php">Regresar</a></p></div>';
$_SESSION['msg_ok'] = 'Usuario, actualizado!';
header('Location: '.BASEURL.'/usuarios/v_usuarios.php');
?>