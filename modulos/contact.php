<?php
include '../configuracion.php';
include '../tool.php';
include '../lib/mail/class.phpmailer.php';
include '../lib/mail/class.smtp.php';
include '../modulos/mail.php';

$name = $_POST['name'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$msg = $_POST['msg'];
$lang = $_POST['lang'];

$body = '<p>El cliente '.$name.'('.$email.') ha enviado el siguiente mensage de contacto:</p><br>';
$body .= '<p>'.$asunto.'</p><br>';
$body .= '<p>'.$msg.'</p><br>';

$mail = new SendMail();
if($mail->EnviarContacto($body, 'Cuinfinity-Contacto'))echo '<script>window.location="../contact-6"</script>';
else echo '<script>window.location="../contact'.$lang.'-7"</script>';



?>
