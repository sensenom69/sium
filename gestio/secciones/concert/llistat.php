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
	$_SESSION['id_concert_activa'] = $request['id'];

	$llistat = new Modelo($tabla, $request);
	$llistat->cargaRelacionConDatos($tabla,"id","asc"," `".$tabla."`.`id` = ".$request['id']." ");
	
	$data = substr($llistat->cargas[$tabla][$request['id']]->datos["data"], 0,10);
	$data = explode("-", $data);
	$hora = substr($llistat->cargas[$tabla][$request['id']]->datos["data"], 11,2);
	$minuts = substr($llistat->cargas[$tabla][$request['id']]->datos["data"], 14,2);
	$llistat->cargas[$tabla][$request['id']]->datos["data"] = $data[2]."-".$data[1]."-".$data[0];
	$llistat->cargas[$tabla][$request['id']]->datos["hora"] = $hora+0;
	$llistat->cargas[$tabla][$request['id']]->datos["minuts"] = $minuts+0;

	//carregue les obres
	$llistat->cargaRelacionConDatos('concert_obra', "id", "asc");
	

	$text_json = json_encode($llistat->cargas[$tabla][$request['id']]->datos);
	$obres_json = "";
	$i=1;
	foreach($llistat->cargas['concert_obra'] as $key => $value){
		$obres_json .= json_encode($value->datos);	
		if($i<count($llistat->cargas['concert_obra'])) $obres_json .=', ';
		$i++;
	}
	$text_json .= ', {"obres": ['.$obres_json.']}';
	
}

echo '['.$text_json.']';

?>