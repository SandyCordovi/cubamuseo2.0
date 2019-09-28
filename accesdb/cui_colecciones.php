<?php

function getSeccion($id)
{
    $query="SELECT idSeccion, nombre, titulo, descripcion, imagen
			FROM seccion
			WHERE idSeccion=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['descripcion']=$col4;
        $html['imagen']=$col5;  
	$html['carpeta']=$col2;
    }
    return $html;
}

function getSeccionEN($id)
{
    $query="SELECT s.idSeccion, e.name, e.title, e.description, s.imagen, s.nombre
			FROM seccion as s inner join seccion_en as e
			on s.idSeccion = e.idSeccion
			WHERE s.idSeccion=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
		$html['descripcion']=$col4;
		$html['imagen']=$col5;  
		$html['carpeta']=$col6;
    }
    return $html;
}

function getGaleriaSeccion($seccion)
{
    $query="SELECT c.idCategoria, c.nombre, c.titulo, c.imagenGaleria, c.carpeta
			FROM categoria AS c
			INNER JOIN seccion_categoria AS s
			ON c.idCategoria = s.idCategoria
			WHERE c.publicada AND s.idSeccion = ".$seccion."
			ORDER BY s.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;
        $html[$n]['carpeta']=$col5;
        $n++;
    }
    return $html;
}

function getGaleriaSeccionXIX($seccion)
{
    $query="SELECT c.idCategoria, c.nombre, c.titulo, c.imagenGaleria, c.carpeta
			FROM categoria AS c
			INNER JOIN seccion_categoria AS s
			ON c.idCategoria = s.idCategoria
			WHERE c.publicada AND s.idSeccion = ".$seccion." AND s.sigloXIX = 1
			ORDER BY s.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;
        $html[$n]['carpeta']=$col5;
        $n++;
    }
    return $html;
}

function getGaleriaSeccionXX($seccion)
{
    $query="SELECT c.idCategoria, c.nombre, c.titulo, c.imagenGaleria, c.carpeta
			FROM categoria AS c
			INNER JOIN seccion_categoria AS s
			ON c.idCategoria = s.idCategoria
			WHERE c.publicada AND s.idSeccion = ".$seccion." AND s.sigloXIX = 0
			ORDER BY s.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;
        $html[$n]['carpeta']=$col5;
        $n++;
    }
    return $html;
}

function getGaleriaSeccionEN($seccion)
{
    $query="SELECT c.idCategoria, c.nombre, e.title, c.imagenGaleria, e.name, c.carpeta
			FROM categoria AS c
			INNER JOIN seccion_categoria AS s
			ON c.idCategoria = s.idCategoria
			INNER JOIN categoria_en as e
			ON e.idCategoria = c.idCategoria
			WHERE c.publicada AND s.idSeccion = ".$seccion."
			ORDER BY s.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col5;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;
	$html[$n]['carpeta']=$col6;
        $n++;
    }
    return $html;
}

function getSeccionCategoria($categoria)
{
    $query="SELECT s.idSeccion, s.nombre, s.titulo, s.descripcion, s.imagen
			FROM seccion AS s
			INNER JOIN seccion_categoria AS c
			ON s.idSeccion = c.idSeccion
			WHERE c.idCategoria = ".$categoria."
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    while ($row = $stmt->fetch())
    {
	$html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
	$html['descripcion']=$col4;
	$html['imagen']=$col5; 
    }
    return $html;
}

function getCategoria($id)
{
    $query="SELECT idCategoria, nombre, titulo, descripcion, imagen, carpeta
            FROM categoria
            WHERE idCategoria=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['descripcion']=$col4;
        $html['imagen']=$col5;
        $html['carpeta']=$col6;
    }
    return $html;
}



function getCategoriaEN($id)
{
    $query="SELECT c.idCategoria, e.name, e.title, e.description, c.imagen, c.nombre, c.carpeta
            FROM categoria as c inner join categoria_en as e
            on c.idCategoria = e.idCategoria
            WHERE c.idCategoria=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['descripcion']=$col4;
        $html['imagen']=$col5;
        $html['carpeta']=$col7;
    }
    return $html;
}

