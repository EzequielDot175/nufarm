<?php  


require_once('Connections/conexion.php');

mysql_select_db($database_conexion, $conexion);

$query = "SELECT * FROM";
$result = mysql_query($query, $conexion) or die(mysql_error());

while($row = mysql_fetch_array( $result )) {
	
	
	
	
}
?>


