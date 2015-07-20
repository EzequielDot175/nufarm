<?php session_start(); error_reporting(0); header('Content-Type: text/html; charset=utf-8');
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



if($_FILES['logo']['name']!=""){
include_once('../resources/class.upload.php');
      $yukle = new upload;
      $yukle->set_max_size(99999999);
      $yukle->set_directory('../../images-clientes');
      $yukle->set_tmp_name($_FILES['logo']['tmp_name']);
      $yukle->set_file_size($_FILES['logo']['size']);
      $yukle->set_file_type($_FILES['logo']['type']);
      //random
      $random = substr(md5(rand()),0,6);
      $avatarname= $random.'_'.$_FILES['logo']['name'];
      $nombre_final = str_replace(' ','-',$avatarname);
      $yukle->set_file_name($nombre_final);
      $yukle->start_copy();
      $yukle->resize(620,0);
      $yukle->set_thumbnail_name('tn_'.$nombre_final);
      $yukle->create_thumbnail();
      $yukle->set_thumbnail_size(300, 0);
      if($yukle->is_ok()){

      $logo =$nombre_final;
      }else{
      //si hay error cargo sin imagen
      $logo ="";

      }



}



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