<?php
//OJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//Modifique el estandar de nuevo per a poder adaptar al progama en si, ya que sempre depen de level i grouping
$_POST["id_local"] = $_SESSION["id_local"];

$titul = isset($_POST["titul"])? ($_POST["titul"]=="true"? true: false):false;
$div_retorno = isset($_POST["div_retorno"])? $_POST["div_retorno"]:"container";

/*
if(isset($_POST["titul"]) or isset($titul)){
    $div_retorno = "container";
    $titul = $_POST["titul"];
    //$_POST['parametre_afegit'] = "titul=true";
}else{
    $div_retorno = "contenedor_test";
    $titul = false;
    //$_POST['parametre_afegit'] = "titul=false";
} 
*/

$parametre_afegit = isset($_POST["parametre_afegit"])? $_POST["parametre_afegit"]:""; 

$ruta_plantillas = $_SERVER["PHP_SELF"];
$ruta_plantillas = explode("/",$ruta_plantillas);
$ruta_parcial = "";//aci abans "../"
for($barres = 5;$barres<count($ruta_plantillas);$barres++)
    $ruta_parcial .= "../";
$objecte_nou = new Modelo($_POST["tabla"]);

if(isset($excepcions)){
    $excepcions = array_merge($excepcions,array("id_local","valid","id"));
}else{
    $excepcions = array("id_local","valid","id","data","id_usuario");    
}

if(!file_exists($ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/editar.tpl") ){
    //print $ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/editar.tpl";
    $plantilla = new classPlantilla(Formulario::getFormulario($objecte_nou,$inclusions,$excepcions,$titul,$div_retorno),false);
}else{
    $plantilla = new classPlantilla($ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/editar.tpl");
}
$plantilla->cambioSustitucionTodas();
$plantilla->cambioSustitucion("id",-1);
if( isset($_POST["titul"])){
    ;
}else{
    $plantilla->cambioSustitucion("div_retorno",$div_retorno);
}
//$div_retorno = isset($_POST["div_retorno"])? $_POST["div_retorno"]:"container";
//per a posar el titul 
//$plantilla->cambioSustitucion("titul",$_POST["titul"]);
$plantilla->cambioSustitucion("div_retorno",$div_retorno);
$plantilla->cambioSustitucion("tabla",$_POST["tabla"]);
$plantilla->cambioSustitucion("parametre_afegit",$parametre_afegit);
if(isset($camp_amagat)){
    foreach($camp_amagat AS $camp){
        $plantilla->insertarElemento("camp_amagat",array_keys($camp),array_values($camp));
    }
}


$local = new Modelo("local",array("id"=>$_POST["id_local"]));
$objecte_nou->cargaCamps();
$camps = $objecte_nou->getCamps();
$camps = array_diff($camps,$excepcions);
foreach($camps AS $camp){
    if(strpos($camp,"id_")!==FALSE){
        $relacio = str_replace("id_","",$camp);
        //$obj_llistat = $local->cargaRelacionConDatos(ucfirst($relacio),"nombre","ASC");
        //Canvie aso per a que quan carrega no fasa la compracio sempre en el id_local, per que carregaba sobre local
        $objecte_amb_relacio = new Modelo($relacio);
        $obj_llistat = $objecte_amb_relacio->cargaRelacionConDatos(ucfirst($relacio),"nombre","ASC");
        
        foreach($obj_llistat AS $objecte_llistat){
            $plantilla->insertarElemento(
                $camp,
                array($camp,"nombre","selected"),
                array(
                    $objecte_llistat->get(array("id")),
                    ($objecte_llistat->get(array("nombre"))==""? "Sin nombre":$objecte_llistat->get(array("nombre"))),
                    "")
            );
        }      
    }
}


return $plantilla->mostrar();
?>