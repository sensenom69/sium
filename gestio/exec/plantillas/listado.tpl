<div class="row" >
    <div class="col-lg-12">
        <div class="panel panel-default" style="margin-top:10px;">
            <div class="panel-heading">
                Listado de ##tabla##
                <div style="float:right;">
                    <a href="index.php?/##tabla##/nuevo">
                        <button type="button" class="btn btn-primary btn-xs">Nuevo</button>
                    </a>
                    
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <!--$ INI camp -->
                                <th>##nom_mostrar##</th>  
                                <!--$ FIN camp --> 
                            </tr>
                        </thead>
                        <tbody>
                            ##ini_insercio##
                            <tr class="##odd## listado_##tabla##">
                                <!--$ INI camp_replenar -->
                                ##linea## 
                                <!--$ FIN camp_replenar -->  
                            </tr>
                            ##fi_insercio##
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->