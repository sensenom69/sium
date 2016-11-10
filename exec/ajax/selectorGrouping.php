<?PHP
include('../comun.php');

$grouping = new Modelo("grouping");
$groups = $grouping->cargaRelacion("grouping","name","ASC"," id_level = ".$_POST["id_level"]);

$s = "<option value='0'>-</option>";
foreach($groups AS $group){
    $s .= "<option value='".$group->get(array("id"))."'>".$group->get(array("name"))."</option>";
}
print $s;
?>