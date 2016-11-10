<?php
include_once("exec/comun.php");
//comporbem si esta logejat
if(!isset($_SESSION["logejat"]) OR  $_SESSION["logejat"]!=true){
    $plantilla_principal = new classPlantilla("plantillas/autentifica.tpl");
}else{
    //Variables generals en la aplicacio, caldria posarho en un arxiu a banda.
    $_POST["ruta_parcial_ajax"] = "";
    $condicions = "";
    $inclusions = array();
    $elements_x_pagina = 15;
    $plantilla_principal = new classPlantilla("plantillas/plantilla_principal.tpl");
    //$plantilla_principal = new classPlantilla("plantillas/dashboard.tpl");
    $usuario = new Modelo("usuari",array("id"=>$_SESSION["id_usuari"]));
    //Traguem els eventos als que te acces
    if($_SESSION["id_permis"]==0){
        ;
    }else{
       ;
    }   
    //comprobem a quin manejador vol anar
    $adresa = explode("/",$_SERVER["REQUEST_URI"]);
    //si acaba de entrar
    if(!isset($adresa[2])){
        $resultat = include("secciones/principal/listado.php");
        $plantilla_principal->cambioSustitucion("contenido",$resultat);
    }
    if(count($adresa)>3){
        //if($adresa[2]!='principal' && $adresa[3]!='principal'){
            $_POST["tabla"] = $adresa[2];
            $_POST["accio"] = $adresa[3];
            if($_POST["accio"]=="add"){
                $_POST["id"] = -1;
            }
            for($i=5;$i<count($adresa);$i++){
                $par = explode("=",$adresa[$i]);
                if(count($par)>1){
                    $_POST[$par[0]] = $par[1];   
                }
            }
            
            if(isset($adresa[4]))
                $_POST["id"] = $adresa[4];
            
            if(!file_exists("secciones/".$adresa[2]."/".$adresa[3].".php") ){
                //print "entra en secciones/".$adresa[3]."/".$adresa[4].".php";
                $resultat = include("exec/funciones/".$adresa[3].".php");
            }else{
                $resultat = include("secciones/".$adresa[2]."/".$adresa[3].".php");
            }
            $plantilla_principal->cambioSustitucion("activa_".$adresa[2],"active");
            //$resultat = require("secciones/".$adresa[3]."/".$adresa[4].".php");
            $plantilla_principal->cambioSustitucion("contenido",$resultat);
        //}
    }
}
print $plantilla_principal->mostrar();
?>