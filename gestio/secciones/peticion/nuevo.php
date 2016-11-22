<?PHP
$excepcions = "";
if($_SESSION["permiso"]!=1){
    $excepcions[] = "id_usuario";
}
$camp_amagat = array(
    array("nom"=>"id_usuario","id"=>$_SESSION["id_usuario"])
    );
    
$varies_tables = array();
$varies_tables[1] = "peticion";
$varies_tables[2] = "interno";
include_once("exec/funciones/nuevo.php");

return $plantilla->mostrar();
?>