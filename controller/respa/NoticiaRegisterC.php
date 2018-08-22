<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$run_trabajadora_raiz = dirname(dirname(__FILE__));
require_once($run_trabajadora_raiz . '/model/NoticiaM.php');
require_once($run_trabajadora_raiz . '/model/subirImagenM.php');
//Dentro de Controlador

if(isset($_POST['titulo']) &&
    isset($_POST['cuerpo']) &&
    isset($_POST['publicada'])
):

    $data = array();
    $imagen = "";
    $error = array();
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach($_POST as $indice => $valor):
        if(empty(trim($valor))):
            $valor = "Campo vació, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice]= utf8_decode(htmlspecialchars($valor));
    endforeach;



    if(count($error)>0):
       $error['titulo'] = "Ha ocurrido un error!";
       $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
       $error['clase'] = "danger";
       echo json_encode($error);
    else:

        $noticia = new NoticiaM();
        $noticia->setTitulo($data['titulo']);
        $noticia->setCuerpo($data['cuerpo']);
        $noticia->setPublicada($data['publicada']);
        if(isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
            $subir = new imgUpldr;
            $imagen = $subir->init($_FILES['url_foto_noticia']); 
            if(empty($imagen)):
                $url_foto_noticia = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
                $noticia->setUrl_foto_noticia($url_foto_noticia);
            else:
                $error['ur_foto_noticia'] = $imagen;
            endif;

        endif;
        if($noticia->registrar_noticia() && $noticia->agregar_imagen()):
            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Información actualiza correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        endif; 
    endif;

else:

    echo "Ha ocurrido un error inesperado";
    
endif;


?>
