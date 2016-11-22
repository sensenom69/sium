<?PHP
include_once("../../exec/comun.php");
if(isset($_POST['id_familia'])){
	$familia = new Modelo("familia",array('id'=>$_POST['id_familia'] ));
	$llistat_instrument = $familia->cargaRelacion("instrument");
}else{
	$llistat_instrument = new Modelo("instrument");
	//$llistat_instrument->cargaRelacion("instrument");
	$llistat_instrument->cargaRelacionConDatos("instrument");
}


$text_json = "";
$i=0;
foreach ($llistat_instrument->cargas['instrument'] as $key => $value) {
	$text_json .= json_encode($value->datos);
	$i++;
	if($i<count($llistat_instrument->cargas['instrument'])) $text_json .=', ';
}
echo '['.$text_json.']';

?>