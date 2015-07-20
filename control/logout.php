<?php session_start();
session_unset();
session_destroy();
header('location:index.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name= "title" content="" /> 
<meta name= "author" content="Gabriel Hubermann" /> 
<meta name= "description" content="" /> 
<meta name= "keywords" content=""/> 
<meta name= "copyright" content="Â© 2009" /> 
<meta name= "designer" content="Gabriel Hubermann | Web Designer, PHP Ajax CSS Programming | http://www.hubermann.com" /> 
<meta name= "publisher" content="" /> 
<meta name= "distribution" content="Local" /> 
<meta name= "robots" content="all" /> 

<?php include('inc/title.php'); ?>

<link href="layout/main.css" rel="stylesheet" type="text/css" />
<link href="layout/additional.css" rel="stylesheet" type="text/css" />
<!-- <link rel="shortcut icon" href="favicon.ico" /> -->
<!-- <link rel="icon" href="animated_favicon1.gif" type="image/gif" /> -->

</head>
<body>
<!--[if !IE]> WRAPPER <![endif]-->
<div id="wrapper">

<!--[if !IE]> HEADER <![endif]-->
<div id="header" class="full"> <div class="inside"></div></div>
<!--[if !IE]> END HEADER <![endif]-->

<!--[if !IE]> MENU <![endif]-->
<div id="menu" class="full">
<ul>
<?php include('inc/main_menu.php'); ?>
</ul>
</div>
<!--[if !IE]> END MENU <![endif]-->

<!--[if !IE]> CONTENT <![endif]-->
<div id="content">

<!--[if !IE]> SIDEBAR <![endif]-->
<div id="sidebar" class="three_1"><div class="inside">Sidebar</div></div>
<!--[if !IE]> END SIDEBAR <![endif]-->

<!--[if !IE]> COLUMN BIG <![endif]-->
<div id="columnBig" class="three_2">
<div class="inside">
<!-- inicio de contenido columna grande -->
<h3>Bye!</h3>


<!--fin contenido columna Grande -->
</div>
</div>
<!--[if !IE]> END COLUMN BIG <![endif]-->


</div>
<!--[if !IE]> END CONTENT <![endif]-->

<!--[if !IE]> FOOTER <![endif]-->
<div id="footer" class="full"> 
<?php include('inc/footer.php'); ?>
</div>
<!--[if !IE]> END FOOTER <![endif]-->


<!--[if !IE]> END WRAPPER <![endif]-->
</div>
</body>

</html>