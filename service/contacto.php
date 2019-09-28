<?php
session_start();
echo '1';
include '../configuracion.php';
//require '../lib/maillv/PHPMailerAutoload.php';
include '../modulos/mail.php';
include '../modulos/lang.php';

echo '2';

$name = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

echo '3';

$send = new SendMail();
$templateMail = file_get_contents('email_template.html');
echo '4';

echo $send->EnviarContacto($mensaje, $email, $name,$templateMail);

echo '5';

?>