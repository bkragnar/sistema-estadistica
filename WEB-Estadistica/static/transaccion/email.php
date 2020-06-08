<?php
require_once("../librerias/phpmailer/vendor/autoload.php");

$tipo_email = $_POST['var'];

/* Start to develop here. Best regards https://php-download.com/ */
// Import PHPMailer classes into the global namespace

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

if ($tipo_email == "nuevo") {
    $nombre_usu = $_POST['nombre_usuario'];
    $apellido_usu = $_POST['apellido_usuario'];
    $correo_usu = $_POST['email_usuario'];
    $usuario_usu = $_POST['usu_usuario'];
    $pass_usu = $_POST['pass_usuario'];
    $privilegio_usu = $_POST['privilegio_usuario'];
    $estable_usu = $_POST['estable_usuario'];
    $fecha_usu = date("Y-m-d");


    $para = $correo_usu;
    $mensaje = "<h3>Credenciales de acceso a sistema S.I.M.E.</h3>";
    $mensaje .= "Hola $nombre_usu $apellido_usu!, sus credenciales de acceso al sistema SIME son las siguientes: <br><br>";
    $mensaje .= "Usuario: </b>$usuario_usu</b> <br><br>";
    $mensaje .= "Contraseña: </b>$pass_usu</b> <br><br>";
    $mensaje .= "<br><br><br>Servicio Salud Coquimbo";
    $mensaje .= "<br><br><p style='font-size:10px'>No responda a este Correo. Mensaje generado automaticamente por sistema SIME SSCQ.</p>";

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.minsal.cl';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'soporte.dssc@redsalud.gov.cl';     // SMTP username
        $mail->Password = 'Minsal.281118';                    // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('soporte.dssc@redsalud.gov.cl', 'Servicio Salud Coquimbo');
        $mail->addAddress($para);      // Add a recipient
        //$mail->addAddress($para2);               // Name is optional
        $mail->addReplyTo('soporte.dssc@redsalud.gov.cl', 'Soporte SSC');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "[DSSC] - Cambio de clave";
        $mail->Body    = $mensaje;
        $mail->AltBody = ''; // Alternative body message without HTML codes or CSS styles (plain text)

        $mail->send();
        echo 1;
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo 0;
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
} else {
    $id_usu = $_POST['id_usuario'];
    $nombre_usu = $_POST['nombre_usuario_up'];
    $apellido_usu = $_POST['apellido_usuario_up'];
    $correo_usu = $_POST['email_usuario_up'];
    $usuario_usu = $_POST['usu_usuario_up'];
    $pass_usu = $_POST['pass_usuario_up'];
    $privilegio_usu = $_POST['privilegio_usuario_up'];
    $estable_usu = $_POST['estable_usuario_up'];

    $para = $correo_usu;

    $mensaje = "<h3>Credenciales de acceso a sistema S.I.M.E.</h3>";
    $mensaje .= "Hola $nombre_usu $apellido_usu!, sus credenciales de acceso o datos personales en sistema S.I.M.E., han sido actualizados: <br><br>";
    $mensaje .= "Usuario: </b>$usuario_usu</b> <br><br>";
    $mensaje .= "Contraseña: </b>$pass_usu</b> <br><br>";
    $mensaje .= "<br><br><br>Servicio Salud Coquimbo";
    $mensaje .= "<br><br><p style='font-size:10px'>No responda a este Correo. Mensaje generado automaticamente por sistema SIME SSCQ.</p>";

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.minsal.cl';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'soporte.dssc@redsalud.gov.cl';     // SMTP username
        $mail->Password = 'Minsal.281118';                    // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('soporte.dssc@redsalud.gov.cl', 'Servicio Salud Coquimbo');
        $mail->addAddress($para);      // Add a recipient
        //$mail->addAddress($para2);               // Name is optional
        $mail->addReplyTo('soporte.dssc@redsalud.gov.cl', 'Soporte SSC');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "[DSSC] - Cambio de clave";
        $mail->Body    = $mensaje;
        $mail->AltBody = ''; // Alternative body message without HTML codes or CSS styles (plain text)

        $mail->send();
        echo 1;
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo 0;
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
