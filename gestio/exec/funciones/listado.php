<?PHP
if(!isset($_POST['desde']))
    $_POST['desde'] = 0;
if(!isset($_POST['hasta']))
    $_POST['hasta'] = $elements_x_pagina;
if(!isset($condicions)){
    $condicions = "";   
}

if(!isset($ordre)){
    $ordre["camp"] = "nombre";
    $ordre["ordre"] = "ASC";
}
if(!isset($_POST["id"]))
    $_POST["id"] = 0;
if(!isset($titul)){
    $titul = true;
}
if(!isset($tipo_llistat)){
    $tipo_llistat = "";
}

if(!isset($div_retorno)){
    //$div_retorno="";
    $div_retorno = isset($_POST["div_retorno"])? $_POST["div_retorno"]:"container";
}

if(!isset($parametre_afegit)){
    $parametre_afegit = "";
}
if(!isset($codi_afegir_contextual)){
    $codi_afegir_contextual["codi"]="";
    $codi_afegir_contextual["boto"]="";
}
    

$_POST["id_local"] = $_SESSION["id_local"];
$local = new Modelo("local",array("id"=>$_POST["id_local"]));
$ruta_plantillas = $_SERVER["PHP_SELF"];
$ruta_plantillas = explode(".php?",$ruta_plantillas);
$ruta_plantillas = explode("/",$ruta_plantillas[0]);
$ruta_parcial = "";
for($barres = 3;$barres<count($ruta_plantillas);$barres++)
    $ruta_parcial .= "../";
if(!file_exists($ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/listado.tpl") ){
    //print $ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/listado.tpl";
    if(!isset($afegir_llistat))
        $afegir_llistat = array();
    if(!isset($excloure_llistat))
        $excloure_llistat = array("id_local","valid","id","data");
    $plantilla = new classPlantilla(Listado::getListado(new Modelo($_POST["tabla"]),$afegir_llistat,$excloure_llistat,$titul,$div_retorno,$tipo_llistat),false);
}
else{
    if(!isset($excloure_llistat))
        $excloure_llistat = array("id_local","valid","id","data");
    $plantilla = new classPlantilla($ruta_parcial."plantillas/secciones/".$_POST["tabla"]."/listado.tpl");
}
    
$plantilla->cambioSustitucion("tabla",$_POST["tabla"]);
$plantilla->cambioSustitucion("titul",$titul);
$plantilla->cambioSustitucion("parametre_afegit",$parametre_afegit);

$plantilla->cambioSustitucion("codi_afegir_contextual",$codi_afegir_contextual["codi"]);
$plantilla->cambioSustitucion("boto_afegir_contextual",$codi_afegir_contextual["boto"]);
//OJo que pose aci per no filtrar per local
$tabla_a_llistar = new Modelo($_POST["tabla"]);
$obj_llistat = $tabla_a_llistar->cargaRelacionConDatos(($_POST["tabla"]),$ordre["camp"],$ordre["ordre"],$condicions,$_POST["desde"],$elements_x_pagina);
$num_objectes = $tabla_a_llistar->numeroElementosRelacion(($_POST["tabla"]),"id",$condicions);
$plantilla->paginar($_POST["desde"],$_POST["hasta"],$elements_x_pagina,$num_objectes);
$plantilla->cambioSustitucion("id",$_POST["id"]);
$plantilla->cambioSustitucion("cantidad",$num_objectes);
$i=1;
foreach($obj_llistat AS $objecte_llistat){
    $afegir_a_objecte = array();
    if(isset($funcio_especifica))
        $afegir_a_objecte = $funcio_especifica($objecte_llistat);
    $plantilla->insertarElementoTodasSustituciones($_POST["tabla"],$objecte_llistat,array_merge(array("odd"=>($i++%2==0? 'par':'impar')),$afegir_a_objecte),$excloure_llistat);
}
return $plantilla->mostrar();

function traureImatgeArxiu($objecte){
    $extensio = $objecte->get(array("name"));
    $extensio = explode(".",$extensio);
    switch(strtolower($extensio[count($extensio)-1])){
        case "jpg":
        case "jpeg":
        case "png":
            $extensio= "jpg";
            break;
        case "doc":
        case "docx":
            $extensio = "doc";
            break;
        case "pdf":
            $extensio = "pdf";
            break;
        default: 
            $extensio = "";
            break;
        
    }
    $extensio = "imatge_".$extensio.".jpg";
    return array("imatge"=>$extensio);
}

function traureUrl($objecte){
    $url = $objecte->get(array("url"));
    $extensio = explode("?v=",$url);
    return array("url_video"=>$extensio[1]);
}
?>