<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');

$id_propuesta = $_POST['id_propuesta'];
$monto = $_POST['monto'];
$aprobado = $_POST['aprobado'];
$estado  = $_POST['estado'];
$aprobado_fecha = $_POST['aprobado_fecha'];
$detalle_admin = $_POST['detalle_admin'];

$aprobado_fecha = date("Y-m-d h:m:s");


include_once("classes/class.propuestas.php");
$propuestas= new propuestas();
$propuestas->select($id_propuesta);
$id_propuesta=$propuestas->getid_propuesta();
$id_usuario=$propuestas->getid_usuario();
$nombre_evento=$propuestas->getnombre_evento();
$lugar=$propuestas->getlugar();
$cant_invitados=$propuestas->getcant_invitados();
$fecha_estimada=$propuestas->getfecha_estimada();
$caracteristicas=$propuestas->getcaracteristicas();
$monto_original=$propuestas->getmonto();

$detalle_compra = $detalle_admin;

include_once("../usuarios/classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select($id_usuario);
$dblCredito=$usuarios->getdblCredito();

$monto_actualizado =  $dblCredito - $monto;
$usuarios= new usuarios();
$usuarios->select($id_usuario);
$usuarios->dblCredito=$monto_actualizado;
$usuarios->update($id_usuario);




/*  No se guarda mas en compras por que se muestra en dos tablas difenrentes en el front
include_once("../compras/classes/class.compras.php");
$compra = new compras();
$compra->idUsuario = $id_usuario;
$compra->detalle = $detalle;
$compra->idUsuario = $id_usuario;
$compra->detalle = $detalle_compra;
$compra->fthCompra = $aprobado_fecha;
$compra->dblTotal = $monto;
$last_compra = $compra->insert();

# 6 = pendiente
# 7 = leido
# 8 = aprobado



$detalle_compra = $detalle_admin;

$compradet= new compras();
$compradet->insert_detalle_productos($last_compra,0,$detalle_compra,$detalle_compra,1,$monto);
*/
# 1 pendiente / 2 En proceso / 3 Aprobado / 4 No aprobado / 5 Entregado  
if ($monto>=1){
	if($estado == 3){
	 
	$modificacion = "Propuesta aprobada. ($$monto)";

		//guardo en historia del cliente
		include_once("../historiales/classes/class.historiales.php");
		$hist = new historiales();
		$hist->id_usuario = $id_usuario;
		$hist->fecha = date("Y-m-d");
		$hist->realizado_por = "Aprobacion de propuesta";
		$hist->tipo_modificacion = $modificacion;
		$hist->monto_modificado = $monto_actualizado;
		$hist->insert();
		
		$aprobado =1;

		/* UPDATE */
		include_once("classes/class.propuestas.php");
		$propuestas= new propuestas();
		$propuestas->select($id_propuesta);
		$propuestas->monto = $monto;
		$propuestas->aprobado = $aprobado;
		$propuestas->leido = $leido;
		$propuestas->aprobado_fecha = $aprobado_fecha;
		$propuestas->detalle_admin = $detalle_admin;
		$propuestas->estado = 3;
		$propuestas->update($id_propuesta);

	#idUsuario,fthCompra,intTipoPago,dblTotal,idCredito,detalle

	}elseif ($estado == 5) {
		/* UPDATE */
		include_once("classes/class.propuestas.php");
		$propuestas= new propuestas();
		$propuestas->select($id_propuesta);
		$propuestas->estado = $estado;
		$propuestas->update($id_propuesta);
	}else{
		$aprobado = 0;
		/* UPDATE */
		include_once("classes/class.propuestas.php");
		$propuestas= new propuestas();
		$propuestas->select($id_propuesta);
		$propuestas->monto = $monto;
		$propuestas->aprobado = $aprobado;
		$propuestas->leido = $leido;
		$propuestas->aprobado_fecha = $aprobado_fecha;
		$propuestas->detalle_admin = $detalle_admin;
		$propuestas->estado = $estado;
		$propuestas->update($id_propuesta);

	}
}
else
{
	if($estado == 3){
	 
	$modificacion = "Propuesta aprobada. ($$monto)";

		//guardo en historia del cliente
		include_once("../historiales/classes/class.historiales.php");
		$hist = new historiales();
		$hist->id_usuario = $id_usuario;
		$hist->fecha = date("Y-m-d");
		$hist->realizado_por = "Aprobacion de propuesta";
		$hist->tipo_modificacion = $modificacion;
		$hist->insert();
		
		$aprobado =1;

		/* UPDATE */
		include_once("classes/class.propuestas.php");
		$propuestas= new propuestas();
		$propuestas->select($id_propuesta);
		$propuestas->aprobado = $aprobado;
		$propuestas->leido = $leido;
		$propuestas->aprobado_fecha = $aprobado_fecha;
		$propuestas->detalle_admin = $detalle_admin;
		$propuestas->estado = 3;
		$propuestas->update($id_propuesta);

	#idUsuario,fthCompra,intTipoPago,dblTotal,idCredito,detalle

	}elseif ($estado == 5) {
		/* UPDATE */
		include_once("classes/class.propuestas.php");
		$propuestas= new propuestas();
		$propuestas->select($id_propuesta);
		$propuestas->estado = $estado;
		$propuestas->update($id_propuesta);
	}else{
		$aprobado = 0;
		/* UPDATE */
		include_once("classes/class.propuestas.php");
		$propuestas= new propuestas();
		$propuestas->select($id_propuesta);
		$propuestas->aprobado = $aprobado;
		$propuestas->leido = $leido;
		$propuestas->aprobado_fecha = $aprobado_fecha;
		$propuestas->detalle_admin = $detalle_admin;
		$propuestas->estado = $estado;
		$propuestas->update($id_propuesta);

	}
}

 
$_SESSION['msg_ok'] = 'Propuesta actualizada!';
header('Location: '.BASEURL.'/propuestas/v_propuestas.php');
?>