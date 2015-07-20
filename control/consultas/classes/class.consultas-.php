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
<p class="fecha">Realizada: '.$fecha.'</p>
<p>'.$strCampo.'</p>
</div>';
}
if($mensaje!=""){echo '
<br />
<br /><p><strong>Respuestas enviadas al cliente</strong></p>';}
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
     
	<p style="padding:5px 0 0 10px":>No hay consultas realizadas.</p>
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
$respondido_status = '<div style="width:15px; height:15px; float:left; margin:10px 0 0 15px; background:#9E1F63;"></div>';
}else{
$respondido_status = '<div style="width:15px; height:15px; float:left; margin:10px 0 0 15px;background:#008752;"></div>';
}

echo '

<div class="item">
<p class="asunto-c"><!--<a href="detail_consultas.php?id='.$idConsulta.'">--><strong>Asunto: '.$strAsunto.'</strong><!--</a>--> <span class="fecha"> | '.$fecha.'</span></p>

<p>'.$strCampo.'</p>
<p>'.$respondido_status.'</p>
<p style="margin:0 0 5px 0">
<a class="button4" href="'.BASEURL.'/consultas/responder_consulta.php?id='.$idConsulta.'">Responder</a>

<!--<form action="detail_consultas.php">
<button onclick="if(!confirm(\'Estas seguro de querer eliminar el producto?\'))return false">Eliminar</button>-->
</form>

<a class="button4" href="'.BASEURL.'/consultas/d_consulta.php?id='.$idConsulta.'">Borrar</a>
</p>';

echo $this->respuestas_de($idConsulta);


echo '</div>';

}
}






/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM consultas WHERE respuesta_de = 0;";
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
$respondido_status = '<div style="width:15px; height:15px; float:left;margin:10px 0 0 15px; background:#9E1F63;"></div>';
}else{
$respondido_status = '<div style="width:15px; height:15px; float:left;margin:10px 0 0 15px;background:#008752;"> </div>';
}

echo '

<div class="item">
<p class="asunto-c"><!--<a href="detail_consultas.php?id='.$idConsulta.'">--><strong>Asunto: '.$strAsunto.'</strong><!--</a>--> <span class="fecha"> | '.$fecha.'</span></p>

<p>'.$strCampo.'</p>
<p>'.$respondido_status.'</p>
';

echo $this->respuestas_de($idConsulta);


echo '<p>
<a class="button5" href="responder_consulta.php?id='.$idConsulta.'">Responder</a>

<!--<form action="detail_consultas.php">
<button onclick="if(!confirm(\'Estas seguro de querer eliminar el producto?\'))return false">Eliminar</button>-->
</form>

<a class="button5" href="d_consulta.php?id='.$idConsulta.'">Borrar</a>
</p></div>';
}

echo '<div class="navigate">';
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