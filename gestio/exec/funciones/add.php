<?PHP
if(!isset($_SESSION)){
    require_once("../comun.php");
}
$_POST["id_local"]=$_SESSION["id_local"];
$obj_guardar = new Modelo($_POST["tabla"],$_POST);
if($_POST["id"]>0){
    $obj_guardar->set($_POST);
}
return "";
?>