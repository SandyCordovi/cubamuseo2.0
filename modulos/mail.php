<?php
//require '../lib/phpmeiler/PHPMailer.php';
//require '../lib/phpmeiler/Exception.php';
//require '../lib/phpmeiler/SMTP.php';
//
//
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
require '../lib/PHPMailer/PHPMailerAutoload.php';

class SendMail
{
    function  __construct()
    {
    }

    function EnviarContacto($body, $subject, $nombre,$templateMail)
    {

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = Configuracion::$host_contacto;
        $mail->SMTPAuth = true;
        $mail->Username = Configuracion::$username_contacto;
        $mail->Password = Configuracion::$password_contacto;
        $mail->SMTPSecure = 'tls';
        $mail->Port = Configuracion::$port_contacto;
        $mail->setFrom($subject, $nombre);
        $mail->addReplyTo($subject, $nombre);
        $mail->addAddress(Configuracion::$from_contacto);
        $message = $templateMail;
        $message = str_replace('{{first_name}}', $nombre, $message);
        $message = str_replace('{{message}}', $body, $message);
        $message = str_replace('{{customer_email}}', $body, $message);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->msgHTML($message);
        if(!$mail->send()) {
            echo '<p style="color:red">No se pudo enviar el mensaje..';
            echo 'Error de correo: ' . $mail->ErrorInfo."</p>";
        } else {
            echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
        }


    }

    function EnviarVPost($body, $subject, $email)
    {
        try {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = Configuracion::$host_contacto;
            $mail->Port =  Configuracion::$port_contacto;
            $mail->Username =  Configuracion::$username_contacto;
            $mail->Password =  Configuracion::$password_contacto;
            $mail->From =  Configuracion::$from_contacto;
            $mail->FromName =  Configuracion::$fromName_contato;

            $mail->Subject = $subject;
            $mail->AltBody = $subject;
            $mail->CharSet = 'UTF-8';
            //$mail->Body = $body;
            $mail->MsgHTML($body);
            $mail->AddAddress($email);
            $mail->IsHTML(true);

            if(!$mail->Send())
            {
              return false;
            }
            return true;
        }
        catch (Exception $exc) {
            return false;
        }
    }
}

?>