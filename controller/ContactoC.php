<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
//require_once($ruta_raiz . '/model/ContactoM.php');
//Dentro de Controlador

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require $ruta_raiz . '/assets/vendor/phpmailer/src/Exception.php';
require $ruta_raiz . '/assets/vendor/phpmailer/src/PHPMailer.php';
require $ruta_raiz . '/assets/vendor/phpmailer/src/SMTP.php';


$name_error = $email_error = $asunto_error = $message_error = "";
$name = $email = $asunto = $message = $success = "";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['asunto']) && isset($_POST['message'])) {

    if (empty($_POST["name"])) {
        $name_error = "Complete nombre";
      } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
          $name_error = "Solo letras"; 
        }
      }

      if (empty($_POST["email"])) {
        $email_error = "Complete email";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_error = "Formato incorrecto"; 
        }
      }

      if ($_POST["asunto"]==="asunto") {
        $asunto_error = "Selecione un asunto";
      } else {
        $asunto = test_input($_POST["asunto"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$asunto)) {
          $asunto_error = "Solo letras"; 
        }else{
            switch($asunto){
                case "integracion": $asunto = "Integración al Sindicato";
                                    break;
                case "reclamo": $asunto = "Reclamo";
                                break;
                case "sugerencia":  $asunto = "Sugerencia";
                                    break;          
                case "felicitacion": $asunto = "Felicitaciones";
                                     break;          
                default: $asunto_error = "Selecione un asunto";
                            break;
            }
        }
      }

      if (empty($_POST["message"])){
        $message_error = "Escriba un mensaje";
      } else {
          $message = test_input($_POST["message"]);
      }

      if ($name_error == '' and $email_error == '' and $asunto_error == '' and $message_error == ''){
        $body = '<!DOCTYPE html>
        <html>
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <style type="text/css">
                body {
                    margin: 0;
                    padding: 0;
                    min-width: 100% !important;
                    text-align: justify;
                }
        
                img {
                    height: auto;
                }
        
                .content {
                    width: 100%;
                    max-width: 600px;
                }
        
        
                .header {
                    padding: 20px;
                    font-weight: bold;
                    font-family: Sans-serif;
                    font-size: 25px;
                    border-bottom: 1px solid #f2eeed;
                }
        
                .innerpadding {
                    padding: 30px 30px 30px 30px;
                }
        
                .innerpadding2 {
                    padding: 20px;
                }
        
                .borderbottom {
                    border-bottom: 1px solid #f2eeed;
                }
        
                .subhead {
                    font-size: 15px;
                    color: #ffffff;
                    font-family: sans-serif;
                    letter-spacing: 10px;
                }
        
                .h1,
                .h2,
                .bodycopy {
                    color: #153643;
                    font-family: sans-serif;
                }
        
                .h1 {
                    font-size: 33px;
                    line-height: 38px;
                    font-weight: bold;
                }
        
                .h2 {
                    padding: 0 0 15px 0;
                    font-size: 20px;
                    line-height: 24px;
                    font-weight: bold;
                }
        
                .bodycopy {
                    font-size: 16px;
                    line-height: 22px;
                }
        
                .button {
                    text-align: center;
                    font-size: 18px;
                    font-family: sans-serif;
                    font-weight: bold;
        
                }
        
                .button a {
                    display: block;
                    padding: 10px 0;
                    margin-top: 20px;
                    background: #5f86e8;
                    color: #ffffff;
                    text-decoration: none;
                    width: 100%;
                }
        
                .footer {
                    padding: 20px 30px 15px 30px;
                }
        
                .footercopy {
                    font-family: sans-serif;
                    font-size: 14px;
                    color: #8e8e8e;
                }
        
                .footer a {
                    color: #8e8e8e;
                    text-decoration: none;
                }
        
                .label {
                    width: 100%;
                    padding: 10px 0;
                }
        
                .input {
                    border: 1px solid #f2eeed;
                    height: 30px;
                    width: 100%;
                    padding: 5px 20px;
                }
        
                .bordeSuperior {
                    border-top: 10px solid #5f86e8;
                }
        
                @media only screen and (max-width: 550px),
                screen and (max-device-width: 550px) {
                    body[yahoo] .hide {
                        display: none !important;
                    }
        
                    body[yahoo] .buttonwrapper {
                        background-color: transparent !important;
                    }
        
                    body[yahoo] .button {
                        padding: 0px !important;
                    }
        
                    body[yahoo] .button a {
                        background-color: #e05443;
                        padding: 15px 15px 13px !important;
                    }
                }
            </style>
        </head>
        
        <body yahoo bgcolor="#ededed">
            <table width="100%" bgcolor="#ededed" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td bgcolor="#ededed" class="header">
                                    <table width="70" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="50">
                                            <td>
                                                <font color="#5f86e8">SINABRINKS</font>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="bordeSuperior innerpadding borderbottom">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="h2">
                                                '.$name.' se ha comunicado a través de la página web.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bodycopy" style="text-align: justify;">
                                                El asunto del mensaje es "'.$asunto.'".
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                    <td class=" innerpadding borderbottom">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="bodycopy" style="text-align: justify;">
                                                    <b>Mensaje: </b> '.$message.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bodycopy" style="text-align: justify;">
                                                    <b>Responder a: </b> '.$email.'
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <tr>
                                <td class="innerpadding bodycopy" style="text-align: justify;">
                                    Este correo fue generado de manera automática, agradecemos no responder al remitente que
                                    aparece en este mensaje.
                                </td>
                            </tr>
                            <tr>
                                <td class="footer" bgcolor="#ededed">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" class="footercopy" style="text-align: center;">
                                                Hecho por BBCHSOLUCIONES 2018. Todos los derechos reservados
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding: 20px 0 0 0;">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                            <a href="http://www.facebook.com/">
                                                                Facebook
                                                            </a>
                                                        </td>
                                                        <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                            <a href="http://www.twitter.com/">
                                                                Twitter
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        
        </html>';
            //unset($_POST['submit']);
            /* foreach ($_POST as $key => $value) {
                $message_body .= "$key: $value\n";
            }   */
            //
            $name = $email = $phone = $message = $url = '';
            
            //
            /* if (mail($to, $subject, $message_body)){
                $success = "Message sent, thank you for contacting us!";
                //reset form values to empty strings
                $name = $email = $phone = $message = $url = '';
            } */

            //
            $mail = new PHPMailer(true); // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0; // Enable verbose debug output
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = "mail.sinabrinks.cl"; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = "no-reply@sinabrinks.cl"; // SMTP username
                $mail->Password = "Santiago2018"; // SMTP password
                $mail->SMTPSecure = "ssl"; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465; // TCP port to connect to

                //Recipients
                $mail->setFrom("no-reply@sinabrinks.cl", "no-reply@sinabrinks.cl");
                //$mail->setFrom('bbchsoluciones@gmail.com');
                //$mail->addAddress($destinatario, $destinatario);     // Add a recipient
                $mail->addAddress("braulio.briones@gmail.com"); // Add a recipient
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $asunto.' (Fomulario)';
                $mail->Body = $body;
                if ($mail->send()):
                    $success = "Mensaje enviado correctamente";
                    echo "true";
                else:
                    $success = "Ha ocurrido un error, intente nuevamente";
                    echo "false";
                endif;

                //echo 'Message has been sent';
            } catch (Exception $e) {
                //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

            }
            //
}
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


