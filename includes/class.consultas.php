<?php

include_once("Connections/class.database.php");

/* CLASS DECLARATION */


class consultas{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idConsulta;   // KEY ATTR. WITH AUTOINCREMENT
var $idUsuario;
var $strAsunto;
var $strCampo;
var $fecha;
var $respondido;
var $tipo;
var $respuesta_de;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function consultas(){

$this->database = new Database();

}


/* GETTER METHODS */
function getidConsulta(){return $this->idConsulta;}
function getidUsuario(){return $this->idUsuario;}
function getstrAsunto(){return $this->strAsunto;}
function getstrCampo(){return $this->strCampo;}
function getfecha(){return $this->fecha;}
function getrespondido(){return $this->respondido;}
function gettipo(){return $this->tipo;}
function getrespuesta_de(){return $this->respuesta_de;}

/* SETTER METHODS */
function setidConsulta($val){ $this->idConsulta =  $val;}
function setidUsuario($val){ $this->idUsuario =  $val;}
function setstrAsunto($val){ $this->strAsunto =  $val;}
function setstrCampo($val){ $this->strCampo =  $val;}
function setfecha($val){ $this->fecha =  $val;}
function setrespondido($val){ $this->respondido =  $val;}
function settipo($val){ $this->tipo =  $val;}
function setrespuesta_de($val){ $this->respuesta_de =  $val;}

/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM consultas WHERE idConsulta = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->idConsulta = $row->idConsulta;
$this->idUsuario = $row->idUsuario;
$this->strAsunto = $row->strAsunto;
$this->strCampo = $row->strCampo;
$this->fecha = $row->fecha;
$this->respondido = $row->respondido;
$this->tipo = $row->tipo;
$this->respuesta_de = $row->respuesta_de;
}


function respuestas_de($id_consulta){
$sql ="SELECT * FROM consultas WHERE respuesta_de = $id_consulta;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idConsulta = $row['idConsulta'];
$idUsuario = $row['idUsuario'];
$strAsunto = $row['strAsunto'];
$strCampo = $row['strCampo'];

$fecha = $row['fecha'];
$respondido = $row['respondido'];
$tipo = $row['tipo'];
$mensaje = "";
$mensaje .= '<div class="item_respuesta">
<div class="text_res_admin">
<p>'.$strCampo.'</p>
</div>
</div>';
}
if($mensaje !=""){echo '
<div class="res-admin"><p>Respuesta: <span class="fecha">'.$fecha.'</span></div>

';}
return $mensaje;

}



/* SELECT ALL */
function select_by_usuario($id_usuario){


$sql ="SELECT * FROM consultas WHERE idUsuario = $id_usuario AND tipo = 1 ORDER BY fecha DESC";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idConsulta = $row['idConsulta'];
$idUsuario = $row['idUsuario'];
$strAsunto = $row['strAsunto'];
$strCampo = $row['strCampo'];

$fecha = $row['fecha'];
$respondido = $row['respondido'];
$tipo = $row['tipo'];

echo  '<div class="misconsultas">
<div class="tit-asunto">
<form action="eliminar_consulta.php" method="post">
<button id="btn-delete" onclick="onclick="this.form.submit()"><img src="imagenes/cross-08.png"/></button>
 <span class="asunto2">Asunto: <br><div class="strAsunto">'.$strAsunto.'</div></span> <span class="fecha">'.$fecha.'</span></div>
<p>'.$strCampo.'</p>
<input type="hidden" name="idconsulta" value="'.$idConsulta.'" />

</form>
<p>
<!--
<a href="d_consulta.php?id='.$idConsulta.'">Borrar</a>
-->
</p>

';

echo $this->respuestas_de($idConsulta);

echo  '</div>';
}



}

/* SELECT DROP LIST */
function consultas_drop_list(){

$sql ="SELECT * FROM consultas ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id= $row['id_consultas'];
$name= $row['name_consultas'];
echo '<option value='.$id.'>'.$name.'</option>';
}
}


/* DELETE */
function delete($id){
$sql = "DELETE FROM consultas WHERE idConsulta = $id;";
$result = $this->database->query($sql);

}


/* DELETE */
function delete_by_consulta($id){
$sql = "DELETE FROM consultas WHERE respuesta_de = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idConsulta = ""; // clear key for autoincrement

$sql = "INSERT INTO consultas ( idUsuario,strAsunto,strCampo, fecha, respondido, tipo, respuesta_de ) VALUES ( '$this->idUsuario','$this->strAsunto','$this->strCampo','$this->fecha', '$this->respondido','$this->tipo','$this->respuesta_de')";
$result = $this->database->query($sql);
$this->idConsulta = mysql_insert_id($this->database->link);

}


/* UPDATE */
function update($id){

$sql = " UPDATE consultas SET  idUsuario = '$this->idUsuario',strAsunto = '$this->strAsunto',strCampo = '$this->strCampo',fecha = '$this->fecha',respondido = '$this->respondido',tipo = '$this->tipo',respuesta_de = '$this->respuesta_de' WHERE idConsulta = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>