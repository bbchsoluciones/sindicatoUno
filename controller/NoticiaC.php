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

    if (isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name",date("Ymdhis"));
        $subir->__set("_dest","../assets/images/noticia/");
        $imagen = $subir->init($_FILES['url_foto_noticia']);
        if (!empty($imagen)):
            $error['url_foto_noticia'] = $imagen;
        endif;

    endif;

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
            if (isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
                $url_foto_noticia = "http://localhost/sindicatoUno/assets/images/noticia/" . $subir->_name;
                $noticia->setUrl_foto_noticia($url_foto_noticia);
                $noticia->agregar_imagen("insert");
            endif;
            $error['tituloN'] = "Éxito!";
            $error['mensaje'] = "Noticia registrada correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
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
    if (!isset($_POST['publicada'])):
        $_POST['publicada'] = "off";
    endif;
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

    if (isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name",date("Ymdhis"));
        $subir->__set("_dest","../assets/images/noticia/");
        $imagen = $subir->init($_FILES['url_foto_noticia']);
        if (!empty($imagen)):
            $error['url_foto_noticia'] = $imagen;
        endif;

    endif;

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
                if (isset($_FILES['url_foto_noticia']['name']) && !empty($_FILES['url_foto_noticia']['name'])):
                    $accion = "";
                    $url_foto_noticia = "http://localhost/sindicatoUno/assets/images/noticia/" . $subir->_name;
                    $noticia->setUrl_foto_noticia($url_foto_noticia);
                    if (!empty($noticia->getNoticias()['url_foto_noticia']) && $noticia->getNoticias()['url_foto_noticia'] !== null):
                        $nombre_imagen = basename(parse_url($noticia->getNoticias()['url_foto_noticia'])['path']);
                        unlink("../assets/images/noticia/" . $nombre_imagen);
                        $accion = "update";
                    else:
                        $accion = "insert";
                    endif;
                    $noticia->agregar_imagen($accion);
                endif;
                $error['tituloN'] = "Éxito!";
                $error['mensaje'] = "Noticia actualizada correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
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
// FIN ELIMINAR noticia
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
        $noticias = $n->getNoticias();
        foreach ($noticias as $key => $val):
            $noticias[$key]['fecha_publicacion'] = strftime("%d %b %Y, %H:%m", strtotime($val['fecha_publicacion']));
        endforeach;
        $n = array("data" => $noticias);
        echo json_encode($n);
    else:
        $n = array("data" => "");
        echo json_encode($n);
    endif;
elseif (isset($_GET['id_news']) && !empty($_GET['id_news'])):

    $noticia = new NoticiaM();
    $id_noticia = $_GET['id_news'];
    if (ctype_digit($id_noticia)):
        $noticia->setId_noticia($id_noticia);
        $noticia->mostrar_noticia();
        if (!empty($noticia->getNoticias())):
            $noticia = $noticia->getNoticias();
        else:
            $noticia = "";
        endif;
    else:
        $noticia = "";
    endif;
else:
    $n = new NoticiaM();
    $n->mostrar_noticias();
    if (!empty($n->getNoticias())):
        $n = $n->getNoticias();
    else:
        $n = array();
    endif;
endif;
function cleanString($text) {
    // 1) convert á ô => a o
    $text = preg_replace("/[áàâãªä]/u","a",$text);
    $text = preg_replace("/[ÁÀÂÃÄ]/u","A",$text);
    $text = preg_replace("/[ÍÌÎÏ]/u","I",$text);
    $text = preg_replace("/[íìîï]/u","i",$text);
    $text = preg_replace("/[éèêë]/u","e",$text);
    $text = preg_replace("/[ÉÈÊË]/u","E",$text);
    $text = preg_replace("/[óòôõºö]/u","o",$text);
    $text = preg_replace("/[ÓÒÔÕÖ]/u","O",$text);
    $text = preg_replace("/[úùûü]/u","u",$text);
    $text = preg_replace("/[ÚÙÛÜ]/u","U",$text);
    $text = preg_replace("/[’‘‹›‚]/u","'",$text);
    $text = preg_replace("/[“”«»„]/u",'"',$text);
    $text = str_replace("–","-",$text);
    $text = str_replace(" "," ",$text);
    $text = str_replace("ç","c",$text);
    $text = str_replace("Ç","C",$text);
    $text = str_replace("ñ","n",$text);
    $text = str_replace("Ñ","N",$text);
 
    //2) Translation CP1252. &ndash; => -
    $trans = get_html_translation_table(HTML_ENTITIES); 
    $trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark 
    $trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook 
    $trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark 
    $trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis 
    $trans[chr(134)] = '&dagger;';    // Dagger 
    $trans[chr(135)] = '&Dagger;';    // Double Dagger 
    $trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent 
    $trans[chr(137)] = '&permil;';    // Per Mille Sign 
    $trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron 
    $trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark 
    $trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE 
    $trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark 
    $trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark 
    $trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark 
    $trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark 
    $trans[chr(149)] = '&bull;';    // Bullet 
    $trans[chr(150)] = '&ndash;';    // En Dash 
    $trans[chr(151)] = '&mdash;';    // Em Dash 
    $trans[chr(152)] = '&tilde;';    // Small Tilde 
    $trans[chr(153)] = '&trade;';    // Trade Mark Sign 
    $trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron 
    $trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark 
    $trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE 
    $trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis 
    $trans['euro'] = '&euro;';    // euro currency symbol 
    ksort($trans); 
     
    foreach ($trans as $k => $v) {
        $text = str_replace($v, $k, $text);
    }
 
    // 3) remove <p>, <br/> ...
    $text = strip_tags($text); 
     
    // 4) &amp; => & &quot; => '
    $text = html_entity_decode($text);
     
    // 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
    $text = preg_replace('/[^(\x20-\x7F)]*/','', $text); 
     
    $targets=array('\r\n','\n','\r','\t');
    $results=array(" "," "," ","");
    $text = str_replace($targets,$results,$text);
 
    //XML compatible
    /*
    $text = str_replace("&", "and", $text);
    $text = str_replace("<", ".", $text);
    $text = str_replace(">", ".", $text);
    $text = str_replace("\\", "-", $text);
    $text = str_replace("/", "-", $text);
    */
     
    return ($text);
} 
//fin listar noticias
