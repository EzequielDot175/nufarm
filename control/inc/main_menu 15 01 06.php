<?php 
if(isset($_SESSION['logged_id'])){

$activo = $_GET['activo'];
$sub = $_GET['sub'];

echo'
<div class="ie8container">
<a href="'.BASEURL.'/compras/v_compras.php?activo=1&sub=c">
<div id="link1" class="link short ie8'; if ($activo==1){echo " activo";}else{echo " disabled";} echo' "><p class="'; if ($sub==c or $sub==a ){echo " subactivo";} echo'">CANJES REALIZADOS</p>
<a href="'.BASEURL.'/propuestas/v_propuestas.php?activo=1&sub=a"><div class="sublink '; if ($sub==a){echo " subactivo";} echo'"><p>PUBLICIDADES & EVENTOS</p></div></a>
<a href="'.BASEURL.'/compras/v_compras.php?activo=1&sub=c&vert=1"><div class="sublink '; if ($sub==c){echo " subactivo";} echo'"><p>PRODUCTOS</p></div></a>
</div>
</a>
</div>


<div class="ie8container">
<a href="'.BASEURL.'/productos/v_productos.php?activo=2&sub=d">
<div id="link2" class="link ie8'; if ($activo==2){echo " activo";}else{echo " disabled";} echo'"><p class="'; if ($sub==d or $sub==e or $sub==f or $sub==g or $sub==h){echo " subactivo";} echo'">ADMINISTRAR</p>
<a href="'.BASEURL.'/productos/v_productos.php?activo=2&sub=d"><div class="sublink '; if ($sub==d){echo " subactivo";} echo'"><p>PRODUCTOS</p></div></a>
<a href="'.BASEURL.'/usuarios/v_usuarios.php?activo=2&sub=e&vert=1"><div class="sublink '; if ($sub==e){echo " subactivo";} echo'"><p>CLIENTES</p></div></a>
<a href="'.BASEURL.'/consultas/v_consultas.php?activo=2&sub=f&orden=1"><div class="sublink '; if ($sub==f){echo " subactivo";} echo'"><p>CONSULTAS</p></div></a>
<a href="'.BASEURL.'/novedades/v_novedades.php?activo=2&sub=g"><div class="sublink '; if ($sub==g){echo " subactivo";} echo'"><p>NOVEDADES</p></div></a>
<a href="'.BASEURL.'/personal/v_personal.php?activo=2&sub=h"><div class="sublink '; if ($sub==h){echo " subactivo";} echo'" class="active"><p>PERSONAL</p></div></a>
</div>
</a>
</div>
';

}
?>





