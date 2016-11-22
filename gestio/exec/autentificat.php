<?PHP
if(!isset($_SESSION['logejat'])){
    header("Location: http://localhost/martin/gestio");
}
 
if(!$_SESSION['logejat'] ){
    header("Location: http://localhost/martin/gestio");
}
?>