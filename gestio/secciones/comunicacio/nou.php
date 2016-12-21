<?PHP
include_once("../../exec/comun.php");
$postdata = file_get_contents("php://input");

$request = json_decode($postdata,true);
$receptors = $request["receptors"];
$request["receptors"] = json_encode($request["receptors"]);

/*$objecte = new Modelo("comunicacio",$request);
if($request['id']>=0){
	$objecte->set($request);
}else
*/
{
	//pillem les agrupacions
	$condicions = "";
	$entrat = 0;
	foreach ($receptors as $key => $value) {
		if(count($value)>0){
			$condicions .= "(";
			foreach ($value as $id => $valor) {
				$entrat = 0;
				if($valor == 1){
					if($key != "familia"){
						$condicions .= " id_".$key." = ".$id." OR ";
						$entrat = 1;
					}else{
						$condicions .= " `instrument`.id_familia = ".$id." OR ";
						$entrat = 1;
					}
				}
			}
			$condicions = substr($condicions, 0, strlen ($condicions)-3);
			$condicions .= ") AND ";
		}
	}
	$condicions = substr($condicions, 0, strlen ($condicions)-4);

	$correus = "";
	$usuaris = array();
	$llista_usuaris = new Modelo("usuari");

	$llista_usuaris = $llista_usuaris->cargaRelacionConDatos("usuari", "nom", "asc", $condicions);

	/*foreach ($receptors as $key => $value) {
		foreach ($value as $id => $valor) {
			if($valor==1){
				$llista_usuaris = new Modelo("usuari");
				$llista_usuaris = $llista_usuaris->cargaRelacionConDatos("usuari", "nom", "asc", " id_".$key." = ".$id." ");
				foreach ($llista_usuaris as $id_usuari => $usuari) {
					if(!array_key_exists($id_usuari, $usuaris)){
						$usuaris[$id_usuari] = $usuari;
						$correu = $usuari->get("email");
						if($correu != ""){
							$correus .= $correu.", ";
						}
					}
				}
			}
		}
	}
	*/
	foreach ($llista_usuaris as $id_usuari => $usuari) {
		if(!array_key_exists($id_usuari, $usuaris)){
			$usuaris[$id_usuari] = $usuari;
			$correu = $usuari->get("email");
			if($correu != ""){
				$correus .= $correu.", ";
			}
		}
	}
	
	
	$correus = substr($correus, 0, strlen ($correus)-2);
	$emisor = "musica@gmail.com";
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$cabeceras .= 'FROM: '.$emisor. "\r\n";
	$adreses = 'BCC: '; 
	$resultat = mail(  "",  $request["assumpte"] , $request["comunicacio"],$cabeceras.$correus);//Ojo que si que senvia a tots aixina
}
?>