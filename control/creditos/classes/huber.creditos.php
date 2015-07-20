
<form method="post" action="c_credito.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; creditos &nbsp; </strong></legend>

<div class="form-item">

<label for="cidUsuario">IdUsuario</label>
<p><input type="text" name="idUsuario" id="idUsuario" /></p>

</div>

<div class="form-item">

<label for="cidProducto">IdProducto</label>
<p><input type="text" name="idProducto" id="idProducto" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_creditos.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>

$idUsuario=$_POST['idUsuario'];
$idProducto=$_POST['idProducto'];


/* INSERT */
include_once("classes/class.creditos.php");
$creditos= new creditos();
$creditos->idCredito=$idCredito;
$creditos->idUsuario=$idUsuario;
$creditos->idProducto=$idProducto;
$creditos->insert();

echo '<div class="notify"><p>credito Creada!</p><p><a href="v_creditos.php">Regresar</a></p></div>';

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.creditos.php");
$creditos= new creditos();
$creditos->select($id);
$idCredito=$creditos->getidCredito();
$idUsuario=$creditos->getidUsuario();
$idProducto=$creditos->getidProducto();

<form method="post" action="u_credito.php" id="simpleform"  >
<fieldset>
<legend><strong> &nbsp; creditos &nbsp; </strong></legend>


<div class="form-item">
<label for="cidUsuario">IdUsuario</label>
<input type="text" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario;?>" />
</div>


<div class="form-item">
<label for="cidProducto">IdProducto</label>
<input type="text" name="idProducto" id="idProducto" value="<?php echo $idProducto;?>" />
</div>

<input type="hidden" name="idCredito" id="idCredito" value="<?php echo $idCredito; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>
$idCredito = $_POST['idCredito'];
$idUsuario=$_POST['idUsuario'];
$idProducto=$_POST['idProducto'];


/* UPDATE */
include_once("classes/class.creditos.php");
$creditos= new creditos();

$creditos->select($idCredito);
$creditos->idCredito=$idCredito;
$creditos->idUsuario=$idUsuario;
$creditos->idProducto=$idProducto;
$creditos->update($idCredito);


echo '<div class="notify"><p>credito actualizada!</p><p><a href="v_creditos.php">Regresar</a></p></div>';

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.creditos.php");
$creditos= new creditos();
$creditos->select($id);
$idCredito=$creditos->getidCredito();
$idUsuario=$creditos->getidUsuario();
$idProducto=$creditos->getidProducto();

if($_POST['confirm']){
$id=$_POST['id_credito'];

/* DELETE */

include_once("classes/class.creditos.php");
$creditos= new creditos();
$creditos->select($id);
$creditos->delete($id);

echo '<div class="notify"><p>credito, eliminado!</p><p><a href="v_creditos.php">Regresar</a></p></div>';

}
else{
echo '<div class="dividerclean"><form action="d_credito.php?id='.$id.'" id="simpleform" method="post">
		<fieldset>
			<legend><strong> &nbsp; credito &nbsp; </strong></legend>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este credito? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_credito" name="id_credito" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_creditos.php\'">Cancelar</button></div>
	
		</fieldset>
	</form></div>
';
} 
$pagina=$_GET['page'];
$ipp=$_GET['ipp'];
if(!$pagina){
$pagina==0;
}
$orden= $_GET['orden'];

if($orden==1){
$orden = "idCredito DESC";
}
if($orden==2){
$orden = "idCredito ASC";
}
if($orden==3){
$orden = "idCredito ASC";
}
if($orden==""){
$orden = "idCredito ASC";
}

echo '<div class="menuorden"><a href="v_creditos.php?orden=1"><img src="../layout/btn-orden1.jpg" alt="desc"/></a><a href="v_creditos.php?orden=2"><img src="../layout/btn-orden2.jpg" alt="desc"/></a></div>';
/* SELECT */
include_once("classes/class.creditos.php");
$creditos= new creditos();
$creditos->select_all($pagina, $orden);
<div id="ajax_idUsuario"><p onclick="modify_idUsuario();">idUsuario</p></div>
<div id="ajax_idProducto"><p onclick="modify_idProducto();">idProducto</p></div>
