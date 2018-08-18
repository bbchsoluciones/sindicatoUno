<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/TrabajadorM.php');


    $t = new TrabajadorM();
    $t->cantidad_miembros();
    if (!empty($t-> getTrabajadores())):
        $t = array(
            "data" => array(
                $t-> getTrabajadores()
            )
        );
        echo json_encode($t);
    else:
        echo "No se han encontrado registros!";
    endif;



?>