<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="margin-top:10px;">
            <div class="panel-heading">
                Nueva peticion
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" id="formulari" class="formulario" method="POST"  action="" target="procesador_formularios" enctype="multipart/form-data" >
                            <input id="id-familiar" name="id-familiar" value="-1" style="display:none;"/>
                            <input id="tabla-familiar" name="tabla-familiar" value="peticion" style="display:none;"/>
                            <input id="accion" name="accion" value="add" style="display:none;"/>
                            <input id="id_usuario-familiar" name="id_usuario-familiar" value="5" style="display:none;"/>
                             <h3>Familiar</h3>
                            <div class="form-group nombre">
                                <label>nombre</label>
                                <input class="form-control" id="nombre-familiar" name="nombre-familiar" value="" type="text" />
                            </div><div class="form-group apellidos">
                                <label>apellidos</label>
                                <input class="form-control" id="apellidos-familiar" name="apellidos-familiar" value="" type="text" />
                            </div><div class="form-group provincia">
                                <label>provincia</label>
                                <input class="form-control" id="provincia-familiar" name="provincia-familiar" value="" type="text" />
                            </div><div class="form-group poblacion">
                                <label>poblacion</label>
                                <select class="form-control" id="id_poblacio-familiarn" name="id_poblacion-familiar" >
                                <option value="0">-</option>
                                 <!--$ INI id_poblacion -->
                                <option value="##id##">##nombre##</option>
                                <!--$ FIN id_poblacion -->
                                </select>
                            </div><div class="form-group fecha">
                                <label>fecha</label>
                                <input class="form-control" id="fecha-familiar" name="fecha-familiar" value="" type="text" />
                            </div>
                            <div class="form-group medio">
                                <label>medio</label>
                                <select class="form-control" id="id_medio-familiar" name="id_medio-familiar" >
                                    <option value="0">-</option>
                                    <!--$ INI id_medio -->
                                    <option value="##id##">##nombre##</option>
                                    <!--$ FIN id_medio -->
                                </select>
                            </div>
                            <div class="form-group estado">
                                <label>estado</label>
                                <input class="form-control" id="estado-familiar" name="estado-familiar" value="" type="text" />
                            </div><div class="form-group observaciones">
                                <label>observaciones</label>
                                <textarea  class="form-control"  id="observaciones-familiar" name="observaciones-familiar"></textarea>
                            </div>
                        
                        <!---------------------------------------------------------------------------------------->
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    <div class="col-lg-6">
                        <h3>Interno</h3>
                            <input id="id-interno" name="id-interno" value="-1" style="display:none;"/>
                            <input id="tabla-interno" name="tabla-interno" value="interno" style="display:none;"/>
                            <input id="accion-interno" name="accion-interno" value="add" style="display:none;"/>  
                            <div class="form-group nombre">
                                <label>nombre</label>
                                <input class="form-control" id="nombre-interno" name="nombre-interno" value="" type="text" />
                            </div><div class="form-group apellidos">
                                <label>apellidos</label>
                                <input class="form-control" id="apellidos-interno" name="apellidos-interno" value="" type="text" />
                            </div><div class="form-group provincia">
                                <label>provincia</label>
                                <select class="form-control" id="id_provincia-interno" name="id_provincia-interno" >
                                <option value="0">-</option>
                                 <!--$ INI id_provincia -->
                                <option value="##id##">##nombre##</option>
                                <!--$ FIN id_provincia -->
                                </select>
                            </div><div class="form-group poblacion">
                                <label>poblacion</label>
                                <select class="form-control" id="id_poblacion-interno" name="id_poblacion-interno" >
                                <option value="0">-</option>
                                 <!--$ INI id_poblacion -->
                                <option value="##id##">##nombre##</option>
                                <!--$ FIN id_poblacion -->
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline btn-success" onclick="javascript:principal.aceptarFormularioDatos('index.php?/##tabla##/add/-1/','formulari','cos','index.php?/peticion/listado/0/','','')">Aceptar</button>
                            <button type="reset" class="btn btn-outline btn-danger" onclick="javascript:window.location.replace('index.php?/peticion/listado')">Cancelar</button>
                            
                        <h3>Alertas</h3>
                            <div  class="form-group alerta">
                                <select id="id_alerta" name="id_alerta">
                                    <option class="form-control" value="0">-</option>
                                    <option class="form-control" value="1">Avisame por correo</option>
                                    <option class="form-control" value="2">Avisame por notificaci&oacute;n</option>
                                    <!--$ INI alarma -->
                                    <option value="##id##">##nombre##</option>
                                    <!--$ FIN alarma -->
                                </select>
                                <label> dentro de </label>
                                <select id="id_tiempo" name="id_tiempo">
                                    <option class="form-control" value="0">-</option>
                                    <option class="form-control" value="1">12 horas</option>
                                    <option class="form-control" value="2">24 horas</option>
                                    <option class="form-control" value="2">48 horas</option>
                                    <!--$ INI alerta -->
                                    <option value="##id##">##nombre##</option>
                                    <!--$ FIN alerta -->
                                </select>
                            </div>
                            <div class="form-group recuerdo">
                                <label>Texto</label>
                                <textarea  class="form-control"  id="recuerdo-alerta" name="recuerdo-alerta"></textarea>
                            </div>
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
