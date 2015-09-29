<?php 
	require_once('../libs.php');
	Ajax::Angular();


	Utils::POST('frontAjax', function(){
		Ajax::call($_POST['method']);
	});

 ?>