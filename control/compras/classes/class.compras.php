<?php
include_once("../resources/class.database.php");

/* CLASS DECLARATION */

class compras{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idCompra;   // KEY ATTR. WITH AUTOINCREMENT
var $idUsuario;
var $fthCompra;
var $intTipoPago;
var $dblTotal;
var $idCredito;
var $detalle;
var $estado;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */
function compras(){
	$this->database = new Database();
}


/* GETTER METHODS */
function getidCompra(){return $this->idCompra;}
function getidUsuario(){return $this->idUsuario;}
function getfthCompra(){return $this->fthCompra;}
function getintTipoPago(){return $this->intTipoPago;}
function getdblTotal(){return $this->dblTotal;}
function getidCredito(){return $this->idCredito;}
function getdetalle(){return $this->detalle;}
function getestado(){return $this->estado;}

/* SETTER METHODS */
function setidCompra($val){ $this->idCompra =  $val;}
function setidUsuario($val){ $this->idUsuario =  $val;}
function setfthCompra($val){ $this->fthCompra =  $val;}
function setintTipoPago($val){ $this->intTipoPago =  $val;}
function setdblTotal($val){ $this->dblTotal =  $val;}
function setidCredito($val){ $this->idCredito =  $val;}
function setdetalle($val){ $this->detalle =  $val;}
function setestado($val){ $this->estado =  $val;}


/* SELECT METHOD / LOAD */
function select($id){

	$sql =  "SELECT * FROM compra WHERE idCompra = '$id'";
	$result =  $this->database->query($sql);
	$result = $this->database->result;
	$row = mysql_fetch_object($result);

	$this->idCompra = $row->idCompra;
	$this->idUsuario = $row->idUsuario;
	$this->fthCompra = $row->fthCompra;
	$this->intTipoPago = $row->intTipoPago;
	$this->dblTotal = $row->dblTotal;
	$this->idCredito = $row->idCredito;
	$this->detalle = $row->detalle;
	$this->estado = $row->estado;

}
/* SELECT METHOD / LOAD PRODUCTOS*/
function select_productos($id){

	$sql =  "SELECT * FROM detalles_compras WHERE id_compra = '$id'";
	$result =  $this->database->query($sql);
	$result = $this->database->result;
	$row = mysql_fetch_object($result);

	$this->estado_producto = $row->estado_producto;

}


/* SELECT ALL */
function select_all($pagina, $orden)
{
	include('../resources/paginator.class.php');
	$vendedor_filtro = $_GET['vendedor'];
	$prod_state = $_GET['prod_state'];




	$vendedor_asignado = $_SESSION['logged_id'];
	if($_SESSION['logged_role'] ==1){
		if($vendedor_filtro >= 1){
			$sql = "SELECT * FROM usuarios  WHERE vendedor='$vendedor_filtro'  ";
			$result = $this->database->query($sql);
			$result = $this->database->result;

			while($row = mysql_fetch_array($result)){
				$clientes[] = $row['idUsuario'];
			}
			$clientes_d = implode(',', $clientes);
			$sql = "SELECT * FROM compra WHERE idUsuario IN ($clientes_d); ";


			echo "<pre>";
			print_r($sql);
			echo "</pre>";
			die();

		}else{
			$sql = "SELECT * FROM usuarios ";
			$result = $this->database->query($sql);
			$result = $this->database->result;

			while($row = mysql_fetch_array($result)){
				$clientes[] = $row['idUsuario'];
			}
			$clientes_d = implode(',', $clientes);
			$sql = "SELECT * FROM compra WHERE idUsuario IN ($clientes_d); ";
		}

	}elseif($_SESSION['logged_role'] ==2){
		
		$sql = "SELECT * FROM usuarios WHERE vendedor='$vendedor_asignado' ";
		$result = $this->database->query($sql);
		$result = $this->database->result;

		while($row = mysql_fetch_array($result)){
			$clientes[] = $row['idUsuario'];
		}
		$clientes_d = implode(',', $clientes);
		$sql = "SELECT * FROM compra WHERE idUsuario IN ($clientes_d); ";

	}elseif($_SESSION['logged_role'] ==3){
		
		$sql = "SELECT * FROM usuarios WHERE vendedor='$vendedor_asignado' ";
		$result = $this->database->query($sql);
		$result = $this->database->result;

		while($row = mysql_fetch_array($result)){
			$clientes[] = $row['idUsuario'];
		}
		$clientes_d = implode(',', $clientes);
		$sql = "SELECT * FROM compra WHERE idUsuario IN ($clientes_d); ";	
	}


	$result = $this->database->query($sql);
	$result = $this->database->result;
	$quantity= mysql_num_rows($result);
	if($quantity < 1)
		{echo '<div class="notify">
	<p>No hay compra en el sistema!</p>
	</div>';}
	else{
		$count=0;

		include_once('../usuarios/classes/class.usuarios.php');
		while($row = mysql_fetch_array($result))
		{
			$idCompra = $row['idCompra'];
			$idUsuario = $row['idUsuario'];

			$count++;
		}

		$pages = new Paginator;
		$pages->items_total = $count;
		$pages->mid_range = 10;
		$pages->paginate();
		$pages->display_pages();

		if($_SESSION['logged_role'] ==1){

			if($vendedor_filtro >= 1){
				$sql ="SELECT * FROM compra AS com INNER JOIN usuarios AS usu ON com.idUsuario=usu.idUsuario WHERE vendedor='$vendedor_filtro' ORDER BY $orden $pages->limit;";
			}
			elseif ( $prod_state)
				{$sql ="SELECT * FROM compra AS com INNER JOIN detalles_compras AS det ON com.idCompra=det.id_compra WHERE det.estado_producto = '$prod_state' GROUP BY det.id_compra ORDER BY $orden $pages->limit;";}
			else
				{$sql ="SELECT * FROM compra ORDER BY $orden $pages->limit;";}

		}elseif($_SESSION['logged_role'] ==2){

			if($vendedor_filtro >= 1){
				$sql ="SELECT * FROM compra AS com INNER JOIN usuarios AS usu ON com.idUsuario=usu.idUsuario WHERE vendedor='$vendedor_filtro' ORDER BY $orden $pages->limit;";
			}
			elseif ( $prod_state)
				{$sql ="SELECT * FROM compra AS com INNER JOIN detalles_compras AS det ON com.idCompra=det.id_compra WHERE det.estado_producto = '$prod_state' GROUP BY det.id_compra ORDER BY $orden $pages->limit;";}
			else
				{$sql ="SELECT * FROM compra ORDER BY $orden $pages->limit;";}

		}elseif($_SESSION['logged_role'] ==3){

			$sql = "SELECT * FROM usuarios WHERE vendedor='$vendedor_asignado' ";
			$result = $this->database->query($sql);
			$result = $this->database->result;
			while($row = mysql_fetch_array($result)){
				$clientes[] = $row['idUsuario'];
			}
			$clientes_d = implode(',', $clientes);
			if ( $prod_state){
				$sql ="SELECT * FROM compra AS com INNER JOIN detalles_compras AS det ON com.idCompra=det.id_compra WHERE  idUsuario IN ($clientes_d) AND det.estado_producto = '$prod_state' GROUP BY det.id_compra ORDER BY $orden $pages->limit;";
			}else
			{$sql ="SELECT * FROM compra WHERE  idUsuario IN ($clientes_d) ORDER BY $orden $pages->limit;";}
		}

		$result = $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_array($result)){

			$idCompra = $row['idCompra'];
			$idUsuario = $row['idUsuario'];
			$fthCompra = $row['fthCompra'];
			$intTipoPago = $row['intTipoPago'];
			$dblTotal = $row['dblTotal'];
			$idCredito = $row['idCredito'];
			$caracteristicas = $row['caracteristicas'];
			$monto = $row['monto'];
			$aprobado = $row['aprobado'];
			$leido = $row['leido'];
			$detalle = $row['detalle'];
			$estado = $row['estado'];

			include_once('../usuarios/classes/class.usuarios.php');

			$usr = new usuarios();
			$usr->select($idUsuario);
			$nombre_usr = $usr->getstrNombre();
			$apellido_usr = $usr->getstrApellido();
			$email_usr = $usr->getstrEmail();
			$monto_usuario = $usr->getdblCredito();
			$vendedor_usuario = $usr->getvendedor();


////////////////////////////////////////////OPCIONES ESTADO PEDIDO
			$opciones .= '
			<option value="1" ';
			if($estado ==1){$opciones .="selected=\"selected\" ";}
			$opciones .='>Pendiente</option>';
			$opciones .='
			<option value="2" ';
			if($estado ==2){$opciones .="selected=\"selected\" ";}
			$opciones .='>Finalizado</option>';


////////////////////////////////////////// PRODUCTOS CANJEADOS ITEM PEDIDO - TOTAL
			$item .= '<div class="item">
			<!-- Compra: '.$idCompra.' pertenece a vendedor : '.$vendedor_usuario.'-->
			<div class="olive-bar_new2"><span class="tit_pedido"><span class="bold">Usuario: '.utf8_decode($nombre_usr).' '.utf8_decode($apellido_usr).'</span> / '.$email_usr.'</span> <span class="fecha_tit_admin">'.$fthCompra.'</span></div>
			<form name="listado_productos" id="estform" action="update_proceso.php" method="post">
			';
//ARRANCA EL FORM------------------------------->

////////////////////////////////////////// SELECT ESTADO PEDIDO
			if($_SESSION['logged_role'] == 1){
				$item .= '
				<div class="estadopedido_box">

					<input type="hidden" name="id_compra" value="'.$idCompra.'" />
					<select name="estado_compra" id="estado1">
					'.$opciones.'
					</select>
					<button type="sybmit" class="button mainbtn">GUARDAR</button>

				</div>
				';
			}else{
				$item .= '

				<div class="estadopedido_box">
				<input type="hidden" name="id_compra" value="'.$idCompra.'" />
				<select name="estado_compra" id="estado1">
				'.$opciones.'
				</select>
				</div>
				</div>
				';
			}


			


/////////////////////////////////////////////////// TABLA PRODUCTOS CANJEADOS ///ADMIN ///TOTALES///	


			 

			$item .= '

			'.$this->bring_detalle_compra($idCompra).'
			<p>
			<!--
			<a href="d_compra.php?id='.$idCompra.'">Borrar</a>
			-->
			</p>

			<div class="total_prod_comprado">

			<div>
			<p>
			<!-- TOTAL DE PUNTOS COMENTADO
			<span class="precio_producto_compra green_style">$'.$dblTotal.'</span>
			<span class="valor_total">VALOR TOTAL</span> </p>
			-->
			</div>

			<div class="box_1_4" >
			<div class="fth-c"><!--'.$fthCompra.'--></div>
			</div>

			</div>

			</div>';

			if($_SESSION['logged_role'] == 1){
				echo $item;
			}elseif($_SESSION['logged_role'] == 2){
				echo $item;
			}else{
				//chequear si el cliente pertenece a ese vendedor
				if($_SESSION['logged_id'] == $vendedor_usuario){
					echo $item;
				}

			}
			$item = "";

			$opciones="";
		}

		echo '<div class="navigate">';
		echo $pages->display_pages();

		// Optional call which will display the page numbers after the results.
		//$pages->display_jump_menu(); // Optional – displays the page jump menu
		//echo $pages->display_items_per_page(); //Optional – displays the items per
		//echo  $pages->current_page . ' of ' .$pages->num_pages.'';

		echo '</div>';
	}
 //////////////////PODUCTOS DEL PEDIDO - NOMBRE - DETALLE - CANTIDAD - PRECIO
}

/* SELECT ALL */
function select_busqueda($search)
{
	include('../resources/paginator.class.php');
	$vendedor_filtro = $_GET['vendedor'];


	$sql = "SELECT * FROM detalles_compras  AS dc
	INNER JOIN compra AS c
	ON dc.id_compra=c.idCompra 
	WHERE dc.nombre LIKE '%$search%'";


	$result = $this->database->query($sql);
	$result = $this->database->result;
	while($row = mysql_fetch_array($result)){


		$idCompra = $row['idCompra'];
		$idUsuario = $row['idUsuario'];
		$fthCompra = $row['fthCompra'];
		$intTipoPago = $row['intTipoPago'];
		$dblTotal = $row['dblTotal'];
		$idCredito = $row['idCredito'];
		$caracteristicas = $row['caracteristicas'];
		$monto = $row['precio_pagado'];
		$aprobado = $row['aprobado'];
		$leido = $row['leido'];
		$nombre = $row['nombre'];
		$detalle = $row['detalle'];
		$estado = $row['estado'];




////////////////////////////////////////// PRODUCTOS CANJEADOS ITEM PEDIDO - TOTAL


		echo "<div class='result_search_detail'>$detalle</div>";
		echo"$$monto";
		echo"<br>";
	}
}


function bring_detalle_compra($id_compra){
/////////////////////////////////////////////////// TABLA PRODUCTOS CANJEADOS ///ADMIN




	include_once('../productos/classes/class.productos.php');
	$sql ="SELECT * FROM detalles_compras WHERE id_compra = $id_compra;";
	$result = $this->database->query($sql);
	$result = $this->database->result;
	$i=0;

	while($row = mysql_fetch_array($result)){

		$id_compra = $row['id_compra'];
		$id = $row['id'];
		$id_producto = $row['id_producto'];
		$nombre = $row['nombre'];
		$detalle = $row['detalle'];
		$remito = $row['remito'];
		$cantidad = $row['cantidad'];
		$precio_pagado = $row['precio_pagado'];
		$estado_producto = $row['estado_producto'];
		$talle = $row['talle'];
		$color = $row['color'];




/////////////////////////////////////////////SELECT ESTADO PRODUCTOS////
	//verifico si tiene imagen
		$prod = new productos();
		$prod->select($id_producto);
		$imagen_producto = $prod->getstrImagen();



		//////******************** NUEVA TABLA DE DATOS 26-08-15***************/////
		if( strlen($imagen_producto) > 0 ){
		//con imagen
			$recuadro .= '
			<table>
				<tr class="tablaDetalle tablaDefault">
				     	<td  class="colA"  align="center">
					     	FECHA
					</td>  
					<td  class="colB" align="center">
					     	TOTAL PUNTOS
					</td>
					<td  class="colC tdBackground"class="colA"  align="center">
						<div class="sub"><img class="imagen" src="../../images_productos/'.$imagen_producto.'"  alt="" /></div>
						<div class="sub text "><span>'.$precio_pagado.'</span></div>
						<span class="sub text">'.$nombre.' </span>
					</td>
					 <td class="colD tdBackground"  align="center">
					      	<span>'.$cantidad.' </span>
					 </td>
					 <td class="colE tdBackground" align="center">
						<span>'.$color.'</span>
					 </td>
					 <td class="colF tdBackground"  align="center">
						<span> '.$talle.'</span>
					 </td>
					 <td  class="colG tdBackground" align="center">
					      	NUM REMITO
					</td>
					<td  class="colH tdBackground"  align="center">
					     	<select name="estado_compra_prod'.$i.'" id="estado2">
					
							<option value="1"';
							if($estado_producto ==1){$recuadro .="selected=selected ";}
							$recuadro .= '>Pedido realizado</option>
							
							<option value="2"';
							if($estado_producto ==2){$recuadro .="selected=selected ";}
							$recuadro .= '>Pedido en Proceso</option>	
							
							<option value="3"';
							if($estado_producto ==3){$recuadro .="selected=selected";}
							$recuadro .= '>Pedido enviado</option>	
							<option value="4"';
							if($estado_producto ==4){$recuadro .="selected=selected";}
							$recuadro .= '>Pedido entregado</option>	
						</select>
					</td>
				</tr>
				<div class="botones">
					<div class="item editar">
						<a href="#">
							<img class="imagen" src="../../layout/editar.png"  alt="" />
						</a>
					</div>
					<div class="item borrar">
						<a href="delete_compras.php?id='.$id.'">borrar</a>
					</div>
				</div>
			 </table>

			


			<!--CODIGO ANTERIOR
			<div class="producto_comprado">
			<div class="box_1_4" >
			<div class="precio_producto_compra"><span>$'.$precio_pagado.'</span></div>
			</div>
			
			<div class="box_1_4" >
			<div class="box-img4"><img src="../../images_productos/'.$imagen_producto.'"  alt="" /></div>
			</div>
			<div class="box_15" >
			<span class="nombreprod">'.$nombre.' </span>
			<span class="cant">'.$cantidad.' </span>
			
			<span class="talle">'.$color .'   '.$talle .'</span>
			
			</div>
			<div class="box_10">
				'.$remito.'
			</div>
			<div class="box_1_5" >
			
			<p>
			<input type="hidden" name="num_prod" value="'.$i.'" />
			<input type="hidden" name="id_prod'.$i.'" value="'.$id_producto.'" />
			<input type="hidden" name="id_compra_prod'.$i.'" value="'.$id_compra.'" />
			<select name="estado_compra_prod'.$i.'" id="estado2">
			
			<option value="1"';
			if($estado_producto ==1){$recuadro .="selected=selected ";}
			$recuadro .= '>Pedido realizado</option>
			
			<option value="2"';
			if($estado_producto ==2){$recuadro .="selected=selected ";}
			$recuadro .= '>Pedido en Proceso</option>	
			
			<option value="3"';
			if($estado_producto ==3){$recuadro .="selected=selected";}
			$recuadro .= '>Pedido enviado</option>	
			<option value="4"';
			if($estado_producto ==4){$recuadro .="selected=selected";}
			$recuadro .= '>Pedido entregado</option>	
			</select>
			
			</div>
			<div class="delete">
			<a href="delete_compras.php?id='.$id.'">borrar</a>
			</div>
			
			</div>
			-->
			';

		}else{
		//sin imagen
			$recuadro .= '
			<div class="producto_comprado">
			<div class="box_1_4" >
			<div class="precio_producto_compra"><span>$ '.$precio_pagado.'</span></div>

			</div>
			
			<div class="box_1_4" >

			<div class="sombra5"></div>
			<div class="box-img4">
			<img  src="../../images_productos/default.png" alt=""/></div>
			</div>

			<div class="box_1_4" >
			<span class="nombreprod">'.$nombre.' </span>
			<span class="cant">'.$cantidad.' </span>
			<span class="talle">
			'.$talle.'
			</span>
			</div>
			<div class="box_1_4" >
			<p>

			<input type="hidden" name="id_prod'.$i.'" value="'.$id_producto.'" />
			<input type="hidden" name="id_compra_prod'.$i.'" value="'.$idCompra.'" />
			<select name="estado_compra_prod'.$i.'" id="estado1">
			'.$opciones_prod.'
			</select>
			

			</div>
			
			</div>';

		}

		$i++;	
	}


	echo	"</form>";
//FIN formulario PRODUCTOS
	return $recuadro;
}

//BY USUARIO
/* SELECT ALL */
function select_by_usuario($id_usuario){

	$sql ="SELECT * FROM compra WHERE idUsuario = $id_usuario;";
	$result = $this->database->query($sql);
	$result = $this->database->result;
	$quantity= mysql_num_rows($result);
	if($quantity < 1)
		{echo ' 
	<div class="item">
	<p  style="padding:5px 0 20px 15px">Sin compras realizadas aun.</p>
	</div>';}
	else{
		$count=0;
		while($row = mysql_fetch_array($result)){
			$count++;
		}



		$sql ="SELECT * FROM compra WHERE idUsuario = $id_usuario ORDER BY fthCompra DESC;";
		$result = $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_array($result)){


			$idCompra = $row['idCompra'];
			$idUsuario = $row['idUsuario'];
			$fthCompra = $row['fthCompra'];
			$intTipoPago = $row['intTipoPago'];
			$dblTotal = $row['dblTotal'];
			$idCredito = $row['idCredito'];
			$caracteristicas = $row['caracteristicas'];
			$monto = $row['monto'];
			$aprobado = $row['aprobado'];
			$leido = $row['leido'];
			$detalle = $row['detalle'];
			$estado = $row['estado'];


			include_once('../usuarios/classes/class.usuarios.php');

			$usr = new usuarios();
			$usr->select($idUsuario);
			$nombre_usr = $usr->getstrNombre();
			$apellido_usr = $usr->getstrApellido();
			$email_usr = $usr->getstrEmail();
			$monto_usuario = $usr->getdblCredito();
//////////////////////////////////////////////////////////////////////////////////////////////////////////SELECT ESTADO PEDIDO
#if($aprobado==1){$aprobado = 'Si';}else{$aprobado ='No';}

#if($leido==1){$leido = 'Si';}else{$leido ='No';}
			$opciones .= '
			<option value="1" ';
			if($estado ==1){$opciones .="selected=\"selected\" ";}
			$opciones .='>Pendiente</option>';
			$opciones .='
			<option value="2" ';
			if($estado ==2){$opciones .="selected=\"selected\" ";}
			$opciones .='>En proceso</option>';
			$opciones .='
			<option value="3" ';
			if($estado ==3){$opciones .="selected=\"selected\" ";}
			$opciones .='>Entregado</option>';

			echo '
			<div class="item">
			<div class="olive-bar_new2"><span class="tit_pedido"><span class="bold">Usuario: '.utf8_decode($nombre_usr).' '.utf8_decode($apellido_usr).'</span> / '.$email_usr.'</span> <span class="fecha_tit_admin">'.$fthCompra.'</span></div>
			';



			if($_SESSION['logged_role'] ==1){
				echo '<form id="estform" action="'.BASEURL.'/compras/update_proceso.php" method="post">
				<p>
				<input type="hidden" name="id_compra" value="'.$idCompra.'" />
				<p><select name="estado_compra" id="estado1">
				'.$opciones.'
				</select></p>
				<button type="sybmit" class="mainbtn-save">ADMINISTRAR</button>
				</form>';
			}elseif($_SESSION['logged_role'] ==2){
				echo '<form id="estform" action="'.BASEURL.'/compras/update_proceso.php" method="post">
				<p>
				<input type="hidden" name="id_compra" value="'.$idCompra.'" />
				<p><select name="estado_compra" id="estado1">
				'.$opciones.'
				</select></p>
				<button type="sybmit" class="button">GUARDAR</button>
				</form>';
			}else{
				echo '<form id="estform" action="#" method="post">
				<p>
				<input type="hidden" name="id_compra" value="'.$idCompra.'" />
				<p><select name="estado_compra" id="estado1">
				'.$opciones.'
				</select></p>

				</form>';

			}		
// Aca modificar
			echo '		


			'.$this->bring_detalle_compra($idCompra).'
			<div class="producto_comprado">
			<div class="box_1_4" >
			<div class="precio_producto_compra"><span>$ '.$precio_pagado.'</span></div>

			</div>
			
			<div class="box_1_4" >

			<div class="sombra5"></div>
			<div class="box-img4">
			<img  src="../../images_productos/default.png" alt=""/></div>
			</div>

			<div class="box_1_4" >
			<span class="nombreprod">'.$nombre.' </span>
			<span class="cant">'.$cantidad.' </span>
			<span class="talle">
			'.$talle.'
			</span>
			</div>
			<div class="box_1_4" >
			<p>

			<input type="hidden" name="id_prod'.$i.'" value="'.$id_producto.'" />
			<input type="hidden" name="id_compra_prod'.$i.'" value="'.$idCompra.'" />
			<select name="estado_compra_prod'.$i.'" id="estado1">
			'.$opciones_prod.'
			</select>
			

			</div>
			
			</div>
			';
			$opciones="";
		}


	}

}



/* DELETE */
function delete($id){
	$sql = "DELETE FROM compra WHERE idCompra = $id;";
	$result = $this->database->query($sql);

}

//<a href="v_compras.php?activo=1&sub=c"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>
//<a href="v_compras.php?activo=1&sub=c"><div class="olive-bar_new'; if(!$link_vendedor){ echo" o_b_n_active";}  echo'"><span>VER TODOS</span></div></a>
/* SELECT ALL */
function select_all_vendedores(){
	$link_vendedor=$_GET['link_vendedor'];
	$vert= $_GET['vert'];
	echo '<div class="item">
	<a href="v_compras.php?activo=1&sub=c&vert=1&vendedor=0"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>



	</div>';

	if($_SESSION['logged_role'] ==3){}else{
		$sql ="SELECT * FROM personal WHERE role>=3";
		$result = $this->database->query($sql);
		$result = $this->database->result;

		$i=1;
		while($row = mysql_fetch_array($result)){
			$id = $row['id'];
			$nombre = $row['nombre'];
			$apellido = $row['apellido'];
			$login = $row['login'];
			$role = $row['role'];
			$password = $row['password'];

			switch ($role) {
				case 1:
				$role_nombre = "Administrador";
				break;
				case 2:
				$role_nombre = "Marketing";
				break;
				case 3:
				$role_nombre = "Ventas";
				break;
			}


			echo '<div class="item">

			<a href="v_compras.php?activo=1&sub=c&vendedor='.$id.'&link_vendedor='.$i.'"><div class="olive-bar_new'; if($link_vendedor==$i){ echo" o_b_n_active";}  echo'"><span>'.$nombre.' '.$apellido.'</span></div></a>



			</div>';
			$i++;
		}
	}
}



function select_all_states(){
	$prod_state=$_GET['prod_state'];
	$vert= $_GET['vert'];
	echo '
	<div class="item">
	<a href="v_compras.php?activo=1&sub=c&vert=1&vendedor=0"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>
	</div>
	';

	echo '<div class="item">



	<a href="v_compras.php?prod_state=1&activo=1&sub=a"><div class="pub-eve';
	if($prod_state==1){ echo" o_b_n_active2";}  echo'"><span>PENDIENTE</span></div></a>

	<a href="v_compras.php?prod_state=2&activo=1&sub=a"><div class="pub-eve2';
	if($prod_state==2){ echo" o_b_n_active3";}  echo'"><span>EN PROCESO</span></div></a>
	
	<a href="v_compras.php?prod_state=3&activo=1&sub=a"><div class="pub-eve3';
	if($prod_state==3){ echo" o_b_n_active4";}  echo'"><span>ENVIADO</span></div></a>
	
	<a href="v_compras.php?prod_state=4&activo=1&sub=a"><div class="pub-eve5';
	if($prod_state==4){ echo" o_b_n_active6";}  echo'"><span>ENTREGADO</span></div></a>
	</div>';

}






function select_all_vendedores_pub_eve(){
	$action_status=$_GET['action_status'];
	echo '<div class="item">

	<a href="v_propuestas.php?action_status=1&activo=1&sub=a"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>

	</div>';


	echo '<div class="item">



	<a href="v_propuestas.php?action_status=1&activo=1&sub=a"><div class="pub-eve';
	if($action_status==1){ echo" o_b_n_active2";}  echo'"><span>NO LEIDO</span></div></a>

	<a href="v_propuestas.php?action_status=2&activo=1&sub=a"><div class="pub-eve2';
	if($action_status==2){ echo" o_b_n_active3";}  echo'"><span>PENDIENTE</span></div></a>
	
	<a href="v_propuestas.php?action_status=3&activo=1&sub=a"><div class="pub-eve3';
	if($action_status==3){ echo" o_b_n_active4";}  echo'"><span>APROBADO</span></div></a>
	
	<a href="v_propuestas.php?action_status=4&activo=1&sub=a"><div class="pub-eve4';
	if($action_status==4){ echo" o_b_n_active5";}  echo'"><span>NO APROBADO</span></div></a>
	
	<a href="v_propuestas.php?action_status=5&activo=1&sub=a"><div class="pub-eve5';
	if($action_status==5){ echo" o_b_n_active6";}  echo'"><span>ENTREGADO</span></div></a>
	</div>';

}



function select_all_vendedores_clientes(){
	$link_vendedor=$_GET['link_vendedor'];
	$vert= $_GET['vert'];
	echo '<div class="item">

	<a href="v_usuarios.php?activo=1&sub=c&vert=1"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>



	</div>';
	if($_SESSION['logged_role'] ==3){}else{
		$sql ="SELECT * FROM personal WHERE role>=3";
		$result = $this->database->query($sql);
		$result = $this->database->result;

		$i=1;
		while($row = mysql_fetch_array($result)){
			$id = $row['id'];
			$nombre = $row['nombre'];
			$apellido = $row['apellido'];
			$login = $row['login'];
			$role = $row['role'];
			$password = $row['password'];

			switch ($role) {
				case 1:
				$role_nombre = "Administrador";
				break;
				case 2:
				$role_nombre = "Marketing";
				break;
				case 3:
				$role_nombre = "Ventas";
				break;
			}


			echo '<div class="item">

			<a href="v_usuarios.php?activo=2&sub=e&vendedor='.$id.'&link_vendedor='.$i.'"><div class="olive-bar_new'; if($link_vendedor==$i){ echo" o_b_n_active";}  echo'"><span>'.$nombre.' '.$apellido.'</span></div></a>



			</div>';
			$i++;
		}
	}
}



function prod_pendientes(){
	$sql ="SELECT * FROM detalles_compras WHERE estado_producto=1;";
	$result = $this->database->query($sql);
	$result = $this->database->result;
	$quantity= mysql_num_rows($result);
	if($quantity < 1){
		echo '<div class="noresult"><div class="notify">
		<p>SIN CANJES PENDIENTES</p>
		</div></div>';
	}else{
		echo '<div class="notify">
		<p><a href="'.BASEURL.'/compras/v_compras.php?prod_state=1&activo=1&sub=a">Canjes Pendientes  '.$quantity.'</a></p>
		</div>';
	}


}





































function insert_detalle_productos($id_compra,$id_producto,$nombre,$detalle,$cantidad,$precio_pagado){

#$this->idCompra = ""; // clear key for autoincrement
	$sql = "INSERT INTO detalles_compras( id_compra, id_producto, nombre, detalle, cantidad, precio_pagado ) VALUES ('$id_compra', '$id_producto', '$nombre', '$detalle', '$cantidad', '$precio_pagado')";
	$result = $this->database->query($sql);
	return $this->idCompra = mysql_insert_id($this->database->link);

}



/* INSERT */

function insert(){
$this->idCompra = ""; // clear key for autoincrement

$sql = "INSERT INTO compra ( idUsuario,fthCompra,intTipoPago,dblTotal,idCredito,detalle, estado ) VALUES ( '$this->idUsuario','$this->fthCompra','$this->intTipoPago','$this->dblTotal','$this->idCredito','$this->detalle','$this->estado' )";
$result = $this->database->query($sql);
return $this->idCompra = mysql_insert_id($this->database->link);

}


/* UPDATE PEDIDO*/

function update($id){
	$sql = " UPDATE compra SET  idUsuario = '$this->idUsuario',fthCompra = '$this->fthCompra',intTipoPago = '$this->intTipoPago',dblTotal = '$this->dblTotal',idCredito = '$this->idCredito',detalle = '$this->detalle', estado = '$this->estado' WHERE idCompra = $id ";

	$result = $this->database->query($sql);

}
/* UPDATE PRODUCTOS*/
function update_prod($id){
	$sql = " UPDATE detalles_compras SET  estado_producto = '$this->estado2' WHERE id_compra = '$id' AND id_producto='$this->id_producto' ";
	$result = $this->database->query($sql);
}


} // class : end

?>