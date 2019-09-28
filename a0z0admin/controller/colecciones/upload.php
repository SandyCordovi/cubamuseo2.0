<?php
include '../../../configuracion.php';

$img  = $_POST['upload'];

$nombre_archivo = $_FILES['upload']['name'];
$tipo_archivo = $_FILES['upload']['type'];
 if(!$nombre_archivo)
     $nombre_archivo="";
 else
 {
    if (!$tipo_archivo)
    {
       $nombre_archivo="";
    }
    else
    {
        $ext = preg_split('/\//', $tipo_archivo);
        $ext = $ext[1];
        $nombre_archivo = $nombre_archivo;
        if(!move_uploaded_file($_FILES['upload']['tmp_name'], "../../../".Configuracion::$imagenes."ImgUpl/".$nombre_archivo))
        {
            $nombre_archivo="";
        }
    }
 }
 
 $url = Configuracion::$site.Configuracion::$imagenes."ImgUpl/".$nombre_archivo;
 echo '<p>'.$url.'</p>';

?>
