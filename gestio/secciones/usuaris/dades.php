<?PHP
include_once("../../exec/comun.php");


echo '{"nom":"'.$_SESSION["nom"].'", "instrument":"'.$_SESSION["instrument"].'", "permis": "'.$_SESSION["permis"].'", "agrupacio":"'.$_SESSION["agrupacio"].'"}';

?>