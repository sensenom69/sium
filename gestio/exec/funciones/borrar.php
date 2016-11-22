<?PHP
$obj_borrar = new Modelo($_POST["tabla"],$_POST);
$obj_borrar->del();
$busqueda = "";
$desde = "";
if(isset($_POST["busqueda"]))
    $busqueda .= "/busqueda=".$_POST["busqueda"];
if(isset($_POST["desde"]))
    $desde .= "/desde=".$_POST["desde"];
header("Location: index.php?/".$_POST["tabla"]."/listado/0/".$_POST["id_evento"].$busqueda.$desde);
//return "";
?>