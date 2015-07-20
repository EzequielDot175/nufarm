<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Subir Imagen</title>
</head>

<body>
<?php if ((isset($_POST["enviado"])) && ($_POST["enviado"] == "form1")) {
 $nombre_archivo = $_FILES['userfile']['name'];
 move_uploaded_file($_FILES['userfile']['tmp_name'], "../documentos/img/".$nombre_archivo);
 
 ?>
 <script>
  opener.document.form1.strImagen<?php echo $campo;?>.value="<? echo $nombre_archivo; ?>";
  self.close();
  </script>
  </script>
 <?php
  
}
else 
{?>
<form name="form1" method="post" action="gestionimagen.php" enctype="multipart/form-data">
  <p>
    <input name="userfile" type="file">
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Subir Imagen">
  </p>
  <input type="hidden" name="enviado" value="form1">
</form>
<?php }?>
</body>
</html>