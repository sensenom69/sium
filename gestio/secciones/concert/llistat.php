<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
$tabla = "concert";
if(!isset($request['id'])){
	$llistat = new Modelo($tabla);
	$llistat->cargaRelacionConDatos($tabla);

	$text_json = "";
	$i=0;
	foreach ($llistat->cargas[$tabla] as $key => $value) {
		$fecha_sencera = explode(" ",$value->datos["data"]);
		$data = substr($value->datos["data"], 0,10);
		$data = explode("-", $data);
		$hora = substr($value->datos["data"], 11,2);
		$minuts = substr($value->datos["data"], 14,2);
		$value->datos["data"] = $data[2]."-".$data[1]."-".$data[0];
		$value->datos["hora"] = $hora;
		$value->datos["minuts"] = $minuts;
		$text_json .= json_encode($value->datos);
		$i++;
		if($i<count($llistat->cargas[$tabla])) $text_json .=', ';
	}
}
else{
	$llistat = new Modelo($tabla, $request);
	$llistat->cargaRelacionConDatos($tabla,"id","asc"," `".$tabla."`.`id` = ".$request['id']." ");
	$text_json = json_encode($llistat->cargas[$tabla][$request['id']]->datos);
}

echo '['.$text_json.']';

?>