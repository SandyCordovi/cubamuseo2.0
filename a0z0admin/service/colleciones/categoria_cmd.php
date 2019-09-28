<?php

include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';
include '../../../lib/DocxConversion.php';

$cmd = $_POST['cmd'];

if($cmd==1)
{


    $seccion = getSeccion($_POST['seccion_s']);
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
    $cant = $_POST['cant_img'];
    $wordes = isset ($_FILES['word_es']) ? utf8_encode($_FILES['word_es']['name']) : FALSE;
    $imagenes = utf8_encode($_FILES['imagenes_zip']['name']);



    $docText=array();
    $dirTmp = "../../".Configuracion::$temp;
    if($wordes)
    {
        UpLoadImg($_FILES['word_es'], $dirTmp);
        $docObj = new DocxConversion($dirTmp.$_FILES['word_es']['name']);
        $docText= $docObj->convertToText();
        $docText = preg_split('/--/', $docText);
        unlink($dirTmp.$_FILES['word_es']['name']);
    }
    
    if($wordes && ValidaWord($docText, 4))
    {
        $jsondata['salida']=array('type'=>"0", 'msg'=>'fail', 'data'=>array());
        echo json_encode($jsondata);
        return;
    }

    if(AddCategoria($nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, 8, $seccion['id'],1))
    {
        $dir = "../../../".Configuracion::$imagenes.$seccion['nombre'].'/'.utf8_decode($_POST['nombre']).'/';
        mkdir($dir, 0777, true);
        UpLoadImg($_FILES['imagen'], $dir);
        UpLoadImg($_FILES['imagen_galeria'], $dir);

        $cat_actual = getCategoriaByNombre($nombre);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ver que pasa que no se sube el zip
        UpLoadImg($_FILES['imagenes_zip'], $dirTmp);
        $zip = new ZipArchive();
        $zip->open($dirTmp.$_FILES['imagenes_zip']['name']);
        $zip->extractTo($dir);
        if(!$wordes)
        {
            mkdir($dir.'cuitemp/');
            $zip->extractTo($dir.'cuitemp/');
        }
        $zip->close();
        unlink($dirTmp.$_FILES['imagenes_zip']['name']);

        if($wordes)
        {
            if($seccion['nombre'] == "Tarjetas Postales")
            {
                ReadWordArr($docText, array("nombre", "titulo", "emision", "descripcion"), $cat_actual['id']);
            }
            else if($seccion['nombre'] == "Biblioteca Virtual")
            {
                ReadWordArr($docText, array("nombre", "titulo", "descripcion"), $cat_actual['id']);
            }
            else if($seccion['nombre'] == "Habilitaciones Tabaco")
            {
                ReadWordArr($docText, array("nombre", "titulo", "impresion", "descripcion"), $cat_actual['id']);
            }
            else if($seccion['nombre'] == "Fichas de Casino" || $seccion['nombre'] == "Fichas Comerciales" || $seccion['nombre'] == "Fichas Azucareras")
            {
                ReadWordArr($docText, array("nombre", "titulo", "color", "dimension", "descripcion"), $cat_actual['id']);
            }
        }
            
        else
        {            
            DeleteItemOfCategoria($cat_actual['id']);
            $arr = getAllFileName($dir.'cuitemp/');
            for($i=0; $i<count($arr); $i++)
            {
                $nom = substr($arr[$i], 0, strlen($arr[$i])-4);
                AddItem($nom, $nom, "", $arr[$i], "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $cat_actual['id']);
            }
            eliminarDir($dir.'cuitemp/');
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
    $item = getCategoria($id);
    $itemsecc = getSeccion($item['seccion']);
    
    $seccion = getSeccion($_POST['seccion_s']);
    $nombre = utf8_encode($_POST['nombre']);
    $name = utf8_encode($_POST['nombre_en']);
    $titulo = utf8_encode($_POST['titulo']);
    $title = utf8_encode($_POST['titulo_en']);
    $descripcion = utf8_encode($_POST['descrip']);
    $description = utf8_encode($_POST['descrip_en']);
    $cant = $_POST['cant_img'];

    $imagen = isset ($_FILES['imagen']) ? utf8_encode($_FILES['imagen']['name']) : FALSE;
    $imagenGaleria = isset ($_FILES['imagen_galeria']) ? utf8_encode($_FILES['imagen_galeria']['name']) : FALSE;
    $wordes = isset ($_FILES['word_es']) ? utf8_encode($_FILES['word_es']['name']) : FALSE;
    //$worden = utf8_encode($_FILES['word_en']['name']);
    $imagenes = isset ($_FILES['imagenes_zip']) ? utf8_encode($_FILES['imagenes_zip']['name']) : FALSE;

    $dir = "../../../".Configuracion::$imagenes.$itemsecc['nombre'].'/'.utf8_decode(utf8_decode($item['nombre'])).'/';
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
        $c_i = getAllItemCateg($id);
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
        DeleteItemOfCategoria($id);        
        UpLoadImg($_FILES['word_es'], $dirTmp);
        $docObj = new DocxConversion($dirTmp.$_FILES['word_es']['name']);
        $docText= $docObj->convertToText();
        $docText = preg_split('/--/', $docText);
        unlink($dirTmp.$_FILES['word_es']['name']);
        if($itemsecc['nombre'] == "Tarjetas Postales")
        {
            ReadWordArr($docText, array("nombre", "titulo", "emision", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Biblioteca Virtual")
        {
            ReadWordArr($docText, array("nombre", "titulo", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Habilitaciones Tabaco")
        {
            ReadWordArr($docText, array("nombre", "titulo", "impresion", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Fichas de Casino" || $itemsecc['nombre'] == "Fichas Comerciales" || $itemsecc['nombre'] == "Fichas Azucareras")
        {
            ReadWordArr($docText, array("nombre", "titulo", "color", "dimension", "descripcion"), $id);
        }
    }

    if($seccion['id']!=$item['seccion'])
    {
        $target = "../../../".Configuracion::$imagenes.$seccion['nombre'].'/'.utf8_decode(utf8_decode($item['nombre'])).'/';
        full_copy( $dir, $target );
        eliminarDir($dir);
    }

    if(EditCategoria($id, $nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, $cant, $seccion['id'],1))
    {
        $dirnew = "../../../".Configuracion::$imagenes.$seccion['nombre'].'/'.utf8_decode($_POST['nombre']).'/';
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
    $item = getCategoria($id);
    $itemsecc = getSeccion($item['seccion']);    
    DeleteCategoria($id);
    $dir = "../../../".Configuracion::$imagenes.$itemsecc['nombre'].'/'.utf8_decode(utf8_decode($item['nombre'])).'/';
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
    SubeCategoria($id);
}
else if($cmd==6)
{
    $id = $_POST['id'];
    BajaCategoria($id);
}
else if($cmd==7)
{
    $id = $_POST['id'];
    $item = getCategoria($id);
    $itemsecc = getSeccion($item['seccion']);

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
        $docText = preg_split('/--/', $docText);
        unlink($dirTmp.$_FILES['word_es']['name']);
        if($itemsecc['nombre'] == "Tarjetas Postales")
        {
            ReadWordArr($docText, array("nombre", "titulo", "emision", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Biblioteca Virtual")
        {
            ReadWordArr($docText, array("nombre", "titulo", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Habilitaciones Tabaco")
        {
            ReadWordArr($docText, array("nombre", "titulo", "impresion", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Fichas de Casino" || $itemsecc['nombre'] == "Fichas Comerciales" || $itemsecc['nombre'] == "Fichas Azucareras")
        {
            ReadWordArr($docText, array("nombre", "titulo", "color", "dimension", "descripcion"), $id);
        }
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
    $item = getCategoria($id);
    $itemsecc = getSeccion($item['seccion']);

    $wordes = isset ($_FILES['word_es']) ? utf8_encode($_FILES['word_es']['name']) : FALSE;
    //$worden = utf8_encode($_FILES['word_en']['name']);

    $dir = "../../../".Configuracion::$imagenes.$itemsecc['nombre'].'/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    $dirTmp = "../../".Configuracion::$temp;

    if($wordes)
    {
        DeleteItemOfCategoria($id);
        UpLoadImg($_FILES['word_es'], $dirTmp);
        $docObj = new DocxConversion($dirTmp.$_FILES['word_es']['name']);
        $docText= $docObj->convertToText();
        $docText = preg_split('/--/', $docText);
        unlink($dirTmp.$_FILES['word_es']['name']);
        if($itemsecc['nombre'] == "Tarjetas Postales")
        {
            ReadWordArr($docText, array("nombre", "titulo", "emision", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Biblioteca Virtual")
        {
            ReadWordArr($docText, array("nombre", "titulo", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Habilitaciones Tabaco")
        {
            ReadWordArr($docText, array("nombre", "titulo", "impresion", "descripcion"), $id);
        }
        else if($itemsecc['nombre'] == "Fichas de Casino" || $itemsecc['nombre'] == "Fichas Comerciales" || $itemsecc['nombre'] == "Fichas Azucareras")
        {
            ReadWordArr($docText, array("nombre", "titulo", "color", "dimension", "descripcion"), $id);
        }
    }
    
    $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd==9)
{
    $id = $_POST['id'];
    $item = getCategoria($id);
    $itemsecc = getSeccion($item['seccion']);
    
    $imagenes = isset ($_FILES['imagenes_zip']) ? utf8_encode($_FILES['imagenes_zip']['name']) : FALSE;

    $dir = "../../../".Configuracion::$imagenes.$itemsecc['nombre'].'/'.utf8_decode(utf8_decode($item['nombre'])).'/';
    $dirTmp = "../../".Configuracion::$temp;

    
    if($imagenes)
    {
        $c_i = getAllItemCateg($id);
        for($i=0; $i<count($c_i); $i++)
        {
            unlink($dir.$c_i[$i]['imagen']);
        }
        UpLoadImg($_FILES['imagenes_zip'], $dirTmp);
        $zip = new ZipArchive();
        $zip->open($dirTmp.$_FILES['imagenes_zip']['name']);
        $zip->extractTo($dir);
        mkdir($dir.'cuitemp/');
        $zip->extractTo($dir.'cuitemp/');
        $zip->close();
        unlink($dirTmp.$_FILES['imagenes_zip']['name']);
        if(isset ($_POST['cui_sinword']))
        {
            DeleteItemOfCategoria($id);
            $arr = getAllFileName($dir.'cuitemp/');
            for($i=0; $i<count($arr); $i++)
            {
                $nom = substr($arr[$i], 0, strlen($arr[$i])-4);
                AddItem($nom, $nom, "", $arr[$i], "", "", "", "", "", "", "", "", "", "", "", "", "", 0, $id);
            }
            eliminarDir($dir.'cuitemp/');
        }
        else
        {

        }
    }
    
    

    $jsondata['salida']=array('type'=>"0", 'msg'=>'w', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd==10)
{
    $id = $_POST['id'];
    $precio = $_POST['precio'];
    if(ChangePrecioCategoria($id, $precio))
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
        if($n == 0)
            $n = FindValueInArr("Descripcion", $docText)+1;
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
