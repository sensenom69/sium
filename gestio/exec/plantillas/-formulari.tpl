<div class="cos" >
    <!--! INI titul --> 
    <div class="div_titul_seccio">
        <label class="eti_titul_seccio">Editar ##tabla##</label> 
    </div>
    <!--! FIN titul --> 
    <form id="formulari" class="formulario" method="POST"  action="" target="procesador_formularios" enctype="multipart/form-data" >
        <input id="id" name="id" value="##id##" style="display:none;"/>
        <input id="tabla" name="tabla" value="##tabla##" style="display:none;"/>
        <input id="accion" name="accion" value="add" style="display:none;"/>
        ##camp_amagat##
        <!--$ INI camp_amagat -->
        <input id="##nom##" name="##nom##" value="##id##" style="display:none;"/>
        <!--$ FIN camp_amagat -->
        
        <!--$ INI prova -->
            
            <input type="text" value="##proveta##"/>
        <!--$ FIN prova -->
        <table>
        <!--$ INI camp -->
            <tr>
                <td><label>##nom_mostrar##</label></td>
                <td style="text-align:left;">##input##</td>
            </tr>
        <!--$ FIN camp -->
            <tr>
                <td colspan="2">
                    <input class="btn" type="button" style="margin-right:20px;" name="nuevo_trabajo" id="nuevo_trabajo" value="Ok" onclick="javascript:principal.aceptarFormularioDatos('index.php?/##tabla##/##accion_ok##/##id##/'+$('#id_evento').val(),'formulari','cos','index.php?/##tabla##/listado/0/'+$('#id_evento').val(),'','')"/>
                    <input class="btn" type="button" name="nuevo_trabajo" id="nuevo_trabajo" value="##cancelar##" onclick="javascript:window.location.replace('index.php?/##tabla##/listado/0/'+$('#id_evento').val()+'/##desde##/##hasta##')"/>
                </td>
            </tr>
        </table>
    </form> 
</div>