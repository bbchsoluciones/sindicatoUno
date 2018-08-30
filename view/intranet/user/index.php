<?php
include('include/header.php');
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="index.php">Resumen</a>
    </li>
    <li class="breadcrumb-item active">Inicio</li>
</ol>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card mb-3">
            <div class="card-header">
                <i class="far fa-address-card"></i>
                Bienvenida</div>
            <div class="card-body">
                <div class="container m-0">
                    <div class="row">
                        <h1 id="saludoTra">Hola!</h1>
                    </div>
                    <div class="row">
                        <p class="text-justify mb-0">
                            Te damos la bienvenida a la nueva forma de transparentar nuestras acciones. El objetivo principal de esto es que todos los
                            integrantes del Sindicato N°1 de Brink´s se sientan informados.
                            <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Ver más
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <p class="mb-0">
                                Mantén tus datos actualizados en tu <strong><a href="" class="">perfil</a></strong> para
                                que podamos tener una mejor experiencia todos juntos. A continuación con el fin de hacer
                                valer nuestro objetivo principal te mostramos la siguiente información:
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
        <div class="card h-100">
            <div class="card-header bg-warning ">
                <i class="far fa-money-bill-alt"></i>
                Movimientos</div>
            <div class="card-body p-2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center text-dark font-weight-bold text-center">
                                <h4>Año 2018</h4>
                            </div>                            
                            <div class="row justify-content-center text-center">
                                <h3><a id="cantIngresos" class="text-success" href="barChartEntry.php">0 Ingresos</a></h3>
                            </div>
                            <div class="row justify-content-center text-danger text-center">
                                <h3><a id="cantEgresos" class="text-danger" href="barChartExit.php">0 Egresos</a></h3>
                            </div>
                            <div class="row justify-content-center text-primary text-center">
                                <h5 id="cantMov">0 Movimientos</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
        <div class="card h-100">
            <div class="card-header bg-success text-light">
                <i class="fas fa-balance-scale"></i>
                Saldo</div>
            <div class="card-body p-2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center text-dark font-weight-bold text-center">
                                <h4>Fondo</h4>
                            </div>
                            <div class="row justify-content-center text-center">
                                <h3><a id="saldoMovimiento" class="text-primary" href="moveManage.php">$0</a></h3>
                            </div>
                            <div class="row justify-content-center text-success text-center">
                                <h5 id="montoIngresos">$0</h5>
                            </div>
                            <div class="row justify-content-center text-danger text-center">
                                <h5 id="montoEgresos">$0</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
        <div class="card h-100">
            <div class="card-header bg-danger text-light">
                <i class="far fa-hand-paper"></i>
                Multas</div>
            <div class="card-body p-2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center text-dark font-weight-bold text-center">
                                <h4>Valores</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center text-danger font-weight-bold text-center">
                                <div>Inasistencia: $1400</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center text-danger font-weight-bold text-center">
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center text-danger font-weight-bold text-center">
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
        <div class="card h-100">
            <div class="card-header bg-info text-light">
                <i class="fas fa-info-circle"></i>
                Info</div>
            <div class="card-body p-2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center text-dark font-weight-bold text-center">
                                <h4>Próxima Reunión</h4>
                            </div>
                            <div class="row justify-content-center text-secondary text-center">
                                <h3>10/08/2018</h3>
                            </div>
                            <div class="row justify-content-center text-secondary text-center">
                                <div class="col-auto"><h5>07:30</h5></div>
                                <div class="col-auto"><h5>14:30</h5></div>
                                <div class="col-auto"><h5>18:00</h5></div>
                                
                                
                                
                            </div>
                            <!-- <div class="row justify-content-center text-dark font-weight-bold text-center">
                                <h4>Reglamento Sindicato</h4>
                            </div>
                            <div class="row justify-content-center text-secondary text-center">
                                <h3>10/08/2018 18:30</h3>
                            </div>
                            <div class="row justify-content-center text-dark font-weight-bold text-center">
                                <h4>Abogados</h4>
                            </div>
                            <div class="row justify-content-center text-secondary text-center">
                                <h3>NEOLEGAL</h3>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-12 mb-3">
        <div class="card h-100">
            <div class="card-header bg-secondary  text-light">
                <i class="fas fa-users"></i>
                Datos personales</div>
            <div class="card-body p-3">

                <div class="form-row">
                    <div class="form-group col-md-4 col-sm-6">
                        <label class="" for="inputEmail4">Nombres</label>
                        <input type="text" disabled class="form-control" id="nombresTra">
                    </div>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="inputPassword4">Apellidos</label>
                        <input type="text" disabled class="form-control" id="apellidosTra">
                    </div>
                    <div class="form-group col-md-4 col-sm-4">
                        <label for="inputPassword4">Miembro desde</label>
                        <input type="text" disabled class="form-control" id="miembroDesdeTra">
                    </div>

                    <div class="form-group col-md-8 col-sm-8">
                        <label for="inputCity">Puesto</label>
                        <input type="text" disabled class="form-control" id="puestoTra">
                    </div>
                    <div class="form-group col-md-4 col-sm-5">
                        <label for="inputZip">Área</label>
                        <input type="text" disabled class="form-control" id="areaTra">
                    </div>
                    <div class="form-group col-md-4 col-sm-7">
                        <label for="inputCity">Dirección</label>
                        <input type="text" disabled class="form-control" id="direccionTra">
                    </div>
                    <div class="form-group col-md-3 col-sm-4">
                        <label for="inputZip">Celular</label>
                        <input type="text" disabled class="form-control" id="celularTra">
                    </div>
                    <div class="form-group col-md-5 col-sm-8">
                        <label for="inputZip">Correo</label>
                        <input type="text" disabled class="form-control" id="correoTra">
                    </div>
                </div>

                <!-- <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 bg-info">
                                            <div class="row">
                                                <div class="col-12"><h3>Cristóbal Augusto Herrera Vidal</h3></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">EJECUTIVO DE SERVICIO ATENCIÓN CLIENTE,</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">ADMINISTRATIVO</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- Icon Cards-->
<!-- <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5">11 New Tasks!</div>
                        <div class="mr-5">11 New Tasks!</div>
                        <div class="mr-5">11 New Tasks!</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">11 New Tasks!</div>
                    <div class="mr-5">11 New Tasks!</div>
                    <div class="mr-5">11 New Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">123 New Orders!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-life-ring"></i>
                    </div>
                    <div class="mr-5">13 New Tickets!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div> -->

<?php
include('include/footer.php');
?>