<?PHP
$ruta_plantillas = $_SERVER["PHP_SELF"];
$ruta_plantillas = explode("/",$ruta_plantillas);
$ruta_parcial = "../";
for($barres = 5;$barres<count($ruta_plantillas);$barres++)
    $ruta_parcial .= "../";
$plantilla_madre = new classPlantilla($ruta_parcial."exec/plantillas/plantilla.tpl");
?>