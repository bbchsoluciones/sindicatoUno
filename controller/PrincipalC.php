<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/PrincipalM.php';
require_once $ruta_raiz . '/model/subirImagenM.php';
//carousel
//listar
if (isset($_GET['categoria_principal']) && isset($_GET['listado'])):

    $principal = new PrincipalM();
    $principal->setCategoria(htmlspecialchars($_GET['categoria_principal']));
    $principal->mostrar_textos();
    if (!empty($principal->getPrincipal())):
        $principal = array(
            "principal" => array(
                $principal->getPrincipal(),
            ),
        );
        echo json_encode($principal);
    endif;
//fin listar
    //detalle
elseif (isset($_GET['id_texto']) && isset($_GET['detalle'])):

    $principal = new PrincipalM();
    $principal->setId_texto(htmlspecialchars($_GET['id_texto']));
    $principal->mostrar_texto();
    if (!empty($principal->getPrincipal())):
        $principal = array(
            "principal" => array(
                $principal->getPrincipal(),
            ),
        );
        echo json_encode($principal);
    endif;
//fin detalle
    //crear
elseif (isset($_POST['id_texto']) &&
    empty($_POST['id_texto']) &&
    isset($_POST['titulo_']) &&
    isset($_POST['descripcion_']) &&
    isset($_POST['alineacion_texto']) &&
    isset($_POST['animacion']) &&
    isset($_POST['color_texto']) &&
    isset($_POST['url_link']) &&
    isset($_POST['crear_carousel'])):
    $data = array();
    $imagen = null;
    $error = array();
    unset($_POST['id_texto']);

    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if (empty(trim($valor)) && $indice != "color_texto"):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name", date("Ymdhis") . "_carousel");
        $subir->__set("_dest", "../assets/images/");
        $subida = $subir->init($_FILES['imagen']);
        $imagen = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
        if (!empty($subida)):
            $error['imagen'] = $subida;
        endif;

    else:
        $error['imagen'] = "Se debe subir una imagen!";
    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $principal = new PrincipalM();
        $principal->setTitulo_($data['titulo_']);
        $principal->setDescripcion_($data['descripcion_']);
        $principal->setCategoria("carousel");
        $principal->setAlineacion_texto($data['alineacion_texto']);
        $principal->setAnimacion($data['animacion']);
        $principal->setColor_fondo(null);
        $principal->setColor_texto($data['color_texto']);
        $principal->setUrl_link($data['url_link']);
        if ($principal->registrar_texto()):
            $principal->setUrl_foto($imagen);
            $principal->agregar_imagen("insert");
            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Imagen Carousel subida correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        else:
            $error['titulo'] = "Ha ocurrido un error!";
            $error['mensaje'] = "No se pudo registrar la información.";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;

//fin crear
    //modificar
elseif (isset($_POST['id_texto']) &&
    !empty($_POST['id_texto']) &&
    isset($_POST['titulo_']) &&
    isset($_POST['descripcion_']) &&
    isset($_POST['alineacion_texto']) &&
    isset($_POST['animacion']) &&
    isset($_POST['color_texto']) &&
    isset($_POST['url_link']) &&
    isset($_POST['actualizar_carousel'])):

    $data = array();
    $imagen = "";
    $error = array();
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if (empty(trim($valor)) && $indice != "color_texto"):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name", date("Ymdhis") . "_carousel");
        $subir->__set("_dest", "../assets/images/");
        $subida = $subir->init($_FILES['imagen']);
        if (!empty($subida)):
            $error['imagen'] = $subida;
        else:
            $imagen = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
        endif;
    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $principal = new PrincipalM();
        $principal->setId_texto($data['id_texto']);
        $principal->mostrar_texto();
        if (!empty($principal->getPrincipal())):
            $principal->setTitulo_($data['titulo_']);
            $principal->setDescripcion_($data['descripcion_']);
            $principal->setCategoria("carousel");
            $principal->setAlineacion_texto($data['alineacion_texto']);
            $principal->setAnimacion($data['animacion']);
            $principal->setColor_fondo(null);
            $principal->setColor_texto($data['color_texto']);
            $principal->setUrl_link($data['url_link']);
            if ($principal->actualizar_texto()):
                if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])):
                    $accion = "";
                    $principal->setUrl_foto($imagen);
                    if (!empty($principal->getPrincipal()['url_foto']) && $principal->getPrincipal()['url_foto'] !== null):
                        $nombre_imagen = basename(parse_url($principal->getPrincipal()['url_foto'])['path']);
                        unlink("../assets/images/" . $nombre_imagen);
                        $accion = "update";
                    else:
                        $accion = "insert";
                    endif;
                    $principal->agregar_imagen($accion);
                endif;
                $error['titulo'] = "Éxito!";
                $error['mensaje'] = "Carousel actualizado correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "El carousel no pudo ser actualizado";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;

        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "El ID del carousel fue modificado";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;
