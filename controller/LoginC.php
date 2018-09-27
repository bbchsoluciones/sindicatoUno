<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/TrabajadorM.php';
//Dentro de Controlador
if (isset($_POST['run_trabajador']) && isset($_POST['contrasena_trabajador'])):
    $user = clean(htmlspecialchars($_POST['run_trabajador']));
    $pass = htmlspecialchars($_POST['contrasena_trabajador']);
    $error = array();
    $t = new TrabajadorM();
    $t->setRun_trabajador($user);
    if (!empty($user) && !empty($pass)):
        if ($t->encontrar_trabajador()):
            //Trabajador existe
            $t->login();
            if (password_verify($pass, $t->getTrabajador()['contrasena_trabajador'])):
                //iniciar sesion
                //session_start();
                //verificar perfil
                if ($t->getTrabajador()['tipo_usuario_id_tipo_usuario'] == 0):
                    //SuperAdmin
                    //$_SESSION['tipo_usuario'] = 0;
                    //$_SESSION['run_trabajador'] = $t->getTrabajador()['run_trabajador'];
                    //header("Location: ../view/intranet/superadmin/index.php");
                    $error['pagina'] = "http://localhost/sindicatoUno/view/public/login.php";
                    //echo "SuperAdmin";
                elseif ($t->getTrabajador()['tipo_usuario_id_tipo_usuario'] == 1):
                    //Admin
                    session_start();
                    $_SESSION['tipo_usuario'] = 1;
                    $_SESSION['run_trabajador'] = $t->getTrabajador()['run_trabajador'];
                    $error['pagina'] = "http://localhost/sindicatoUno/view/intranet/admin/index.php";
                    //echo "Administrador";
                elseif ($t->getTrabajador()['tipo_usuario_id_tipo_usuario'] == 2):
                    //User
                    session_start();
                    $_SESSION['tipo_usuario'] = 2;
                    $_SESSION['run_trabajador'] = $t->getTrabajador()['run_trabajador'];
                    $error['pagina'] = "http://localhost/sindicatoUno/view/intranet/user/index.php";
                    //echo "Usuario";
                endif;
            else:
                $error['titulo'] = "Oops, hubo un error!";
                $error['mensaje'] = "Contraseña incorrecta";
                $error['clase'] = "danger";
            endif;
        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "Usuario no registrado";
            $error['clase'] = "danger";
        endif;
        echo json_encode($error);
    else:
        $error['titulo'] = "Oops, hubo un error!";
        $error['mensaje'] = "Campo(s) vacío(s)";
        $error['clase'] = "danger";
        echo json_encode($error);
    endif;
endif;
function clean($string)
{
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
