<?PHP
require_once("../comun.php");
$sql = "SELECT * FROM ".$_POST["mesa"]." WHERE ".$_POST["camp"]." LIKE %".$_POST["busqueda"];
if($_POST["condicions"]!=""){
    $sql .= " AND ".$_POST["condicions"];
}
$res = mysql_query($sql);
$retorno="";

?>