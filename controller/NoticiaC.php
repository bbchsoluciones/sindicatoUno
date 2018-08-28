<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/NoticiaM.php';
require_once $ruta_raiz . '/model/subirImagenM.php';
if (!isset($_SESSION)):
    session_start();
endif;
//registrar noticia
if (isset($_POST['titulo']) &&
    isset($_POST['cuerpo']) &&
    isset($_POST['registrar_noticia'])):
    $data = array();
    $imagen = "";
    $error = array();
    if (!isset($_POST['publicada'])) {
        $_POST['publicada'] = "off";
    }
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if ($indice == "publicada"):
            if ($valor == "on"):
                $valor = "publicada";
            else:
                $valor = "borrador";
            endif;
        elseif (empty(trim($valor))):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;
    if (count($error) > 0):
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
        if ($noticia->registrar_noticia()):
            $n = true;
            $img = false;
            if (isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
                $subir = new imgUpldr;
                $imagen = $subir->init($_FILES['url_foto_noticia']);
                if (empty($imagen)):
                    $url_foto_noticia = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
                    $noticia->setUrl_foto_noticia($url_foto_noticia);
                    $noticia->agregar_imagen("insert");
                    $img = true;
                else:
                    $img = false;
                endif;
            else:
                $img = true;
                
            endif;
            if ($n && $img):
                $error['tituloN'] = "Éxito!";
                $error['mensaje'] = "Noticia registrada correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['tituloN'] = "Noticia registrada con errores!";
                $error['mensaje'] = "Archivo no corresponde a un formato admitido (jpg|jpeg|png)";
                $error['clase'] = "warning";
                echo json_encode($error);
            endif;
        endif;
    endif;
//fin registrar noticia

//modificar noticia
elseif (isset($_POST['id_noticia']) &&
    isset($_POST['titulo']) &&
    isset($_POST['cuerpo']) &&
    isset($_POST['actualizar_noticia'])):
    $data = array();
    $imagen = "";
    $error = array();
    if (!isset($_POST['publicada'])) {
        $_POST['publicada'] = "off";
    }
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if ($indice == "publicada"):
            if ($valor == "on"):
                $valor = "publicada";
            else:
                $valor = "borrador";
            endif;
        elseif (empty(trim($valor))):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;
    if (count($error) > 0):
        $error['tituloN'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $noticia = new NoticiaM();
        $noticia->setId_noticia($data['id_noticia']);
        $noticia->mostrar_noticia();
        if (!empty($noticia->getNoticias())):
            $noticia->setTitulo($data['titulo']);
            $noticia->setCuerpo($data['cuerpo']);
            $noticia->setPublicada($data['publicada']);
            if ($noticia->actualizar_noticia()):
                $n = true;
                $img = false;
                if (isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
                    $subir = new imgUpldr;
                    $imagen = $subir->init($_FILES['url_foto_noticia']);
                    if (empty($imagen)):
                        $accion = "";
                        $url_foto_noticia = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
                        $noticia->setUrl_foto_noticia($url_foto_noticia);
                        if (!empty($noticia->getNoticias()['url_foto_noticia']) && $noticia->getNoticias()['url_foto_noticia'] !== null):
                            $nombre_imagen = basename(parse_url($noticia->getNoticias()['url_foto_noticia'])['path']);
                            $split = explode(".", $nombre_imagen);
                            $name = $split[0];
                            $extension = $split[1];
                            if (ctype_digit($name)):
                                unlink("../assets/images/" . $nombre_imagen);
                            endif;
                            $accion = "update";
                        else:
                            $accion = "insert";
                        endif;
                        $noticia->agregar_imagen($accion);
                        $img = true;
                    else:
                        $img = false;
                    endif;
                else:
                    $img = true;
                endif;
                if ($n && $img):
                    $error['tituloN'] = "Éxito!";
                    $error['mensaje'] = "Noticia actualizada correctamente.";
                    $error['clase'] = "success";
                    echo json_encode($error);
                else:
                    $error['tituloN'] = "Noticia actualizada con errores!";
                    $error['mensaje'] = "Archivo subido no corresponde a un formato admitido (jpg, jpeg, png)";
                    $error['clase'] = "warning";
                    echo json_encode($error);
                endif;

            else:
                $error['tituloN'] = "Oops, hubo un error!";
                $error['mensaje'] = "La noticia no ha podido ser actualizada";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;

        else:
            $error['tituloN'] = "Oops, hubo un error!";
            $error['mensaje'] = "El ID de la noticia fue modificado";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;
//fin modificar noticia

// eliminar noticia
elseif (isset($_GET['id_noticia']) && !empty($_GET['id_noticia']) && isset($_GET['eliminar_noticia'])):
    $img = false;
    $noticia = new NoticiaM();
    $id_noticia = htmlspecialchars($_GET['id_noticia']);
    $noticia->setId_noticia($id_noticia);
    $noticia->mostrar_noticia();
    if (!empty($noticia->getNoticias())):
        $array = $noticia->getNoticias();
        $noticia->setUrl_foto_noticia($array['url_foto_noticia']);
        if (!empty($noticia->getNoticias()['url_foto_noticia']) && $noticia->getNoticias()['url_foto_noticia'] !== null):
            $img = $noticia->eliminar_imagen();
        else:
            $img = true;
        endif;
        if ($img):
            if ($noticia->eliminar_noticia()):
                $error['titulo'] = "Éxito!";
                $error['mensaje'] = "Noticia eliminada correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "La noticia no ha podido ser eliminada";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;
        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "La imagen no ha podido ser eliminada";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;

    else:
        $error['titulo'] = "Oops, hubo un error!";
        $error['mensaje'] = "El ID de la noticia fue modificado";
        $error['clase'] = "danger";
        echo json_encode($error);
    endif;
// FIN ELIMINAR TRABAJADOR
    //detalle noticia
elseif (isset($_GET['id_noticia']) && !empty($_GET['id_noticia']) && isset($_GET['detalle'])):

    $noticia = new NoticiaM();
    $id_noticia = $_GET['id_noticia'];
    if (ctype_digit($id_noticia)):
        $noticia->setId_noticia($id_noticia);
        $noticia->mostrar_noticia();
        if (!empty($noticia->getNoticias())):
            $noticia = array(
                "noticia" => array(
                    $noticia->getNoticias(),
                ),
            );
            echo json_encode($noticia);
        else:
            $error['titulo'] = "Identificador de la noticia invalido!";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    else:
        $error['titulo'] = "No se ha encontrado información.";
        echo json_encode($error);
    endif;

//fin detalle noticia

//listar noticias
elseif (isset($_POST['ajax']) && isset($_POST['selectNoticia'])):
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
//fin listar noticias
