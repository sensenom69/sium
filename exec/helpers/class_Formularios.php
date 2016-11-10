<?PHP
class Formulario{

    public static function getFormulario($objecte,$inclusions=array(),$excepcions=array(),$titul=false,$div_retorno="",$readonly=""){
        $ruta_plantillas = $_SERVER["PHP_SELF"];
        $ruta_plantillas = explode("/",$ruta_plantillas);
        $ruta_parcial = "";
        for($barres = 5;$barres<count($ruta_plantillas);$barres++)
            $ruta_parcial .= "../";
        $plantilla_madre = new classPlantilla($ruta_parcial."exec/plantillas/formulari.tpl");
        if($titul=="true"){
            $plantilla_madre->cambioSeccion("titul",true);
        }else{
            $plantilla_madre->cambioSustitucion("div_retorno",$div_retorno);
        }
        $objecte->cargaCamps(); 
        $camps = $objecte->getCamps();
        $camps = array_merge($camps,$inclusions);
        $camps = array_diff($camps,$excepcions);

        $plantilla_madre->cambioSustitucion("camp_amagat",
        '<!--$ INI camp_amagat -->
        <input id="##nom##" name="##nom##" value="##id##" style="display:none;"/>
        <!--$ FIN camp_amagat -->'
        );
        $plantilla_madre->cambioSustitucion("titul",$titul);
        $plantilla_madre->cambioSustitucion("tabla",$objecte->tabla);
        $plantilla_madre->cambioSustitucion("div_retorno",$div_retorno);
        $plantilla_madre->cambioSustitucion("accion_ok","add");
        
        $plantilla_madre->cambioSustitucion("cancelar",$_SESSION["permiso"]==0? "Cancel":"Back");
        $plantilla_madre->cambioSeccion("botons_admin",$_SESSION["permiso"]==0);
        foreach($camps AS $camp){
            $nom_camp = Formulario::getNomCamp($camp);
            $plantilla_madre->insertarElemento(
                "camp",
                array(
                    "nom_mostrar",
                    "input"
                ),
                array(
                    $nom_camp,
                    Formulario::getInput($camp)
                )
            );
        }
        return $plantilla_madre->mostrar();
    }
    
    /**
     * Modifique exclusivament per a levle i grouping 
    */
    private static function getInput($camp){
        if(strpos($camp,"id_")!==FALSE){
            return '<select class="form-control" id="'.$camp.'" name="'.$camp.'" ><option value="0">-</option><!--$ INI '.$camp.' --><option value="##'.$camp.'##" ##selected##>##nombre##</option><!--$ FIN '.$camp.' --></select>';
            
        }elseif(strpos($camp,"observaciones")!==FALSE OR strpos($camp,"message")!==FALSE ){
            return '<textarea ##editable## class=" form-control" ##readonly## id="'.$camp.'" name="'.$camp.'">##'.$camp.'##</textarea>';
        }elseif(strpos($camp,"slider")!==FALSE OR strpos($camp,"news")!==FALSE OR strpos($camp,"activities")!==FALSE OR strpos($camp,"blog")!==FALSE){
            return '<textarea ##editable## style="width:195px;height:170px;" size="30" ##readonly## id="'.$camp.'" name="'.$camp.'">##'.$camp.'##</textarea>';   
        }elseif($camp=="avisado" OR $camp=="no-20-asistira"){
            return '<input type="checkbox" id="avisado" name="avisado" value=1 ##avisado##>';
        }elseif($camp=="no-20-asistira"){
            return '<input type="checkbox" id="no-20-asistira" name="no-20-asistira" value=1 ##no-20-asistira##>';
        }
        else{
            return '<input class="form-control" id="'.$camp.'" name="'.$camp.'" value="##'.$camp.'##" type="text" ##editable##/>';   
        }
    }
    
    private static function getNomCamp($camp){
        if(strpos($camp,"id_")!==FALSE)
            return str_replace("id_","",$camp);
        return $camp;
    }
}
?>