<?PHP
/*
0=>no existix el usuari
-1=>pass no correcte
1=>usuari super
2=>usuari admin
3=>usuari bibilotecari
4=>usuari usuari
*/
include('../comun.php');
/*
print_r($_POST);
$email = $_POST['email'];
$pass = $_POST['pass'];
*/
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$email = $request->email;
$pass = $request->pass;
$sql = "SELECT usuari.nom, usuari.pass, usuari.id, usuari.id_permis, usuari.id_agrupacio, usuari.id_instrument, instrument.nom as instrument, permis.nom as permis, agrupacio.nom as agrupacio  FROM `usuari`, `instrument`, `permis`, `agrupacio` WHERE usuari.id_permis = permis.id AND usuari.id_instrument = instrument.id AND usuari.id_agrupacio = agrupacio.id AND usuari.email = '".addslashes($email)."'";
$res = mysql_query($sql);
$dades = mysql_fetch_array($res);

if(mysql_affected_rows()==0){
    die ("0");
}
if($pass == $dades['pass'] && $pass != ''){
    $_SESSION["id_permis"]=$dades['id_permis'];
    $_SESSION["id_usuari"] = $dades["id"];
    $_SESSION["id_agrupacio"] = $dades["id_agrupacio"];
    $_SESSION["id_instrument"] = $dades["id_instrument"];
    $_SESSION["permis"] = $dades["permis"];
    $_SESSION["agrupacio"] = $dades["agrupacio"];
    $_SESSION["instrument"] = $dades["instrument"];
    $_SESSION["nom"] = $dades["nom"];
    $_SESSION['logejat']=true;
    die($_SESSION['id_permis']);
}
else{
	print_r($dades);
    die("-1");
}
?>