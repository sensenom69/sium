<?php
require_once("exec/comun.php");
if( $_SESSION['id_permis']>3)
    header('Location: http://sium.ideas2bits.com');
 session_start();
 if(!isset($_SESSION['id_obra_activa'])){
    $_SESSION['id_obra_activa']=0;
 }
 if(isset($_GET['id_particella'])){
  $_SESSION['id_particella'] = $_GET['id_particella'];
 }
 elseif(!isset($_SESSION['id_particella'])){
  $_SESSION['id_particella'] = -1;
 }
 if(isset($_GET['id_instrument_activa'])){
    $_SESSION['id_instrument_activa'] = $_GET['id_instrument_activa'];
 }
 if(isset($_GET['nom_particella'])){
    $_SESSION['nom_particella'] = $_GET['nom_particella'];
 }
    require_once 'google-api-php-client/vendor/autoload.php';
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $client = new Google_Client();
    // Get your credentials from the console
    $client->setClientId('310652789266-c2ljs8he2omfsloo86cmc4bkglcvm2k6.apps.googleusercontent.com');
    $client->setClientSecret('97wWaiA26zIMVE9l44q6L-Nk');
    $client->setRedirectUri('http://www.sium.ideas2bits.com/gestio2/particella.php');
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
      $obra = new Modelo("obra", array("id"=>$_SESSION['id_obra_activa']));
      $obra->carga();
    if($_SESSION['id_particella']>0){
      $particella = new Modelo("particella");
      $particella->cargaRelacionConDatos("particella","id","ASC"," `particella`.`id`=".$_SESSION['id_particella']." ");
    }
    ?>
        <script type="text/javascript">
                var id_instrument_activa = "<?PHP print $particella->cargas['particella'][$_SESSION['id_particella']]->datos['id_instrument']?>";
                var nom = "<?PHP print $particella->cargas['particella'][$_SESSION['id_particella']]->datos['instrument']?>"
         
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
               
                var url = "particella.php?editar=true&id_instrument_activa="+id_instrument_activa+"&nom_particella="+nom;
                var archivoSeleccionado = document.getElementById("myfile");
                var file = archivoSeleccionado.files[0];
                if(file){
                  var fd = new FormData();
                  fd.append("archivo", file);
                }
                
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

            function canviatInstrument(id){
                id_instrument_activa = id;
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

        <!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en" ng-app="material-lite">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>SIUM particelles</title>

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
                    <h2 class="mdl-card__title-text"><b>Pujar particelles obra <?PHP print $obra->get("nom");?></b></h2>
                  </div>
                  <div class="p-30" >
                    <form name="formulari" ng-class="nou_item.clase" novalidate>
                      <div ng-controller="SelectInstrument" ng-change="canviarInstrument($parent.nou_item.instrument)" ng-model="$parent.nou_item.instrument" ng-required="true" ng-class="nou_item.clase">
                        <ui-select   id="select_instrument" name="select_instrument" scope="" onload="" theme="select2" ng-disabled="disabled" title="Tria un instrument" search-enabled="true" >
                          <ui-select-match placeholder="Selecciona un instrument">{{$parent.nou_item.instrument.nom}}</ui-select-match>
                          <ui-select-choices repeat="item in instrument | filter: $select.search">
                            <div ng-bind-html="instrument_select.nom | highlight: $select.search"></div>
                            <small>
                              {{item.nom}}
                            </small>
                          </ui-select-choices>
                        </ui-select>
                      </div>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" ng-class="nou_item.clase">
                        <input ng-blur="canviNom(nou_item.nom)" ng-model="nou_item.nom" class="mdl-textfield__input" type="text" pattern="[a-z0-9A-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" id="nom" ng-required="true"/>
                        <label class="mdl-textfield__label" for="nom">Nom</label>
                        <span class="mdl-textfield__error">Per favor introduix un nom vàlid.</span>
                      </div>
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
                        <button type="submit" onClick="uploadFile()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                          Guardar
                        </button>
                        <button ng-click="tornar()" type="reset" class="mdl-button mdl-js-button mdl-js-ripple-effect">
                          Eixir
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
<script type="text/javascript">
         (function() {
              'use strict';

              angular
                .module('material-lite')
                .controller('PujarParticheles', ['$scope', '$http', '$window', '$location','PlaceholderTextService', 'ngTableParams', '$filter','$mdDialog', PujarParticheles]);

              function PujarParticheles($scope, $http, $window, $location, PlaceholderTextService, ngTableParams, $filter,$mdDialog) {
                      
                      $scope.nou_item = [];
                      $scope.nou_item.instrument = [];
                      $scope.nou_item.nom = "<?PHP print $particella->cargas['particella'][$_SESSION['id_particella']]->datos['nom'];?>";
                      $scope.nou_item.instrument.nom = "<?PHP print $particella->cargas['particella'][$_SESSION['id_particella']]->datos['instrument'];?>";
                      id_instrument_activa = '<?PHP print $_SESSION['id_instrument_activa']?>';
                       $scope.canviarInstrument = function(){
                            id_instrument_activa = $scope.nou_item.instrument.id;
                        }
                        $scope.canviNom = function(){
                            nom = $scope.nou_item.nom;
                        }
                         $scope.tornar = function(){
                            $window.location.href = "index.php#/obra/editar_particheles?id=<?php print $_SESSION['id_obra_activa'] ?>";
                        }
                
            }

        })();
    </script>
    
</html>
        <?php
        if(isset($_GET['editar'])){
           if(isset($_FILES['archivo']['name'])){
                $target_path = "uploads/";
                $target_path = $target_path . basename( $_FILES['archivo']['name']); 
                if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) 
                { echo "El archivo ". basename( $_FILES['archivo']['name']). " ha sido subido";
                }
                
                
                


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
                //$obra->set(array("partitura"=>"https://drive.google.com/open?id=".$resultat_pujada['id']));
                if($_SESSION['id_particella']<0){
                  $particella = new Modelo("particella", array("id"=>-1, "id_obra"=>$obra->get("id"), "id_instrument"=>$_SESSION['id_instrument_activa'], "nom"=>$_SESSION['nom_particella'], "enllas"=>"https://drive.google.com/open?id=".$resultat_pujada['id']));
                }
                else{
                    $particella = new Modelo("particella", array("id"=>$_SESSION['id_particella']));
                    $enllas = $particella->get("enllas");
                    $enllas = substr($enllas, 33);

                    $particella->set(array("id_instrument"=>$_SESSION['id_instrument_activa'], "nom"=>$_SESSION['nom_particella'], "enllas"=>"https://drive.google.com/open?id=".$resultat_pujada['id']));
                    $resultat_pujada = $service->files->delete($enllas);
                
                }
                unlink($target_path);
                $newPermission = new Google_Service_Drive_Permission(array(
                    'type'=>'anyone',
                    'role'=>'reader'
                    ));

                $service->permissions->create($resultat_pujada['id'], $newPermission);
                
                if($_SESSION['id_particella']>0){
                  $resultat_pujada = $service->files->delete($enllas);
                }
                
                
                
            }
            else {
              if($_SESSION['id_particella']<0){
                  $particella = new Modelo("particella", array("id"=>-1, "id_obra"=>$obra->get("id"), "id_instrument"=>$_SESSION['id_instrument_activa'], "nom"=>$_SESSION['nom_particella']));
                }
                else{
                    $particella = new Modelo("particella", array("id"=>$_SESSION['id_particella']));
                    $particella->set(array("id_instrument"=>$_SESSION['id_instrument_activa'], "nom"=>$_SESSION['nom_particella']));
                
                }
            }
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