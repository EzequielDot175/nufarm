<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Marketing Net</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript">
$(document).ready(function(){
// var mywindow = $(window);
// var mypos = mywindow.scrollTop();
// mywindow.scroll(function() {
    // if(mywindow.scrollTop() > mypos)
    // {
        // $('.header2').fadeIn();  
    // }
    // else
    // {
        // $('.header2').fadeOut();
    // }
    // mypos = mywindow.scrollTop();
 // });

//menu productos eventos publicidad
// $(".productos").addClass("activo");
$(".productos").hide();



$("#menu2 div").click(function(){
$(".productos").show();

});

// FUNCIONAMIENTO DE MENU DESCOMENTAR PARA ACTIVAR.
$("#menu3 div").click(function(){
$(".productos").show();
var punto= ".";
var boton= punto + $(this).attr("id");
$(".productos div").removeClass("activo");
$("#menu3 div").removeClass("activo");
$(boton).addClass("activo");
$(".welcometitle").show();
$(".original").hide();
$(".inicio2").hide();
});


//menu mi cuenta
    if(window.location.href.indexOf("del=1") > -1) {
	$("#MC_3").addClass("MC_active");
	$(".MC_3").show();
    }
	else
	{
	$("#MC_1").addClass("MC_active");
	$(".MC_1").show();
	
	}
  if(window.location.href.indexOf("prod=1") > -1) {
  	$(".productos div").removeClass("activo");
  	$(".productosb").addClass("activo");//seccion a mostrar
   $(".welcometitle").show();
   $(".original").hide();
  $(".inicio2").hide();
  $(".productos").show();
  $("#productosb").addClass("activo");
}
    if(window.location.href.indexOf("eve=1") > -1) {
	$(".productos div").removeClass("activo");
		$(".eventos").addClass("activo");//seccion a mostrar
	$(".welcometitle").show();
	$(".productos").show();
	$(".original").hide();
	$(".inicio2").hide();
	$("#eventos").addClass("activo");
    }
    if(window.location.href.indexOf("pub=1") > -1) {
	$(".productos div").removeClass("activo");
		$(".publicidad").addClass("activo");//seccion a mostrar
	$(".welcometitle").show();
	$(".productos").show();
	$(".original").hide();
	$(".inicio2").hide();
	$("#publicidad").addClass("activo");
    }	



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
$(".productos").slideToggle("fast");
		$(".productosb").toggleClass("activo");//seccion a mostrar
});
$(".original").fadeToggle("fast","linear");

});

$(".destacado1 .titlef , .destacado2 .titlef , .destacado3 .titlef").hover(function(){
$(this).addClass("hoveron");
},function(){
$(this).removeClass("hoveron");
});



$(".titlef").hover(function(){
$(this).addClass("hoveron2");
},function(){
$(this).removeClass("hoveron2");
});



});
</script>

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


<script language="JavaScript"> 

// var navegador = navigator.appName  
// if (navegador == "Microsoft Internet Explorer")  
// direccion=("http://nufarm-maxx.com/redir/index.html");  

// window.location=direccion;  
</script>  

<!--
<script languaje="Javascript">

<!--
var name = navigator.appName
 if (name == "Microsoft Internet Explorer")
   url=("http://nufarm-maxx.com/redir/index.html");

window.location=url;


</script>//-->
</head>

<body>

<div id="top"></div>
<div id="contenedor">
<header>
<div id="logo">
<a href="index.php"><img src="imagenes/logo.png" alt="Nufarm"> </a>
</div>
<div id="header_bg_img"></div>
</header>
<div class="header2"><img src="imagenes/logo2-02.png" alt="Nufarm"></div>