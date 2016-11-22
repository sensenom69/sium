<div id="cos" class="cos" style="margin: 0 auto;">
     <script type="text/javascript" src="../exec/js/jquery.contextmenu.r2.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('td.listado_##tabla##').contextMenu('myMenu_##tabla##', {   
            bindings: {   
              'editar': function(t) {    
                var id = t.id.split("-")
                window.location.href = 'index.php?/##tabla##/editar/'+id[1]+'/##id_evento##/busqueda='+$('#search_nom').val()+'/desde=##hasta_arrere##';
                //principal.irA('index.php?/##tabla##/editar/'+id[1],'titul=##titul##&tabla=##tabla##&accion=editar&busqueda='+$("#search_nom").val()+'&div_retorno=##div_retorno##&id='+id[1],'##div_retorno##')     
              },    
              'borrar': function(t) {
                var id = t.id.split("-");
                principal.borrar=id[1];  
                $('#modal_borrar').modal('show');
                //window.location.href = 'index.php?/##tabla##/listado';
                //utilidades.mostrarDialogBorrar('','##tabla##','##tabla##','','','');
              }   
              ##codi_afegir_contextual##
            }
          });
        });   
      </script>
    <!--! INI titul --> 
    <div class="div_titul_seccio">
        <label style="padding:20px;" class="eti_titul_seccio">Listado de ##tabla##</label>
    </div>
    <!--! FIN titul --> 
    <!--! INI buscador -->
    <div id="busqueda_nom" style="float: left; margin-left: 25px;">
        <input id="search_nom" value="##busqueda##" type="text" onkeyup="javascript:setTimeout('principal.busquedainvitado($(\'#search_nom\').val())',1000); " name="search_nom" style="height:12px;">
        <a href="#">
            <i class="icon-search" style="margin-top:-10px;"></i>
        </a>
    </div>
    <div id="contenedor_cantidad">
        <span><b>n&uacute;mero de ##tabla##:</b> ##cantidad##</span>
    </div> 
    <!--! FIN buscador -->
    <table style="width:1000px;margin: 0 auto;" class="table table-striped table-hover table-condensed listado" summary="Llistat de dades de ##tabla##" cellspacing="0">
      <thead>
        <!--$ INI camp -->
        <th  scope="col" >##nom_mostrar##</th>  
        <!--$ FIN camp -->             

      </thead>
      ##ini_insercio##
      <tr class="##odd## listado_##tabla##">
        <!--$ INI camp_replenar -->
        ##linea## 
        <!--$ FIN camp_replenar -->  
      </tr>
      ##fi_insercio##
      <tfoot>
        <tr style="text-align:center;">
            <td colspan="20" >
                <div style="margin:5px 0 0 460px;">
                    <a style="float:left;margin-right:10px;" href="#" onclick='javascript:principal.irASincrono("secciones/invitado/listado.php","id_evento="+$("#id_evento").val()+"&id=0&desde=##desde_arrere##&hasta=##hasta_arrere##&busqueda="+$("#search_nom").val(),"cos");principal.desde=##desde_arrere##;'>
                        <i class="icon-arrow-left"></i>
                    </a>
                    <label style="float:left;" id="num_pag">##num_pag##</label>
                    <label style="float:left;" >&nbsp;/&nbsp;</label>
                    <label style="float:left;margin-right:10px;" id="##total_pagines##">##total_pagines##</label>
                    &nbsp;&nbsp;
                    <a style="float:left;" href="#" ##proxima_pagina##='javascript:principal.irASincrono("secciones/invitado/listado.php","id_evento="+$("#id_evento").val()+"&id=0&desde=##desde_avant##&hasta=##hasta_avant##&busqueda="+$("#search_nom").val(),"cos");principal.desde=##desde_avant##;'>
                        <i class="icon-arrow-right"></i>
                    </a> 
                </div>
            </td>
        </tr>
      </tfoot>
    </table> 
    <div class="contextMenu" id="myMenu_##tabla##" style="display:none;">
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
            <h3>Atenci&oacute;n</h3>
        </div>
        <div class="modal-body">
            <p>Desea borrar?</p>
        </div>
        <div class="modal-footer">
            <a href="#" onclick="javascript:$('#modal_borrar').modal('hide');" class="btn">No</a>
            <a href="#" onclick="javascript:$('#modal_borrar').modal('hide');window.location.href = 'index.php?/##tabla##/borrar/'+principal.borrar+'/##id_evento##/busqueda='+$('#search_nom').val()+'/desde=##hasta_arrere##'"  class="btn btn-primary">Si</a>
        </div>
    </div>
</div>