<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');


date_default_timezone_set('America/Buenos_Aires');
$idConsulta = $_POST['idConsulta'];
$idUsuario=$_POST['idUsuario'];
$strAsunto=$_POST['strAsunto'];
$strCampo=$_POST['strCampo'];
$strCampo = str_replace("//", "//\n", $strCampo);

include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->idUsuario=0; // 0 para que no se confunda con ids de usuarios
$consultas->strAsunto=$strAsunto;
$consultas->strCampo=$strCampo;
$consultas->fecha=date("Y-m-d H:i:s");
$consultas->tipo=2; //2 = respuesta de admin
$consultas->respuesta_de =$idConsulta;
$consultas->insert();


//Actualizo la consulta a respondido
include_once("classes/class.consultas.php");
$cons= new consultas();
$cons->select($idConsulta);
$cons->respondido=1;
$cons->update($idConsulta);

$_SESSION['msg_ok'] = 'Mensaje enviado!';
header('Location: '.BASEURL.'/consultas/v_consultas.php?activo=2&sub=f&orden=1');

?>	