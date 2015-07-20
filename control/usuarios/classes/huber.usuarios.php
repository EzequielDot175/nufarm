
<form method="post" action="c_usuario.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; usuarios &nbsp; </strong></legend>

<div class="form-item">

<label for="cstrNombre">StrNombre</label>
<p><input type="text" name="strNombre" id="strNombre" /></p>

</div>

<div class="form-item">

<label for="cstrApellido">StrApellido</label>
<p><input type="text" name="strApellido" id="strApellido" /></p>

</div>

<div class="form-item">

<label for="cstrEmail">StrEmail</label>
<p><input type="text" name="strEmail" id="strEmail" /></p>

</div>

<div class="form-item">

<label for="cstrEmpresa">StrEmpresa</label>
<p><input type="text" name="strEmpresa" id="strEmpresa" /></p>

</div>

<div class="form-item">

<label for="cstrCargo">StrCargo</label>
<p><input type="text" name="strCargo" id="strCargo" /></p>

</div>

<div class="form-item">

<label for="cstrPassword">StrPassword</label>
<p><input type="text" name="strPassword" id="strPassword" /></p>

</div>

<div class="form-item">

<label for="cdblCredito">DblCredito</label>
<p><input type="text" name="dblCredito" id="dblCredito" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_usuarios.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>

$strNombre=$_POST['strNombre'];
$strApellido=$_POST['strApellido'];
$strEmail=$_POST['strEmail'];
$strEmpresa=$_POST['strEmpresa'];
$strCargo=$_POST['strCargo'];
$strPassword=$_POST['strPassword'];
$dblCredito=$_POST['dblCredito'];


/* INSERT */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->idUsuario=$idUsuario;
$usuarios->strNombre=$strNombre;
$usuarios->strApellido=$strApellido;
$usuarios->strEmail=$strEmail;
$usuarios->strEmpresa=$strEmpresa;
$usuarios->strCargo=$strCargo;
$usuarios->strPassword=$strPassword;
$usuarios->dblCredito=$dblCredito;
$usuarios->insert();

echo '<div class="notify"><p>usuario Creada!</p><p><a href="v_usuarios.php">Regresar</a></p></div>';

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select($id);
$idUsuario=$usuarios->getidUsuario();
$strNombre=$usuarios->getstrNombre();
$strApellido=$usuarios->getstrApellido();
$strEmail=$usuarios->getstrEmail();
$strEmpresa=$usuarios->getstrEmpresa();
$strCargo=$usuarios->getstrCargo();
$strPassword=$usuarios->getstrPassword();
$dblCredito=$usuarios->getdblCredito();

<form method="post" action="u_usuario.php" id="simpleform"  >
<fieldset>
<legend><strong> &nbsp; usuarios &nbsp; </strong></legend>


<div class="form-item">
<label for="cstrNombre">StrNombre</label>
<input type="text" name="strNombre" id="strNombre" value="<?php echo $strNombre;?>" />
</div>


<div class="form-item">
<label for="cstrApellido">StrApellido</label>
<input type="text" name="strApellido" id="strApellido" value="<?php echo $strApellido;?>" />
</div>


<div class="form-item">
<label for="cstrEmail">StrEmail</label>
<input type="text" name="strEmail" id="strEmail" value="<?php echo $strEmail;?>" />
</div>


<div class="form-item">
<label for="cstrEmpresa">StrEmpresa</label>
<input type="text" name="strEmpresa" id="strEmpresa" value="<?php echo $strEmpresa;?>" />
</div>


<div class="form-item">
<label for="cstrCargo">StrCargo</label>
<input type="text" name="strCargo" id="strCargo" value="<?php echo $strCargo;?>" />
</div>


<div class="form-item">
<label for="cstrPassword">StrPassword</label>
<input type="text" name="strPassword" id="strPassword" value="<?php echo $strPassword;?>" />
</div>


<div class="form-item">
<label for="cdblCredito">DblCredito</label>
<input type="text" name="dblCredito" id="dblCredito" value="<?php echo $dblCredito;?>" />
</div>

<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>
$idUsuario = $_POST['idUsuario'];
$strNombre=$_POST['strNombre'];
$strApellido=$_POST['strApellido'];
$strEmail=$_POST['strEmail'];
$strEmpresa=$_POST['strEmpresa'];
$strCargo=$_POST['strCargo'];
$strPassword=$_POST['strPassword'];
$dblCredito=$_POST['dblCredito'];


/* UPDATE */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();

$usuarios->select($idUsuario);
$usuarios->idUsuario=$idUsuario;
$usuarios->strNombre=$strNombre;
$usuarios->strApellido=$strApellido;
$usuarios->strEmail=$strEmail;
$usuarios->strEmpresa=$strEmpresa;
$usuarios->strCargo=$strCargo;
$usuarios->strPassword=$strPassword;
$usuarios->dblCredito=$dblCredito;
$usuarios->update($idUsuario);


echo '<div class="notify"><p>usuario actualizada!</p><p><a href="v_usuarios.php">Regresar</a></p></div>';

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select($id);
$idUsuario=$usuarios->getidUsuario();
$strNombre=$usuarios->getstrNombre();
$strApellido=$usuarios->getstrApellido();
$strEmail=$usuarios->getstrEmail();
$strEmpresa=$usuarios->getstrEmpresa();
$strCargo=$usuarios->getstrCargo();
$strPassword=$usuarios->getstrPassword();
$dblCredito=$usuarios->getdblCredito();

if($_POST['confirm']){
$id=$_POST['id_usuario'];

/* DELETE */

include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select($id);
$usuarios->delete($id);

echo '<div class="notify"><p>usuario, eliminado!</p><p><a href="v_usuarios.php">Regresar</a></p></div>';

}
else{
echo '<div class="dividerclean"><form action="d_usuario.php?id='.$id.'" id="simpleform" method="post">
		<fieldset>
			<legend><strong> &nbsp; usuario &nbsp; </strong></legend>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este usuario? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_usuario" name="id_usuario" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_usuarios.php\'">Cancelar</button></div>
	
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
$orden = "idUsuario DESC";
}
if($orden==2){
$orden = "idUsuario ASC";
}
if($orden==3){
$orden = "idUsuario ASC";
}
if($orden==""){
$orden = "idUsuario ASC";
}

echo '<div class="menuorden"><a href="v_usuarios.php?orden=1"><img src="../layout/btn-orden1.jpg" alt="desc"/></a><a href="v_usuarios.php?orden=2"><img src="../layout/btn-orden2.jpg" alt="desc"/></a></div>';
/* SELECT */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select_all($pagina, $orden);
<div id="ajax_strNombre"><p onclick="modify_strNombre();">strNombre</p></div>
<div id="ajax_strApellido"><p onclick="modify_strApellido();">strApellido</p></div>
<div id="ajax_strEmail"><p onclick="modify_strEmail();">strEmail</p></div>
<div id="ajax_strEmpresa"><p onclick="modify_strEmpresa();">strEmpresa</p></div>
<div id="ajax_strCargo"><p onclick="modify_strCargo();">strCargo</p></div>
<div id="ajax_strPassword"><p onclick="modify_strPassword();">strPassword</p></div>
<div id="ajax_dblCredito"><p onclick="modify_dblCredito();">dblCredito</p></div>
