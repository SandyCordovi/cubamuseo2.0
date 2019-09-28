<?php
session_start();
include '../../configuracion.php';
include '../../tool.php';
include '../../lib/maillv/PHPMailerAutoload.php';
include '../../modulos/mail.php';


$pemail = $_POST['pemail'];
$pnombre = $_POST['pnombre'];
$demail = $_POST['demail'];
$dnombre = $_POST['dnombre'];
$msg = $_POST['msg'];
$url = configuracion::$site. $_POST['url'];

if(!trim($pemail) || !trim($pnombre) || !trim($demail) || !trim($dnombre))
{
    $jsondata['salida']=array('type'=>"1", 'msg'=> 'Verifique que todos los datos sean correctos.', 'action'=>'Volver a intentarlo');
    echo json_encode($jsondata);
}
else{
    $body = '<p>'.$dnombre .'('.$demail.') le ha enviado una postal.</p><br>';
    $body .= '<img src="'.$url.'" /><br>';
    $body .= '<p>'.$msg .'</p>';

    $send = new SendMail();
    $mail = $send->EnviarVPost($body, "Le han enviado una postal!!!!", $pemail);
    
    if (!$mail) {
        $jsondata['salida']=array('type'=>"1", 'msg'=> 'Ha ocurrido un error. Intentelo de nuevo. Gracias', 'action'=>'Volver a intentarlo');
        echo json_encode($jsondata);
    }
    else
    {
        $jsondata['salida']=array('type'=>"0", 'msg'=> 'Su postal ha sido envia correctamente.', 'action'=>'Enviar esta postal a otro amigo');
        echo json_encode($jsondata);
    }
}

?>
