<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$cmd = $_POST['cmd'];
if($cmd==1)
{
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $imagen = utf8_encode($_FILES['imagen']['name']);
    $imagenMenu = utf8_encode($_FILES['imagen_menu']['name']);
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);
    $description= $description==null || $description=="" ? Configuracion::$txt_ingles : $description;
    
    if(AddSeccion($nombre, $name, $titulo, $title, $imagen, $imagenMenu, $descripcion, $description))
    {
        $dir = "../../../".Configuracion::$imagenes.utf8_decode($_POST['nombre']).'/';
        $dir1 = "../../../".Configuracion::$images.'menu/';
        mkdir($dir, 0777, true);
        UpLoadImg($_FILES['imagen'], $dir);
        UpLoadImg($_FILES['imagen_menu'], $dir1);
        $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
        echo json_encode($jsondata);
    }
    else
    {
        $jsondata['salida']=array('type'=>"0", 'msg'=>'fail', 'data'=>array());
        echo json_encode($jsondata);
    }
}
else if($cmd==2)
{
    $id = $_POST['id'];
    $item = getSeccion($id);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $imagen = utf8_encode($_FILES['imagen']['name']);
    $imagenMenu = utf8_encode($_FILES['imagen_menu']['name']);
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);

    if(EditSeccion($id, $nombre, $name, $titulo, $title, $imagen, $imagenMenu, $descripcion, $description))
    {
        if($imagen!=""&&$imagen!=null)
        {
            $dir = "../../../".Configuracion::$imagenes.utf8_decode(utf8_decode($item['nombre'])).'/'.utf8_decode(utf8_decode($item['imagen']));
            unlink($dir);
            $dir = "../../../".Configuracion::$imagenes.utf8_decode(utf8_decode($item['nombre'])).'/';
            UpLoadImg($_FILES['imagen'], $dir);
        }
        if($imagenMenu!=""&&$imagenMenu!=null)
        {
            $dir = "../../../".Configuracion::$images.'menu/'.utf8_decode(utf8_decode($item['imagenMenu']));
            unlink($dir);
            $dir = "../../../".Configuracion::$images.'menu/';
            UpLoadImg($_FILES['imagen_menu'], $dir);
        }
        if($nombre!=$item['nombre'])
        {
            $dir = "../../../".Configuracion::$imagenes.utf8_decode(utf8_decode($item['nombre'])).'/';
            $dirnew = "../../../".Configuracion::$imagenes.utf8_decode($_POST['nombre']).'/';
            rename($dir, $dirnew);
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
else if($cmd==3)
{
    $id = $_POST['id'];
    $item = getSeccion($id);
    DeleteSeccion($id);
    
    $dir = "../../../".Configuracion::$imagenes.utf8_decode(utf8_decode($item['nombre'])).'/';
    eliminarDir($dir);

    $dir = "../../../".Configuracion::$images.'menu/'.utf8_decode(utf8_decode($item['imagenMenu']));
    unlink($dir);
}
else if($cmd==4)
{
    $id = $_POST['id'];
    $pub = $_POST['p'];
    ChangePubSeccion($id, $pub);
}
else if($cmd==5)
{
    $id = $_POST['id'];
    SubeSeccion($id);
}
else if($cmd==6)
{
    $id = $_POST['id'];
    BajaSeccion($id);
}
?>
