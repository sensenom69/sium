<?PHP
$_POST["id_local"] = $_SESSION["id_local"];

$titul = isset($_POST["titul"])? $_POST["titul"]:false;
$div_retorno = isset($_POST["div_retorno"])? $_POST["div_retorno"]:"container"; 
$readonly = isset($_POST["readonly"])? $_POST["readonly"]:"";

/*
if(isset($_POST["titul"]) or isset($titul)){
    $div_retorno = "container";
    $titul = $_POST["titul"];
    $_POST['parametre_afegit'] = "titul=true";
}else{
    $div_retorno = "contenedor_test";
    $titul = false;
    $_POST['parametre_afegit'] = "titul=false";
}
*/

$parametre_afegit = isset($_POST["parametre_afegit"])? $_POST["parametre_afegit"]:""; 
$ruta_plantillas = $_SERVER["PHP_SELF"];
$ruta_plantillas = explode("/",$ruta_plantillas);
$ruta_parcial = "";
for($barres = 4;$barres<count($ruta_plantillas);$barres++)
    $ruta_parcial .= "/";
if(isset($excepcions)){
    $excepcions = array_merge($excepcions,array("id_local","valid","id"));
}else{
    $excepcions = array("id_local","valid","id","data");    
}
if(!file_exists($ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/editar.tpl") ){
    $plantilla = new classPlantilla(Formulario::getFormulario(new Modelo($_POST["tabla"]),array(),$excepcions,$titul,$div_retorno,$readonly),false);
    
}else{
    $plantilla = new classPlantilla($ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/editar.tpl");
}
$obj_editar = new Modelo($_POST["tabla"],$_POST);
$plantilla->cambioSustitucionTodas($obj_editar->get());
$plantilla->cambioSustitucion("tabla",$_POST["tabla"]);
$plantilla->cambioSustitucion("editable",$readonly);
$local = new Modelo("local",array("id"=>$_POST["id_local"]));

$obj_editar->cargaCamps();
$camps = $obj_editar->getCamps();

foreach($camps AS $camp){
    if(strpos($camp,"id_")!==FALSE){
        $relacio = str_replace("id_","",$camp);
        $obj_llistat = $local->cargaRelacion(ucfirst($relacio),"nombre","ASC");
        foreach($obj_llistat AS $objecte_llistat){
            if($objecte_llistat->get(array("id"))!=1 && $relacio=="mesa")    
                $plantilla->insertarElemento(
                    $camp,
                    array(
                        $camp,
                        "nombre",
                        "selected"
                    ),
                    array(
                        $objecte_llistat->get(array("id")),
                        ($objecte_llistat->get(array("nombre"))==""? "Sin nombre":$objecte_llistat->get(array("nombre"))),
                        ($objecte_llistat->get("id")==$obj_editar->get($camp))? "selected":""
                    )
                );
        }        
    }
}

return $plantilla->mostrar();
?>