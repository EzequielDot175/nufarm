<?php @session_start(); header('Content-Type: text/html; charset=utf-8');

include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../resources/control.php'); ?>
	<title></title>
	<link rel="stylesheet" type="text/css" media="all" href="../layout/base.css" />
	<link rel="stylesheet" type="text/css" media="all" href="../layout/header-footer-columns.css" />
	<link rel="stylesheet" type="text/css" media="all" href="../layout/forms.css" />

	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">

<?php include_once('../resources/includes.php'); ?>
<script type="text/javascript">
function changueoferta(div){
$('#oferta'+div).load('changue_oferta.php?id='+div);
}
</script>

</head>
<body>

<!-- Header -->
	<?php include_once('../inc/header.php') ?>


<div class="block">
	
	<div class="three_4">
    
	<?php  
	if($_SESSION['msg_ok']){echo '<div class="notify_ok"><p>'.$_SESSION['msg_ok'].'</p></div>'; unset($_SESSION['msg_ok']);}
	if($_SESSION['msg_error']){echo '<div class="notify_error"><p>'.$_SESSION['msg_error'].'</p></div>'; unset($_SESSION['msg_error']);}
	if($_SESSION['msg_warning']){echo '<div class="notify_warning"><p>'.$_SESSION['msg_warning'].'</p></div>'; unset($_SESSION['msg_warning']);}
	?></div>
	<?php include_once('../inc/footer.php') ?>
</div>
</body>
</html>