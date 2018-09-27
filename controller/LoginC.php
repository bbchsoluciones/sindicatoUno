<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/TrabajadorM.php');
//Dentro de Controlador

if(isset($_POST['user']) && isset($_POST['pass'])):
    $user = htmlspecialchars($_POST['user']);
    $pass = htmlspecialchars($_POST['pass']);
    $error = array();
    $t = new TrabajadorM();
    $t->setRun_trabajador($user);
    if($t->encontrar_trabajador()):
        //Trabajador existe   
        $t->login();             
        if(password_verify($pass, $t->getTrabajador()['contrasena_trabajador'])):
            //iniciar sesion
            //session_start();
            //verificar perfil
            if($t->getTrabajador()['tipo_usuario_id_tipo_usuario'] == 0):
                //SuperAdmin
                //$_SESSION['tipo_usuario'] = 0;
                //$_SESSION['run_trabajador'] = $t->getTrabajador()['run_trabajador'];
                //header("Location: ../view/intranet/superadmin/index.php");
                header("Location: ../view/public/login.php");
                //echo "SuperAdmin";
            elseif($t->getTrabajador()['tipo_usuario_id_tipo_usuario'] == 1):
                //Admin   
                session_start();             
                $_SESSION['tipo_usuario'] = 1;
                $_SESSION['run_trabajador'] = $t->getTrabajador()['run_trabajador'];
                header("Location: ../view/intranet/admin/index.php");
                //echo "Administrador";    
            elseif($t->getTrabajador()['tipo_usuario_id_tipo_usuario'] == 2):
                //User
                session_start();
                $_SESSION['tipo_usuario'] = 2;
                $_SESSION['run_trabajador'] = $t->getTrabajador()['run_trabajador'];
                header("Location: ../view/intranet/user/index.php");     
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
    //user y pass vacios
    echo "Campos vacíos";
    //header("Location: ../view/public/login.php");
endif;