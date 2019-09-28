<?php

include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/estampas/estampas.php';
include '../../../lib/DocxConversion.php';

$cmd = $_POST['cmd'];

if($cmd==1)
{
    $categoria = getCategoriaEstampa($_POST['categoria_s']);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $imagenGaleria = utf8_encode($_FILES['imagen_galeria']['name']);
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);
    $description= $description==null || $description=="" ? Configuracion::$txt_ingles : $description;
	
    if(AddEstampa($nombre, $name, $titulo, $title, $imagenGaleria, $descripcion, $description, $categoria['id']))
    {
        $dir = "../../../".Configuracion::$imagenes.'Estampas/'.utf8_decode($_POST['nombre']).'/';
		mkdir($dir, 0777, true);
        UpLoadImg($_FILES['imagen_galeria'], $dir);
        
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
    $item = getEstampa($id);
    $categoria = getCategoriaEstampa($_POST['tematica_s']);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $imagenGaleria = utf8_encode($_FILES['imagen_galeria']['name']);
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);
    $description= $description==null || $description=="" ? Configuracion::$txt_ingles : $description;

    if(EditEstampa($id, $nombre, $name, $titulo, $title, $imagenGaleria, $descripcion, $description, $categoria['id']))
    {
        if($imagenGaleria!=""&&$imagenGaleria!=null)
        {
            $dir = "../../../".Configuracion::$imagenes.'Estampas/'.utf8_decode(utf8_decode($item['nombre'])).'/'.utf8_decode(utf8_decode($item['imagenGaleria']));
            unlink($dir);
            $dir = "../../../".Configuracion::$imagenes.'Estampas/'.utf8_decode(utf8_decode($item['nombre'])).'/';
            UpLoadImg($_FILES['imagen_galeria'], $dir);
        }
		if($nombre!=$item['nombre'])
        {
            $dir = "../../../".Configuracion::$imagenes.'Estampas/'.utf8_decode(utf8_decode($item['nombre'])).'/';
            $dirnew = "../../../".Configuracion::$imagenes.'Estampas/'.utf8_decode($_POST['nombre']).'/';
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
    $estampa = getEstampa($id);
	
    DeleteEstampa($id);

    $dir = "../../../".Configuracion::$imagenes.'Estampas/'.utf8_decode(utf8_decode($estampa['nombre']));
    eliminarDir($dir);

}
else if($cmd==4)
{
    $id = $_POST['id'];
    $pub = $_POST['p'];
    ChangePubEstampa($id, $pub);
}
else if($cmd==5)
{
    $id = $_POST['id'];
    
}
else if($cmd==6)
{
    $id = $_POST['id'];
}
function FindValueInArr($v, $arr)
{
    if(trim($arr[0])==$v)return 0;
    $n=-1;
    while($n<count($arr) && trim($arr[$n+1])!=$v)
        $n++;
    return $n!=-1 && $n<count($arr) ? $n+1 : -1;
}

function ReadWordArr($docText, $field, $categoria)
{    
    $n = FindValueInArr("Comentarios", $docText)+1;
    while($n<count($docText)-count($field))
    {
        $arr = array();
        for($i=0; $i<count($field); $i++)
        {
            $r = $n%count($field);
            $arr[$i] = trim($docText[$n]);
            $n++;
        }

        $i_nombre = FindValueInArr("nombre", $field);
        $nombre = $i_nombre==-1 ? "" : utf8_encode($arr[$i_nombre]);

        $i_titulo = FindValueInArr("titulo", $field);
        $titulo = $i_titulo==-1 ? "" : utf8_encode($arr[$i_titulo]);

        $i_title = FindValueInArr("title", $field);
        $title = $i_title==-1 ? "" : $arr[$i_title];

        $imagen = $nombre.'.jpg';

        $i_descripcion = FindValueInArr("descripcion", $field);
        $descripcion = $i_descripcion==-1 ? "" : utf8_encode($arr[$i_descripcion]);

        $i_description = FindValueInArr("description", $field);
        $description = $i_description==-1 ? "" : $arr[$i_description];

        $i_dimension = FindValueInArr("dimension", $field);
        $dimension = $i_dimension==-1 ? "" : $arr[$i_dimension];

        $i_dimensione = FindValueInArr("dimensione", $field);
        $dimensione = $i_dimensione==-1 ? "" : $arr[$i_dimensione];

        $i_imageSize = FindValueInArr("imageSize", $field);
        $imageSize = $i_imageSize==-1 ? "" : $arr[$i_imageSize];

        $i_emision = FindValueInArr("emision", $field);
        $emision = $i_emision==-1 ? "" : utf8_encode($arr[$i_emision]);

        $i_emisione = FindValueInArr("emisione", $field);
        $emisione = $i_emisione==-1 ? "" : $arr[$i_emisione];

        $i_material = FindValueInArr("material", $field);
        $material = $i_material==-1 ? "" : $arr[$i_material];

        $i_materiale = FindValueInArr("materiale", $field);
        $materiale = $i_materiale==-1 ? "" : $arr[$i_materiale];

        $i_color = FindValueInArr("color", $field);
        $color = $i_color==-1 ? "" : $arr[$i_color];

        $i_colore = FindValueInArr("colore", $field);
        $colore = $i_colore==-1 ? "" : $arr[$i_colore];

        $i_impresion = FindValueInArr("impresion", $field);
        $impresion = $i_impresion==-1 ? "" : $arr[$i_impresion];

        $i_impresione = FindValueInArr("impresione", $field);
        $impresione = $i_impresione==-1 ? "" : $arr[$i_impresione];

        $i_precio = FindValueInArr("precio", $field);
        $precio = $i_precio==-1 ? "" : $arr[$i_precio];

        AddItem($nombre, $titulo, $title, $imagen, $descripcion, $description, $dimension, $dimensione, $imageSize, $emision, $emisione, $material, $materiale, $color, $colore, $impresion, $impresione, $precio, $categoria);
    }
}

?>
