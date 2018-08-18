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
      

          <!-- Icon Cards-->
          <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                  <div class="card text-white bg-dark o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-users"></i>
                      </div>
                      <div id="miembrosIndex" class="mr-5 text-bold"></div>
                      <div class="container">
                          <div id="activosIndex" class="row text-success font-weight-bold"></div>
                          <div id="pendientesIndex" class="row text-warning font-weight-bold"></div>
                          <div id="inactivosIndex" class="row text-danger font-weight-bold"></div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                  <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                      </div>
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
              </div>

              <div class="row">
                <div class="col-4">              
                  <!-- Area Chart Example-->
                  <div class="card mb-3">
                    <div class="card-header">
                      <i class="fas fa-chart-area"></i>
                      Miembros</div>
                    <div class="card-body">
                      <canvas id="graficoMiembros"></canvas>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                  </div>              
                </div>    
                <div class="col-4">              
                    <!-- Area Chart Example-->
                    <div class="card mb-3">
                      <div class="card-header">
                        <i class="fas fa-chart-area"></i>
                        Area Chart Example</div>
                      <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="30"></canvas>
                      </div>
                      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>              
                  </div> 
                  <div class="col-4">              
                      <!-- Area Chart Example-->
                      <div class="card mb-3">
                        <div class="card-header">
                          <i class="fas fa-chart-area"></i>
                          Area Chart Example</div>
                        <div class="card-body">
                          <canvas id="myAreaChart" width="100%" height="30"></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                      </div>              
                    </div>           
              </div>
    
              
    
              <!-- DataTables Example -->
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                  Movimientos</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered display" id="tableIndex" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Folio</th>
                              <th>Tipo</th>
                              <th>Categoria</th>
                              <th>Nombre</th>
                              <th>Monto</th>
                              <th>Fecha</th>
                              <th>Por</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>Folio</th>
                              <th>Tipo</th>
                              <th>Categoria</th>
                              <th>Nombre</th>
                              <th>Monto</th>
                              <th>Fecha</th>
                              <th>Por</th>
                          </tr>
                      </tfoot>
                  </table>
                  </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
    
    
    
<?php
include('include/footer.php');
?>