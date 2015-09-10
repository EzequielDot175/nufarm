<?php 
	require_once('../libs.php');


	
	Ajax::Angular();

	Utils::POST('excel', function(){
		Ajax::call($_POST['method']);
	});

 ?>