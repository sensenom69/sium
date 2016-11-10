<?PHP
$_POST["ruta_parcial_ajax"] = "";
//per a saber si tinc que fer return o print;
$ve_de_la_general = true;
if(!class_exists("classPlantilla")){
    require_once("../../exec/comun.php");
    $_POST["ruta_parcial_ajax"] = "../../";
    $condicions = "";   
    $ve_de_la_general = false;     
}
$_POST["tabla"] = "cliente";

$hi_han_condicions = true;
if(!isset($_POST["busqueda"])){
    $_POST["busqueda"]="";
}else{
    $condicions .= " AND (cliente.nombre LIKE '%".$_POST["busqueda"]."%' OR cliente.apellidos LIKE '%".$_POST["busqueda"]."%') ";
}
if(isset($_POST["alfabetico"]) AND $_POST["alfabetico"]){
    $condicions .= " AND cliente.apellidos LIKE '".$_POST["busqueda"]."%' ";
}
$ordre["camp"] = "apellidos";
$ordre["ordre"] = "ASC";
$variable = "apellidos";
$elements_x_pagina = 20;
$excloure_llistat = array("id_local","valid","id");
$afegir_llistat = array();
/*
include_once($_POST["ruta_parcial_ajax"]."exec/funciones/listado.php");
$plantilla->cambioSustitucion("busqueda",$_POST["busqueda"]);
for($i=0;$i<26;$i++){
    $plantilla->insertarElemento("lletra_alfabeto",array("lletra"),chr(97+$i));
}
*/
$plantilla = new classPlantilla("plantillas/secciones/principal/listado.tpl");
if($ve_de_la_general){
    return $plantilla->mostrar();
}

print $plantilla->mostrar();
return "";
/*
$plantilla = new classPlantilla("plantillas/secciones/mesa/listado.tpl");
$usuario = new Modelo("usuario",array("id_local"=>$_SESSION["id_local"],"id"=>$_SESSION["id_usuario"]));
//$clientes = $usuario->cargaRelacion("cliente");
$_POST["tabla"] = "cliente";
return $plantilla->mostrar();
*/
?>