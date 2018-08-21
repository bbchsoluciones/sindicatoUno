<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/TrabajadorM.php');
require_once($ruta_raiz . '/model/subirImagenM.php');
require_once($ruta_raiz . '/model/FotoPerfilM.php');
require_once('EncriptadorC.php');
//MOSTRAR TRABAJORES CON/SIN FILTROS
$error = array();
$data = array();
$opcionales = array("email_trabajador","telefono_trabajador");

if(isset($_GET['accion']) && !empty($_GET['accion'])):
    $trabajador = new TrabajadorM();
    $objeto = $_GET['objeto'];
    if($_GET['accion']==="buscar" && ctype_digit(clean($_GET['objeto']))==true ):
        $objeto = clean($_GET['objeto']);
    endif;
    $trabajador->filtrarTrabajadores($_GET['accion'],$objeto,$_GET['pagina'],$_GET['r_pagina']);
    if (!empty($trabajador->getTrabajadores())):
        $trabajadores = array(
            "trabajador" => array(
                $trabajador->getTrabajadores()
            ),
            "cantidad_total" => array(
                $trabajador->getCantidad_trabajadores()
            ),
            "accion" => array(
                "valor" => $_GET['accion']
            ),
            "objeto" => array(
                "valor" => $objeto
            ),
        );
        echo json_encode($trabajadores);
    else:
        $error['titulo'] = "No se han encontrado registros.";
        echo json_encode($error);
    endif;
// FIN MOSTRAR TRABAJORES CON/SIN FILTROS

// MOSTRAR DATOS DEL TRABAJADOR
elseif(isset($_GET['run_trabajador']) && !empty($_GET['run_trabajador']) && isset($_GET['detalle'])):

    $trabajador = new TrabajadorM();
    $rut = clean($_GET['run_trabajador']);
    if(ctype_digit($rut)):
        $trabajador->setRun_trabajador($rut);
        $trabajador->mostrar_datos_trabajador();
        if (!empty($trabajador->getTrabajador())):
            $trabajadores = array(
                "trabajador" => array(
                    $trabajador->getTrabajador()
                )
            );
            echo json_encode($trabajadores);
        else:
            $error['titulo'] = "Se ha producido un error.";
            echo json_encode($error);
        endif;
    else:
        $error['titulo'] = "No se han encontrado registros.";
        echo json_encode($error);
    endif;
// FIN MOSTRAR DATOS DEL TRABAJADOR

// REGISTRAR TRABAJADOR 
elseif(isset($_POST['tipo_usuario']) &&
    isset($_POST['nombres_trabajador']) &&
    isset($_POST['apellidos_trabajador']) &&
    isset($_POST['contrasena_trabajador']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['registrar'])):

    foreach($_POST as $indice => $valor):
        if($indice == 'run_trabajador' && esRut($valor)==false):
                $valor = "Rut invalido";
                $error[$indice] = $valor;
            endif;
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
        $data['run_trabajador'] = clean($data['run_trabajador']);
        $encriptador = new EncriptadorC($data['contrasena_trabajador']);
        $data['contrasena_trabajador']= $encriptador->getClave(); 
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($data['run_trabajador']);
        $trabajador->setNombres_trabajador($data['nombres_trabajador']);
        $trabajador->setApellidos_trabajador($data['apellidos_trabajador']);
        $trabajador->setContrasena_trabajador($data['contrasena_trabajador']);
        $trabajador->setTipo_usuario_id_tipo_usuario($data['tipo_usuario']);
        if($trabajador->registrar_trabajador()):
            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Información registrada correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        else:
            $error['titulo'] = "Oops hubo un error!";
            $error['mensaje'] = "El rut ingresado ya existe.";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif; 
    endif;
// FIN REGISTRAR TRABAJADOR

