<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
$objecte = new Modelo("concert",$request);
$objecte->del();
?>