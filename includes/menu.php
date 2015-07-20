<div id="menu">
<a href="index.php?activo=1">
<div class="link <?php if ($activo==1){echo "activo";}else if (!$activo){echo "activo";} ?> main">
<span class="<?php if ($activo==1){echo "home_icon2";}else if(!$activo) {echo "home_icon2";}else{echo "home_icon";} ?>"></span>
<div style="margin:12px 0 0 -5px;">Programa</div>
</div>
</a>
<a href="mi_cuenta.php?activo=2">
<div class="link <?php if ($activo==2){echo "activo";} ?> main">
<span class="<?php if ($activo==2){echo "profile2";}else{echo "profile";} ?>"></span>
<div style="margin:12px 0 0 8px;">Mi Cuenta</div>
</div>
</a>
<a href="contacto.php?activo=3">
<div class="link <?php if ($activo==3){echo "activo";} ?> main">
<span class="<?php if ($activo==3){echo "contacto2";}else{echo "contacto";} ?>"></span>
<div style="margin:12px 0 0 8px;">CONTACTO</div>
</div>
</a>
<!--<a href="novedades.php?activo=3">
 <div class="link <?php if ($activo==3){echo "activo";} ?> main">Novedades</div>
</a>-->
 </ul>
</div>