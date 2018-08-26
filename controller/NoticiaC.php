<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/NoticiaM.php');
require_once($ruta_raiz . '/model/subirImagenM.php');
if(!isset($_SESSION)):
    session_start();
endif;
//Dentro de Controlador
if(isset($_POST['titulo']) && isset($_POST['cuerpo'])):
    $data = array();
    $imagen = "";
    $error = array();
    if(!isset($_POST['publicada'])){
        $_POST['publicada']="off";
    }
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach($_POST as $indice => $valor):
        if($indice=="publicada"):
            if($valor=="on"):
                $valor="publicada";
            else:
                $valor="borrador";
            endif;
        elseif(empty(trim($valor))):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice]= utf8_decode(htmlspecialchars($valor));
    endforeach;
    if(count($error)>0):
       $error['tituloN'] = "Ha ocurrido un error!";
       $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
       $error['clase'] = "danger";
       echo json_encode($error);
    else:
        $noticia = new NoticiaM();
        $noticia->setTitulo($data['titulo']);
        $noticia->setCuerpo($data['cuerpo']);
        $noticia->setPublicada($data['publicada']);
        $noticia->setTrabajador_run_trabajador($_SESSION['run_trabajador']);
        if(isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
            $subir = new imgUpldr;
            $imagen = $subir->init($_FILES['url_foto_noticia']); 
            if(empty($imagen)):
                $url_foto_noticia = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
                $noticia->setUrl_foto_noticia($url_foto_noticia);
            else:
                $error['url_foto_noticia'] = $imagen;
                echo json_encode($error);
            endif;

        endif;
        if($noticia->registrar_noticia() && $noticia->agregar_imagen()):
            $error['tituloN'] = "Éxito!";
            $error['mensaje'] = "Noticia registrada correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        endif; 
    endif;
elseif(isset($_POST['ajax']) && isset($_POST['selectNoticia'])):
    $n = new NoticiaM();
    $n->mostrar_noticias();
    if (!empty($n->getNoticias())):
        $n = array("data" => $n->getNoticias());
        echo json_encode($n);
    else:
        $n = array("data" => "");
        echo json_encode($n);
    endif;
endif;