<?PHP
include_once("../../exec/comun.php");
$llistat = new Modelo("familia");
$llistat->cargaRelacion("familia");

$text_json = "";
$i=0;
foreach ($llistat->cargas['familia'] as $key => $value) {
	$text_json .= json_encode($value->datos);
	$i++;
	if($i<count($llistat->cargas['familia'])) $text_json .=', ';
}
echo '['.$text_json.']';

?>