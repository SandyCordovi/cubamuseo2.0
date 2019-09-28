<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/tienda/tienda.php';

$cmd = $_POST['cmd'];
if($cmd==1)
{
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $imagenMenu = utf8_encode($_FILES['imagen_menu']['name']);
    
    if(AddTematica($nombre, $name, $titulo, $title, $imagenMenu))
    {        
        $dir1 = "../../../".Configuracion::$images.'menutienda/';
        mkdir($dir, 0777, true);
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
    $item = getTematica($id);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $imagenMenu = utf8_encode($_FILES['imagen_menu']['name']);

    if(EditTematica($id, $nombre, $name, $titulo, $title, $imagenMenu))
    {
        if($imagenMenu!=""&&$imagenMenu!=null)
        {
            $dir = "../../../".Configuracion::$images.'menutienda/'.utf8_decode(utf8_decode($item['imagenMenu']));
            unlink($dir);
            $dir = "../../../".Configuracion::$images.'menutienda/';
            UpLoadImg($_FILES['imagen_menu'], $dir);
        }
        if($nombre!=$item['nombre'])
        {
            $dir = "../../../".Configuracion::$imagenes.'Tienda/'.utf8_decode(utf8_decode($item['nombre'])).'/';
            $dirnew = "../../../".Configuracion::$imagenes.'Tienda/'.utf8_decode($_POST['nombre']).'/';
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
    $item = getTematica($id);
    DeleteTematica($id);
    
    $dir = "../../../".Configuracion::$imagenes.'Tienda/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    eliminarDir($dir);

    $dir = "../../../".Configuracion::$images.'menutienda/'.utf8_decode(utf8_decode($item['imagenMenu']));
    unlink($dir);
}
else if($cmd==4)
{
    $id = $_POST['id'];
    $pub = $_POST['p'];
    ChangePubTematica($id, $pub);
}
else if($cmd==5)
{
    $id = $_POST['id'];
    SubeTematica($id);
}
else if($cmd==6)
{
    $id = $_POST['id'];
    BajaTematica($id);
}
?>
