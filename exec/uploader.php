<?php
if (!empty($_FILES)) {
    /*
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$file_name = $_FILES['Filedata']['name'];	
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetFile =  str_replace('//','/',$targetPath) . $file_name;	
	if (move_uploaded_file($tempFile,$targetFile)){
		echo 'Tu archivo se subió correctamente '.$_POST['texto'];
	} else {
		echo 'Tu archivo falló';
	}
    */
   	$ruta="uploads/";
    //$texto=$_POST['texto'];
    foreach ($_FILES as $key) {
        if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
            $nombre = $key['name'];//Obtenemos el nombre del archivo
            $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
            $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
            move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
            //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
            die ("1");
        }else{
            echo $key['error']; //Si no se cargo mostramos el error
        }
    }
 }
?>