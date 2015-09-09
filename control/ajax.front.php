<?php 
	require_once('../libs.php');

	Utils::POST('frontAjax', function(){
		Ajax::call($_POST['method']);
	});

 ?>