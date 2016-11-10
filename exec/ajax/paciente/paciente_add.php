<?PHP
include('../../comun.php');
if(!$_SESSION['logeado']){
    die("Es necesari estar autenticat.");
}
$nom_pacient        = $_POST['nom_pacient'];
$congnom_pacient    = $_POST['congnom_pacient'];
$dni                = $_POST['dni'];
$res = mysql_query("SELECT * FROM pacient WHERE id_local = '".$_SESSION['id_local']."' AND (dni='".addslashes($dni)."' AND nom='".addslashes($nom_pacient)."' AND congnom='".addslashes($congnom_pacient)."')");
if(mysql_affected_rows()!=0)
    die ("-1");
$pacient = new classKartingPacient($_SESSION['id_local'],-1,$_POST['nom_pacient'],$_POST['congnom_pacient'],$_POST['dni'],$_POST['adresa'],$_POST['cp'],$_POST['poblacio'],$_POST['provincia'],$_POST['telefon'],$_POST['movil'],$_POST['email'],classUtilidades::tornaIntFecha($_POST['data_naixement']),0,1);
//die ("<option value='".$pacient->getId_pacient()."'>".$_POST['congnom_pacient'].'. '.$_POST['nom_pacient']."</option>");
$json = "{\"congnom\":\"".$_POST['congnom_pacient']."\",\"nom\":\"".$_POST['nom_pacient']."\",\"id\":\"".$pacient->getId_pacient()."\"";
//die($_POST['congnom_pacient'].'. '.$_POST['nom_pacient']);
die($json);
?>