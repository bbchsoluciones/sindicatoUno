<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/NotificacionesM.php';
require $ruta_raiz . '/model/vendor/autoload.php';
date_default_timezone_set('America/Santiago');

if (isset($_GET['notificaciones'])):
    $error = array();
    $timeZone = null;
    $notificacion = new NotificacionesM();
    $timeAgo = new Westsworld\TimeAgo(); 
    $notificacion->listar_notificaciones();
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