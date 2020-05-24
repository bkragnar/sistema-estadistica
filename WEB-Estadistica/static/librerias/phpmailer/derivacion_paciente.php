<?php 
require_once ("vendor/autoload.php"); 

//require ("../../ctrl/config/connection_usuarios.php");


$para = "omar.claude@redsalud.gov.cl";
//$para = $usuario_correo;

$mensaje = "<h3>Derivación Paciente</h3>";
$mensaje .= "Paciente derivado con éxito";
$mensaje .= "<br><br><br>Servicio Salud Coquimbo";
$mensaje .= "<br><br><p style='font-size:10px'>No responda a este Correo. Mensaje generado automaticamente por DSSC.</p>";

/* Start to develop here. Best regards https://php-download.com/ */
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

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
    $mail->Subject = "[DSSC] - Derivación paciente";
    $mail->Body    = $mensaje;
    $mail->AltBody = ''; // Alternative body message without HTML codes or CSS styles (plain text)

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}