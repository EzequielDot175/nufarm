<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Marketing Net</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

//menu productos eventos publicidad
$(".publicidad").addClass("activo");
$("#menu3 div").click(function(){
var punto= ".";
var boton= punto + $(this).attr("id");
$(".productos div").removeClass("activo");
$("#menu3 div").removeClass("activo");
$(boton).addClass("activo");
});

//menu mi cuenta
$(".separador").hide();
$("#MC_1").addClass("MC_active");
$(".MC_1").show();
$(".micuenta_submenu ul li").click(function(){
var punto= ".";
var boton= punto + $(this).attr("id");
$(".separador").hide();
$(".micuenta_submenu ul li").removeClass("MC_active");
$(this).addClass("MC_active");
$(boton).fadeIn("activo");
});

//boton home slide
$(".slide_btn").click(function(){
$(".inicio2").slideToggle("fast,swing",function(){
$(".slide_btn").toggleClass("slide_btn2");
});

});

});
</script>
</head>

<body>
<div id="top"></div>
<div id="contenedor">
<header>
<div id="logo">
<a href="index.php"><img src="../imagenes/logo.png" alt="Nufarm"> </a>
</div>
<div id="header_bg_img"></div>
</header>