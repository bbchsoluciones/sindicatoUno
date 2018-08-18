<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$run_trabajadora_raiz = dirname(dirname(__FILE__));
require_once($run_trabajadora_raiz . '/model/TrabajadorM.php');
require_once($run_trabajadora_raiz . '/model/subirImagenM.php');
require_once($run_trabajadora_raiz . '/model/FotoPerfilM.php');
require_once('EncriptadorC.php');
//Dentro de Controlador
if(isset($_POST['tipo_usuario']) &&
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
    isset($_POST['run_trabajador'])):

    $data = array();
    $imagen = "";
    $error = array();
    //limpiar registros de array para luego pasarlos a uno nuevo
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
    
        elseif(strpos($valor, '...')!==false):
            $valor = "Campo vació, favor completar";
            $error[$indice] = $valor;
        elseif($indice === 'run_trabajador'):
            $valor = clean($valor);
        endif;
        if(empty(trim($valor)) && $valor!=='0' && $indice!=="telefono_trabajador"):
            $valor = "Campo vació, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice]= utf8_decode(htmlspecialchars($valor));
    endforeach;



    //validación e encriptación de contraseña
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

// Listo:
//validar que placa solo sea ingresada cuando el cargo es id=3 (vigilante) ✔
//validar que ambas contraseñas sean iguales ✔
//encriptar contraseña ✔
//validar que si no ingresan contraseña, esta no se actualice ✔
//lo mismo de arriba pero para el numero de placa ✔
//agregar excepcion en caso de que la fecha no sea correcta ✔
//validar email ✔
//subir y validar imagen  ✔
//problema principal (involucra todo el sistema), error con la codificación utf-8 y ajax ✔
//guardar los errores en otra columna contenida por el array data o crear un nuevo array ✔

//por hacer:



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

else:

    echo "Ha ocurrido un error inesperado";
    
endif;
function clean($string) 
{
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

?>
