<?php
include('include/header.php');
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.php">Resumen</a>
  </li>
</ol>
<div class="row"><!-- card bienvenida -->
  <div class="col-md-12 col-12">
    <div class="card mb-3">
      <div class="card-header">
        <i class="far fa-address-card"></i>
        Bienvenida</div>
      <div id="loadBienvenida" class="loadData_container text-center mt-3 mb-3">
        <img src="../../../assets/images/loading.gif" width="50">
      </div>
      <div id="cardBienvenida" class="card-body d-none animated fadeIn">
        <div class="container m-0">
          <div class="row">
            <h1 id="saludoTra">Hola!</h1>
          </div>
          <div class="row">
            <p class="text-justify mb-0">
              Te damos la bienvenida a la nueva forma de transparentar nuestras acciones. El objetivo principal de esto
              es que todos los
              integrantes del Sindicato N°1 de Brink´s se sientan informados.
              <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                aria-controls="collapseExample">
                Ver más
              </a>
            </p>
            <div class="collapse" id="collapseExample">
              <p class="mb-0">
                Mantén tus datos actualizados en tu <strong><a href="userManageProfile.php" class="">perfil</a></strong>
                para
                que podamos tener una mejor experiencia todos juntos. A continuación con el fin de hacer
                valer nuestro objetivo principal te mostramos la siguiente información:
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- card bienvenida -->
<!-- row etiquetas -->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3"><!-- primera etiqueta -->
    <div class="card text-white o-hidden h-100" style="background-color: #4B126A;">
        <div id="loadMiembros" class="card-body text-center">
            <div class="loadData_container">
              <img src="../../../assets/images/loading.gif" width="35">
            </div>
          </div>
      <div id="bodyMiembros" class="card-body animated fadeIn pb-2 d-none">
        <div class="card-body-icon">
            <i class="fas fa-users"></i>
        </div>
        <div id="miembrosIndex" class="mr-5 text-bold"></div>
        <div id="activosIndex" class="mr-5 text-success font-weight-bold" style="font-size: 12px;"></div>
        <div id="pendientesIndex" class="mr-5 text-warning font-weight-bold" style="font-size: 12px;"></div>
        <div id="inactivosIndex" class="mr-5 text-danger font-weight-bold" style="font-size: 12px;"></div>
      </div>
      <a id="btnMiembros" class="card-footer text-white clearfix small z-1 d-none" href="userManage.php">
        <span class="float-left animated fadeIn">Administrar</span>
        <span class="float-right animated fadeIn">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div><!-- primera etiqueta -->
  <div class="col-xl-3 col-sm-6 mb-3"><!-- segunda etiqueta -->
    <div class="card text-white bg-info o-hidden h-100">
      <div class="card-body animated fadeIn">
        <div class="card-body-icon">
            <i class="fas fa-plus-circle"></i>
        </div>
        <div class="mr-5">Añade nuevos miembros.</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="userNew.php">
        <span class="float-left animated fadeIn">Registrar Trabajador</span>
        <span class="float-right animated fadeIn">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div><!-- segunda etiqueta -->
  <div class="col-xl-3 col-sm-6 mb-3"><!-- tercera etiqueta -->
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body animated fadeIn">
        <div class="card-body-icon">
            <i class="far fa-newspaper"></i>
        </div>
        <div class="mr-5">Publica una nueva noticia.</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="newNews.php">
        <span class="float-left animated fadeIn">Crear Noticia</span>
        <span class="float-right animated fadeIn">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div><!-- tercera etiqueta -->
  <div class="col-xl-3 col-sm-6 mb-3"><!-- cuarta etiqueta -->
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body animated fadeIn">
        <div class="card-body-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="mr-5">Registra nuevos movimientos</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="moveNew.php">
        <span class="float-left animated fadeIn">Registrar Movimiento</span>
        <span class="float-right animated fadeIn">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div><!-- cuarta etiqueta -->
