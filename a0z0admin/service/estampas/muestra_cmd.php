<?php

include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/estampas/estampas.php';
include '../../../lib/DocxConversion.php';

$cmd = $_POST['cmd'];

if($cmd==1)
{
    $seccion = getCategoriaEstampa($_POST['seccion_s']);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $imagen = utf8_encode($_FILES['imagen']['name']);
    $imagenGaleria = utf8_encode($_FILES['imagen_galeria']['name']);
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);
    $description= $description==null || $description=="" ? Configuracion::$txt_ingles : $description;
    $wordes = utf8_encode($_FILES['word_es']['name']);
    $imagenes = utf8_encode($_FILES['imagenes_zip']['name']);


    $dirTmp = "../../".Configuracion::$temp;
    UpLoadImg($_FILES['word_es'], $dirTmp);
    $docObj = new DocxConversion($dirTmp.$_FILES['word_es']['name']);
    $docText= $docObj->convertToText();
    $docText = preg_split('/__/', $docText);
    unlink($dirTmp.$_FILES['word_es']['name']);
    
    if(ValidaWord($docText, 4))
    {
        $jsondata['salida']=array('type'=>"0", 'msg'=>'fail', 'data'=>array());
        echo json_encode($jsondata);
        return;
    }

    if(AddMuestra($nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, $seccion['id']))
    {
        $dir = "../../../".Configuracion::$imagenes.'Muestras/'.utf8_decode($_POST['nombre']).'/';
        mkdir($dir, 0777, true);
        UpLoadImg($_FILES['imagen'], $dir);
        UpLoadImg($_FILES['imagen_galeria'], $dir);

        $cat_actual = getMuestraByNombre($nombre);

        UpLoadImg($_FILES['imagenes_zip'], $dirTmp);
        $zip = new ZipArchive();
        $zip->open($dirTmp.$_FILES['imagenes_zip']['name']);
        $zip->extractTo($dir);
        $zip->close();
        unlink($dirTmp.$_FILES['imagenes_zip']['name']);

        ReadWordArr($docText, array("nombre", "titulo", "emision","procedencia", "descripcion"), $cat_actual['id']);
        
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
    $item = getMuestra($id);
    $itemsecc = getCategoriaEstampa($item['seccion']);
    
    $seccion = getCategoriaEstampa($_POST['seccion_s']);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $name = $name==null || $name=="" ? Configuracion::$txt_ingles : $name;
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $title= $title==null || $title=="" ? Configuracion::$txt_ingles : $title;
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);
    $description= $description==null || $description=="" ? Configuracion::$txt_ingles : $description;
    
    $imagen = isset ($_FILES['imagen']) ? utf8_encode($_FILES['imagen']['name']) : FALSE;
    $imagenGaleria = isset ($_FILES['imagen_galeria']) ? utf8_encode($_FILES['imagen_galeria']['name']) : FALSE;
    $wordes = isset ($_FILES['word_es']) ? utf8_encode($_FILES['word_es']['name']) : FALSE;
    $imagenes = isset ($_FILES['imagenes_zip']) ? utf8_encode($_FILES['imagenes_zip']['name']) : FALSE;

    $dir = "../../../".Configuracion::$imagenes.'Muestras/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    if($imagen)
    {
        unlink($dir.$item['imagen']);
        UpLoadImg($_FILES['imagen'], $dir);
    }
    if($imagenGaleria)
    {
        unlink($dir.$item['imagenGaleria']);
        UpLoadImg($_FILES['imagen_galeria'], $dir);
    }

    $dirTmp = "../../".Configuracion::$temp;
    if($imagenes)
    {
        $c_i = getAllItemMuestra($id);
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
    }

    if($wordes)
    {
        DeleteItemOfMuestra($id);
        UpLoadImg($_FILES['word_es'], $dirTmp);
        $docObj = new DocxConversion($dirTmp.$_FILES['word_es']['name']);
        $docText= $docObj->convertToText();
        $docText = preg_split('/__/', $docText);
        unlink($dirTmp.$_FILES['word_es']['name']);
        ReadWordArr($docText, array("nombre", "titulo", "emision","procedencia", "descripcion"), $id);
    }

    if($seccion['id']!=$item['seccion'])
    {
        $target = "../../../".Configuracion::$imagenes.'Muestras/'.utf8_decode(utf8_decode($item['nombre'])).'/';
        full_copy( $dir, $target );
        eliminarDir($dir);
    }

    if(EditMuestra($id, $nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, $seccion['id']))
    {
        $dirnew = "../../../".Configuracion::$imagenes.'Muestras/'.utf8_decode($_POST['nombre']).'/';
        $tttt = rename($dir, $dirnew);
        
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
    $item = getMuestra($id);

    DeleteMuestras($id);
    $dir = "../../../".Configuracion::$imagenes.'Muestras/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    eliminarDir($dir);

    $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd==4)
{
    $id = $_POST['id'];
    $pub = $_POST['p'];
    ChangePubMuestra($id,$pub);
}
else if($cmd==5)
{
    $id = $_POST['id'];
}
else if($cmd==6)
{
    $id = $_POST['id'];
}
else if($cmd==7)
{
    $id = $_POST['id'];
    $item = getMuestra($id);
    $itemsecc = getCategoriaEstampa($item['seccion']);

    $wordes = isset ($_FILES['word_es']) ? utf8_encode($_FILES['word_es']['name']) : FALSE;
    //$worden = utf8_encode($_FILES['word_en']['name']);
    $imagenes = isset ($_FILES['imagenes_zip']) ? utf8_encode($_FILES['imagenes_zip']['name']) : FALSE;

    $dir = "../../../".Configuracion::$imagenes.$itemsecc['nombre'].'/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    $dirTmp = "../../".Configuracion::$temp;

    if($wordes)
    {
        UpLoadImg($_FILES['word_es'], $dirTmp);
        $docObj = new DocxConversion($dirTmp.$_FILES['word_es']['name']);
        $docText= $docObj->convertToText();
        $docText = preg_split('/__/', $docText);
        unlink($dirTmp.$_FILES['word_es']['name']);
        ReadWordArr($docText, array("nombre", "titulo", "emision","procedencia", "descripcion"), $id);
    }

    if($imagenes)
    {
        UpLoadImg($_FILES['imagenes_zip'], $dirTmp);
        $zip = new ZipArchive();
        $zip->open($dirTmp.$_FILES['imagenes_zip']['name']);
        $zip->extractTo($dir);
        $zip->close();
        unlink($dirTmp.$_FILES['imagenes_zip']['name']);
    }

    $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd==8)
{
    $id = $_POST['id'];
    $item = getMuestra($id);
    $itemsecc = getCategoriaEstampa($item['seccion']);

    $wordes = isset ($_FILES['word_es']) ? utf8_encode($_FILES['word_es']['name']) : FALSE;
    //$worden = utf8_encode($_FILES['word_en']['name']);

    $dir = "../../../".Configuracion::$imagenes.'Muestras/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    $dirTmp = "../../".Configuracion::$temp;

    if($wordes)
    {
        DeleteItemOfMuestra($id);
        UpLoadImg($_FILES['word_es'], $dirTmp);
        $docObj = new DocxConversion($dirTmp.$_FILES['word_es']['name']);
        $docText = $docObj->convertToText();
        $docText = preg_split('/__/', $docText);
        unlink($dirTmp.$_FILES['word_es']['name']);
        ReadWordArr($docText, array("nombre", "titulo", "emision","procedencia", "descripcion"), $id);
    }
    
    $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd==9)
{
    $id = $_POST['id'];
    $item = getMuestra($id);
    $itemsecc = getCategoriaEstampa($item['seccion']); 
    
    $imagenes = isset ($_FILES['imagenes_zip']) ? utf8_encode($_FILES['imagenes_zip']['name']) : FALSE;

    $dir = "../../../".Configuracion::$imagenes.'Muestras/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    $dirTmp = "../../".Configuracion::$temp;

    if($imagenes)
    {
        $c_i = getAllItemMuestra($id);
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
    }
    $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd==10)
{
    $id = $_POST['id'];
    $precio = $_POST['precio'];
    if(ChangePrecioMuestra($id, $precio))
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

            $i_procedencia = FindValueInArr("procedencia", $field);
            $procedencia = $i_procedencia==-1 ? "" : utf8_encode($arr[$i_procedencia]);

            $i_source = FindValueInArr("source", $field);
            $source = $i_source==-1 ? "" : utf8_encode($arr[$i_source]);


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

            AddItem($nombre, $titulo, $title, $imagen, $descripcion, $description,$procedencia,$source, $dimension, $dimensione, $imageSize, $emision, $emisione, $material, $materiale, $color, $colore, $impresion, $impresione, $precio, $categoria);
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