function getGaleriaCategoria($categoria, $n, $s)
{
    $ini=($s - 1) * $n;
    
    $query="SELECT i.idItem, i.nombre, i.titulo, i.imagen
			FROM item AS i
			INNER JOIN categoria_item AS c
			ON c.idItem = i.idItem
			WHERE i.publicado AND c.idCategoria = ".$categoria." Order by i.nombre LIMIT ".$ini.", ".$n;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;

        $n++;
    }
    return $html;
}

function getGaleriaCategoriaEN($categoria, $n, $s)
{
    $ini=($s - 1) * $n;

    $query="SELECT i.idItem, i.nombre, e.title, i.imagen
			FROM item AS i INNER JOIN item_en as e
                        ON i.idItem = e.idItem
			INNER JOIN categoria_item AS c
			ON c.idItem = i.idItem
			WHERE i.publicado AND c.idCategoria = ".$categoria." Order by i.nombre LIMIT ".$ini.", ".$n;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['imagen']=$col4;

        $n++;
    }
    return $html;
}
function getAllGaleriaCategoria($categoria, $n, $s, $total)
{
    $ini=($s - 1) * $n;

    $query="SELECT i.idItem, i.nombre, i.titulo, i.imagen
			FROM item AS i
			INNER JOIN categoria_item AS c
			ON c.idItem = i.idItem
			WHERE i.publicado AND c.idCategoria = ".$categoria." Order by i.nombre LIMIT ".$ini.", ".($total-$ini);
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['imagen']=$col4;

        $n++;
    }
    return $html;
}

function getAllGaleriaCategoriaEN($categoria, $n, $s, $total)
{
    $ini=($s - 1) * $n;

    $query="SELECT i.idItem, i.nombre, e.title, i.imagen
            FROM item AS i INNER JOIN item_en as e
            ON i.idItem = e.idItem
            INNER JOIN categoria_item AS c
            ON c.idItem = i.idItem
            WHERE i.publicado AND c.idCategoria = ".$categoria." Order by i.nombre LIMIT ".$ini.", ".($total-$ini);
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['imagen']=$col4;

        $n++;
    }
    return $html;
}

function getTotalGaleriaCategoria($categoria)
{
    $query="SELECT COUNT(i.idItem)
			FROM item AS i
			INNER JOIN categoria_item AS c
			ON c.idItem = i.idItem
			WHERE i.publicado AND c.idCategoria = ".$categoria;
			
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    
    while ($row = $stmt->fetch())
    {
        $html['total']=$col1;
    }
    return $html;
}

function getItem($id)
{
    $query="SELECT idItem, nombre, titulo, descripcion, imagen, dimension, emision, material, color, impresion, precio
			FROM item
			WHERE idItem=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['descripcion']=$col4;
        $html['imagen']=$col5;
        $html['dimension']=$col6;
        $html['emision']=$col7;
        $html['material']=$col8;  
        $html['color']=$col9;
        $html['impresion']=$col10;
        $html['precio']=$col11;
		
    }
    return $html;
}

function getItemEN($id)
{
    $query="SELECT i.idItem, i.nombre, e.title, e.description, i.imagen, e.dimension, e.emision, e.material, e.color, e.impresion, i.precio
			FROM item as i inner join item_en as e
			on i.idItem = e.idItem
			WHERE e.idItem=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['descripcion']=$col4;
        $html['imagen']=$col5;
        $html['dimension']=$col6;
        $html['emision']=$col7;
        $html['material']=$col8;  
        $html['color']=$col9;
        $html['impresion']=$col10;
        $html['precio']=$col11;
    }
    return $html;
}

