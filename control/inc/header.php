<header>
<!--[if lt IE 9]>
<script type="text/javascript">
   document.createElement("nav");
   document.createElement("header");
   document.createElement("footer");
   document.createElement("section");
   document.createElement("article");
   document.createElement("aside");
   document.createElement("hgroup");
</script>
<![endif]-->

<!--[if lt IE 8]>
<script type="text/javascript">
   document.createElement("nav");
   document.createElement("header");
   document.createElement("footer");
   document.createElement("section");
   document.createElement("article");
   document.createElement("aside");
   document.createElement("hgroup");
</script>
<![endif]-->

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type="text/javascript" src="../js/modernizr.custom.29057.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.three_444 .item .olive-bar_new2').click(function(){
$(this).next("form").slideToggle('fast');
 });
 $('.three_44 .item .olive-bar_new2').click(function(){
$(this).next("div").slideToggle('fast');
 });
$(".search_box").find('input').click(function(){
 $(this).val(''); 
});

// comprobacion estado canje para que no se repitan los quites de creditos
// $( "#estado" ).change(function() {
 // if($(this).val() == "1" || $(this).val() == "2"){
// $("#monto2").fadeIn();
    // } else {
// $("#monto2").fadeOut();
    // }
 });

</script>
<div id="top"></div>
<div id="logo">
<a href="../index.php"><img src="../../imagenes/logo2-02.png" alt="Nufarm"> </a>
</div>
<div id="header_bg_img"><div class="subheader"><span class="adminwelcome"><?php  echo $_SESSION['logged_name']; ?> </span>
<!--<div class="prop"><?php  
/*include_once("../propuestas/classes/class.propuestas.php");
$prop= new propuestas();
$prop->sin_responder();*/
?></div>-->
</div></div>
<ul><li class="cerrar_sesion"><a  href="<?php  echo BASEURL.'/logout.php'?>">Cerrar sesion X</a></li></ul>		
</header>			
<div class="main_menu">
				<?php include('../inc/main_menu.php'); ?>

				
				<!--<div class="search_box">
				<form action="<?php  echo BASEURL.'/busquedas/busquedas.php'; ?>" method="post">
				<input type="text" value="BUSCAR" name="busqueda" id="busqueda" />
				</form>
				</div>-->
</div>

