<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/FondoM.php');


    $f = new FondoM();
    $f->saldoFondo();
    if (!empty($f-> getMonto_fondo())):
        $f = array(
            "monto" => array(
                $f-> getMonto_fondo()
            )
        );
        echo json_encode($f);
    else:
        echo "No se han encontrado registros!";
    endif;



?>