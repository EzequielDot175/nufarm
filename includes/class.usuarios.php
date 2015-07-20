<?php

include_once("Connections/class.database.php");

/* CLASS DECLARATION */


class usuarios{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idUsuario;   // KEY ATTR. WITH AUTOINCREMENT
var $strNombre;
var $strApellido;
var $strEmail;
var $strEmpresa;
var $strCargo;
var $cp;
var $ciudad;
var $provincia;
var $strPassword;
var $dblCredito;
var $vigencia_credito;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function usuarios(){

$this->database = new Database();

}


/* GETTER METHODS */
function getidUsuario(){return $this->idUsuario;}
function getstrNombre(){return $this->strNombre;}
function getstrApellido(){return $this->strApellido;}
function getstrEmail(){return $this->strEmail;}
function getstrEmpresa(){return $this->strEmpresa;}
function getstrCargo(){return $this->strCargo;}
function getstrPassword(){return $this->strPassword;}
function getdblCredito(){return $this->dblCredito;}
function getvigencia_credito(){return $this->vigencia_credito;}
function getciudad(){return $this->ciudad;}
function getcp(){return $this->cp;}
function getprovincia(){return $this->provincia;}

/* SETTER METHODS */
function setidUsuario($val){ $this->idUsuario =  $val;}
function setstrNombre($val){ $this->strNombre =  $val;}
function setstrApellido($val){ $this->strApellido =  $val;}
function setstrEmail($val){ $this->strEmail =  $val;}
function setstrEmpresa($val){ $this->strEmpresa =  $val;}
function setstrCargo($val){ $this->strCargo =  $val;}
function setstrPassword($val){ $this->strPassword =  $val;}
function setdblCredito($val){ $this->dblCredito =  $val;}
function setvigencia_credito($val){ $this->vigencia_credito =  $val;}
function setciudad($val){ $this->ciudad =  $val;}
function setcp($val){ $this->cp =  $val;}
function setprovincia($val){ $this->provincia =  $val;}

/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM usuarios WHERE idUsuario = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->idUsuario = $row->idUsuario;
$this->strNombre = $row->strNombre;
$this->strApellido = $row->strApellido;
$this->strEmail = $row->strEmail;
$this->strEmpresa = $row->strEmpresa;
$this->strCargo = $row->strCargo;
$this->strPassword = $row->strPassword;
$this->dblCredito = $row->dblCredito;
$this->vigencia_credito = $row->vigencia_credito;
$this->ciudad = $row->ciudad;
$this->cp = $row->cp;
$this->provincia = $row->provincia;

}


/* SELECT METHOD / LOAD */
function select_by_login($login){

$sql =  "SELECT * FROM usuarios WHERE strEmail = $login;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->idUsuario = $row->idUsuario;
$this->strNombre = $row->strNombre;
$this->strApellido = $row->strApellido;
$this->strEmail = $row->strEmail;
$this->strEmpresa = $row->strEmpresa;
$this->strCargo = $row->strCargo;
$this->strPassword = $row->strPassword;
$this->dblCredito = $row->dblCredito;
$this->vigencia_credito = $row->vigencia_credito;
$this->ciudad = $row->ciudad;
$this->cp = $row->cp;
$this->provincia = $row->provincia;

}

/* SELECT ALL */
function select_all(){
$sql ="SELECT * FROM usuarios ";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idUsuario = $row['idUsuario'];
$strNombre = $row['strNombre'];
$strApellido = $row['strApellido'];
$strEmail = $row['strEmail'];
$strEmpresa = $row['strEmpresa'];
$strCargo = $row['strCargo'];
$strPassword = $row['strPassword'];
$dblCredito = $row['dblCredito'];
$cp = $row['cp'];
$ciudad = $row['ciudad'];
$provincia = $row['provincia'];
$vigencia_credito = $row['vigencia_credito'];

}


}


/* DELETE */
function delete($id){
$sql = "DELETE FROM usuarios WHERE idUsuario = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idUsuario = ""; // clear key for autoincrement

$sql = "INSERT INTO usuarios ( strNombre,strApellido,strEmail,strEmpresa,strCargo,strPassword,dblCredito,vigencia_credito,ciudad,cp,provincia ) VALUES ( '$this->strNombre','$this->strApellido','$this->strEmail','$this->strEmpresa','$this->strCargo','$this->strPassword','$this->dblCredito','$this->vigencia_credito','$this->ciudad','$this->cp','$this->provincia' )";
$result = $this->database->query($sql);
$this->idUsuario = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE usuarios SET  strNombre = '$this->strNombre',strApellido = '$this->strApellido',strEmail = '$this->strEmail',strEmpresa = '$this->strEmpresa',strCargo = '$this->strCargo',strPassword = '$this->strPassword',dblCredito = '$this->dblCredito',vigencia_credito = '$this->vigencia_credito',ciudad = '$this->ciudad',cp = '$this->cp',provincia = '$this->provincia'  WHERE idUsuario = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>