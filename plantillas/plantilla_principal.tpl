<!DOCTYPE html>
<html lang="en" ng-app="material-lite">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Material Lite Angular Admin Theme">
  <meta name="author" content="Theme Guys - The Netherlands">

  <title>SIUM</title>

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


  <!-- IE Compatibility shims -->
  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js""></script>
  <![endif]-->
  <!--[if IE]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/es5-shim/4.1.7/es5-shim.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/classlist/2014.01.31/classList.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/flexie/1.0.3/flexie.min.js"></script>
  <![endif]-->
  <!-- end shims -->

</head>

<body ng-controller="MainController">
  <div id="app" class="app" ng-include="'plantillas/app.html'"></div>

 
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

  <script charset="utf-8" src="js/demo/directives/dynamic-color.js"></script>
  <script charset="utf-8" src="js/demo/directives/header.js"></script>
  <script charset="utf-8" src="js/demo/directives/sidebar.js"></script>

  <script charset="utf-8" src="js/modules/chat.js"></script>
  <script charset="utf-8" src="js/modules/menu.js"></script>
  <script charset="utf-8" src="js/modules/svg-map.js"></script>
  <script charset="utf-8" src="js/modules/todo.js"></script>

  <script charset="utf-8" src="js/directives/sticky.js"></script>
  <!-- endbuild -->
  <!--<script src="//localhost:35729/livereload.js"></script>--><!--@grep demo--><!--@grep release-->
</body>

</html>
