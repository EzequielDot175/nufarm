<?php
include_once("../resources/class.database.php");

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


function sin_responder(){

$sql ="SELECT * FROM consultas WHERE respondido = 0 and respuesta_de =0;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1){
		echo '
			<a href="#">No hay Mensajes sin responder</a>
';
		}else{
			echo '
				<a href="#">Mensajes sin responder '.$quantity.'</a>
';
		}
		

}

function respuestas_de($id_consulta){
$sql ="SELECT * FROM consultas WHERE respuesta_de = $id_consulta ORDER BY fecha ASC;";
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

$mensaje .= '<div class="item_respuesta">
<p>'.$strCampo.'</p>
</div>';
}
if($mensaje!=""){echo '
<span class="respuesta"><p>Respuesta enviada <i>'.$fecha.'</i></p></span>';}
return $mensaje;
}



function select_by_usuario($id_usuario){

$sql ="SELECT * FROM consultas WHERE idUsuario = $id_usuario ORDER BY fecha ASC;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '
	<div class="item">
     
	<p style="padding:5px 0 20px 15px">No hay consultas realizadas.</p>
	</div>';}
		


$sql ="SELECT * FROM consultas WHERE idUsuario = $id_usuario ORDER BY fecha ASC;";
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

if($respondido==0){
$respondido_status = '<div class="status_purple">SIN RESPONDER <img src="../layout/item4.png" alt=""></div>';
}else{
$respondido_status = '<div class="status_green">RESPONDIDA <img src="../layout/item7.png" alt=""></div>';
}
include_once("../usuarios/classes/class.usuarios.php");
$user_info= new usuarios();
$user_info->select($idUsuario);
$nombre_usuario = $user_info->getstrNombre();
$apellido_usuario = $user_info->getstrApellido();
$email_usuario = $user_info->getstrEmail();
$empresa_usuario = $user_info->getstrEmpresa();
echo '

<div id="content-consultas historial-usuario">
<div class="bar-consultas">


<span>Cliente: '.utf8_decode($nombre_usuario).' '.utf8_decode($apellido_usuario).'</span>

<span> Empresa: '.utf8_decode($empresa_usuario).'<div style="float:right"> '.$fecha.' </span>

<a class="btn-consulta" href="responder_consulta.php?id='.$idConsulta.'&activo=2&sub=f">ADMINISTRAR</a>
</div>

</div>


<div class="box-consulta-g">

<div class="box-asunto-consulta"><span>Asunto: <h4>'.utf8_decode($strAsunto).'</h4></span> </div>
<div class="cuadro-respondido">'.$respondido_status.'</div>
</div>

<div class="box-consulta-campo">
<p><span>Consulta: </span>'.utf8_decode($strCampo).'</p>
</div>

<div class="divisor"></div>
';

echo $this->respuestas_de($idConsulta);


echo '</div> ';

}
}






/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM consultas WHERE respuesta_de = 0 ";

$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay consulta en el sistema!</p>
		</div>';}
		else{
$count=0;
while($row = mysql_fetch_array($result)){
$count++;
}

$pages = new Paginator;
$pages->items_total = $count;
$pages->mid_range = 10;
$pages->paginate();
$pages->display_pages();


$sql ="SELECT * FROM consultas WHERE respuesta_de = 0 ORDER BY $orden $pages->limit;";

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

if($respondido==0){
$respondido_status = '<div class="status_purple">SIN RESPONDER <img src="../layout/item4.png" alt=""></div>';
}else{
$respondido_status = '<div class="status_green">RESPONDIDA <img src="../layout/item7.png" alt=""></div>';
}
include_once("../usuarios/classes/class.usuarios.php");
$user_info= new usuarios();
$user_info->select($idUsuario);
$nombre_usuario = $user_info->getstrNombre();
$apellido_usuario = $user_info->getstrApellido();
$email_usuario = $user_info->getstrEmail();
$empresa_usuario = $user_info->getstrEmpresa();

echo '

<div id="content-consultas">
<div class="bar-consultas">


<span>Cliente: '.utf8_decode($nombre_usuario).' '.utf8_decode($apellido_usuario).'</span>

<span> Empresa: '.utf8_decode($empresa_usuario).'<div style="float:right"> '.$fecha.' </span>

<a class="btn-consulta" href="responder_consulta.php?id='.$idConsulta.'&activo=2&sub=f">ADMINISTRAR</a>
</div>

</div>


<div class="box-consulta-g">

<div class="box-asunto-consulta"><span>Asunto: <h4>'.utf8_decode($strAsunto).'</h4></span> </div>
<div class="cuadro-respondido">'.$respondido_status.'</div>
</div>

<div class="box-consulta-campo">
<p><span>Consulta: </span>'.utf8_decode($strCampo).'</p>
</div>

<div class="divisor"></div>
';

echo $this->respuestas_de($idConsulta);


echo '<p>


<!--<form action="detail_consultas.php">
<button onclick="if(!confirm(\'Estas seguro de querer eliminar el producto?\'))return false">Eliminar</button>-->
</form>

</p><br /></div>';
}

echo '<div class="navigate2">';
echo $pages->display_pages();


// Optional call which will display the page numbers after the results.
//$pages->display_jump_menu(); // Optional Ð displays the page jump menu
//echo $pages->display_items_per_page(); //Optional Ð displays the items per
//echo  $pages->current_page . ' of ' .$pages->num_pages.'';
echo '</div>';
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


/* INSERT */

function insert(){
$this->idConsulta = ""; // clear key for autoincrement

$sql = "INSERT INTO consultas ( idUsuario,strAsunto,strCampo, fecha, respondido, tipo, respuesta_de ) VALUES ( '$this->idUsuario','$this->strAsunto','$this->strCampo','$this->fecha', '$this->respondido','$this->tipo','$this->respuesta_de' )";
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