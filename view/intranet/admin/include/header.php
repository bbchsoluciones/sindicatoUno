<?php
if(!isset($_SESSION)):
  session_start();//inicia sesion si está vacío
endif;

if(!isset($_SESSION['tipo_usuario']))://Detectar salto de login
  header("Location: ../../public/login.php");
elseif($_SESSION['tipo_usuario'] != 1):// no es usuario administrador
  header("Location: ../../public/login.php");
endif;
?>
<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
      $pageName = basename($_SERVER['PHP_SELF']);
      $pageName = explode(".", $pageName);
    ?>
    <!-- title -->
    <?php if ($pageName[0]=="index"): ?>
      <title>Resúmen</title>
    <?php elseif ($pageName[0]=="userNew"): ?>
      <title>Registrar Trabajador</title>
    <?php elseif ($pageName[0]=="userManage"): ?>
      <title>Administrar Trabajadores</title>
    <?php elseif ($pageName[0]=="sonNew"): ?>
      <title>Registrar Hijo</title>
    <?php elseif ($pageName[0]=="sonManage"): ?>
      <title>Administrar Hijos</title>
    <?php elseif ($pageName[0]=="moveNew"): ?>
      <title>Registrar Movimiento</title>
    <?php elseif ($pageName[0]=="moveManage"): ?>
      <title>Administrar Movimientos</title>
    <?php elseif ($pageName[0]=="barChartEntry"): ?>
      <title>Gráfico Ingresos</title>
    <?php elseif ($pageName[0]=="barChartExit"): ?>
      <title>Gráfico Egresos</title>
    <?php elseif ($pageName[0]=="newNews"): ?>
      <title>Crear Noticia</title>
    <?php elseif ($pageName[0]=="newsManage"): ?>
      <title>Administrar Noticias</title> 
    <?php elseif ($pageName[0]=="homeManage"): ?>
      <title>Administrar Inicio</title> 
    <?php elseif ($pageName[0]=="aboutManage"): ?>
      <title>Administrar Quiénes Somos</title> 
    <?php elseif ($pageName[0]=="userManageProfile"): ?>
      <title>Perfil</title>
    <?php elseif ($pageName[0]=="sonNewProfile"): ?>
      <title>Registrar Hijo</title>
    <?php elseif ($pageName[0]=="sonManageProfile"): ?>
      <title>Administrar Hijos</title>
    <?php elseif ($pageName[0]=="newGallery"): ?>
      <title>Galería</title> 
    <?php elseif ($pageName[0]=="galleryManage"): ?>
      <title>Administrar Galería</title> 
    <?php elseif ($pageName[0]=="imageApproval"): ?>
      <title>Solicitudes Pendientes</title> 
    <?php elseif ($pageName[0]=="imageApprovalHistory"): ?>
      <title>Historial Solicitudes</title> 
    <?php endif; ?>
    <!-- title -->



    

    <!-- Bootstrap core CSS-->
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/gijgo/css/gijgo.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../assets/vendor/fontawesome/css/all.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../../../assets/css/sb-admin.css" rel="stylesheet">
    <link href="../../../assets/css/estilos_intranet.css" rel="stylesheet">
    <link href="../../../assets/css/spectrum.css" rel="stylesheet">
    <link href="../../../assets/vendor/animate/animate.css" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <?php if($pageName[0]=="moveManage"):?>   
      <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <?php endif;?>  
    <?php if($pageName[0]=="index"):?>       
      <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <?php endif;?>

    <script>
      window.onload = function () {
        <?php if($pageName[0]=="userManageProfile"):?>
          mostrarTrabajador(<?php echo $_SESSION['run_trabajador']; ?>);
        <?php elseif($pageName[0]=="sonNewProfile"):?>
          buscarPadre(<?php echo $_SESSION['run_trabajador']; ?>);
        <?php elseif($pageName[0]=="sonManageProfile"):?>
          buscarHijo(<?php echo $_SESSION['run_trabajador']; ?>);
        <?php elseif($pageName[0]=="index"):?>
          mostrarDatosTrabajador(<?php echo $_SESSION['run_trabajador']; ?>);
        <?php endif;?>
      }        
    </script>

  </head>
  <body id="page-top" class="<?php echo $pageName[0]; ?>">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Sindicato Uno</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-danger" id="contador_notificaciones"></span>  
          <i class="fas fa-bell fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" id="notificaciones" aria-labelledby="alertsDropdown"></div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <!-- <span class="badge badge-danger">7</span>   -->
          <i class="fas fa-user-circle fa-fw"></i>            
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="userManageProfile.php">Mi Cuenta</a>
            <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

<?php include('sideMenu.php') ?>    

      <div id="content-wrapper" class="content-wrapper">

        <div class="container-fluid">