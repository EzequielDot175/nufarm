<?php session_start();

$id_compra = $_POST['id_compra'];
$nuevo_proceso = $_POST['estado_compra'];
$num_prod = $_POST['num_prod'];

include_once('classes/class.compras.php');


//////////////////////////////////////////PEDIDO
$update = new compras();
$update->select($id_compra);
$update->estado = $nuevo_proceso;
$update->update($id_compra);

//////////////////////////////////////////PRODUCTOS
$i=0;
while($i <= $num_prod){


$update = new compras();
$update->select_productos($_POST['id_compra_prod'.$i]);
$update->estado2 = $_POST['estado_compra_prod'.$i];
$update->id_producto = $_POST['id_prod'.$i];
$update->update_prod($_POST['id_compra_prod'.$i]);
$i++;
}

$_SESSION['msg_ok'] = 'Estado Modificado!';
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>