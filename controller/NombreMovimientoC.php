<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/NombreMovimientoM.php');

if(isset($_GET["id_categoriatm"])):
    $nombreTM = new NombreMovimientoM();
    $nombreTM->setCategoria_movimiento_id_categoria_movimiento($_GET['id_categoriatm']);
    $nombreTM->listar_NombreMovimiento();
    if (!empty($nombreTM-> getNombresMovimientos())):
        $nombreTM = array(
            "nombreTM" => array(
                $nombreTM-> getNombresMovimientos()
            )
        );
        echo json_encode($nombreTM);
    else:
        echo "No se han encontrado registros!";
    endif;
endif;



?>