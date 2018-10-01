<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php
  $pageName = basename($_SERVER['PHP_SELF']);
  $pageName = explode(".", $pageName);
  ?>
  <?php if($pageName[0]=="login"): ?>

  <?php endif; ?>
  <link rel="icon" href="../../../../favicon.ico">

  <!-- title -->
  <?php if ($pageName[0]=="index"): ?>
      <title>Inicio</title>
    <?php elseif ($pageName[0]=="about"): ?>
      <title>Quiénes Somos</title>
    <?php elseif ($pageName[0]=="news"): ?>
      <title>Noticias</title>
    <?php elseif ($pageName[0]=="gallery"): ?>
      <title>Galería</title>
    <?php elseif ($pageName[0]=="contact"): ?>
      <title>Contacto</title>
    <?php elseif ($pageName[0]=="newsdetail"): ?>
      <title>Detalle Noticia</title>
    <?php endif; ?>
    <!-- title -->

  <!-- Bootstrap core CSS -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css?ver=<?php echo time(); ?>" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="../../assets/vendor/fontawesome/css/all.css?ver=<?php echo time(); ?>" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../assets/css/estilos_public.css?ver=<?php echo time(); ?>" rel="stylesheet">
  <link href="../../assets/vendor/animate/animate.css?ver=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
  <header>
    <div class="navigation_menu">
      <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container">
          <a class="navbar-brand logo" href="index.php">
            <img src="../../assets/images/logo.png">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul id="botonera" class="navbar-nav menu_buttons">
              <li class="nav-item active">
                <a id="btn" class="nav-link" href="index.php">Inicio
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a id="btn" class="nav-link" href="about.php">Quiénes Somos</a>
              </li>
              <li class="nav-item">
                <a id="btn" class="nav-link" href="news.php">Noticias</a>
              </li>
              <li class="nav-item">
                <a id="btn" class="nav-link" href="gallery.php">Galería</a>
              </li>
              <li class="nav-item">
                <a id="btn" class="nav-link" href="contact.php">Contacto</a>
              </li>
              <?php 
                if(!isset($_SESSION)):
                  session_start();//inicia sesion si está vacío
                endif;
                if(isset($_SESSION['tipo_usuario']))://sesion iniciada
                  if($_SESSION['tipo_usuario'] == 0):
              ?>
                    <li class="nav-item">
                      <a id="btn" class="nav-link" href="../intranet/superadmin/index.php">
                      Mi Cuenta <i class="fas fa-user-circle fa-fw"></i>
                      </a>
                    </li>
              <?php
                  elseif($_SESSION['tipo_usuario'] == 1):
              ?>
                    <li class="nav-item">
                      <a id="btn" class="nav-link" href="../intranet/admin/index.php">
                      Mi Cuenta <i class="fas fa-user-circle fa-fw"></i>
                      </a>
                    </li>
              <?php
                  elseif($_SESSION['tipo_usuario'] == 2):
              ?>
                    <li class="nav-item">
                      <a id="btn" class="nav-link" href="../intranet/user/index.php">
                      Mi Cuenta <i class="fas fa-user-circle fa-fw"></i>
                      </a>
                    </li>
              <?php
                  endif;
                else://
              ?>
                  <li class="nav-item mb-md-0 mb-sm-3 mb-3">
                    <a id="btn" class="btn btn-success" href="login.php">Inicio de sesión</a>
                  </li>
              <?php 
                endif; 
              ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <div class="wrap">
    <main role="main">
