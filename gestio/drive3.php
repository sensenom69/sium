<?php
require_once 'google-api-php-client/vendor/autoload.php';
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $client = new Google_Client();
    // Get your credentials from the console
    $client->setClientId('310652789266-6qmmuqro4o42h80lcmj0dqjdukd3j2mg.apps.googleusercontent.com');
    $client->setClientSecret('CAvU0SeI5UmpALpdnVxAmeZ4');
    $client->setRedirectUri('http://sium.ideas2bits.com/gestio2/drive3.php');
    $client->setScopes(array('https://www.googleapis.com/auth/drive'));
    $authUrl = $client->createAuthUrl();
    
    $ch = curl_init(filter_var($authUrl, FILTER_SANITIZE_URL));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,http_build_query());
    $response = curl_exec($ch);
    print "arriba2";
    /*
    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);  
        $_SESSION['token'] = $client->getAccessToken();
        
        //header('Location: http://localhost/examples2/googledrive/step1.php');
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
    if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
        $authUrl = $client->createAuthUrl();


        //print "<a class='login' href='$authUrl'>Conectar</a>";
    }        
   if (isset($_SESSION['token'])) {
       print "<a class='logout' href='".$_SERVER['PHP_SELF']."?logout=1'>Salir</a><br>";
       $client->setAccessToken($_SESSION['token']);
      $service = new Google_Service_Drive($client);
      
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file = new Google_Service_Drive_DriveFile();
        $file_path = 'prova_pujada.txt';
        $mime_type = finfo_file($finfo, $file_path);
        $file->setName('prova_pujada.txt');
        $file->setDescription('This is a '.$mime_type.' document');
        $file->setMimeType($mime_type);
        $resultat_pujada = $service->files->create(
            $file,
            array(
                'data' => file_get_contents($file_path),
                'mimeType' => $mime_type
            )
        );
        echo json_encode($resultat_pujada);
        echo('Location: https://drive.google.com/open?id='.$resultat_pujada['id']);
    }
    */
?>