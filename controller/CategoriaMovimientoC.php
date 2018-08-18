<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/CategoriaMovimientoM.php');

if(isset($_GET["id_tm"])):
    $categoriatm = new CategoriaMovimientoM();
    $categoriatm->setTipo_movimiento_id_tipo_movimiento($_GET['id_tm']);
    $categoriatm->listar_CategoriaMovimiento();
    if (!empty($categoriatm->getCategoriasMovimientos())):
        $categoriatm = array(
            "categoriaTM" => array(
                $categoriatm->getCategoriasMovimientos()
            )
        );
        echo json_encode($categoriatm);
    else:
        echo "No se han encontrado registros!";
    endif;
endif;



?>