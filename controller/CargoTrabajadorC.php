<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/CargoTrabajadorM.php');

    $cargo = new CargoTrabajadorM();
    $cargo->listar_cargos();
    if (!empty($cargo->getCargo())):
        $cargo = array(
            "cargo" => array(
                $cargo->getCargo()
            )
        );
        echo json_encode($cargo);
    else:
        echo "No se han encontrado registros!";
    endif;




?>