<?php
// Fichero y nuevo tamaño
$pauta = 0; $propo = 1;
$seccion = utf8_decode($_GET['s']);
$categoria = utf8_decode($_GET['c']);
$imagen = $_GET['i'];
$nombre_fichero = '../imagenes/'.$seccion.'/'.$categoria.'/'.$imagen;

if(isset ($_GET['p']) && $_GET['p'])
{
    $pauta = $_GET['p'];
}

// Tipo de contenido
header('Content-Type: image/jpeg');

// Obtener los nuevos tamaños
$t = getimagesize($nombre_fichero);
$ancho = $t[0];
$alto = $t[1];
$outputType = $t['mime'];


if($pauta==0)
{
    $origen = imagecreatefromjpeg($nombre_fichero);
    switch ($outputType){
        case "image/jpeg":
            imagejpeg($origen, null, 100);
            break;
        case "image/gif":
            imagegif($origen, null, 100);
            break;
        case "image/png":
            imagepng($origen, null, 100);
            break;
    }
    return;
}

if($pauta<0)$pauta=85;

if($ancho>$alto)
{
    $propo = $pauta/$ancho;
}
else{
    $propo = $pauta/$alto;
}

$nuevo_ancho = $ancho * $propo;
$nuevo_alto = $alto * $propo;

// Cargar
$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
$origen = imagecreatefromjpeg($nombre_fichero);

// Cambiar el tamaño
imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
// Imprimir
switch ($outputType){
    case "image/jpeg":
        imagejpeg($thumb, null, 100);
        break;
    case "image/gif":
        imagegif($thumb, null, 100);
        break;
    case "image/png":
        imagepng($thumb, null, 100);
        break;
}
?>