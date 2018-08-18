<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/TipoMovimientoM.php');

$tm = new TipoMovimientoM();
$tm->listar_TipoMovimiento();
if (!empty($tm->getTipoMovimientos())):
    $tm = array(
        "tipo_movimiento" => array(
            $tm->getTipoMovimientos()
        )
    );
    echo json_encode($tm);
else:
    echo "No se han encontrado registros!";
endif;




?>