//fin modificar
    //eliminar
elseif (isset($_GET['id_texto']) && !empty($_GET['id_texto']) && isset($_GET['eliminar_carousel'])):
    $img = false;
    $principal = new PrincipalM();
    $principal->setId_texto(htmlspecialchars($_GET['id_texto']));
    $principal->mostrar_texto();
    if (!empty($principal->getPrincipal())):
        $principal->setUrl_foto($principal->getPrincipal()['url_foto']);
        if (!empty($principal->getPrincipal()['url_foto']) && $principal->getPrincipal()['url_foto'] !== null):
            $img = $principal->eliminar_imagen();
        else:
            $img = true;
        endif;
        if ($img):
            if ($principal->eliminar_texto()):
                $error['titulo'] = "Éxito!";
                $error['mensaje'] = "Imagen eliminada del carousel correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "Imagen eliminada del carousel no ha podido ser eliminada";
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
// fin eliminar
    //fin carousel
    //texto presentacion
elseif (isset($_POST['id_texto']) &&
    !empty($_POST['id_texto']) &&
    isset($_POST['titulo_']) &&
    isset($_POST['descripcion_']) &&
    isset($_POST['actualizar_presentacion'])):

    $data = array();
    $imagen = "";
    $error = array();
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if (empty(trim($valor))):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $principal = new PrincipalM();
        $principal->setId_texto($data['id_texto']);
        $principal->mostrar_texto();
        if (!empty($principal->getPrincipal())):
            $principal->setTitulo_($data['titulo_']);
            $principal->setDescripcion_($data['descripcion_']);
            $principal->setCategoria("presentacion");
            $principal->setAlineacion_texto(null);
            $principal->setAnimacion(null);
            $principal->setColor_fondo(null);
            $principal->setColor_texto(null);
            $principal->setUrl_link(null);
            if ($principal->actualizar_texto()):
                $error['titulo'] = "Éxito!";
                $error['mensaje'] = "Texto presentación actualizado correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "Texto presentación pudo ser actualizado";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;

        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "El ID del titulo fue modificado";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;
//fin texto presentacion

//titulo destacado
elseif (isset($_POST['id_texto']) &&
    !empty($_POST['id_texto']) &&
    isset($_POST['titulo_']) &&
    isset($_POST['actualizar_titulo'])):

    $data = array();
    $imagen = "";
    $error = array();
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if (empty(trim($valor))):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $principal = new PrincipalM();
        $principal->setId_texto($data['id_texto']);
        $principal->mostrar_texto();
        if (!empty($principal->getPrincipal())):
            $principal->setTitulo_($data['titulo_']);
            $principal->setDescripcion_(null);
            $principal->setCategoria("destacado");
            $principal->setAlineacion_texto(null);
            $principal->setAnimacion(null);
            $principal->setColor_fondo(null);
            $principal->setColor_texto(null);
            $principal->setUrl_link(null);
            if ($principal->actualizar_texto()):
                $error['titulo'] = "Éxito!";
                $error['mensaje'] = "Titulo destacado actualizado correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "Titulo destacado pudo ser actualizado";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;

        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "El ID del titulo fue modificado";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;
//fin titulo destacado
    //tarjeta
    //modificar
elseif (isset($_POST['id_texto']) &&
    !empty($_POST['id_texto']) &&
    isset($_POST['titulo_']) &&
    isset($_POST['descripcion_']) &&
    isset($_POST['color_fondo']) &&
    isset($_POST['color_texto']) &&
    isset($_POST['url_link']) &&
    isset($_POST['actualizar_tarjeta'])):

    $data = array();
    $imagen = "";
    $error = array();
    foreach ($_POST as $indice => $valor):
        if (empty(trim($valor))):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name", date("Ymdhis") . "_tarjeta");
        $subir->__set("_dest", "../assets/images/");
        $subida = $subir->init($_FILES['imagen']);
        if (!empty($subida)):
            $error['imagen'] = $subida;
        else:
            $imagen = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
        endif;
    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $principal = new PrincipalM();
        $principal->setId_texto($data['id_texto']);
        $principal->mostrar_texto();
        if (!empty($principal->getPrincipal())):
            $principal->setTitulo_($data['titulo_']);
            $principal->setDescripcion_($data['descripcion_']);
            $principal->setCategoria("tarjeta");
            $principal->setAlineacion_texto(null);
            $principal->setAnimacion(null);
            $principal->setColor_fondo($data['color_fondo']);
            $principal->setColor_texto($data['color_texto']);
            $principal->setUrl_link($data['url_link']);
            if ($principal->actualizar_texto()):
                if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])):
                    $accion = "";
                    $principal->setUrl_foto($imagen);
                    if (!empty($principal->getPrincipal()['url_foto']) && $principal->getPrincipal()['url_foto'] !== null):
                        $nombre_imagen = basename(parse_url($principal->getPrincipal()['url_foto'])['path']);
                        unlink("../assets/images/" . $nombre_imagen);
                        $accion = "update";
                    else:
                        $accion = "insert";
                    endif;
                    $principal->agregar_imagen($accion);
                endif;
                $error['titulo'] = "Éxito!";
                $error['mensaje'] = "Tarjeta actualizada correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "Tarjeta no pudo ser actualizado";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;

        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "El id de la tarjeta fue modificado";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;
