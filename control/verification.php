<?php session_start(); error_reporting(0);
$nickname=$_POST['nickname'];
$password=$_POST['password'];

?>


<!--[if !IE]> CONTENT <![endif]-->

<?php 
define('ROOT_PATH', realpath(__DIR__.'/../includes/'));

?>


<?php 
include_once('personal/classes/class.personal.php');
$log = new personal();
$log->checklogin($nickname,$password);

?>



<!--[if !IE]> END CONTENT <![endif]-->


</body>

</html>