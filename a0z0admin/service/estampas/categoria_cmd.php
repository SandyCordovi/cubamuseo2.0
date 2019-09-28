<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/estampas/estampas.php';

$cmd = $_POST['cmd'];
if($cmd==1)
{
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $imagenMenu = utf8_encode($_FILES['imagen_menu']['name']);
    
    if(AddCategoriaEstampa($nombre, $name, $imagenMenu))
    {        
        $dir1 = "../../../".Configuracion::$images.'menuestampas/';
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
    $item = getCategoriaEstampa($id);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $imagenMenu = utf8_encode($_FILES['imagen_menu']['name']);

    if(EditCategoriaEstampa($id, $nombre, $name, $imagenMenu))
    {
        if($imagenMenu!=""&&$imagenMenu!=null)
        {
            $dir = "../../../".Configuracion::$images.'menuestampas/'.utf8_decode(utf8_decode($item['imagenMenu']));
            unlink($dir);
            $dir = "../../../".Configuracion::$images.'menuestampas/';
            UpLoadImg($_FILES['imagen_menu'], $dir);
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
    $item = getCategoriaEstampa($id);
    DeleteCategoriaEstampa($id);
    
    $dir = "../../../".Configuracion::$images.'menuestampas/'.utf8_decode(utf8_decode($item['imagenMenu']));
    unlink($dir);
}
else if($cmd==4)
{
    $id = $_POST['id'];
    $pub = $_POST['p'];
    ChangePubCatEstampa($id, $pub);
}
else if($cmd==5)
{
    $id = $_POST['id'];
    SubeCategoriaEstampa($id);
}
else if($cmd==6)
{
    $id = $_POST['id'];
    BajaCategoriaEstampa($id);
}
?>