//fin modificar
    // fin tarjeta
//about
//modificar
    elseif (isset($_POST['id_texto']) &&
    !empty($_POST['id_texto']) &&
    isset($_POST['titulo_']) &&
    isset($_POST['descripcion_'])  &&
    isset($_POST['alineacion_texto'])  &&
    isset($_POST['actualizar_about'])):

    $data = array();
    $imagen = "";
    $error = array();
    foreach ($_POST as $indice => $valor):
        if (empty(trim($valor))):
            $valor = "Campo vacío, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name", date("Ymdhis") . "_about");
        $subir->__set("_dest", "../assets/images/");
        $subida = $subir->init($_FILES['imagen']);
        if (!empty($subida)):
            $error['imagen'] = $subida;
        else:
            $imagen = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
        endif;
    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $principal = new PrincipalM();
        $principal->setId_texto($data['id_texto']);
        $principal->mostrar_texto();
        if (!empty($principal->getPrincipal())):
            $principal->setTitulo_($data['titulo_']);
            $principal->setDescripcion_($data['descripcion_']);
            $principal->setCategoria("about");
            $principal->setAlineacion_texto($data['alineacion_texto']);
            $principal->setAnimacion(null);
            $principal->setColor_fondo(null);
            $principal->setColor_texto(null);
            $principal->setUrl_link(null);
            if ($principal->actualizar_texto()):
                if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])):
                    $accion = "";
                    $principal->setUrl_foto($imagen);
                    if (!empty($principal->getPrincipal()['url_foto']) && $principal->getPrincipal()['url_foto'] !== null):
                        $nombre_imagen = basename(parse_url($principal->getPrincipal()['url_foto'])['path']);
                        unlink("../assets/images/" . $nombre_imagen);
                        $accion = "update";
                    else:
                        $accion = "insert";
                    endif;
                    $principal->agregar_imagen($accion);
                endif;
                $error['titulo'] = "Éxito!";
                $error['mensaje'] = "Información actualizada correctamente.";
                $error['clase'] = "success";
                echo json_encode($error);
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "Información no pudo ser actualizado";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;

        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "El id fue modificado";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;
//fin modificar
//fin about
//listar home
elseif($pageName[0]=="index"):
    $carousel = array();
    $presentacion = array();
    $destacado = array();
    $tarjeta = array();

    $principal = new PrincipalM();
    $principal->setCategoria("carousel");
    $principal->mostrar_textos();
    if (!empty($principal->getPrincipal())):
        $carousel = $principal->getPrincipal();
    endif;
    $principal->setCategoria("presentacion");
    $principal->mostrar_textos();
    if (!empty($principal->getPrincipal())):
        $presentacion = $principal->getPrincipal();
    endif;
    $principal->setCategoria("destacado");
    $principal->mostrar_textos();
    if (!empty($principal->getPrincipal())):
        $destacado = $principal->getPrincipal();
    endif;
    $principal->setCategoria("tarjeta");
    $principal->mostrar_textos();
    if (!empty($principal->getPrincipal())):
        $tarjeta = $principal->getPrincipal();
    endif;

    $principal = array(
        "carousel" => $carousel,
        "presentacion" => $presentacion,
        "destacado" => $destacado,
        "tarjeta" => $tarjeta,
    );
//fin listar home
//listar about
elseif($pageName[0]=="about"):
    $nosotros = array();
    $principal = new PrincipalM();
    $principal->setCategoria("about");
    $principal->mostrar_textos();
    if (!empty($principal->getPrincipal())):
        $nosotros = $principal->getPrincipal();
    endif;

    $principal = array(
        "nosotros" => $nosotros
    );
//fin listar about
endif;
