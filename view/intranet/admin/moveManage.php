<?php
include('include/header.php');
?>
<div class="register-page pr-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Movimiento</li>
        <li class="breadcrumb-item active">Administrar</li>
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
    <div id="mov" class="row">
        <!--tabla -->
        <div class="col-lg-12">
                <div class="card mb-3">
                    <div id="headerMov" class="card-header">
                        <i class="fas fa-table"></i>
                        Movimientos<!-- <div class="float-right">
                                        <button id="btnEditar" class="btn btn-success btn-sm mr-1" disabled><i class="fas fa-pen-alt"></i></button>
                                        <button id="btnEliminar" class="btn btn-danger btn-sm" disabled><i class="fas fa-trash-alt"></i></button>
                                   </div> --></div>
                    <div class="card-body">
                            <div class="container p-0 m-0">
                                    <div id="alertMov"></div>
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
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
                                                                <th>Por</th>
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
                                                                <th>Por</th>
                                                                <!-- <th>Acción</th> -->
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                    </div>
                                    <div class="col-md-12 h-100  align-self-center">
                                            <div class="row">
                                                <div id="movSelect" class="col-12 text-center">
                                                        Seleccione un movimiento.
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 text-center">
                                                    <button id="btnEditar" class="btn btn-warning mr-1" disabled><i class="fas fa-pen-alt"></i></button>
                                                    <button id="btnEliminar" class="btn btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                </div>
        </div>
    </div>

</div>

<?php
include('include/footer.php');
?>