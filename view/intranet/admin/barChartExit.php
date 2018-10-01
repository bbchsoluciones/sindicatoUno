<?php
include('include/header.php');
?>
<div class="register-page">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Movimiento</li>
        <li class="breadcrumb-item active">Gráfico Egreso</li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Egresos</div>
                <div class="card-body">
                    <div id="page-wrapper">

                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                            <div class="row">
                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Categoria Egreso</label>
                                                                <select id="categoriaTM" name="categoriaTM" class="form-control" onchange="graficoEgreso($('#categoriaTM option:selected').val(),$('#anioIngreso option:selected').val())">
                                                                    <option selected value="0">TODOS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Año</label>
                                                        <select id="anioIngreso" name="anioIngreso" class="form-control" onchange="graficoEgreso($('#categoriaTM option:selected').val(),$('#anioIngreso option:selected').val())">
                                                            <option selected value="2018">2018</option>
                                                        </select>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div id="contenedorGraficoEgreso" class="col-12 chart-container">                                                
                                                </div>
                                            </div>                                            
                                            <div id="contenedorBotonesEgreso" class="row">                                                                                                   
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
                <!-- /#page-wrapper -->
            </div>
        </div>






    </div>

    

    
    
</div>
<?php
include('include/footer.php');
?>