<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$cmd = $_POST['cmd'];

if($cmd==1)
{
    $categoria = utf8_encode($_POST['categoria']);
    $item = getCategoria($categoria);
    $itemsecc = getSeccion($item['seccion']);

    $nombre = utf8_encode($_POST['nombre']);

    $titulo = ValidaEmpty(utf8_encode($_POST['titulo']), "");
    $title = utf8_encode($_POST['titulo_en']);
    $title = $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    
    $imagen = ValidaEmpty(utf8_encode($_FILES['imagen']['name']), "");
    
    $descripcion = ValidaEmpty(utf8_encode($_POST['descrip']), "");
    $description = utf8_encode($_POST['descrip_en']);
    $description = $description==null || $description=="" ? Configuracion::$txt_ingles : $description;

    $dimension = ValidaEmpty(utf8_encode($_POST['dimension']), "");
    $dimensione = utf8_encode($_POST['dimension_en']);
    $dimensione = $dimensione==null || $dimensione=="" ? Configuracion::$txt_ingles : $dimensione;
    
    $imageSize = "";

    $emision = ValidaEmpty(utf8_encode($_POST['emision']), "");
    $emisione = utf8_encode($_POST['emision_en']);
    $emisione = $emisione==null || $emisione=="" ? Configuracion::$txt_ingles : $emisione;

    $material = ValidaEmpty(utf8_encode($_POST['material']), "");
    $materiale = utf8_encode($_POST['material_en']);
    $materiale = $materiale==null || $materiale=="" ? Configuracion::$txt_ingles : $materiale;

    $color = ValidaEmpty(utf8_encode($_POST['color']), "");
    $colore = utf8_encode($_POST['color_en']);
    $colore = $colore==null || $colore=="" ? Configuracion::$txt_ingles : $colore;

    $impresion = ValidaEmpty(utf8_encode($_POST['impresion']), "");
    $impresione = utf8_encode($_POST['impresion_en']);
    $impresione = $impresione==null || $impresione=="" ? Configuracion::$txt_ingles : $impresione;

    $precio = utf8_encode($_POST['precio']);
    $precio = $precio==null || $precio=="" ? "0" : $precio;

    if(AddItem($nombre, $titulo, $title, $imagen, $descripcion, $description, $dimension, $dimensione, $imageSize, $emision, $emisione, $material, $materiale, $color, $colore, $impresion, $impresione, $precio, $categoria))
    {
        $dir = "../../../".Configuracion::$imagenes.$itemsecc['nombre'].'/'.utf8_decode(utf8_decode($item['nombre'])).'/';
        UpLoadImg($_FILES['imagen'], $dir);

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
    $id = utf8_encode($_POST['id']);
    $categoria = utf8_encode($_POST['categoria']);
    $item = getCategoria($categoria);
    $itemsecc = getSeccion($item['seccion']);

    $nombre = utf8_encode($_POST['nombre']);

    $titulo = ValidaEmpty(utf8_encode($_POST['titulo']), "");
    $title = utf8_encode($_POST['titulo_en']);
    $title = $title==null || $title=="" ? Configuracion::$txt_ingles : $title;

    $imagen = ValidaEmpty(utf8_encode($_FILES['imagen']['name']), "");

    $descripcion = ValidaEmpty(utf8_encode($_POST['descrip']), "");
    $description = utf8_encode($_POST['descrip_en']);
    $description = $description==null || $description=="" ? Configuracion::$txt_ingles : $description;

    $dimension = ValidaEmpty(utf8_encode($_POST['dimension']), "");
    $dimensione = utf8_encode($_POST['dimension_en']);
    $dimensione = $dimensione==null || $dimensione=="" ? Configuracion::$txt_ingles : $dimensione;

    $imageSize = "";

    $emision = ValidaEmpty(utf8_encode($_POST['emision']), "");
    $emisione = utf8_encode($_POST['emision_en']);
    $emisione = $emisione==null || $emisione=="" ? Configuracion::$txt_ingles : $emisione;

    $material = ValidaEmpty(utf8_encode($_POST['material']), "");
    $materiale = utf8_encode($_POST['material_en']);
    $materiale = $materiale==null || $materiale=="" ? Configuracion::$txt_ingles : $materiale;

    $color = ValidaEmpty(utf8_encode($_POST['color']), "");
    $colore = utf8_encode($_POST['color_en']);
    $colore = $colore==null || $colore=="" ? Configuracion::$txt_ingles : $colore;

    $impresion = ValidaEmpty(utf8_encode($_POST['impresion']), "");
    $impresione = utf8_encode($_POST['impresion_en']);
    $impresione = $impresione==null || $impresione=="" ? Configuracion::$txt_ingles : $impresione;

    $precio = utf8_encode($_POST['precio']);
    $precio = $precio==null || $precio=="" ? "0" : $precio;

    if(EditItem($id, $titulo, $title, $descripcion, $description, $dimension, $dimensione, $emision, $emisione, $material, $materiale, $color, $colore, $impresion, $impresione, $precio))
    {
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
    DeleteItem($id);
    
    $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
    echo json_encode($jsondata);
}

?>
