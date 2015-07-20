<?php session_start();
if(!$_SESSION['logged_id']){
header('Location: ../control/index.php?activo=1&sub=c');
// header('Location: http://www.productosnufarm.com.ar/control/index.php?activo=1&sub=c');
 // header('Location:http://184.172.50.89/~pnufarm/control/index.php');
}
else{
header('Location:../control/compras/v_compras.php?activo=1&sub=c');
// header('Location:http://184.172.50.89/~pnufarm/control/categorias/v_categorias.php');
// header('Location:http://www.productosnufarm.com.ar/control/compras/v_compras.php');
}
?>