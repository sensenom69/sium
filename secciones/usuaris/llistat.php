<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
if(!isset($request['id'])){
	$llistat_usuaris = new Modelo("usuari");
	$llistat_usuaris->cargaRelacionConDatos("usuari");

	$text_json = "";
	$i=0;
	foreach ($llistat_usuaris->cargas['usuari'] as $key => $value) {
		$text_json .= json_encode($value->datos);
		$i++;
		if($i<count($llistat_usuaris->cargas['usuari'])) $text_json .=', ';
	}
}
else{
	$llistat_usuaris = new Modelo("usuari", $request);
	$llistat_usuaris->cargaRelacionConDatos("usuari","id","asc"," `usuari`.`id` = ".$request['id']." ");
	$text_json = json_encode($llistat_usuaris->cargas['usuari'][$request['id']]->datos);
}

echo '['.$text_json.']';

?>