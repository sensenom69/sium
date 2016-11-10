<?PHP

$plantilla = new classPlantilla("plantillas/secciones/estadistica/listado.tpl");
if($ve_de_la_general){
    return $plantilla->mostrar();
}

return  $plantilla->mostrar();

/*
$plantilla = new classPlantilla("plantillas/secciones/mesa/listado.tpl");
$usuario = new Modelo("usuario",array("id_local"=>$_SESSION["id_local"],"id"=>$_SESSION["id_usuario"]));
//$clientes = $usuario->cargaRelacion("cliente");
$_POST["tabla"] = "cliente";
return $plantilla->mostrar();
*/
?>