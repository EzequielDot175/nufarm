<?php
include_once("../resources/class.database.php");

class propuestas{ 

/* ATTRIBUTE DECLARATION */
var $id_propuesta ;
var $id_usuario ;
var $nombre_evento ;
var $lugar ;
var $cant_invitados ;
var $fecha_estimada ;
var $caracteristicas ;
var $monto ;
var $aprobado ;
var $leido ;
var $detalle_admin ;
var $aprobado_fecha ;
var $estado ;

function propuestas(){
$this->database = new Database();
}

/* GETTER METHODS */
function getid_propuesta(){return $this->id_propuesta;}
function getid_usuario(){return $this->id_usuario;}
function getnombre_evento(){return $this->nombre_evento;}
function getlugar(){return $this->lugar;}
function getcant_invitados(){return $this->cant_invitados;}
function getfecha_estimada(){return $this->fecha_estimada;}
function getcaracteristicas(){return $this->caracteristicas;}
function getmonto(){return $this->monto;}
function getaprobado(){return $this->aprobado;}
function getleido(){return $this->leido;}
function getdetalle_admin(){return $this->detalle_admin;}
function getaprobado_fecha(){return $this->aprobado_fecha;}
function getestado(){return $this->estado;}

/* SETTER METHODS */
function setid_propuesta($val){ $this->id_propuesta =  $val;}
function setid_usuario($val){ $this->id_usuario =  $val;}
function setnombre_evento($val){ $this->nombre_evento =  $val;}
function setlugar($val){ $this->lugar =  $val;}
function setcant_invitados($val){ $this->cant_invitados =  $val;}
function setfecha_estimada($val){ $this->fecha_estimada =  $val;}
function setcaracteristicas($val){ $this->caracteristicas =  $val;}
function setmonto($val){ $this->monto =  $val;}
function setaprobado($val){ $this->aprobado =  $val;}
function setleido($val){ $this->leido =  $val;}
function setdetalle_admin($val){ $this->detalle_admin =  $val;}
function setaprobado_fecha($val){ $this->aprobado_fecha =  $val;}
function setestado($val){ $this->estado =  $val;}

/* SELECT METHOD / LOAD */
function select($id){
$sql =  "SELECT * FROM propuestas WHERE id_propuesta = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);
$this->id_propuesta = $row->id_propuesta;
$this->id_usuario = $row->id_usuario;
$this->nombre_evento = $row->nombre_evento;
$this->lugar = $row->lugar;
$this->cant_invitados = $row->cant_invitados;
$this->fecha_estimada = $row->fecha_estimada;
$this->caracteristicas = $row->caracteristicas;
$this->monto = $row->monto;
$this->aprobado = $row->aprobado;
$this->leido = $row->leido;
$this->detalle_admin = $row->detalle_admin;
$this->aprobado_fecha = $row->aprobado_fecha;
$this->estado = $row->estado;
}


function sin_responder(){
$sql ="SELECT * FROM propuestas WHERE estado=1;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1){
		echo '<div class="noresult"><div class="notify">
			<p>SIN PROPUESTAS</p>
		</div></div>';
		}else{
			echo '<div class="notify">
				<p><a href="'.BASEURL.'/propuestas/v_propuestas_sin_leer.php?action_status=1&activo=1&sub=a">Propuestas sin leer  '.$quantity.'</a></p>
			</div>';
		}
		

}



/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$action_status=$_GET['action_status'];
if($action_status){$sql ="SELECT * FROM propuestas WHERE estado='$action_status';";}
else{$sql ="SELECT * FROM propuestas";}

$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="noresult"><div class="notify-cero">
			<p>SIN PROPUESTAS</p>
		</div></div>';}
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

if($action_status){$sql ="SELECT * FROM propuestas WHERE estado='$action_status' ORDER BY $orden $pages->limit;";}
else{$sql ="SELECT * FROM propuestas ORDER BY $orden $pages->limit;";}
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id_propuesta = $row['id_propuesta'];
$id_usuario = $row['id_usuario'];
$nombre_evento = $row['nombre_evento'];
$lugar = $row['lugar'];
$cant_invitados = $row['cant_invitados'];
$fecha_estimada = $row['fecha_estimada'];
$caracteristicas = $row['caracteristicas'];
$monto = $row['monto'];
$aprobado = $row['aprobado'];
$leido = $row['leido'];
$detalle_admin = $row['detalle_admin'];
$aprobado_fecha = $row['aprobado_fecha'];
$estado = $row['estado'];

include_once('../usuarios/classes/class.usuarios.php');

$usr = new usuarios();
$usr->select($id_usuario);
$nombre_usr = $usr->getstrNombre();
$apellido_usr = $usr->getstrApellido();
$email_usr = $usr->getstrEmail();
$monto_usuario = $usr->getdblCredito();

switch ($estado) {
	case 1:
		$estado = 'NO LEIDO';
	break;
	case 2:
		$estado = 'PENDIENTE';
	break;
	case 3:
		$estado = 'APROBADO';
	break;
	case 4:
		$estado = 'NO APROBADO';
	break;
	case 5:
		$estado = 'ENTREGADO';
	break;
}



