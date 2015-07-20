<?php session_start(); error_reporting(ALL);

$finalizado=0;
require("classes/PHPMailerAutoload.php");


$nombre_del_evento = $_POST['strnombrecompleto'];
$lugar =$_POST['strlugar'];
$cantidad_invitados = $_POST['strcantidadinvitados'];

//LA FECHA ESTIMADA se usa para guarda la fecha de echo la propuesta
$fecha_estimada = date("d-m-Y");//=$_POST['fthfechaestimada'];
$caracteristicas = $_POST['strcaracteristicas'];
$enviado_desde = $_POST['envio_desde'];


include_once('includes/class.usuarios.php');

$usuario = new usuarios();
$usuario->select($_SESSION['MM_IdUsuario']);
$nombre_usuario = $usuario->getstrNombre();
$apellido_usuario = $usuario->getstrApellido();
$email_usuario = $usuario->getstrEmail();

if($enviado_desde == 'ploteo_vidriera'){
	
	$detalle = '
	<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa">'.$nombre_usuario.', '.$apellido_usuario.' | '.$email_usuario.'<br>
</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="prod">Ploteo Vidriera</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec1"><span class="mailbold">Tipo de aviso:</span> '.$_POST['strnombrecompleto'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec2"><span class="mailbold">Lugar:</span> '.$_POST['strlugar'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec3"><span class="mailbold">Medidas:</span> '.$_POST['strcantidadinvitados'].'</span></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec4"><span class="mailbold">Fecha estimada:</span>'.$_POST['fthfechaestimada'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" alt="" width="8" height="11"><span class="sec5 carac"><span class="mailbold">Caracteristicas:</span>'.$_POST['strcaracteristicas'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>
	';	
}
elseif ($enviado_desde == 'aviso_grafico') {
	$detalle = '
	<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa">'.$nombre_usuario.', '.$apellido_usuario.' | '.$email_usuario.'<br>
</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="prod">Aviso Gráfico</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec1"><span class="mailbold">Tipo de aviso:</span> '.$_POST['strnombrecompleto'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec2"><span class="mailbold">Lugar:</span> '.$_POST['strlugar'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec3"><span class="mailbold">Medidas:</span> '.$_POST['strcantidadinvitados'].'</span></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec4"><span class="mailbold">Fecha estimada:</span>'.$_POST['fthfechaestimada'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" alt="" width="8" height="11"><span class=" sec5 carac"><span class="mailbold">Caracteristicas:</span>'.$_POST['strcaracteristicas'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>';	
	
}
elseif ($enviado_desde == 'aviso_radial') {
	$detalle = '
		<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa">'.$nombre_usuario.', '.$apellido_usuario.' | '.$email_usuario.'<br>
'.$_POST['fthfechaestimada'].'</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="prod">Aviso Radial</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec1"><span class="mailbold">Producto que desea promocionar:</span>'.$_POST['strnombrecompleto'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec2"><span class="mailbold">Medio:</span> '.$_POST['strlugar'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec3"><span class="mailbold">Fecha estimada de emisión:</span>'.$_POST['fthfechaestimada'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" alt="" width="8" height="11"><span class="sec5 carac"><span class="mailbold">Caracteristicas:</span>'.$_POST['strcaracteristicas'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
    <tr>
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>
	';	
}
elseif ($enviado_desde == 'cartel_frente') {
	$detalle = '
		<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa">'.$nombre_usuario.', '.$apellido_usuario.' | '.$email_usuario.'<br>
</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="prod">Cartel Frente</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec1"><span class="mailbold">Tipo de aviso:</span> '.$_POST['strnombrecompleto'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec2"><span class="mailbold">Lugar:</span>'.$_POST['strlugar'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec3"><span class="mailbold">Medidas:</span>'.$_POST['strcantidadinvitados'].'</span></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec4"><span class="mailbold">Soporte:</span> '.$_POST['fthfechaestimada'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" alt="" width="8" height="11"><span class="sec5 carac"><span class="mailbold">Caracteristicas:</span>'.$_POST['strcaracteristicas'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>';

}
elseif ($enviado_desde == 'cartel_interior') {
	$detalle = '
		<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa">'.$nombre_usuario.', '.$apellido_usuario.' | '.$email_usuario.'<br>
</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="prod">Cartel Interior</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec1"><span class="mailbold">Tipo de aviso:</span> '.$_POST['strnombrecompleto'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec2"><span class="mailbold">Lugar:</span>'.$_POST['strlugar'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec3"><span class="mailbold">Medidas:</span>'.$_POST['strcantidadinvitados'].'</span></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec4"><span class="mailbold">Soporte:</span>'.$_POST['fthfechaestimada'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" alt="" width="8" height="11"><span class="sec5 carac"><span class="mailbold">Caracteristicas:</span>'.$_POST['strcaracteristicas'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
    <tr>
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>';
                    
}
elseif ($enviado_desde == 'evento_interno') {
	$detalle = '
	
			<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa">'.$nombre_usuario.', '.$apellido_usuario.' | '.$email_usuario.'<br>
</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="prod">Evento Externo</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec1"><span class="mailbold">Nombre del evento:</span> '.$_POST['strnombrecompleto'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec2"><span class="mailbold"><span class="mailbold">Lugar:</span> '.$_POST['strlugar'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec3"><span class="mailbold">Cantidad estimada de invitados:</span> '.$_POST['strcantidadinvitados'].'</span></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec4"><span class="mailbold">Fecha estimada:</span>'.$_POST['fthfechaestimada'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" alt="" width="8" height="11"><span class="sec5 carac"><span class="mailbold">Caracteristicas:</span>'.$_POST['strcaracteristicas'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
    <tr>
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>
	';
                    
}
elseif ($enviado_desde == 'evento_externo') {
	$detalle = '
			<table width="500" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr class="trhide">
    <td colspan="3"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_ADMIN-03.jpg" width="500" height="197"></td>
  </tr>
  <tr>
    <td width="3">&nbsp;</td>
    <td width="433" class="emmpresa">'.$nombre_usuario.', '.$apellido_usuario.' | '.$email_usuario.'<br>
</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td class="prod">Evento Interno</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec1"><span class="mailbold">Nombre del evento:</span> '.$_POST['strnombrecompleto'].'</span></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec2"><span class="mailbold">Lugar:</span> '.$_POST['strlugar'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec3"><span class="mailbold">Cantidad estimada de invitados:</span>'.$_POST['strcantidadinvitados'].'</span></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11"><span class="sec4"><span class="mailbold">Fecha estimada:</span>'.$_POST['fthfechaestimada'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" alt="" width="8" height="11"><span class=" sec5 carac"><span class="mailbold">Caracteristicas:</span>'.$_POST['strcaracteristicas'].'</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td class="total"></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="trhide">
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
    <tr>
    <td height="12" colspan="3"><hr width="100%" size="1" noshade></td>
  </tr>
  <tr class="trhide">
    <td height="39">&nbsp;</td>
    <td align="left" valign="top"><p class="miniatura"><img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mailINFO-04.jpg" width="17" height="17" align="left">Consulte el detalle del pedido en www.productosnufarm.com/control</p>
    <span style="text-align: right">    <span class="BOLD">nufarm.com/ar</span><br>
    </span>
    <hr noshade></td>
    <td>&nbsp;</td>
  </tr>
</table>
	';
                    
}






$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
body {

}
body {
font-family:"verdana";
	font-size: 13px;
}
.miniatura {
	font-size: 10px;
}
.BOLD {
	font-weight: bold;
	margin-bottom: -20px;
	padding-bottom: -20px;
	font-size: 12px;
}
hr{
	background-color:#eee !important;
	color:#eee !important;
	height: 0px;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #eee;
	border-right-color: #eee;
	border-bottom-color: #eee;
	border-left-color: #eee;
}
.total {
	font-weight: bold;
	color: #099642;
}
.emmpresa {
	font-size: 18px;
}
.td{
	font-size: 12px;
}
</style>
</head>
<body>';
$msg .=$detalle;
$msg .='</body>
</html>';


$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.productosnufarm.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mknet@productosnufarm.com';                            // SMTP username
$mail->Password = 'mkn1243';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

/*
$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'jswan';                            // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';
*/

$mail->From = 'mknet@productosnufarm.com';
$mail->FromName = 'MarketingNet';
$mail->addAddress('mknet@productosnufarm.com', '--'); 
// $mail->addAddress('facundo@dot175.com');  // Add a recipient
// Name is optional
#$mail->addReplyTo('alguna@gmail.com', 'Information');
#$mail->addCC('cc@example.com');
$mail->addBCC($email_usuario);

#$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
#$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
#$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$desde_donde = str_replace('_',' ', $enviado_desde);

$mail->Subject = $desde_donde.' Mknet site - Solicitud';
$mail->Body    = $msg;
#$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



if(!$mail->send()) {
   $msg_error =  'El mensaje no pudo ser enviado!.';
   #$msg_error =  'Mailer Error: ' . $mail->ErrorInfo;
   #exit;
$_SESSION['mensaje'] =$msg_error;

$_SESSION['strnombrecompleto'] = $nombre_del_evento;
$_SESSION['nombre_del_evento'] = $nombre_del_evento;
$_SESSION['lugar'] = $lugar;
$_SESSION['cantidad_invitados'] = $cantidad_invitados;
//LA FECHA ESTIMADA se usa para guarda la feca de echo la propuesta
$_SESSION['fecha_estimada'] = $fecha_estimada;
$_SESSION['caracteristicas'] = $caracteristicas;

}

$_SESSION['mensaje'] = 'Mensaje enviado';




unset($_SESSION['strnombrecompleto']);
unset($_SESSION['nombre_del_evento']);
unset($_SESSION['lugar']);
unset($_SESSION['cantidad_invitados']);
//LA FECHA ESTIMADA se usa para guarda la feca de echo la propuesta
unset($_SESSION['fecha_estimada']);
unset($_SESSION['caracteristicas']);


include_once('includes/class.propuestas.php');

$prop = new propuestas();
$prop->id_usuario = $_SESSION['MM_IdUsuario'];
$prop->nombre_evento = $nombre_del_evento;
$prop->lugar = $lugar;
$prop->cant_invitados = $cantidad_invitados;
//LA FECHA ESTIMADA se usa para guarda la feca de echo la propuesta
$prop->fecha_estimada = $fecha_estimada;
$prop->caracteristicas = $detalle;
# 1 pendiente / 2 En proceso / 3 Aprobado / 4 No aprobado / 5 Entregado  
$prop->estado = 1;
$prop->insert();


header("location: $enviado_desde.php?activo=1&eve=1");




/* ----------------------------------------------------  */  
/* 
$mail = new PHPMailer();
$mail->Host = "localhost";
$mail->From = "contacto_web@nufarm.com";
$mail->FromName = "Web Nufarm";
$mail->Subject = "Contacto desde nufarm";
$mail->AddAddress("hubermann@gmail.com");
$mail->AddBCC("poloinfinity@gmail.com");
$mail->Body = $msg;
#$mail->AltBody = $message2;
$mail->IsHTML(true);
$mail->Send();

$finalizado=1;

if($finalizado==1){

$_SESSION['mensaje'] = 'Su mensaje se envio correctamente, Gracias!';

#$finalizado=1;
}else{

// INSERTA EL CﾓDIGO DE ERROR AQUI
$_SESSION['mensaje'] = 'Mensaje no enviado, error!';
$finalizado=0;
}


header("location: $enviado_desde.php");

*/

?>