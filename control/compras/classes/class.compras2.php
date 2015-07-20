<?php


/* CLASS DECLARATION */


class compras2{ 


/* SELECT ALL */
function select_all_vendedores(){


include('../resources/paginator.class.php');
$sql ="SELECT * FROM personal ;";
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

$sql ="SELECT * FROM personal ";
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


echo '<div class="item">

<div class="olive-bar"><h4>'.$nombre.' '.$apellido.'</h4></div>

</div>';
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



} // class : end

?>