<?php
include('include/header.php');
?>
<div class="register-page pr-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Movimiento</li>
        <li class="breadcrumb-item active">Mostrar Movimiento</li>
    </ol>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table"></i> Saldo Fondo</div>
                            <div class="card-body">
                                <div id="page-wrapper">
        
                                    <!-- /.row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-auto">
                                                                <div id="montoIngresos" class="text-center saldo-movimiento text-success"></div>
                                                                <div class="text-center text-success">Ingresos</div>
                                                        </div>
                                                        <div class="col-auto">
                                                                <div id="montoEgresos" class="text-center saldo-movimiento text-danger"></div>
                                                                <div class="text-center text-danger">Egresos</div>
                                                        </div>
                                                        <div class="col-auto">
                                                                <div id="saldoMovimiento" class="text-center saldo-movimiento text-primary"></div>
                                                                <div class="text-center text-primary">Saldo</div>
                                                        </div>
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

        <div class="row">
            <!--tabla -->
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Movimientos</div>
                    <div class="card-body">
                    <table id="tableMov" class="display responsive nowrap table-condensed" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Folio</th>
                                                                <th>Tipo</th>
                                                                <th>Categoria</th>
                                                                <th>Nombre</th>
                                                                <th>Desc</th>
                                                                <th>Monto</th>
                                                                <th>Fecha</th>
                                                                <!-- <th>Por</th> -->
                                                                <!-- <th>Acción</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Folio</th>
                                                                <th>Tipo</th>
                                                                <th>Categoria</th>
                                                                <th>Nombre</th>
                                                                <th>Desc</th>
                                                                <th>Monto</th>
                                                                <th>Fecha</th>
                                                                <!-- <th>Por</th> -->
                                                                <!-- <th>Acción</th> -->
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                    </div>
                </div>
            </div>
        </div>

</div>

<?php
include('include/footer.php');
?>