<?php
include_once("Connections/class.database.php");

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
$this->aprobado_fecha = $row->aprobado_fecha;
$this->estado = $row->estado;
}



/* SELECT ALL */
function select_by_usuario($id_usuario){
$sql ="SELECT * FROM propuestas WHERE id_usuario = $id_usuario ;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay propuestas</p>
		</div>';}
		else{

}

$sql ="SELECT * FROM propuestas WHERE id_usuario = $id_usuario";
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
$detalle_admin = $row['detalle_admin'];
$monto = $row['monto'];
$aprobado = $row['aprobado'];
$leido = $row['leido'];
$aprobado_fecha = $row['aprobado_fecha'];
$estado = $row['estado'];

# 1 pendiente / 2 En proceso / 3 Aprobado / 4 No aprobado / 5 Entregado  
if($estado==3 || $estado ==5){$monto_actual = $monto;}else{$monto_actual = 0;}
#if($estado==5){$monto_actual = $monto;}else{$monto_actual = 0;}

switch ($estado) {
	case 1:
		$estado = 'Pendiente';
	break;
	case 2:
		$estado = 'En Proceso';
	break;
	case 3:
		$estado = 'Aprobado';
	break;
	case 4:
		$estado = 'No Aprobado';
	break;
	case 5:
		$estado = 'Entregado';
	break;
}


echo '



<tr bgcolor="#FFFFFF" style="font-size:12px;">
  
 
  <td colspan="4" height="21" bgcolor="#DDE99E" style="color:#008752;text-align:left; text-transform:uppercase; padding-left:10px;">PROPUESTA: '.$fecha_estimada.'</td>
  
</tr><tr>
  <td align="center" style="font-size:22px; color:#008752">$'.$monto_actual.'</td>
  <td align="center" style="font-size:12px;">X</td>
 
 <td style="padding-left:10px;">'.$caracteristicas.'</td>
  <td align="center" style="font-size:12px;">ESTADO: '.$estado.'</td>
  

</tr>

';
if($detalle_admin!=""){
echo '<tr>

<td colspan="4" height="21" bgcolor="#DDD" style="color:#008752;text-align:left;  padding-left:10px;">DETALLES ADMINISTRACION: '.$detalle_admin.'</td></tr>';


}
}


}

/* DELETE */
function delete($id){
$sql = "DELETE FROM propuestas WHERE id_propuesta = $id;";
$result = $this->database->query($sql);
}

/* INSERT */

function insert(){
$this->id_propuesta = ""; // clear key for autoincrement

$sql = "INSERT INTO propuestas ( id_usuario, nombre_evento, lugar, cant_invitados, fecha_estimada, caracteristicas, monto, aprobado, leido, aprobado_fecha, estado) VALUES ( '$this->id_usuario', '$this->nombre_evento', '$this->lugar', '$this->cant_invitados', '$this->fecha_estimada', '$this->caracteristicas', '$this->monto', '$this->aprobado', '$this->leido', '$this->aprobado_fecha', '$this->estado')"; 
 $result = $this->database->query($sql);
$this->id_propuesta = mysql_insert_id($this->database->link);
}

/* UPDATE */

function update($id){

$sql = " UPDATE propuestas SET   id_usuario = '$this->id_usuario', nombre_evento = '$this->nombre_evento', lugar = '$this->lugar', cant_invitados = '$this->cant_invitados', fecha_estimada = '$this->fecha_estimada', caracteristicas = '$this->caracteristicas', monto = '$this->monto', aprobado = '$this->aprobado', leido = '$this->leido', aprobado_fecha = '$this->aprobado_fecha', estado = '$this->estado' WHERE id_propuesta = $id "; 
 $result = $this->database->query($sql);
}

/* UPDATE AVATAR */

function update_avatar($id){

$sql = " UPDATE propuestas SET  main_image = '$this->main_image' WHERE id_propuesta = $id "; 
 $result = $this->database->query($sql); 
}


} // class : end
?>