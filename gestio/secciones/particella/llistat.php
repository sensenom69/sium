<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true);
if(isset($request['id_obra'])){
	$particella = new Modelo("particella");;
	//$familia = new Modelo("obra",array('id'=>$request['id_obra'] ));
	$llistat_instrument = $particella->cargaRelacionConDatos("particella","id","asc"," `particella`.id_obra = ".$request['id_obra']." ");
}else{
	$llistat_instrument = new Modelo("particella");
	//$llistat_instrument->cargaRelacion("instrument");
	$llistat_instrument->cargaRelacionConDatos("particella");
}


$text_json = "";
$i=0;
//foreach ($llistat_instrument->cargas['particella'] as $key => $value) {
foreach ($llistat_instrument as $key => $value) {
	$text_json .= json_encode($value->datos);
	$i++;
	if($i<count($llistat_instrument)) $text_json .=', ';
	
}
echo '['.$text_json.']';

?>