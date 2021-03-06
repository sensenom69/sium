<!doctype html>
<html lang="en" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIUM Tavernes - login</title>

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="images/touch/chrome-touch-icon-192x192.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Material Design Lite">
  <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
  <meta name="msapplication-TileColor" content="#3372DF">

  <link rel="canonical" href="">

  <link href='//fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/material.min.css">
  <link rel="stylesheet" href="css/helpers.css">
  <link rel="stylesheet" href="css/login.css">

  <style type="text/css">
    li{
    font-size: 0.8em;
    margin-bottom: 10px;
    padding: 10px;
}
li span{
    font-weight: bold;
    display: block;
    font-size: 1.2em;
}
aside{
    width: 200px;
    float: right;
    padding: 20px;
    display: table-cell;
}
aside h2{
    margin-bottom: 3px;
}
section{
    display: table-cell;
}
li.even{
    background-color: #d5d5d5;
}
li.odd{
    background-color: #d5d5ff;   
}
.error {
  border: 1px solid;
  margin: 10px 10px;
  padding:15px 10px 15px 40px;
  background-repeat: no-repeat;
  background-position: 10px center;
  color: #D8000C;
  background-color: #FFBABA;
background-image: url('error.png');
}
  </style>

</head>
<body>
<div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
  <div class="demo-ribbon mdl-color--accent"></div>
  <main class="demo-main mdl-layout__content">
    <h2 class="t-center mdl-color-text--white text-shadow">SIUM Tavernes de la Valldigna</h2>
    <a id="top"></a>
    <div ng-app="apiApp" ng-controller="apiAppCtrl as vm" class="demo-container mdl-grid">
      <div class="mdl-cell mdl-cell--4-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
      <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet">

        <div class="mdl-card__title ">
          <h2 class="mdl-card__title-text">
            <i class="material-icons mdl-color-text--grey m-r-5 lh-13">account_circle</i>
            Login
          </h2>
        </div>
        <div ng-show="vm.mostrar" class="error">{{vm.error}}</div>
        <div  class="p-l-20 p-r-20 p-b-20">
          <form action="#">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
              <input ng-model="vm.email" class="mdl-textfield__input" type="text" id="email" pattern="^\s*[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-_]+\.[a-zA-Z]{2,4}\s*$"/>
              <label class="mdl-textfield__label" name="email_label" for="email">Email</label>
              <span class="mdl-textfield__error">Per favor dona un email valid.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
              <input ng-model="vm.pass" class="mdl-textfield__input" type="password" id="pass" />
              <label class="mdl-textfield__label" for="pass">Password</label>
            </div>

            <div class="m-t-20">
            <button type="button" ng-click="vm.autentificar()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect mdl-color--light-blue">
              Login
            </button>
            <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect">
              Cancel
            </button>
            </div>
                
          </form>
        </div>
          
      </div>
    </div>
  </main>
</div>

<script src="js/material.min.js"></script>
<script src="js/angular.js" type="text/javascript"></script>
<script type="text/javascript">
 angular
    .module('apiApp', [])
    .controller('apiAppCtrl', controladorPrincipal);

function controladorPrincipal($scope, $http){
    var vm=this;
    vm.mostrar = false;
    var url = "exec/ajax/autentificar.php";
    vm.autentificar = function(){
      $http.post(url, {email: vm.email, pass: vm.pass})
      .then(function(resposta){
        console.log("res:", resposta);
        switch(resposta.data){
          case "-1": 
            vm.error = "Pass no correcte";
            vm.mostrar = true;
          break;
          case "0": 
            vm.error = "Usuari no existeix";
            vm.mostrar = true;
          break;
          default: window.location.href = "index.php";
        }
      });
      

    }
}
</script>
</body>
</html>
