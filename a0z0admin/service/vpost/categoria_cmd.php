<?php

include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/vpost/vpost.php';
include '../../../lib/DocxConversion.php';

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
    $imagenes = utf8_encode($_FILES['imagenes_zip']['name']);
   
    if(AddCategoria($nombre, $name, $titulo, $title, $imagenMenu))
    {
        $dirTmp = "../../".Configuracion::$temp;
        $dir = "../../../".Configuracion::$imagenes.'V-Posts/'.utf8_decode($_POST['nombre']).'/';
        mkdir($dir, 0777, true);
        $dir1 = "../../../".Configuracion::$images.'menupostales/';
        UpLoadImg($_FILES['imagen_menu'], $dir1);

        $cat_actual = getCategoriaByNombre($nombre);

        UpLoadImg($_FILES['imagenes_zip'], $dirTmp);
        $zip = new ZipArchive();
        $zip->open($dirTmp.$_FILES['imagenes_zip']['name']);
        $zip->extractTo($dir);
        $zip->close();
        unlink($dirTmp.$_FILES['imagenes_zip']['name']);

        $postales = getAllFileName($dir);
        for($i=0; $i<count($postales); $i++)
        {
            if(AddPostal($postales[$i],0,$postales[$i],1,$cat_actual['id']))
            {
            }
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
else if($cmd==2)
{
    $id = $_POST['id'];
    $item = getCategoriaPostal($id);
    
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $imagenMenu = isset ($_FILES['imagen_menu']) ? utf8_encode($_FILES['imagen_menu']['name']) : FALSE;
    $imagenes = isset ($_FILES['imagenes_zip']) ? utf8_encode($_FILES['imagenes_zip']['name']) : FALSE;

    $dir = "../../../".Configuracion::$imagenes.'V-Post/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    
    if($imagenMenu)
    {
        unlink($dir.$item['$imagenMenu']);
        UpLoadImg($_FILES['imagen_menu'], $dir);
    }

    $dirTmp = "../../".Configuracion::$temp;
    if($imagenes)
    {
        $c_i = getAllPostalCateg($id);
        for($i=0; $i<count($c_i); $i++)
        {
            unlink($dir.$c_i[$i]['imagen']);
        }
        UpLoadImg($_FILES['imagenes_zip'], $dirTmp);
        $zip = new ZipArchive();
        $zip->open($dirTmp.$_FILES['imagenes_zip']['name']);
        $zip->extractTo($dir);
        $zip->close();
        unlink($dirTmp.$_FILES['imagenes_zip']['name']);

        DeletePostalesCategoria($id);

        $postales = getAllFileName($dir);
        for($i=0; $i<count($postales); $i++)
        {
            if(AddPostal($postales[$i],0,$postales[$i],1,$cat_actual['id']))
            {
            }
        }
    }

    if(EditCategoriaPostal($id, $nombre, $name, $titulo, $title, $imagenMenu))
    {
        $dirnew = "../../../".Configuracion::$imagenes.'V-Post/'.utf8_decode($_POST['nombre']).'/';
        $tttt = rename($dir, $dirnew);
        
        $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>$dirnew);
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
    $item = getCategoriaPostal($id);
    DeleteCategoriaPostal($id);
    $dir = "../../../".Configuracion::$imagenes.'V-Post/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    eliminarDir($dir);

    $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd==4)
{
    $id = $_POST['id'];
    $pub = $_POST['p'];
    ChangePubCategoria($id,$pub);
}
else if($cmd==5)
{
    $id = $_POST['id'];
    SubeCategoriaPostal($id);
}
else if($cmd==6)
{
    $id = $_POST['id'];
    BajaCategoriaPostal($id);
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
    try
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
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}

function ValidaWord($docText, $n)
{   
    if( count($docText)%$n !=0)return FALSE;
}

?>
