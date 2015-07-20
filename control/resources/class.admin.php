<?php

include_once("resources/class.database.php");

/* CLASS DECLARATION */


class admin{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $id_admin;   // KEY ATTR. WITH AUTOINCREMENT

var $name_admin;   // (normal Attribute)
var $pass_admin;   // (normal Attribute)
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function admin(){

$this->database = new Database();

}


/* GETTER METHODS */

function getid_admin()
{
return $this->id_admin;
}

function getname_admin()
{
return $this->name_admin;
}

function getpass_admin()
{
return $this->pass_admin;
}

/* SETTER METHODS */

function setid_admin($val){
$this->id_admin =  $val;
}

function setname_admin($val){
$this->name_admin =  $val;
}

function setpass_admin($val){
$this->pass_admin =  $val;
}

/* SELECT METHOD / LOAD */


function select($id){

$sql =  "SELECT * FROM admin WHERE id_admin = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id_admin = $row->id_admin;
$this->name_admin = $row->name_admin;
$this->pass_admin = $row->pass_admin;

}

/* LOGIN */
function checklogin($name_admin,$pass_admin){
	
	include_once("resources/class.database.php");
	$this->database = new Database();

	$sql = "SELECT * FROM admin WHERE name_admin = '$name_admin' AND pass_admin = '$pass_admin';";
		$result = $this->database->query($sql);
		$result = $this->database->result;
		$quantity= mysql_num_rows($result);
		if($quantity > 0){
		$row = mysql_fetch_array($result);

		$id_admin = $row[id_admin];
		$name_admin=$row[name_admin];

		$this->user_login=1;
		
		@session_start();
		$_SESSION['admin_logged'] = $name_admin;
		//$navigate=$_SESSION['admin_logged'];
		echo '<script type="text/javascript">
		window.location="secure.php";
		</script>';
		echo '<div class="notify"><a href="secure.php">Bienvenido, aguarde....</a></div>';
		}
		else
		{
			$this->user_login=0;
			echo '<div class="notify"><p>Datos Incorrectos! Intente Nuevamente</p></div>';
			echo'<form id="login" name="login" method="POST" action="verification.php" class="formvalid">

<fieldset>
<legend>Acceder al sistema</legend>

<p>
<label for="cnombre">Usuario</label>
<p><input type="text" name="nickname" id="nickname" value=""/></p>
</p>

<p>
<label for="cnombre">Password</label>
<p><input type="password" name="password" id="password" value=""/></p>
</p>

<p><br />
<p><button type="submit">Aceptar</button> </p>
</p>

</fieldset>

</form>
';
			

			
		}
	
	
}
/* DELETE */


function delete($id){
$sql = "DELETE FROM admin WHERE id_admin = $id;";
$result = $this->database->query($sql);

}


/* INSERT */


function insert(){
$this->id_admin = ""; // clear key for autoincrement

$sql = "INSERT INTO admin ( name_admin,pass_admin ) VALUES ( '$this->name_admin','$this->pass_admin' )";
$result = $this->database->query($sql);
$this->id_admin = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){



$sql = " UPDATE admin SET  name_admin = '$this->name_admin',pass_admin = '$this->pass_admin' WHERE id_admin = $id ";

$result = $this->database->query($sql);

}
/* UTILS */
/* SELECT
include_once("classes/class.admin.php");
$admin= new admin();
$admin->select($id);
$mivar=$admin->getid_admin();
$mivar=$admin->getname_admin();
$mivar=$admin->getpass_admin();
*/
/* INSERT
include_once("classes/class.admin.php");
$admin= new admin();
$admin->id_admin=$mivar;
$admin->name_admin=$mivar;
$admin->pass_admin=$mivar;
$admin->insert();
*/
} // class : end

?>