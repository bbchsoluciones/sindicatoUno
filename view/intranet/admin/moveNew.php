<?php
    include('include/header.php');
    ?>
<div class="register-page pr-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Movimiento</li>
        <li class="breadcrumb-item active">Registrar Movimiento</li>
    </ol>


    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Registrar Movimiento</div>
                <div class="card-body">
                    <div id="page-wrapper">

                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <form id="formMovimiento" role="form" action="" onsubmit="insertMovimiento(<?php echo $_SESSION['run_trabajador']; ?>);
                                                return false">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Tipo</label>
                                                        <select id="tipo_movimiento" name="tipo_movimiento" class="form-control">
                                                            <option selected>Seleccionar una...
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Categoria</label>
                                                        <select id="categoriaTM" name="categoriaTM" class="form-control">
                                                            <option selected>Seleccionar una...
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <select id="nombreTM" name="nombreTM" class="form-control">
                                                            <option selected>Seleccionar una...
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Monto</label>
                                                        <input class="form-control" type="number" id="monto" name="monto" value="">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">

                                                    <div class="form-group">
                                                        <label for="inputSindicato">Fecha</label>
                                                        <input id="datepickerMov" name="fec_ing_sin_trabajador" class="dataUser" value="" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Descripción</label>
                                                        <input class="form-control" type="text" id="des_mov" name="des_mov" value="">
                                                    </div>
                                                </div>

                                                

                                                <div class="col-lg-6
                                                        align-self-end">

                                                    <div class="form-group">
                                                        <div class="input-group-btn">
                                                            <button type="submit" class="btn
                                                                    btn-success
                                                                    btn-block">Registrar
                                                                Movimiento
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>

                                        </form>

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