echo '
<div class="item">

<div class="olive-bar_new2">
<span class="bold">Usuario: </span>'.$nombre_usr.' '.$apellido_usr.'
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">EMAIL </span>'.$email_usr.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">FECHA </span>'.$fecha_estimada.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
</div>

<div class="pubeev2">
<span class="estado">'.$estado.'</span>
<span class="monto">$'.$monto.'</span>
'.utf8_decode($caracteristicas).'



<p class="boton2">
<a href="e_propuesta.php?id='.$id_propuesta.'&activo=1&sub=a">ADMINISTRAR</a>
</p>


</div>
</div>';
}

echo '<div class="navigate">';
echo $pages->display_pages();


 // Optional call which will display the page numbers after the results.
//$pages->display_jump_menu(); // Optional – displays the page jump menu
//echo $pages->display_items_per_page(); //Optional – displays the items per
//echo  $pages->current_page . ' of ' .$pages->num_pages.'';
echo '</div>';
}

}



/* SELECT ALL */
function select_busqueda($search){


$sql ="SELECT * FROM propuestas WHERE nombre_evento LIKE '%$search%';";
$result = $this->database->query($sql);
$result = $this->database->result;

$count_resultados  = 0;
while($row = mysql_fetch_array($result)){
$id_propuesta = $row['id_propuesta'];
$id_usuario = $row['id_usuario'];
$nombre_evento = $row['nombre_evento'];
$lugar = $row['lugar'];
$cant_invitados = $row['cant_invitados'];
$fecha_estimada = $row['fecha_estimada'];
$caracteristicas = $row['caracteristicas'];
$monto = $row['monto'];
$aprobado = $row['aprobado'];
$leido = $row['leido'];
$detalle_admin = $row['detalle_admin'];
$aprobado_fecha = $row['aprobado_fecha'];
$estado = $row['estado'];

include_once('../usuarios/classes/class.usuarios.php');

$usr = new usuarios();
$usr->select($id_usuario);
$nombre_usr = $usr->getstrNombre();
$apellido_usr = $usr->getstrApellido();
$email_usr = $usr->getstrEmail();
$monto_usuario = $usr->getdblCredito();

switch ($estado) {
	case 1:
		$estado = 'NO LEIDO';
	break;
	case 2:
		$estado = 'PENDIENTE';
	break;
	case 3:
		$estado = 'APROBADO';
	break;
	case 4:
		$estado = 'NO APROBADO';
	break;
	case 5:
		$estado = 'ENTREGADO';
	break;
}



echo '

<div class="item">

<div class="olive-bar_new2">
<span class="bold">Usuario: </span>'.$nombre_usr.' '.$apellido_usr.'
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">EMAIL </span>'.$email_usr.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">FECHA </span>'.$fecha_estimada.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
</div>

<div class="pubeev2">
<span class="estado">'.$estado.'</span>
<span class="monto">$'.$monto.'</span>
'.utf8_decode($caracteristicas).'



<p class="boton2">
<a href="e_propuesta.php?id='.$id_propuesta.'&activo=1&sub=a">ADMINISTRAR</a>
</p>


</div>
</div>';
$count_resultados ++;
}
//echo '<p>Resultados: '.$count_resultados.'</p>';

echo $item;
}

//
#############NO LEIDAS
/* SELECT ALL */
function select_no_leidas(){


$sql ="SELECT * FROM propuestas WHERE estado=1;";
$result = $this->database->query($sql);
$result = $this->database->result;

$count_resultados  = 0;
while($row = mysql_fetch_array($result)){
$id_propuesta = $row['id_propuesta'];
$id_usuario = $row['id_usuario'];
$nombre_evento = $row['nombre_evento'];
$lugar = $row['lugar'];
$cant_invitados = $row['cant_invitados'];
$fecha_estimada = $row['fecha_estimada'];
$caracteristicas = $row['caracteristicas'];
$monto = $row['monto'];
$aprobado = $row['aprobado'];
$leido = $row['leido'];
$detalle_admin = $row['detalle_admin'];
$aprobado_fecha = $row['aprobado_fecha'];
$estado = $row['estado'];
include_once('../usuarios/classes/class.usuarios.php');

$usr = new usuarios();
$usr->select($id_usuario);
$nombre_usr = $usr->getstrNombre();
$apellido_usr = $usr->getstrApellido();
$email_usr = $usr->getstrEmail();
$monto_usuario = $usr->getdblCredito();

switch ($estado) {
	case 1:
		$estado = 'NO LEIDO';
	break;
	case 2:
		$estado = 'PENDIENTE';
	break;
	case 3:
		$estado = 'APROBADO';
	break;
	case 4:
		$estado = 'NO APROBADO';
	break;
	case 5:
		$estado = 'ENTREGADO';
	break;
}


echo '<div class="menuorden"><a href="v_propuestas.php?orden=1"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_propuestas.php?orden=2"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>';
echo '
<div class="item">

<div class="olive-bar_new2">
<span class="bold">Usuario: </span>'.$nombre_usr.' '.$apellido_usr.'
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">EMAIL </span>'.$email_usr.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">FECHA </span>'.$fecha_estimada.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
</div>

<div class="pubeev2">
<span class="estado">'.$estado.'</span>
<span class="monto">$'.$monto.'</span>
'.utf8_decode($caracteristicas).'



<p class="boton2">
<a href="e_propuesta.php?id='.$id_propuesta.'&activo=1&sub=a">ADMINISTRAR</a>
</p>


</div>
</div>';
$count_resultados ++;
}
//echo '<p>Resultados: '.$count_resultados.'</p>';

echo $item;
}