// MODIFICAR TRABAJADOR
elseif(isset($_POST['tipo_usuario']) &&
    isset($_POST['email_trabajador']) &&
    isset($_POST['nombres_trabajador']) &&
    isset($_POST['apellidos_trabajador']) &&
    isset($_POST['nombre_cargo']) &&
    isset($_POST['nombre_subcargo']) &&
    isset($_POST['contrasena_trabajador']) &&
    isset($_POST['vcontrasena_trabajador']) &&
    isset($_POST['direccion_trabajador']) &&
    isset($_POST['nombre_comuna']) &&
    isset($_POST['fec_nac_trabajador']) &&
    isset($_POST['genero_trabajador']) &&
    isset($_POST['estado_civil_trabajador']) &&
    isset($_POST['fec_ing_emp_trabajador']) &&
    isset($_POST['fec_ing_sin_trabajador']) &&
    isset($_POST['estado_trabajador']) &&
    isset($_POST['telefono_trabajador']) &&
    isset($_POST['celular_trabajador']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['actualizar'])):

    $imagen = "";
        foreach($_POST as $indice => $valor):
            if(strpos($indice, 'fec')!==false):
                $date = clean($valor);
                if(is_numeric($date)):
                    if(strpos($valor, '-')):
                        $valor = str_replace("-","/",$valor);
                    endif;
                    $fecha = explode("/", $valor);
                    if(checkdate($fecha[1],$fecha[0],$fecha[2])):
                        try{
                            $valor = DateTime::createFromFormat('d/m/Y', $valor);
                            $valor = $valor->format('Y-m-d');
                        }catch(Exception $e){
                            $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                            $error[$indice] = $valor;
                        } 
                    else:
                        $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                        $error[$indice] = $valor;
                    endif;
                    
                else:
                    $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                    $error[$indice] = $valor;
                endif;
            elseif($indice === 'run_trabajador'):
                $valor = clean($valor);
            endif;
            if(empty(trim($valor)) && $indice!=="estado_trabajador"):
                $valor = "Campo vació, favor completar";
                $error[$indice] = $valor;
            endif;
            $data[$indice]= utf8_decode(htmlspecialchars($valor));
        endforeach;

    if(array_key_exists('contrasena_trabajador', $error) && array_key_exists('vcontrasena_trabajador', $error)):
        $data['contrasena_trabajador']="nula";
        $data['vcontrasena_trabajador']="nula";
        unset($error['contrasena_trabajador']);
        unset($error['vcontrasena_trabajador']);
        
        elseif($data['contrasena_trabajador']!==$data['vcontrasena_trabajador']):
            $error['contrasena_trabajador']="Contraseñas no coinciden";
            $error['vcontrasena_trabajador']="Contraseñas no coinciden";
            elseif($data['contrasena_trabajador']==$data['vcontrasena_trabajador'] &&
                    array_key_exists('contrasena_trabajador', $error)==false && array_key_exists('vcontrasena_trabajador', $error)==false ):
                    $encriptador = new EncriptadorC($data['contrasena_trabajador']);
                    $data['contrasena_trabajador']= $encriptador->getClave(); 
    endif;

    //validación placa vigilante
    if($data['nombre_cargo']=="3" && ctype_digit($data['placa_trabajador']) == false 
            || $data['nombre_cargo']=="3" && empty($data['placa_trabajador'])):
                $error['placa_trabajador']="Formato incorrecto o vacío";
        elseif($data['nombre_cargo']!=="3"):
                    $data['placa_trabajador']="";
    endif;

    //validación email
    if(!filter_var($data['email_trabajador'], FILTER_VALIDATE_EMAIL)):
        $error['email_trabajador']="Correo invalido!";
    endif;

    if(count($error)>0):
       $error['titulo'] = "Ha ocurrido un error!";
       $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
       $error['clase'] = "danger";
       echo json_encode($error);
    else:

        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($data['run_trabajador']);
        $trabajador->setTipo_usuario_id_tipo_usuario($data['tipo_usuario']);
        $trabajador->setEmail_trabajador($data['email_trabajador']);
        $trabajador->setNombres_trabajador($data['nombres_trabajador']); 
        $trabajador->setApellidos_trabajador($data['apellidos_trabajador']);
        $trabajador->setSub_cargo_id_sub_cargo($data['nombre_subcargo']);
        $trabajador->setContrasena_trabajador($data['contrasena_trabajador']);
        $trabajador->setDireccion_trabajador($data['direccion_trabajador']);
        $trabajador->setComuna_id_comuna($data['nombre_comuna']);
        $trabajador->setFec_nac_trabajador($data['fec_nac_trabajador']);
        $trabajador->setPlaca_trabajador($data['placa_trabajador']);
        $trabajador->setGenero_trabajador($data['genero_trabajador']);
        $trabajador->setEstado_civil_trabajador($data['estado_civil_trabajador']);
        $trabajador->setFec_ing_emp_trabajador($data['fec_ing_emp_trabajador']);
        $trabajador->setFec_ing_sin_trabajador($data['fec_ing_sin_trabajador']);
        $trabajador->setEstado_trabajador_id_estado_trabajador($data['estado_trabajador']);
        $trabajador->setTelefono_trabajador($data['telefono_trabajador']);
        $trabajador->setCelular_trabajador($data['celular_trabajador']);
        if(isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])):
            $foto = new FotoPerfilM();
            $subir = new imgUpldr;
            $imagen = $subir->init($_FILES['avatar']); 
            $existT = $trabajador->encontrar_trabajador();
            $existI = $trabajador->encontrarTconImagen();
            $accion = "";
            if($existT==false):
                $data['run_trabajador']="No debe modificar el run_trabajador!";
            elseif($existI==false):
                $accion = "insert";
            elseif($existI==true):
                $accion = "update";
            endif;
            if(empty($imagen) && !empty($accion)):
                $avatar = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
                $foto->setUrl_foto_perfil($avatar);
                $foto->modificarFotoPerfil($accion, $data['run_trabajador']);
            else:
                $error['avatar'] = $imagen;
            endif;

        endif;
        if($trabajador->actualizar_trabajador()):
            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Información actualiza correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        endif; 
    endif;
