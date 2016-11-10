<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
<head>
<title>Taller</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href='http://fonts.googleapis.com/css?family=Roboto|Quicksand' rel='stylesheet'>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link type="text/css" href="bootstrap/css/bootstrap.css" rel="Stylesheet" />
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.css" rel="Stylesheet" />
    <!--<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />-->
    <link type="text/css" href="css/style.css" rel="Stylesheet" />
    <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
   <!-- <script src="js/jcanvas.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/principal.js"></script>    
    <script type="text/javascript" src="js/validaFormularios.js"></script>
    <!--<script type="text/javascript" src="js/jquery.rotate.js"></script>-->
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <!--<script type="text/javascript" src="js/jquery-ui-1.10.0.custom.min.js"></script>-->
    <!--<script type="text/javascript" src="js/jquery.contextmenu.r2.js"></script>-->
    <!--<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>-->
    
    <script type="text/javascript">
        $(document).ready(function() {
            //$('.enlace_menu').bind("click",function(){
            //   window.location = $(this).attr('href')+"/0/";
            //    return false;
            //});
        });
    </script>
</head>
<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner" id="barra_menu">
            <div style="width:1250px;margin:0 auto;">
                <ul class="nav" style="float:left;">
                    <li id="menu_interno" class="dropdown ##activa_interno##">
                        <a class="dropdown-toggle" data-toggle="dropdown">Internos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a class="enlace_menu" href="index.php?/interno/listado">Listado</a></li>
                          <li><a class="enlace_menu" href="index.php?/interno/nuevo">Nuevo</a></li>
                    
                        </ul>
                    </li>
                    <li id="menu_hoja_trabajo" class="dropdown ##activa_hoja_trabajo##">
                        <a class="dropdown-toggle" data-toggle="dropdown">Hojas de trabajo <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a class="enlace_menu" href="index.php?/hoja_trabajo/listado">Listado</a></li>
                          <li><a class="enlace_menu" href="index.php?/hoja_trabajo/nuevo">Nuevo</a></li>
                    
                        </ul>
                    </li>
                    <li id="menu_vehiculo" class="dropdown ##activa_vehiculo##">
                        <a class="dropdown-toggle" data-toggle="dropdown">Vehiculos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a class="enlace_menu" href="index.php?/vehiculo/listado">Listado</a></li>
                          <li><a class="enlace_menu" href="index.php?/vehiculo/nuevo">Nuevo</a></li>
                    
                        </ul>
                    </li>
                    <li id="menu_factura" class="dropdown ##activa_factura##">
                        <!--<a class="enlace_menu" href="index.php?/factura/listado">facturas</a>-->
                        <a class="dropdown-toggle" data-toggle="dropdown">Facturas <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a class="enlace_menu" href="index.php?/factura/listado">Listado</a></li>
                          <li><a class="enlace_menu" href="index.php?/factura/nuevo">Nueva</a></li>
                        </ul>
                    </li>
                    <li id="menu_gasto" class="dropdown ##activa_gasto##">
                        <!--<a class="enlace_menu" href="index.php?/gasto/listado">gastos</a>-->
                        <a  class="dropdown-toggle" data-toggle="dropdown">Gastos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a class="enlace_menu" href="index.php?/gasto/listado">Listado</a></li>
                          <li><a class="enlace_menu" href="index.php?/gasto/nuevo">Nuevo</a></li>
                        </ul>
                    </li>
                    <li id="menu_servicio" class="dropdown ##activa_servicio##">
                        <!--<a class="enlace_menu" href="index.php?/servicio/listado">servicios</a>-->
                        <a class="dropdown-toggle" data-toggle="dropdown">Servicios <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a class="enlace_menu" href="index.php?/servicio/listado">Listado</a></li>
                          <li><a class="enlace_menu" href="index.php?/servicio/nuevo">Nuevo</a></li>
                        </ul>
                    </li>
                    
                    <!--! INI gestion_eventos -->
                    <li id="menu_evento" class="dropdown ##activa_evento##">
                        <a class="dropdown-toggle" data-toggle="dropdown">Eventos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a class="enlace_menu" href="index.php?/evento/listado">Listado</a></li>
                          <li><a class="enlace_menu" href="index.php?/evento/nuevo">Nuevo</a></li>
                        </ul>
                    </li>
                    <!--! FIN gestion_eventos -->
                </ul>
                <div style="float:left;margin:8px 0px 0px 115px;width:200px;">
                    <img src="img/logos/logo_web_blanc.png"/>
                </div>
                <div style="float:right;margin-top:5px;">
                    <h2 id="logo_wesat" style="">Wesat</h2>
                    <a style="" href="#" onclick="javascript:principal.salir();">
                        <i style="margin:10px 0 0 28px;" class="icon-off icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div id="contenedor_principal">
        ##contenido##
    </div>
    <!--pagina-->
</body>
</html> 