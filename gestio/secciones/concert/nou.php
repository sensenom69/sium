<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
$objecte = new Modelo("concert",$request);
//print_r($request);
$obres = $request['obra'];

if($request['id']>=0){
	$objecte->set($request);
	$llista_obres = $objecte->cargaRelacion("concert_obra");
	foreach ($llista_obres as $key => $value) {
		$obra = new Modelo("concert_obra",array("id"=>$value->datos["id"]));
		$obra->del();
	}
	
}
foreach ($obres as $key => $value) {
	$obra = new Modelo("concert_obra",array("id"=>-1, "id_concert"=>$objecte->get("id"), "id_obra"=>$value["id"]));
}

?>