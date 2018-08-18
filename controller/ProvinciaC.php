<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/ProvinciaM.php');

if(isset($_GET["id_region"])):
    $provincia = new ProvinciaM();
    $provincia->setRegion_id_region($_GET['id_region']);
    $provincia->listar_provincias();
    if (!empty($provincia->getProvincia())):
        $provincia = array(
            "provincia" => array(
                $provincia->getProvincia()
            )
        );
        echo json_encode($provincia);
    else:
        echo "No se han encontrado registros!";
    endif;
endif;



?>