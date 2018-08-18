<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/RegionM.php');

    $region = new RegionM();
    $region->listar_region();
    if (!empty($region->getRegion())):
        $region = array(
            "region" => array(
                $region->getRegion()
            )
        );
        echo json_encode($region);
    else:
        echo "No se han encontrado registros!";
    endif;




?>