// FIN MODIFICAR TRABAJADOR

// ELIMINAR TRABAJADOR

elseif(isset($_GET['run_trabajador']) && !empty($_GET['run_trabajador']) 
    && 
    isset($_GET['eliminar']) && $_GET['eliminar']===1):

    $trabajador = new TrabajadorM();
    $eliminado = array();
    $rut = htmlspecialchars($_GET['run_trabajador']);
    $rut = clean($rut);
    $trabajador->setRun_trabajador($rut);
    $existT = $trabajador->encontrar_trabajador();
    if ($existT==true):
        if($trabajador->eliminar_trabajador()):
            $eliminado['titulo'] = "Éxito!";
            $eliminado['mensaje'] = "usuario eliminado satisfactoriamente.";
            $eliminado['clase'] = "success";
            echo json_encode($eliminado);
        else:
            $eliminado['titulo'] = "Oops!";
            $eliminado['mensaje'] = "el usuario no ha podido ser eliminado.";
            $eliminado['clase'] = "danger";
            echo json_encode($eliminado);
        endif;

    else:
        echo "trabajador no existe";
    endif;
// FIN ELIMINAR TRABAJADOR
endif;
function clean($string) {
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function esRut($r = false){
    if((!$r) or (is_array($r)))
        return false; /* Hace falta el rut */
 
    if(!$r = preg_replace('|[^0-9kK]|i', '', $r))
        return false; /* Era código basura */
 
    if(!((strlen($r) == 8) or (strlen($r) == 9)))
        return false; /* La cantidad de carácteres no es válida. */
 
    $v = strtoupper(substr($r, -1));
    if(!$r = substr($r, 0, -1))
        return false;
 
    if(!((int)$r > 0))
        return false; /* No es un valor numérico */
 
    $x = 2; $s = 0;
    for($i = (strlen($r) - 1); $i >= 0; $i--){
        if($x > 7)
            $x = 2;
        $s += ($r[$i] * $x);
        $x++;
    }
    $dv=11-($s % 11);
    if($dv == 10)
        $dv = 'K';
    if($dv == 11)
        $dv = '0';
    if($dv == $v)
        return number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
    return false;
}