<?php

print_r($_FILES);

$target_path = "uploads/";
$target_path = $target_path . basename( $_FILES['archivo']['name']); if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) { echo "El archivo ". basename( $_FILES['archivo']['name']). " ha sido subido";
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}

die("holalaaa");
?>