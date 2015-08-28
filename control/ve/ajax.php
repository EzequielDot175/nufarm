<?php 
	require_once('../../libs.php');

	Ajax::Angular();

	Utils::POST('vendedor_estrella',function(){
		Ajax::call($_POST['method']);
	});


 ?>