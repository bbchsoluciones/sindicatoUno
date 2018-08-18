<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/SubCargoTrabajadorM.php');

if(isset($_GET["id_cargo"])):
    $subcargo = new SubCargoTrabajadorM();
    $subcargo->setId_sub_Cargo($_GET['id_cargo']);
    $subcargo->listar_subcargos();
    if (!empty($subcargo->getSubcargo())):
        $subcargo = array(
            "subcargo" => array(
                $subcargo->getSubcargo()
            )
        );
        echo json_encode($subcargo);
    else:
        echo "No se han encontrado registros!";
    endif;
endif;



?>