</div>
<!-- row etiquetas -->
<div class="row"><!-- row contenidoIndex -->
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3"><!-- card graficoGenero -->
    <div class="card h-100 mb-3">
      <div class="card-header text-light" style="background-color: #1DB892;">
        <i class="fas fa-chart-area"></i>
        Miembros</div>
      <div class="card-body d-flex align-items-center p-0">
        <canvas id="graficoMiembros"></canvas>
      </div>
    </div>
  </div><!-- card graficoGenero -->
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3"><!-- card datosPersonales -->
    <div class="card h-100">
      <div class="card-header bg-secondary  text-light">
        <i class="fas fa-users"></i>
        Mis datos personales</div>
      <div class="card-body p-3">
        <div id="loadDatos" class="row justify-content-center">
          <div class="loadData_container">
            <img src="../../../assets/images/loading.gif" width="50">
          </div>
        </div>
        <div id="cardDatos" class="form-row d-none animated fadeIn">
          <div class="form-group col-md-4 col-sm-4">
            <label class="" for="inputEmail4">Nombres</label>
            <input type="text" disabled class="form-control" id="nombresTra">
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label for="inputPassword4">Apellidos</label>
            <input type="text" disabled class="form-control" id="apellidosTra">
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label for="inputZip">Celular</label>
              <input type="text" disabled class="form-control" id="celularTra">
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label for="inputPassword4">Ingreso</label>
            <input type="text" disabled class="form-control" id="miembroDesdeTra">
          </div>
          <div class="form-group col-md-8 col-sm-8">
            <label for="inputCity">Puesto</label>
            <input type="text" disabled class="form-control" id="puestoTra">
          </div>          
          <div class="form-group col-md-6 col-sm-6">
            <label for="inputCity">Dirección</label>
            <input type="text" disabled class="form-control" id="direccionTra">
          </div>          
          <div class="form-group col-md-6 col-sm-6">
            <label for="inputZip">Correo</label>
            <input type="text" disabled class="form-control" id="correoTra">
          </div>
        </div>
      </div>
    </div>
  </div><!-- card datosPersonales --> 
  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3"><!-- card cantidadMovimientos -->
    <div class="card h-100">
      <div class="card-header bg-warning ">
        <i class="far fa-money-bill-alt"></i>
        Movimientos</div>
      <div class="card-body p-2 d-flex align-items-center">
        <div class="container">
          <div id="loadMovimientos" class="row justify-content-center">
            <div class="loadData_container">
              <img src="../../../assets/images/loading.gif" width="50">
            </div>
          </div>
          <div id="cardMovimientos" class="row d-none animated fadeIn">
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
  </div><!-- card cantidadMovimientos -->
  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3"><!-- card saldoFondo -->
    <div class="card h-100">
      <div class="card-header bg-success text-light">
        <i class="fas fa-balance-scale"></i>
        Saldo</div>
      <div class="card-body p-2 d-flex align-items-center">
        <div class="container">
          <div id="loadFondo" class="row justify-content-center">
            <div class="loadData_container">
              <img src="../../../assets/images/loading.gif" width="50">
            </div>
          </div>
          <div id="cardFondo" class="row d-none animated fadeIn">
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
  </div><!-- card saldoFondo -->
  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3"><!-- card multas -->
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
  </div><!-- card multas -->
  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3"><!-- card info -->
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
                <div class="col-auto">
                  <h5>07:30</h5>
                </div>
                <div class="col-auto">
                  <h5>14:30</h5>
                </div>
                <div class="col-auto">
                  <h5>18:00</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- card info -->  
  <div class="col-lg-12 col-md-12 col-12 mb-3"><!-- card tablaMovimientos -->
    <div class="card mb-3">
      <div class="card-header text-light" style="background-color: #1DB857;">
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
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div><!-- card tablaMovimientos -->    
</div><!-- row contenidoIndex -->
<?php
include('include/footer.php');
?>