function getNextInGal($id, $idCat)
{
    $item = getItem($id);
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio
            FROM item AS i
            INNER JOIN categoria_item AS c
            ON c.idItem = i.idItem
            WHERE i.publicado AND c.idCategoria = ".$idCat." AND i.nombre>'".$item['nombre']."' Order by i.nombre Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
	
    $categoria = getCategoria($idCat);
    $seccion = getSeccionCategoria($idCat);

    $html = array();
	
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=utf8_decode($col3);
        $html['descripcion']=utf8_decode($col4);
        $html['imagen']=$col5;
        $html['dimension']=utf8_decode($col6);
        $html['emision']=utf8_decode($col7);
        $html['material']=utf8_decode($col8);
        $html['color']=utf8_decode($col9);
        $html['impresion']=utf8_decode($col10);
        $html['precio']=$col11;
        $html['url'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p=0';
    }

    if(count($html)==0)
    {
        $html = getPrimeroInGal($idCat);
    }

    return $html;
}

function getPrimeroInGal($idCat)
{
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio
            FROM item AS i
            INNER JOIN categoria_item AS c
            ON c.idItem = i.idItem
            WHERE i.publicado AND c.idCategoria = ".$idCat." Order by i.nombre Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);

    $categoria = getCategoria($idCat);
    $seccion = getSeccionCategoria($idCat);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=utf8_decode($col3);
        $html['descripcion']=utf8_decode($col4);
        $html['imagen']=$col5;
        $html['dimension']=utf8_decode($col6);
        $html['emision']=utf8_decode($col7);
        $html['material']=utf8_decode($col8);
        $html['color']=utf8_decode($col9);
        $html['impresion']=utf8_decode($col10);
        $html['precio']=$col11;
        $html['url'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p=0';
    }

    return $html;
}

function getPrevInGal($id, $idCat)
{
    $item = getItem($id);
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio
            FROM item AS i
            INNER JOIN categoria_item AS c
            ON c.idItem = i.idItem
            WHERE i.publicado AND c.idCategoria = ".$idCat." AND i.nombre<'".$item['nombre']."' Order by i.nombre DESC Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);

    $categoria = getCategoria($idCat);
    $seccion = getSeccionCategoria($idCat);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=utf8_decode($col3);
        $html['descripcion']=utf8_decode($col4);
        $html['imagen']=$col5;
        $html['dimension']=utf8_decode($col6);
        $html['emision']=utf8_decode($col7);
        $html['material']=utf8_decode($col8);
        $html['color']=utf8_decode($col9);
        $html['impresion']=utf8_decode($col10);
        $html['precio']=$col11;
        $html['url'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p=0';
    }

    if(count($html)==0)
    {
        $html = getUltimoInGal($idCat);
    }

    return $html;
}

function getUltimoInGal($idCat)
{
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio
            FROM item AS i
            INNER JOIN categoria_item AS c
            ON c.idItem = i.idItem
            WHERE i.publicado AND c.idCategoria = ".$idCat." Order by i.nombre DESC Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);

    $categoria = getCategoria($idCat);
    $seccion = getSeccionCategoria($idCat);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=utf8_decode($col3);
        $html['descripcion']=utf8_decode($col4);
        $html['imagen']=$col5;
        $html['dimension']=utf8_decode($col6);
        $html['emision']=utf8_decode($col7);
        $html['material']=utf8_decode($col8);
        $html['color']=utf8_decode($col9);
        $html['impresion']=utf8_decode($col10);
        $html['precio']=$col11;
        $html['url'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s='.utf8_decode($seccion['nombre']).'&c='.utf8_decode($categoria['carpeta']).'&i='.utf8_decode($col5).'&p=0';
    }

    return $html;
}

function EstaCarItem($id, $car)
{
    $query="SELECT idImagen FROM carrito_imagen WHERE idImagen=$id and idCarrito=$car";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return FALSE;
    $stmt->bind_result($col1);
    $row = $stmt->fetch();
    $html=$col1;
    return $html;
}

function getCategoriaItem($item)
{
    $query="SELECT c.nombre
			FROM categoria AS c
			INNER JOIN categoria_item AS i
			ON c.idCategoria = i.idCategoria
			WHERE i.idItem = ".$item."
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $html['nombre']=$col1; 
    }
    return $html;
}


?>
