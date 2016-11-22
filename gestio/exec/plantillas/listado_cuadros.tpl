<div class="cos">
     <script type="text/javascript" src="../exec/js/jquery.contextmenu.r2.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('.listado_##tabla##').contextMenu('myMenu_##tabla##', {   
            bindings: {   
              'editar': function(t) {    
                var id = t.id.split("-")
                principal.irA('portada.php','titul=##titul##&tabla=##tabla##&accion=editar&div_retorno=##div_retorno##&id='+id[1],'##div_retorno##')     
              },    
              'borrar': function(t) {
                var id = t.id.split("-")
                utilidades.mostrarDialogBorrar('','##tabla##','##tabla##','','','');
                principal.borrar=id[1];  
              }   
              ##codi_afegir_contextual##
            }
          });
        });   
      </script>
    <!--! INI titul --> 
    <div class="div_titul_seccio">
        <label class="eti_titul_seccio">Llistat de ##tabla##</label>
    </div>
    <!--! FIN titul --> 
    <!--! INI boto_nou --> 
    <div class="div_boto_nou">
        <input type="button" value="new" onclick="javascript:principal.irA('portada.php','tabla=##tabla##&accion=nuevo&id_level='+$('#id_level').val()+'&id_grouping='+$('#id_grouping').val()+'&titul=##titul##&div_retorno=##div_retorno##&##parametre_afegit##','##div_retorno##')"/>
    </div>
    <!--! FIN boto_nou --> 
    <div class="llistat_vinyetes">
        ##ini_insercio##
            <div class="listado_vinyetes listado_##tabla##" id="celda-##id##" >
                <div class="imatge_vinyeta" style="background-image:url(../img/botones/##imatge##);">
                    
                </div>
                <span>##name##</span>
            </div>
        ##fi_insercio##
    </div>
    <div class="contextMenu" id="myMenu_##tabla##" style="display:none;">
    <ul style="text-align:left;">
        <!--! INI menu_contextual_admin -->
        <li id="editar"><img src="../img/botones/lapiz.png" /> Edit</li>
        <li id="borrar"><img src="../img/botones/borrar.png" /> Delete</li>
        <!--! FIN menu_contextual_admin -->
        ##boto_afegir_contextual##
    </ul>
  </div>
</div>