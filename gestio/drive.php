<?php
require_once("exec/comun.php");
if($_SESSION['logejat']!= true OR $_SESSION['id_permis']<3)
    header('Location: http://sium.ideas2bits.com');
 session_start();
 if(!isset($_SESSION['id_obra_activa'])){
    $_SESSION['id_obra_activa']=0;
 }
 if(isset($_GET["logout"])){
  session_destroy();
 }
    require_once 'google-api-php-client/vendor/autoload.php';
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $client = new Google_Client();
    // Get your credentials from the console
    $client->setClientId('310652789266-6qmmuqro4o42h80lcmj0dqjdukd3j2mg.apps.googleusercontent.com');
    $client->setClientSecret('CAvU0SeI5UmpALpdnVxAmeZ4');
    $client->setRedirectUri('http://www.sium.ideas2bits.com/gestio2/drive.php');
    $client->setScopes(array('https://www.googleapis.com/auth/drive'));
    $authUrl = $client->createAuthUrl();
    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);  
        $_SESSION['token'] = $client->getAccessToken();
        
        //header('Location: http://localhost/examples2/googledrive/step1.php');
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
    if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
        $authUrl = $client->createAuthUrl();


        print "<a class='login' href='$authUrl'>Conectar</a>";
    }        
   if (isset($_SESSION['token'])) {
    ?>
        <script type="text/javascript">
         
              function selectedFile() {
                var archivoSeleccionado = document.getElementById("myfile");
                var file = archivoSeleccionado.files[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1048576)
                        fileSize = (Math.round(file.size * 100 / 1048576) / 100).toString() + ' MB';
                    else
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + ' Kb';
         
                    var divfileSize = document.getElementById('fileSize');
                    var divfileType = document.getElementById('fileType');
                    divfileSize.innerHTML = 'Tamaño: ' + fileSize;
                    divfileType.innerHTML = 'Tipo: ' + file.type;
                     
                }
              }     
         
            function uploadFile(){
                //var url = "http://localhost/ReadMoveWebServices/WSUploadFile.asmx?op=UploadFile";     
                var url = "drive.php";
                var archivoSeleccionado = document.getElementById("myfile");
                var file = archivoSeleccionado.files[0];
                var fd = new FormData();
                fd.append("archivo", file);
                var xmlHTTP= new XMLHttpRequest();              
                //xmlHTTP.upload.addEventListener("loadstart", loadStartFunction, false);
                xmlHTTP.upload.addEventListener("progress", progressFunction, false);
                xmlHTTP.addEventListener("load", transferCompleteFunction, false);
                xmlHTTP.addEventListener("error", uploadFailed, false);
                xmlHTTP.addEventListener("abort", uploadCanceled, false);               
                xmlHTTP.open("POST", url, true);
                //xmlHTTP.setRequestHeader('book_id','10');
                xmlHTTP.send(fd);
            }       
             
            function progressFunction(evt){
                var progressBar = document.getElementById("progressBar");
                var percentageDiv = document.getElementById("percentageCalc");
                if (evt.lengthComputable) {
                    progressBar.max = evt.total;
                    progressBar.value = evt.loaded;
                    percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";
                }
            }
             
            function loadStartFunction(evt){
                alert('Comenzando a subir el archivo');
            }
            function transferCompleteFunction(evt){
                alert('Transferencia completa');            
                var progressBar = document.getElementById("progressBar");
                var percentageDiv = document.getElementById("percentageCalc");
                progressBar.value = 100;
                percentageDiv.innerHTML = "100%";   
            }   
             
            function uploadFailed(evt) {
                alert("Hubo un error al subir el archivo.");
            }
     
            function uploadCanceled(evt) {
                alert("La operación se canceló o la conexión fue interrunpida.");
            }
             
                             
         
        </script>
        <!DOCTYPE html>
<html>
    <head>
        <title>Upload File</title>
        <meta charset="iso-8859-1" />
    </head>
    <body>
        <div id="wrap">
            <div class="field">
                <ul class="options">
                    <li>
                        <input type="file" id="myfile" name="myfile" class="rm-input" onchange="selectedFile();"/>
                    </li>
                    <li>
                        <div id="fileSize"></div>
                    </li>
                    <li>
                        <div id="fileType"></div>
                    </li>
                    <li>
                        <input type="button" value="Subir Archivo" onClick="uploadFile()" class="rm-button" />
                    </li>
                </ul>
            </div>
            <progress id="progressBar" value="0" max="100" class="rm-progress"></progress>
            <div id="percentageCalc"></div>
        </div>
    </body>
</html>
        <?php
        print "<a class='logout' href='index.php#/obra/editar?id=".$_SESSION['id_obra_activa']."'>Tornar</a><br>";
       if(isset($_FILES['archivo']['name'])){
            $target_path = "uploads/";
            $target_path = $target_path . basename( $_FILES['archivo']['name']); 
            if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) 
            { echo "El archivo ". basename( $_FILES['archivo']['name']). " ha sido subido";
            }
            echo $target_path."\n";
           $client->setAccessToken($_SESSION['token']);
          $service = new Google_Service_Drive($client);
          
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file = new Google_Service_Drive_DriveFile();
            $file_path = $target_path;
            $mime_type = finfo_file($finfo, $file_path);
            $file->setName($_FILES['archivo']['name']);
            $file->setDescription('This is a '.$mime_type.' document');
            $file->setMimeType($mime_type);
            $resultat_pujada = $service->files->create(
                $file,
                array(
                    'data' => file_get_contents($file_path),
                    'mimeType' => $mime_type
                )
            );
            $obra = new Modelo("obra", array("id"=>$_SESSION['id_obra_activa']));
            $obra->carga();
            $obra->set(array("partitura"=>"https://drive.google.com/open?id=".$resultat_pujada['id']));
            print_r($obra);
            //echo json_encode($resultat_pujada);
            
        }
        /*
      
      //$results = $service->files->listFiles();
      //echo json_encode($results);
        $results = $service->files->listFiles(array())->getFiles();
        //echo json_encode($results);
      //$results = $service->files->listFiles(array())->getFiles();
      
      if (count($results) == 0) {
        print "No files found.\n";
      } else {
        print "<table border='1'><thead><th>Archivo</th><th>Id</th></thead>";
        foreach ($results as $file) {
          printf("<tr><td>%s</td><td> %s</td></tr>", $file['name'], $file->getId());
        }
        print "</table>";
      }
      */
      
    }
?>