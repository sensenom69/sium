<?PHP
class Listado{
    public static function getListado($objecte,$inclusions=array(),$excepcions=array(),$titul=false,$div_retorno="",$tipo_llistat=""){
        global $_POST;
        $ruta_plantillas = $_SERVER["PHP_SELF"];
        $ruta_plantillas = explode("/",$ruta_plantillas);
        $ruta_parcial = "";
        for($barres = 5;$barres<count($ruta_plantillas);$barres++)
            $ruta_parcial .= "../";
        
        $plantilla_madre = new classPlantilla($_POST["ruta_parcial_ajax"].$ruta_parcial."exec/plantillas/listado".$tipo_llistat.".tpl");
        
        if($titul=="true"){
            $plantilla_madre->cambioSeccion("titul",true);
        }
        else{
            $plantilla_madre->cambioSustitucion("titul",$titul=="true"? "true":"false");
        }
        $plantilla_madre->cambioSeccion("menu_contextual_admin",$_SESSION["permiso"]==0);
        $plantilla_madre->cambioSeccion("buscador",$objecte->tabla=="invitado");
        $objecte->cargaCamps(); 
        $camps = $objecte->getCamps();
        $camps = array_diff($camps,$excepcions);
        $camps = array_merge($camps,$inclusions);
        $plantilla_madre->cambioSustitucion("tabla",$objecte->tabla);
        
        $plantilla_madre->cambioSustitucion("div_retorno",$div_retorno);

        foreach($camps AS $camp){
            if(strpos($camp,"-20-")!==FALSE){
                $aux = $camp;
                $camp = str_replace('-20-',' ',$camp);
            }
            $plantilla_madre->insertarElemento("camp",array("nom_mostrar"),array(Listado::getNomCamp($camp)));
            if(isset($aux))
                $camp = $aux;
            if($camp == "avisado"){
                $plantilla_celda = new classPlantilla($_POST["ruta_parcial_ajax"].$ruta_parcial."exec/plantillas/celdas_listado/celda_listado_check.tpl");
                $plantilla_celda->cambiosARealizar(array("nom_mostrar","tabla","campo"),array(Listado::getNomCamp($camp),$objecte->tabla,$camp));
                $plantilla_madre->insertarElemento("camp_replenar",array("linea"),array($plantilla_celda->mostrar()));
                //$plantilla_madre->insertarElemento("camp_replenar_checkbox",array("nom_mostrar","tabla","campo"),array(Listado::getNomCamp($camp),$objecte->tabla,$camp));
            }elseif($camp=="no-20-asistira"){
                $plantilla_celda = new classPlantilla($_POST["ruta_parcial_ajax"].$ruta_parcial."exec/plantillas/celdas_listado/celda_listado_check_js.tpl");
                $plantilla_celda->cambiosARealizar(array("nom_mostrar","codiJavascript"),array(Listado::getNomCamp($camp),(isset($codiJavascript[$camp])? $codiJavascript[$camp]:"")));
                $plantilla_madre->insertarElemento("camp_replenar",array("linea"),array($plantilla_celda->mostrar()));
                //$plantilla_madre->insertarElemento("camp_replenar_checkbox_javascript",array("nom_mostrar","codiJavascript"),array(Listado::getNomCamp($camp),(isset($codiJavascript[$camp])? $codiJavascript[$camp]:"")));
            }
            else{
                $plantilla_celda = new classPlantilla($_POST["ruta_parcial_ajax"].$ruta_parcial."exec/plantillas/celdas_listado/celda_listado_mostrar.tpl");
                $plantilla_celda->cambiosARealizar(array("nom_mostrar"),array(Listado::getNomCamp($camp)));
                //$plantilla_madre->insertarElemento("camp_replenar",array("linea"),array($plantilla_celda->mostrar()));
                $plantilla_madre->insertarElemento("camp_replenar",array("linea"),array($plantilla_celda->mostrar()));
            }
            unset($aux);
        }
        $plantilla_madre->cambioSustitucion("ini_insercio","<!--$ INI ".$objecte->tabla." -->");
        $plantilla_madre->cambioSustitucion("fi_insercio","<!--$ FIN ".$objecte->tabla." -->");
        return $plantilla_madre->mostrar();
    }
    
    private static function getNomCamp($camp){
        if(strpos($camp,"id_")!==FALSE)
            return str_replace("id_","",$camp);
        elseif(strpos($camp,".")!==FALSE){
            $nom = explode(".",$camp);
            return $nom[0];
        }
        return $camp;
    }
}
?>