<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$cmd = $_POST['cmd'];
if($cmd==2)
{    
	$item = getTextoGaleria();
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $imagen = utf8_encode($_FILES['imagen']['name']);
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);

    if(EditTextoGaleria($nombre, $name, $imagen, $descripcion, $description))
    {
        if($imagen!=""&&$imagen!=null)
        {
            $dir = "../../../".Configuracion::$images.'/home/'.utf8_decode(utf8_decode($item['imagen']));
            unlink($dir);
            $dir = "../../../".Configuracion::$images.'/home/';
            UpLoadImg($_FILES['imagen'], $dir);
        }
        
        $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
        echo json_encode($jsondata);
    }
    else
    {
        $jsondata['salida']=array('type'=>"0", 'msg'=>'fail', 'data'=>array());
        echo json_encode($jsondata);
    }
}

?>
