<?php 
	require_once('../../libs.php');
	
	Utils::POST('comboFiltro', function(){
		Cliente::optionsCombo($_POST['vendedor']);
	});
 ?>