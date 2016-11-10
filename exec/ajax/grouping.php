<?PHP
include('../comun.php');
$objecte_pare = new Modelo($_POST["tabla_pare"],array("id"=>$_POST["id_pare"]));

$listado = $objecte_pare->cargaRelacion($_POST["tabla"],"id");
$s = "<option value='0'>-</option>";
foreach($listado AS $objecte)
    $s .= "<option value='".$objecte->get(array("id"))."' ".($_POST["id"]==$objecte->get(array("id"))? "selected":"").">".$objecte->get(array("name"))."</option>";
print $s;
?>