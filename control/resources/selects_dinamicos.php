<?php



#categorias de convenios
function select_cat_convenios($id_categoria_convenio){
include_once('../convenios/classes/class.categoria_convenios.php');
$catcon = new categoria_convenios();
echo $categorias = $catcon->categoria_convenios_drop_list($id_categoria_convenio);

return $categorias;
}


#Obras Sociales
function select_obras_sociales($id_obra_social){
include_once('../convenios/classes/class.obras_sociales.php');
$catcon = new obras_sociales();
$obras = $catcon->obras_sociales_drop_list_return($id_obra_social);

return $obras;
}

#tipos (A,B,C,etc..)
function select_tipo_convenio($id_tipo){
include_once('../convenios/classes/class.tipo_convenios.php');
$catcon = new tipo_convenios();
return $tipos = $catcon->tipo_convenios_drop_list($id_tipo);
}




?>

