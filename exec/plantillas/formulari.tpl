<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="margin-top:10px;">
            <div class="panel-heading">
                Nuevo ##tabla##
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" id="formulari" class="formulario" method="POST"  action="" target="procesador_formularios" enctype="multipart/form-data" >
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
                            <!--$ INI camp -->
                            <div class="form-group ##nom_mostrar##">
                                <label>##nom_mostrar##</label>
                                ##input##
                            </div>
                            <!--$ FIN camp -->
                            <button type="submit" class="btn btn-outline btn-success" onclick="javascript:principal.aceptarFormularioDatos('index.php?/##tabla##/##accion_ok##/##id##/','formulari','cos','index.php?/##tabla##/listado/0/','','')">Aceptar</button>
                            <button type="reset" class="btn btn-outline btn-danger" onclick="javascript:window.location.replace('index.php?/##tabla##/listado/0/##desde##/##hasta##')">Cancelar</button>
                        </form> 
                        <!---------------------------------------------------------------------------------------->
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>