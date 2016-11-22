<div id="cos" class="cos" style="margin: 0 auto;">
     <script type="text/javascript" src="../exec/js/jquery.contextmenu.r2.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('td.listado_cliente').contextMenu('myMenu_cliente', {   
            bindings: {   
              'editar': function(t) {    
                var id = t.id.split("-")
                window.location.href = 'index.php?/cliente/editar/'+id[1]+'/'+$('#id_evento').val()+'/busqueda='+$('#search_nom').val()+'/desde='+(##pagina##)+'/id_usuario='+$('#id_usuario').val();
                //principal.irA('index.php?/cliente/editar/'+id[1],'titul=##titul##&tabla=cliente&accion=editar&busqueda='+$("#search_nom").val()+'&div_retorno=##div_retorno##&id='+id[1],'##div_retorno##')     
              },    
              'borrar': function(t) {
                var id = t.id.split("-");
                principal.borrar=id[1];  
                $('#modal_borrar').modal('show');
                //window.location.href = 'index.php?/cliente/listado';
                //utilidades.mostrarDialogBorrar('','cliente','cliente','','','');
              }   
              ##codi_afegir_contextual##
            }
          });
        });   
      </script>
    <!--<div class="div_titul_seccio">
        <label class="eti_titul_seccio">Listado de clientes</label>
    </div>-->
    <div class="contenedor_boto_nou" style="width:50px;position:relative; z-index:20;top:-26px;float:right;right:200px;" >
        <a onclick="javascript:window.location.href = 'index.php?/cliente/nuevo'"><img src="img/nuevo.png"/></a>
    </div>
    <div style="background:#7986cb;height:40px;">
        <div id="barra_filtros">
            <div id="busqueda_nom" style="margin-left: 16px;width:250px;display:inline-block;">
                <!--<input id="search_nom" value="##busqueda##" type="text" onkeyup="javascript:setTimeout('principal.busquedacliente($(\'#search_nom\').val())',1000); " name="search_nom" style="height:18px;">-->
                <input id="search_nom" value="##busqueda##" type="text" name="search_nom" style="height:18px;">
                <a onclick="principal.busquedacliente($('#search_nom').val()); ">
                    <i class="icon-search" style="margin-top:0px;" ></i>
                </a>
            </div>
            <div id="busqueda_alfabetic" style="margin-left: 16px;display:inline-block;">
                <a onclick="principal.busquedacliente(''); " class="lletra_alfabeto">Tots</a>
                <!--$ INI lletra_alfabeto -->
                <a onclick="principal.busquedacliente('##lletra##',true); " class="lletra_alfabeto">##lletra##</a>
                <!--$ FIN lletra_alfabeto -->
            </div>
        </div>
    </div>
    
    <div style="clear:both;"></div>
    <div style="padding: 50px;">
        <!--$ INI cliente -->
          <div style="width:350px;height:100px;background:#ffffff;padding: 20px; margin:0px 0px 25px 25px;display: inline-block">
            <img style="width: 70px;border-radius: 50%;margin: 10px;float:left;" src="img/avatars/avatar-01.svg"/>
            <h4>##apellidos##, ##nombre##</h4>
            <span>Mov: ##movil##</span>
            <span>&nbsp;</span>
            <span>Fij: ##telefono##</span>
            <div style="clear:both;"></div>
            <div class="ferramentes_editar_tarjeta" style="float:right;">
                <a href="#" style="margin-right:5px;" onclick="javascript:window.location.href = 'index.php?/hoja_trabajo/listado/0/busqueda='+$('#search_nom').val()+'/id_cliente=##id##';"><i class="icon-folder-open"></i></a>
                <a href="#" style="margin-right:5px;" onclick="javascript:window.location.href = 'index.php?/vehiculo/listado/0/busqueda='+$('#search_nom').val()+'/id_cliente=##id##';"><i class="icon-eye-open"></i></a>
                <a href="#" style="margin-right:5px;" onclick="javascript:window.location.href = 'index.php?/cliente/editar/##id##/busqueda='+$('#search_nom').val()+'/desde='+(##pagina##)+'/id_usuario='+$('#id_usuario').val();"><i class="icon-edit"></i></a>
                <a href="#" onclick="javascript:principal.borrar=##id##;$('#modal_borrar').modal('show');"><i class="icon-remove-circle"></i></a>
            </div>
          </div>
        <!--$ FIN cliente -->  
    </div>
    <table style="width:1000px;margin: 0 auto;" class="table table-striped table-hover table-condensed listado" summary="Llistat de dades de cliente" cellspacing="0">
      
      
      <tfoot>
        <tr >
            <td  colspan="20" >
                <div style="margin:5px 0 0 460px;">
                    <a style="float:left;margin-right:10px;" href="#" onclick='javascript:principal.irASincrono("secciones/cliente/listado.php","id_evento="+$("#id_evento").val()+"&id=0&desde=##desde_arrere##&hasta=##hasta_arrere##&busqueda="+$("#search_nom").val()+"&id_usuario="+$("#id_usuario").val(),"cos");principal.desde=##desde_arrere##;'>
                        <i class="icon-arrow-left"></i>
                    </a>
                    <label style="float:left;" id="num_pag">##num_pag##</label>
                    <label style="float:left;" >&nbsp;/&nbsp;</label>
                    <label style="float:left;margin-right:10px;" id="##total_pagines##">##total_pagines##</label>
                    &nbsp;&nbsp;
                    <a style="float:left;" href="#" ##proxima_pagina##='javascript:principal.irASincrono("secciones/cliente/listado.php","id_evento="+$("#id_evento").val()+"&id=0&desde=##desde_avant##&hasta=##hasta_avant##&busqueda="+$("#search_nom").val()+"&id_usuario="+$("#id_usuario").val(),"cos");principal.desde=##desde_avant##;'>
                        <i class="icon-arrow-right"></i>
                    </a> 
                </div>
            </td>
        </tr>
      </tfoot>
    </table> 
    <div class="contextMenu" id="myMenu_cliente" style="display:none;">
        <ul style="text-align:left;">
            <!--! INI menu_contextual_admin --> 
            <!--! FIN menu_contextual_admin -->
            <li id="editar"><i class="icon-edit"></i> Editar</li>
            <li id="borrar"><i class="icon-remove-circle"></i> Borrar</li>
            ##boto_afegir_contextual##
        </ul>
    </div>
    <div id="modal_borrar" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Atencio</h3>
        </div>
        <div class="modal-body">
            <p>Desea borrar?</p>
        </div>
        <div class="modal-footer">
            <a href="#" onclick="javascript:$('#modal_borrar').modal('hide');" class="btn">No</a>
            <a href="#" onclick="javascript:$('#modal_borrar').modal('hide');window.location.href = 'index.php?/cliente/borrar/'+principal.borrar+'/##id_evento##/busqueda='+$('#search_nom').val()+'/desde=##hasta_arrere##/id_usuario='+$('#id_usuario').val()"  class="btn btn-primary">Si</a>
        </div>
    </div>