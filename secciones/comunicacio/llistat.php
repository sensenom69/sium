<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
$tabla = "comunicacio";
if(!isset($request['id'])){
	$llistat_usuaris = new Modelo($tabla);
	$llistat_usuaris->cargaRelacionConDatos($tabla);

	$text_json = "";
	$i=0;
	foreach ($llistat_usuaris->cargas[$tabla] as $key => $value) {
		$text_json .= json_encode($value->datos);
		$i++;
		if($i<count($llistat_usuaris->cargas[$tabla])) $text_json .=', ';
	}
}
else{
	$llistat_usuaris = new Modelo($tabla, $request);
	$llistat_usuaris->cargaRelacionConDatos($tabla,"id","asc"," `".$tabla."`.`id` = ".$request['id']." ");
	$text_json = json_encode($llistat_usuaris->cargas[$tabla][$request['id']]->datos);
}

echo '['.$text_json.']';

?>