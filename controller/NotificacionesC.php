<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/NotificacionesM.php';
require $ruta_raiz . '/model/vendor/autoload.php';
date_default_timezone_set('America/Santiago');

if (!isset($_SESSION)):
    session_start(); //inicia sesion si está vacío
endif;

if (isset($_GET['notificaciones'])):
    $error = array();
    $timeZone = null;
    $notificacion = new NotificacionesM();
    $timeAgo = new Westsworld\TimeAgo(); 
    $notificacion->listar_notificaciones_admin();
    if (!empty($notificacion->getNotificaciones())):
        $notificacion = $notificacion->getNotificaciones();
        foreach ($notificacion as $key => $val):
            $notificacion[$key]['fecha'] =  $timeAgo->inWords(new DateTime($val['fecha']));
        endforeach;
        echo json_encode($notificacion);
    else:
        $error['mensaje'] = "Nada por aquí.";
        echo json_encode($error);
    endif;
elseif (isset($_GET['notificaciones_user'])):
    $error = array();
    $timeZone = null;
    $notificacion = new NotificacionesM();
    $timeAgo = new Westsworld\TimeAgo(); 
    $notificacion->setRun_trabajador($_SESSION['run_trabajador']);
    $notificacion->listar_notificaciones_user();
    if (!empty($notificacion->getNotificaciones())):
        $notificacion = $notificacion->getNotificaciones();
        foreach ($notificacion as $key => $val):
            $notificacion[$key]['fecha'] =  $timeAgo->inWords(new DateTime($val['fecha']));
        endforeach;
        echo json_encode($notificacion);
    else:
        $error['mensaje'] = "Nada por aquí.";
        echo json_encode($error);
    endif;
endif;


?>