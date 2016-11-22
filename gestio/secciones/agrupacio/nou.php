<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
$objecte = new Modelo("agrupacio",$request);
if($request['id']>=0){
	$objecte->set($request);
}

?>