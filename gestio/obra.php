<?php
require_once("exec/comun.php");
if( $_SESSION['id_permis']>3)
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
    $client->setClientId('310652789266-c2ljs8he2omfsloo86cmc4bkglcvm2k6.apps.googleusercontent.com');
    $client->setClientSecret('97wWaiA26zIMVE9l44q6L-Nk');
    $client->setRedirectUri('http://www.sium.ideas2bits.com/gestio2/obra.php');
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
                var url = "obra.php";
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
            function tornar(){
                window.location="index.php#/obra/editar?id=<?php print $_SESSION['id_obra_activa'] ?>";
            }
             
                             
         
        </script>
        <!DOCTYPE html>
            }
<html lang="en" ng-app="material-lite">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>SIUM Obra</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- build:css css/vendors.min.css -->
  <link href="css/principal/select.css" rel="stylesheet" />
  <link href="css/principal/select2.css" rel="stylesheet"><!-- Required by angular-ui-select -->
  <link href="bower_components/ng-wig/dist/css/ng-wig.css" rel="stylesheet" /><!-- Text editor -->
  <link href="bower_components/ng-table/dist/ng-table.css" rel="stylesheet" />
  <link href="bower_components/pikaday/css/pikaday.css" rel="stylesheet" />
  <link href="bower_components/c3/c3.css" rel="stylesheet" />
  <link href="bower_components/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="bower_components/animate.css/animate.css" rel="stylesheet" />
  <!-- endbuild -->
  <!-- build:css css/demo.min.css -->
  <link href="css/material-lite-demo.css" rel="stylesheet">
  <link href="css/helpers.css" rel="stylesheet">
  <!-- endbuild -->
   <link href="bower_components/angular-material/angular-material.css" rel="stylesheet" />
    <!--tabla-->
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <section class="text-fields" ng-controller="PujarParticheles" >
          <div class="mdl-color--amber ml-header relative clear" style="min-height: 120px;">
            <div class="p-20">
            </div>
          </div>

            <div class="mdl-cell mdl-cell--9-col mdl-cell--12-col-tablet mdl-cell--12-col-phone no-p-l" style="margin-top:-109px;">
              <div class="p-20 ml-card-holder">
                <div class="mdl-card mdl-shadow--1dp">
                  <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text"></b></h2>
                  </div>
                  <div class="p-30" >
                    <form name="formulari" ng-class="nou_item.clase" novalidate>
                      <div class="mdl-textfield mdl-js-textfield" style="margin-top: 40px;">
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
                    </ul>
                      </div>
                      <div id="wrap">
                           
                            <progress id="progressBar" value="0" max="100" class="rm-progress"></progress>
                            <div id="percentageCalc"></div>
                        </div>
                      <div  class="m-t-20">
                      <input type="button" value="Subir Archivo" onClick="uploadFile()" class="rm-button mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" />
                       
                        <button onclick="tornar()" type="reset" class="mdl-button mdl-js-button mdl-js-ripple-effect">
                          Cancelar
                        </button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
        </section>
        
    </body>
    <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
     
 <script charset="utf-8" src="bower_components/material-design-lite/material.js"></script>

  <script charset="utf-8" src="bower_components/angular/angular.js"></script>
  <script charset="utf-8" src="bower_components/angular-route/angular-route.js"></script>
  <script charset="utf-8" src="bower_components/angular-animate/angular-animate.js"></script>

  <script charset="utf-8" src="bower_components/angular-ui-select/dist/select.js"></script>
  <script charset="utf-8" src="bower_components/angular-sanitize/angular-sanitize.js"></script><!-- Required by angular-ui-select -->

  <script charset="utf-8" src="bower_components/angular-local-storage/dist/angular-local-storage.js"></script><!-- Required by todo module -->

  <script charset="utf-8" src="bower_components/lodash/lodash.js"></script><!-- Required by angular google maps -->
  <script charset="utf-8" src="bower_components/angular-simple-logger/dist/angular-simple-logger.js"></script><!-- Required by angular google maps -->
  <script charset="utf-8" src="bower_components/angular-google-maps/dist/angular-google-maps.js"></script>

  <script charset="utf-8" src="bower_components/ng-file-upload/ng-file-upload.js"></script>

  <script charset="utf-8" src="bower_components/ng-table/dist/ng-table.js"></script>

  <script charset="utf-8" src="bower_components/ng-wig/dist/ng-wig.js"></script><!-- Text editor -->

  <script charset="utf-8" src="bower_components/moment/moment.js"></script><!-- Required by pikaday -->
  <script charset="utf-8" src="bower_components/pikaday/pikaday.js"></script><!-- Required by pikaday-angular -->
  <script charset="utf-8" src="bower_components/pikaday-angular/pikaday-angular.js"></script><!-- Datepicker -->

  <script charset="utf-8" src="bower_components/d3/d3.js"></script><!-- Charts -->
  <script charset="utf-8" src="bower_components/c3/c3.js"></script><!-- Charts -->
  <script charset="utf-8" src="bower_components/c3-angular/c3-angular.min.js"></script><!-- C3 Chart directives -->

  <script charset="utf-8" src="bower_components/angulargrid/angulargrid.js"></script>

  <script charset="utf-8" src="js/vendors/angular-placeholders.js"></script>
  <script charset="utf-8" src="js/vendors/angular-mdl.js"></script>
  <!-- endbuild -->
  <!-- build:js js/demo.min.js -->
  <script charset="utf-8" src="js/demo/app.js"></script>
  <script charset="utf-8" src="js/demo/app.route.js"></script>
  <script charset="utf-8" src="js/demo/app.config.js"></script>
  <script charset="utf-8" src="js/app.constants.js"></script>
  <script charset="utf-8" src="js/demo/controllers/main.js"></script>
  <script charset="utf-8" src="js/demo/controllers/dashboard.js"></script>
  <script charset="utf-8" src="js/demo/controllers/todo.js"></script>

  <script charset="utf-8" src="js/demo/controllers/ui-elements/loading.js"></script>
  <script charset="utf-8" src="js/demo/controllers/gallery.js"></script>

  <!--<script charset="utf-8" src="js/demo/controllers/forms/advanced-elements/select.js"></script>-->
  <script charset="utf-8" src="js/demo/controllers/forms/advanced-elements/upload.js"></script>
  <!--<script charset="utf-8" src="js/demo/controllers/forms/advanced-elements/text-editor.js"></script>-->

  <script charset="utf-8" src="js/demo/controllers/maps/clickable-map.js"></script>
  <script charset="utf-8" src="js/demo/controllers/maps/searchable-map.js"></script>
  <script charset="utf-8" src="js/demo/controllers/maps/zoomable-map.js"></script>
  <script charset="utf-8" src="js/demo/controllers/maps/styled-map.js"></script>
  <script charset="utf-8" src="js/demo/controllers/maps/full-map.js"></script>

  <script charset="utf-8" src="js/demo/controllers/charts.js"></script>

  <!-- <script charset="utf-8" src="js/demo/controllers/tables-data.js"></script>-->

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  <!-- Angular Material Library -->
  <script src="http://ngmaterial.assets.s3.amazonaws.com/svg-assets-cache.js"></script>
  <!--<script charset="utf-8" src="bower_components/angular-messages/angular-messages.js"></script>
  <script charset="utf-8" src="bower_components/angular-animate/angular-animate.js"></script>
  <script charset="utf-8" src="bower_components/angular-aria/angular-aria.js"></script>
  <script charset="utf-8" src="bower_components/angular-material/angular-material.js"></script>-->
  <script charset="utf-8" src="js/controllers/tables-data.js"></script>
  <script charset="utf-8" src="js/controllers/sidebar.js"></script>
  
    <script charset="utf-8" src="js/controllers/nou_usuari.js"></script>
    <script charset="utf-8" src="js/controllers/nou_agrupacio.js"></script>
    <script charset="utf-8" src="js/controllers/nou_familia.js"></script>
    <script charset="utf-8" src="js/controllers/nou_instrument.js"></script>
    <script charset="utf-8" src="js/controllers/nou_obra.js"></script>
    <script charset="utf-8" src="js/controllers/nou_concert.js"></script>
    <script charset="utf-8" src="js/controllers/nou_comunicacio.js"></script>
    <script charset="utf-8" src="js/controllers/editar_usuari.js"></script>
    <script charset="utf-8" src="js/controllers/editar_agrupacio.js"></script>
    <script charset="utf-8" src="js/controllers/editar_familia.js"></script>
    <script charset="utf-8" src="js/controllers/editar_instrument.js"></script>
    <script charset="utf-8" src="js/controllers/editar_obra.js"></script>
    <script charset="utf-8" src="js/controllers/editar_concert.js"></script>
    <script charset="utf-8" src="js/controllers/editar_comunicacio.js"></script>
    <script charset="utf-8" src="js/controllers/editar_particheles.js"></script>
    <script charset="utf-8" src="js/controllers/permis.js"></script>
    <script charset="utf-8" src="js/controllers/agrupacions.js"></script>
    <script charset="utf-8" src="js/controllers/familia.js"></script>
    <script charset="utf-8" src="js/controllers/instruments.js"></script>
    <script charset="utf-8" src="js/controllers/particella.js"></script>

  <script charset="utf-8" src="js/demo/directives/dynamic-color.js"></script>
  <script charset="utf-8" src="js/demo/directives/header.js"></script>
  <script charset="utf-8" src="js/demo/directives/sidebar.js"></script>

  <script charset="utf-8" src="js/modules/chat.js"></script>
  <script charset="utf-8" src="js/modules/menu.js"></script>
  <script charset="utf-8" src="js/modules/svg-map.js"></script>
  <script charset="utf-8" src="js/modules/todo.js"></script>

  <script charset="utf-8" src="js/directives/sticky.js"></script>
        <?php
        print "<a class='logout' href='index.php#/obra/editar?id=".$_SESSION['id_obra_activa']."'>Tornar</a><br>";
       if(isset($_FILES['archivo']['name'])){
            $target_path = "uploads/";
            $target_path = $target_path . basename( $_FILES['archivo']['name']); 
            if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) 
            { echo "El archivo ". basename( $_FILES['archivo']['name']). " ha sido subido";
            }
            
            
            $obra = new Modelo("obra", array("id"=>$_SESSION['id_obra_activa']));
            $obra->carga();


           $client->setAccessToken($_SESSION['token']);
          $service = new Google_Service_Drive($client);

            //comprobem que no te carpeta creada
            if($obra->get('drive')==""){
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $file = new Google_Service_Drive_DriveFile();
                $file_path = $_SESSION['id_obra_activa']."-".$obra->get("nom");
                $mime_type = "application/vnd.google-apps.folder";
                $file->setName($_SESSION['id_obra_activa']."-".$obra->get("nom"));
                $file->setDescription('This is a '.$mime_type.' document');
                $file->setMimeType($mime_type);
                $resultat_pujada = $service->files->create(
                    $file,
                    array(
                        'data' => file_get_contents($file_path),
                        'mimeType' => $mime_type
                    )
                );
                $obra->set(array("drive"=>$resultat_pujada['id']));
            }

          
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file = new Google_Service_Drive_DriveFile(array(
                'name' =>$_FILES['archivo']['name'],
                'parents' => array($obra->get('drive'))
                ));
            $file_path = $target_path;
            $mime_type = finfo_file($finfo, $file_path);
            //$file->setName($_FILES['archivo']['name']);
            $file->setDescription('This is a '.$mime_type.' document');
            $file->setMimeType($mime_type);
            $resultat_pujada = $service->files->create(
                $file,
                array(
                    'data' => file_get_contents($file_path),
                    'mimeType' => $mime_type

                )
            );
            $obra->set(array("partitura"=>"https://drive.google.com/open?id=".$resultat_pujada['id']));
            
            $newPermission = new Google_Service_Drive_Permission(array(
                'type'=>'anyone',
                'role'=>'reader'
                ));

            $service->permissions->create($resultat_pujada['id'], $newPermission);
            
            
            print_r($obra);
            unlink($target_path);
            
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