############
//by user

/* SELECT ALL */
function select_by_suario($id_usuario){
$sql ="SELECT * FROM propuestas WHERE id_usuario = $id_usuario;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
	if($quantity < 1){
	
	$mensaje =  '<div class="item">
	
    <p style="padding:5px 0 20px 15px">Sin canjes realizados aun.</p>
	</div>';
	}

$sql ="SELECT * FROM propuestas WHERE id_usuario = $id_usuario;";
$result = $this->database->query($sql);
$result = $this->database->result;

$count_resultados  = 0;
while($row = mysql_fetch_array($result)){
$id_propuesta = $row['id_propuesta'];
$id_usuario = $row['id_usuario'];
$nombre_evento = $row['nombre_evento'];
$lugar = $row['lugar'];
$cant_invitados = $row['cant_invitados'];
$fecha_estimada = $row['fecha_estimada'];
$caracteristicas = $row['caracteristicas'];
$monto = $row['monto'];
$aprobado = $row['aprobado'];
$leido = $row['leido'];
$detalle_admin = $row['detalle_admin'];
$aprobado_fecha = $row['aprobado_fecha'];
$estado = $row['estado'];
include_once('../usuarios/classes/class.usuarios.php');

$usr = new usuarios();
$usr->select($id_usuario);
$nombre_usr = $usr->getstrNombre();
$apellido_usr = $usr->getstrApellido();
$email_usr = $usr->getstrEmail();
$monto_usuario = $usr->getdblCredito();

switch ($estado) {
	case 1:
		$estado = 'NO LEIDO';
	break;
	case 2:
		$estado = 'PENDIENTE';
	break;
	case 3:
		$estado = 'APROBADO';
	break;
	case 4:
		$estado = 'NO APROBADO';
	break;
	case 5:
		$estado = 'ENTREGADO';
	break;
}


$item .= '
<div class="item">

<div class="olive-bar_new2">
<span class="bold">Usuario: </span>'.$nombre_usr.' '.$apellido_usr.'
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">EMAIL </span>'.$email_usr.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
<span class="bold">FECHA </span>'.$fecha_estimada.'</span>
&nbsp;&nbsp&nbsp;&nbsp;
</div>

<div class="pubeev2">
<span class="estado">'.$estado.'</span>
<span class="monto">$'.$monto.'</span>
'.utf8_decode($caracteristicas).'



<p class="boton2">
<a href="e_propuesta.php?id='.$id_propuesta.'&activo=1&sub=a">ADMINISTRAR</a>
</p>


</div>
</div>';



$count_resultados ++;
}
echo $mensaje;

echo $item;
}



/* DELETE */
function delete($id){
$sql = "DELETE FROM propuestas WHERE id_propuesta = $id;";
$result = $this->database->query($sql);
}

/* INSERT */

function insert(){
$this->id_propuesta = ""; // clear key for autoincrement

$sql = "INSERT INTO propuestas ( id_usuario, nombre_evento, lugar, cant_invitados, fecha_estimada, caracteristicas, monto, aprobado, leido, detalle_admin, aprobado_fecha, estado) VALUES ( '$this->id_usuario', '$this->nombre_evento', '$this->lugar', '$this->cant_invitados', '$this->fecha_estimada', '$this->caracteristicas', '$this->monto', '$this->aprobado', '$this->leido','$this->detalle_admin', '$this->aprobado_fecha', '$this->estado')"; 
 $result = $this->database->query($sql);
$this->id_propuesta = mysql_insert_id($this->database->link);
}

/* UPDATE */

function update($id){

$sql = " UPDATE propuestas SET   id_usuario = '$this->id_usuario', nombre_evento = '$this->nombre_evento', lugar = '$this->lugar', cant_invitados = '$this->cant_invitados', fecha_estimada = '$this->fecha_estimada', caracteristicas = '$this->caracteristicas', monto = '$this->monto', aprobado = '$this->aprobado', leido = '$this->leido', detalle_admin = '$this->detalle_admin', aprobado_fecha = '$this->aprobado_fecha', estado = '$this->estado' WHERE id_propuesta = $id "; 
 $result = $this->database->query($sql);
}

/* UPDATE AVATAR */

function update_avatar($id){

$sql = " UPDATE propuestas SET  main_image = '$this->main_image' WHERE id_propuesta = $id "; 
 $result = $this->database->query($sql); 
}


} // class : end
?>