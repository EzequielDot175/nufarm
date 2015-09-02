<?php

include_once("resources/class.database.php");
include_once("../resources/class.database.php");

/* CLASS DECLARATION */


class personal{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $id;   // KEY ATTR. WITH AUTOINCREMENT

var $nombre;   // (normal Attribute)
var $apellido;   // (normal Attribute)
var $login;   // (normal Attribute)
var $password;   // (normal Attribute)
var $role;   // (normal Attribute)
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function personal(){

$this->database = new Database();

}


/* GETTER METHODS */

function getid()
{
return $this->id;
}

function getnombre(){
return $this->nombre;
}
function getapellido(){
return $this->apellido;
}

function getlogin(){
return $this->login;
}

function getpassword(){
return $this->password;
}

function getrole(){
return $this->role;
}

/* SETTER METHODS */

function setid($val){
$this->id =  $val;
}

function setnombre($val){
$this->nombre =  $val;
}
function setapellido($val){
$this->apellido =  $val;
}
function setlogin($val){
$this->login =  $val;
}

function setpassword($val){
$this->password =  $val;
}
function setrole($val){
$this->role =  $val;
}

/* SELECT METHOD / LOAD */


function select($id){

$sql =  "SELECT * FROM personal WHERE id = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id = $row->id;
$this->nombre = $row->nombre;
$this->apellido = $row->apellido;
$this->login = $row->login;
$this->password = $row->password;
$this->role = $row->role;
}

/* LOGIN */
function checklogin($login,$password){

/***
Adminstrador hace y ve todo
Marketing ve todo y responde consultas de todos los clientes
Ventas ve todo y responde consultas de su gurpo de clientes asignado
***/

$sql = "SELECT * FROM personal WHERE login = '$login' AND password = '$password';";
			$result = $this->database->query($sql);
			$result = $this->database->result;
			$quantity= mysql_num_rows($result);
			if($quantity > 0){
			$row = mysql_fetch_array($result);
	
			$id = $row['id'];
			$nombre=$row['nombre'];
			$apellido=$row['apellido'];
			$login=$row['login'];
			$role=$row['role'];
	
			$this->user_login=1;
			
@session_start();
$_SESSION['logged_id'] = $id; 
$_SESSION['logged_name'] = $nombre.' '.$apellido;
$_SESSION['logged_role'] = $role;


			//$navigate=$_SESSION['personal_logged'];
			echo '<script type="text/javascript">
			window.location="secure.php";
			</script>';
			echo '<div class="notify"><a href="secure.php">Bienvenido, aguarde....</a></div>';
			}
			else
			{
				$this->user_login=0;
				echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tienda Nufarm</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css">
<link href="../layout/main.css" rel="stylesheet" type="text/css">	
</head>
<body class="bg-login">
<div id="contenedor-login">
<div class="logo-login"></div>

  <div id="login">
   
  <div id="logincaja3">
  <div class="login-admin">Administrador</div>
   <form id="login2" name="login" method="POST" action="verification.php" class="formvalid">
        <center class="center2"><label>CORREO ELECTRÓNICO</label></center>
      
        <center class="center2"><input type="text" name="nickname" id="nickname" value=""/></center>
       
        <center class="center2"><label> clave</label></center>
     
        <center class="center2"><input type="password" name="password" id="password" value=""/></center>
      

       <center class="center2">
       <br>
	   <a class="btn-login-admin">
		<input type="submit" name="button" id="button-login-admin" value="Entrar">
		</a>
        </center>

         <center id="radio-remember"><input type="radio" name="radio" id="radio" value="radio" />
      Recordarme</center><br />

    </form>
  </div>
         </div>
		 </div>

</body>
</html>

	';
				
}
	
	
}


function select_vendedores($selected){
	$sql ="SELECT * FROM personal WHERE role =3 ORDER BY id ;";
	$result = $this->database->query($sql);
	$result = $this->database->result;
	while($row = mysql_fetch_array($result)){
	$id = $row['id'];
	$nombre = $row['nombre'];
	$apellido = $row['apellido'];
	$login = $row['login'];
	$role = $row['role'];
	
	if($selected == $id){
	$checked = 'selected="selected"';
	}else{
	$checked = '';
	}
	
	echo '<option value="'.$id.'" '.$checked.'> '.$apellido .' '.$nombre.'</option>';
	$checked ="";
	}
	

}



/* SELECT ALL */
function select_all($pagina, $orden){
$filtro_personal=$_GET['filtro_personal'];

include('../resources/paginator.class.php');
if($filtro_personal){$sql ="SELECT * FROM personal WHERE role='$filtro_personal'";}
else{$sql ="SELECT * FROM personal";}
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay personal en el sistema!</p>
		</div>';}
		else{
$count=0;
while($row = mysql_fetch_array($result)){
$count++;
}

$pages = new Paginator;
$pages->items_total = $count;
$pages->mid_range = 10;
$pages->paginate();
$pages->display_pages();

if($filtro_personal){$sql ="SELECT * FROM personal WHERE role='$filtro_personal' ORDER BY $orden $pages->limit;";}
else{$sql ="SELECT * FROM personal ORDER BY $orden $pages->limit;";}

$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id = $row['id'];
$nombre = $row['nombre'];
$apellido = $row['apellido'];
$login = $row['login'];
$role = $row['role'];
$password = $row['password'];

switch ($role) {
	case 1:
		$role_nombre = "Administrador";
		break;
	case 2:
		$role_nombre = "Marketing";
		break;
	case 3:
		$role_nombre = "Ventas";
		break;
}


echo '

<table>
           <tbody>
                <tr class=" tablaPersonal ">
                  <td class="colA" align="center">
			<div class="imagen-personal"></div>
                  </td>
                  <td class="colB tdBackground" align="center">
                    <span>'.$nombre.' '.$apellido.'</span>
                  </td>
                  <td class="colC tdBackground" align="center">
                     <span>Login: '.$login.'</span>
                  </td>
                  <td class="colD tdBackground" align="center">
                    <span>'.$role_nombre.'</span>
                  </td>
                  <td class="colE ">
                     		<div class="botones">
		              <div class="item editar">
		                <a href="e_personal.php?id='.$id.'&activo=2&sub=h">
		                  <img class="imagen" src="../layout/editar.png" alt="">
		                </a>
		              </div>
		              <div class="item borrar">
		                <a href="d_personal.php?id='.$id.'&activo=2&sub=h">
		                  <img class="imagen" src="../layout/borrar.png" alt="">
		                </a>
		              </div>
		           </div>
                  </td>
                </tr>

           </tbody>
</table>

';
}

echo '<div class="navigate">';
echo $pages->display_pages();


 // Optional call which will display the page numbers after the results.
//$pages->display_jump_menu(); // Optional Ð displays the page jump menu
//echo $pages->display_items_per_page(); //Optional Ð displays the items per
//echo  $pages->current_page . ' of ' .$pages->num_pages.'';
echo '</div>';
}

}



/* DELETE */


function delete($id){
echo $sql = "DELETE FROM personal WHERE id = $id;";
$result = $this->database->query($sql);

}


/* INSERT */


function insert(){
$this->id = ""; // clear key for autoincrement

$sql = "INSERT INTO personal ( nombre, apellido, login,password, role ) VALUES ( '$this->nombre','$this->apellido','$this->login','$this->password','$this->role' )";
$result = $this->database->query($sql);
$this->id = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){



$sql = " UPDATE personal SET nombre = '$this->nombre',apellido = '$this->apellido',login = '$this->login',password = '$this->password', role = '$this->role' WHERE id = $id ";

$result = $this->database->query($sql);

}
/* UTILS */
/* SELECT
include_once("classes/class.personal.php");
$personal= new personal();
$personal->select($id);
$mivar=$personal->getid();
$mivar=$personal->getnombre();
$mivar=$personal->getpassword();
*/
/* INSERT
include_once("classes/class.personal.php");
$personal= new personal();
$personal->id=$mivar;
$personal->nombre=$mivar;
$personal->password=$mivar;
$personal->insert();
*/
} // class : end

?>