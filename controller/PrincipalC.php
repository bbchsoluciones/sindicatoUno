<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/PrincipalM.php';
require_once $ruta_raiz . '/model/upload/class.upload.php';
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
        $handle = new upload($_FILES['imagen'], 'es_ES');
        if ($handle->uploaded):
            $handle->file_new_name_body = date("Ymdhis") . "_carousel";
            $handle->image_resize = true;
            $handle->image_x = 1280;
            $handle->image_ratio_y = true;
            $handle->file_max_size = 200000000;
            $handle->process('../assets/images/');
            if ($handle->processed):
                $imagen = "http://localhost/sindicatoUno/assets/images/" . $handle->file_dst_name;
                $handle->clean();
            endif;
        else:
            $error['imagen'] = $handle->error . " " . ini_get('upload_max_filesize');
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
        $handle = new upload($_FILES['imagen'], 'es_ES');
        if ($handle->uploaded):
            $handle->file_new_name_body = date("Ymdhis") . "_carousel";
            $handle->image_resize = true;
            $handle->image_x = 1280;
            $handle->image_ratio_y = true;
            $handle->file_max_size = 200000000;
            $handle->process('../assets/images/');
            if ($handle->processed):
                $imagen = "http://localhost/sindicatoUno/assets/images/" . $handle->file_dst_name;
                $handle->clean();
            endif;
        else:
            $error['imagen'] = $handle->error . " " . ini_get('upload_max_filesize');
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

endif;
