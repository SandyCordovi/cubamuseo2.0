<?php
// Fichero y nuevo tamaño
$pauta = 0; $propo = 1;
$seccion = $_GET['s'];
$categoria = $_GET['c'];
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


$font = '../lib/font/'.$_GET['font'].'.ttf';
$font_size = $_GET['font_size'];
$angulo = 0;
$x = $_GET['x'];
$y = $_GET['y']+$font_size;
$black = hexdec('#'.$_GET['color']);
$texto = $_GET['txt'];
$w = $_GET['w'];
$h = $_GET['h'];

$texto = Wrap($texto, $font_size, $font, $w);

if($pauta==0)
{
    $origen = imagecreatefromjpeg($nombre_fichero);

    $color = imagecolorallocate($origen, 255, 255, 255);
    imagettftext($origen, $font_size, $angulo, $x, $y, $black, $font, $texto);

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

$color = imagecolorallocate($thumb, 255, 255, 255);
imagettftext($thumb, $font_size, $angulo, $x, $y, $black, $font, $texto);


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

function Wrap($text, $font_size, $font ,$width)
{
    //explode text by words
    $text_a = explode(' ', $text);
    $text_new = '';
    foreach($text_a as $word){
            //Create a new text, add the word, and calculate the parameters of the text
            $box = imagettfbbox($font_size, 0, $font, $text_new.' '.$word);
            //if the line fits to the specified width, then add the word with a space, if not then add word with new line
            if($box[2] > $width){
                    $text_new .= "\n".$word;
            } else {
                    $text_new .= " ".$word;
            }
    }
    //trip spaces
    $text_new = trim($text_new);
    //new text box parameters
    $box = imagettfbbox($font_size, 0, $font, $text_new);

    return $text_new;
}
?>