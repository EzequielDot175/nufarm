<?php require_once('Connections/conexion.php'); ?>

<?php include("includes/header.php"); ?>


<section>
<div id="buscador">

   <form name="form1" method="post" action="buscar.php">

    <input type="text" name="buscar" id="buscar" placeholder="Buscar...">

  </form>

</div>
<?php $activo = $_GET['activo']; include("includes/menu.php"); ?>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
      <div class="mcuenta_bg">	
	
<div class="tit"><span class="asunto">Realizar una Consulta</span></div>
	<?php
	$mensaje=(isset($_SESSION['mensaje'])? $_SESSION['mensaje']:'');
	if($mensaje){
		echo '<h2>'.$mensaje.'</h2>';
		unset($_SESSION['mensaje']);
	}

	if ((isset($_SESSION['MM_IdUsuario']))  && ($_SESSION['MM_IdUsuario']!="")) {
	?>	
		
		<form method="post" name="form1" action="process_consulta.php">
		   <table id="formconsulta" width="100%">
		     <tr valign="baseline">
		       <td align="left" nowrap>Asunto:</td>
		     </tr>
			 <tr valign="baseline">
				<td width="100%"><input id="asunto" type="text" name="strAsunto" value="" size="32"></td>
			 </tr>
		     <tr valign="baseline">
		       <td align="left" valign="top" nowrap>Consulta:</td>
		     </tr>
			 <tr valign="baseline">
				<td><textarea id="campo" name="strCampo"></textarea></td>
			 </tr>
		     <tr valign="baseline">
		       <td nowrap align="left"><div style="margin-right: 15px"><input id="enviar" type="submit" value="Enviar"></div>
		   <input type="hidden" name="MM_insert" value="form1"></td>
		     </tr>
		   </table>
		   
		 
		 </form>
		
<?php
	//consultas del usuario y respuestas recibidas.
	include_once('includes/class.consultas.php');
	$cons = new consultas();
	$cons->select_by_usuario($_SESSION['MM_IdUsuario']);
	
	}else{
		#echo 'No hay login';
	

 echo '<p>Necesita acceder para enviar y ver sus consultas. <a href="/login.php">Acceder</a></p>';
 	
 
  }
  
 ?>
	</div>

</article>


</section>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
