<!-- Sidebar -->
<ul class="sidebar navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span class="pl-2">Resumen</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
      <i class="fa fa-users pr-2"></i>
      <span>Usuario</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Trabajador(a):</h6>
      <a class="dropdown-item" href="userNew.php"><i class="fa fa-user-plus text-info pr-3"></i>Registrar</a>
      <a class="dropdown-item" href="userManage.php"><i class="fa fa-address-card text-info pr-3"></i>Administrar</a>
      <h6 class="dropdown-header">Solicitudes</h6>
      <a class="dropdown-item" href="imageApproval.php"><i class="fa fa-comment-alt text-info pr-3"></i>Pendientes</a>
      <a class="dropdown-item" href="imageApprovalHistory.php"><i class="fa fa-clock text-info pr-3"></i>Historial</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Hijo(a):</h6>
      <a class="dropdown-item" href="sonNew.php"><i class="fa fa-user-plus text-info pr-3"></i>Registrar</a>
      <a class="dropdown-item" href="sonManage.php"><i class="fa fa-address-card text-info pr-3"></i>Administrar</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
      <i class="fa fa-money-bill-alt pr-2"></i>
      <span>Movimiento</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Ingreso y Egreso:</h6>
      <a class="dropdown-item" href="moveNew.php"><i class="fas fa-money-bill-wave text-info pr-3"></i>Registrar</a>
      <a class="dropdown-item" href="moveManage.php"><i class="fas fa-hand-holding-usd text-info pr-3"></i>Administrar</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Gráficos:</h6>
      <a class="dropdown-item" href="barChartEntry.php"><i class="fas fa-chart-line text-info pr-3"></i>Ingresos</a>
      <a class="dropdown-item" href="barChartExit.php"><i class="fas fa-chart-bar text-info pr-3"></i>Egresos</a>
    </div>
  </li>
<!--   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
      <i class="fa fa-list-alt pr-2"></i>
      <span>Reportes</span>
    </a>
  </li> -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
      <i class="fa fa-file-alt pr-2"></i>
      <span>Pagina Principal</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <a class="dropdown-item" href="homeManage.php"><i class="fa fa-align-justify text-info pr-3"></i>Inicio</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="aboutManage.php"><i class="fa fa-users text-info pr-3"></i>Quiénes Somos</a>
    </div>
  </li>
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fas fa-newspaper pr-2"></i>
        <span>Noticias</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <a class="dropdown-item" href="newNews.php"><i class="fa fa-user-plus text-info pr-3"></i>Crear</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="newsManage.php"><i class="fa fa-address-card text-info pr-3"></i>Administrar</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa fa-images pr-2"></i>
        <span>Galeria</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <a class="dropdown-item" href="newGallery.php"><i class="fas fa-file-upload text-info pr-3"></i>Subir</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="galleryManage.php"><i class="far fa-images text-info pr-3"></i>Administrar</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="userManageProfile.php">
        <i class="fas fa-user"></i>
        <span class="pl-2">Perfil</span>
      </a>
    </li>
</ul>