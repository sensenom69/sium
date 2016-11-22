<?PHP
include_once("../../exec/comun.php");
$llistat_agrupacio = new Modelo("agrupacio");
$llistat_agrupacio->cargaRelacion("agrupacio");

$text_json = "";
$i=0;
foreach ($llistat_agrupacio->cargas['agrupacio'] as $key => $value) {
	$text_json .= json_encode($value->datos);
	$i++;
	if($i<count($llistat_agrupacio->cargas['agrupacio'])) $text_json .=', ';
}
echo '['.$text_json.']';

?>