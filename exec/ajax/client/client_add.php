<?PHP
//ARREGLAR EL CLIENT
include('../../comun.php');
if(!$_SESSION['logeado']){
    die("Es necesari estar autenticat.");
}
$nom        = $_POST['nom'];
$dni                = $_POST['dni'];
$res = mysql_query("SELECT * FROM client WHERE id_local = '".$_SESSION['id_local']."' AND (dni='".addslashes($dni)."' AND nom='".addslashes($nom)."')");
if(mysql_affected_rows()!=0)
    die ("-1");
$client = new classKartingClient($_SESSION['id_local'],-1,$_POST['nom'],$_POST['adresa'],$_POST['cp'],$_POST['poblacio'],$_POST['provincia'],$_POST['dni'],$_POST['telefon'],$_POST['movil'],$_POST['email'],0,1);
//die ("<option value='".$client->getId_client()."'>".$_POST['congnom_client'].'. '.$_POST['nom_client']."</option>");
$json = "{\"nom\":\"".$_POST['nom']."\",\"id\":\"".$client->getId_client()."\"";
//die($_POST['congnom_client'].'. '.$_POST['nom_client']);
die($json);
?>