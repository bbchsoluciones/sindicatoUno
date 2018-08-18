<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/ComunaM.php');

if(isset($_GET["id_provincia"])):
    $comuna = new ComunaM();
    $comuna->setProvincia_id_provincia($_GET['id_provincia']);
    $comuna->listar_comunas();
    if (!empty($comuna->getComuna())):
        $comuna = array(
            "comuna" => array(
                $comuna->getComuna()
            )
        );
        echo json_encode($comuna);
    else:
        echo "No se han encontrado registros!";
    endif;
endif;



?>