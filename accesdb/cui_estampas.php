<?php

function getEstampa($id)
{
    $query="SELECT idEstampa, nombre, titulo, texto, imagenGaleria, carpeta
			FROM estampa
			WHERE idEstampa=".$id;
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

function getEstampaEN($id)
{
    $query="SELECT e.idEstampa, e.carpeta, n.title, n.text, e.imagenGaleria, n.name
            FROM estampa as e
            INNER JOIN estampa_en as n
            ON e.idEstampa = n.idEstampa
            WHERE e.idEstampa=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col6;
        $html['titulo']=$col3;  
        $html['descripcion']=$col4;
        $html['imagen']=$col5;
        $html['carpeta']=$col2;
    }
    return $html;
}

function getMuestra($id)
{
    $query="SELECT idMuestra, nombre, titulo, imagen, imagenGaleria, descripcion, cantImagenes, carpeta
			FROM muestra
			WHERE idMuestra=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['imagen']=$col4;
        $html['imagenG']=$col5;
        $html['descripcion']=$col6;
        $html['cant']=$col7;
        $html['carpeta']=$col8;
    }
    return $html;
}

function getMuestraEN($id)
{
    $query="SELECT m.idMuestra, m.carpeta, e.title, m.imagen, m.imagenGaleria, e.description, m.cantImagenes, e.name
            FROM muestra as m
            INNER JOIN muestra_en as e
            ON m.idMuestra = e.idMuestra
            WHERE m.idMuestra=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col8;
        $html['titulo']=$col3;
        $html['imagen']=$col4;
        $html['imagenG']=$col5;
        $html['descripcion']=$col6;
        $html['cant']=$col7;
        $html['carpeta']=$col2;
    }
    return $html;
}

function getGaleriaEstampas($categoria)
{
    $query="SELECT e.idEstampa, e.nombre, e.titulo, e.imagenGaleria, e.carpeta
			FROM estampa AS e
			INNER JOIN clasificacion_estampa AS c
			ON c.idEstampa = e.idEstampa
			WHERE e.publicada AND c.idCategoriaEstampa = ".$categoria."
			ORDER BY c.orden
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

function getGaleriaEstampasEN($categoria)
{
    $query="SELECT e.idEstampa, e.carpeta, e.titulo, e.imagenGaleria, n.name
			FROM estampa AS e
			INNER JOIN estampa_en as n
			ON e.idEstampa = n.idEstampa
			INNER JOIN clasificacion_estampa AS c
			ON c.idEstampa = e.idEstampa
			WHERE e.publicada AND c.idCategoriaEstampa = ".$categoria."
			ORDER BY c.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col5;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;
		$html[$n]['carpeta']=$col2;
        $n++;
    }
    return $html;
}

function getGaleriaEstampasT()
{
    $query="SELECT e.idEstampa, e.nombre, e.titulo, e.imagenGaleria, e.carpeta
			FROM estampa AS e
			INNER JOIN clasificacion_estampa AS c
			ON c.idEstampa = e.idEstampa
			WHERE e.publicada
			ORDER BY c.orden
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

function getGaleriaEstampasTEN()
{
    $query="SELECT e.idEstampa, e.carpeta, e.titulo, e.imagenGaleria, n.name
			FROM estampa AS e 
			INNER JOIN estampa_en as n
			ON e.idEstampa = n.idEstampa
			INNER JOIN clasificacion_estampa AS c
			ON c.idEstampa = e.idEstampa
			WHERE e.publicada
			ORDER BY c.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col5;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;
		$html[$n]['carpeta']=$col2;
        $n++;
    }
    return $html;
}

function getGaleriaMuestras($categoria)
{
    $query="SELECT m.idMuestra, m.nombre, m.titulo, m.imagenGaleria, m.carpeta
			FROM muestra AS m
			INNER JOIN clasificacion_muestra AS c
			ON m.idMuestra = c.idMuestra
			WHERE m.publicada AND c.idCategoriaEstampa = ".$categoria."
			ORDER BY c.orden
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

function getGaleriaMuestrasEN($categoria)
{
    $query="SELECT m.idMuestra, m.carpeta, m.titulo, m.imagenGaleria, e.name
			FROM muestra AS m
			INNER JOIN muestra_en as e
			ON m.idMuestra = e.idMuestra
			INNER JOIN clasificacion_muestra AS c
			ON m.idMuestra = c.idMuestra
			WHERE m.publicada AND c.idCategoriaEstampa = ".$categoria."
			ORDER BY c.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=utf8_decode($col5);
        $html[$n]['titulo']=utf8_decode($col3);
        $html[$n]['imagen']=$col4;
		$html[$n]['carpeta']=$col2;
        $n++;
    }
    return $html;
}

function getTotalGaleriaMuestra($muestra)
{
    $query="SELECT COUNT(i.idItem)
			FROM item AS i
			INNER JOIN muestra_item AS m
			ON m.idItem = i.idItem
			WHERE i.publicado AND m.idMuestra = ".$muestra;
			
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    
    while ($row = $stmt->fetch())
    {
        $html['total']=$col1;
    }
    return $html;
}

function getGaleriaMuestra($muestra, $n, $s)
{
    $ini=($s - 1) * $n;
    
    $query="SELECT i.idItem, i.nombre, i.titulo, i.imagen
			FROM item AS i
			INNER JOIN muestra_item AS m
			ON m.idItem = i.idItem
			WHERE i.publicado AND m.idMuestra = ".$muestra." Order by i.nombre LIMIT ".$ini.", ".$n;
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

function getAllGaleriaMuestra($muestra, $n, $s, $total)
{
    $ini=($s - 1) * $n;

    $query="SELECT i.idItem, i.nombre, i.titulo, i.imagen
			FROM item AS i
			INNER JOIN muestra_item AS m
			ON m.idItem = i.idItem
			WHERE i.publicado AND m.idMuestra = ".$muestra." Order by i.nombre LIMIT ".$ini.", ".($total-$ini);
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

function getGaleriaMuestrasT() //Aqui habia un error, este metodo no requiere variables
{
    $query="SELECT m.idMuestra, m.nombre, m.titulo, m.imagenGaleria, m.carpeta
			FROM muestra AS m
			INNER JOIN clasificacion_muestra AS c
			ON m.idMuestra = c.idMuestra
			WHERE m.publicada
			ORDER BY c.orden
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

function getGaleriaMuestrasTEN($categoria)
{
    $query="SELECT m.idMuestra, m.carpeta, m.titulo, m.imagenGaleria, e.name
			FROM muestra AS m
			INNER JOIN muestra_en as e
			ON m.idMuestra = e.idMuestra
			INNER JOIN clasificacion_muestra AS c
			ON m.idMuestra = c.idMuestra
			WHERE m.publicada
			ORDER BY c.orden
			";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col5;
        $html[$n]['titulo']=$col3;   
        $html[$n]['imagen']=$col4;
		$html[$n]['carpeta']=$col2;
        $n++;
    }
    return $html;
}

function getNextInGal($id, $idMuestra)
{
    $item = getItem($id);
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio, i.procedencia
            FROM item AS i
            INNER JOIN muestra_item AS m
            ON m.idItem = i.idItem
            WHERE i.publicado AND m.idMuestra = ".$idMuestra." AND i.nombre>'".$item['nombre']."' Order by i.nombre Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11,$col12);

    $muestra = getMuestra($idMuestra);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=utf8_decode($col2);
        $html['titulo']=utf8_decode($col3);
        $html['descripcion']=utf8_decode($col4);
        $html['imagen']=$col5;
        $html['dimension']=utf8_decode($col6);
        $html['emision']=utf8_decode($col7);
        $html['material']=utf8_decode($col8);
        $html['color']=utf8_decode($col9);
        $html['impresion']=utf8_decode($col10);
        $html['precio']=$col11;
        $html['procedencia']=$col12;
        $html['url'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p=0';
    }

    if(count($html)==0)
    {
        $html = getPrimeroInGal($idMuestra);
    }

    return $html;
}

function getPrimeroInGal($idMuestra)
{
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio, i.procedencia
            FROM item AS i
            INNER JOIN muestra_item AS m
            ON m.idItem = i.idItem
            WHERE i.publicado AND m.idMuestra = ".$idMuestra." Order by i.nombre Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11,$col12);

    $muestra = getMuestra($idMuestra);

    $html = array();

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
        $html['procedencia']=$col12;
        $html['url'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p=0';
    }

    return $html;
}

function getPrevInGal($id, $idMuestra)
{
    $item = getItem($id);
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio, i.procedencia
            FROM item AS i
            INNER JOIN muestra_item AS m
            ON m.idItem = i.idItem
            WHERE i.publicado AND m.idMuestra = ".$idMuestra." AND i.nombre<'".$item['nombre']."' Order by i.nombre DESC Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11,$col12);

    $muestra = getMuestra($idMuestra);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']= utf8_decode($col2);
        $html['titulo']=utf8_decode($col3);
        $html['descripcion']=utf8_decode($col4);
        $html['imagen']=$col5;
        $html['dimension']=utf8_decode($col6);
        $html['emision']=utf8_decode($col7);
        $html['material']=utf8_decode($col8);
        $html['color']=utf8_decode($col9);
        $html['impresion']=utf8_decode($col10);
        $html['precio']=$col11;
        $html['procedencia']=$col12;
        $html['url'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p=0';
    }

    if(count($html)==0)
    {
        $html = getUltimoInGal($idMuestra);
    }

    return $html;
}

function getUltimoInGal($idMuestra)
{
    $query="SELECT i.idItem, i.nombre, i.titulo, i.descripcion, i.imagen, i.dimension, i.emision, i.material, i.color, i.impresion, i.precio,i.procedencia
            FROM item AS i
            INNER JOIN muestra_item AS m
            ON m.idItem = i.idItem
            WHERE i.publicado AND m.idMuestra = ".$idMuestra." Order by i.nombre DESC Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12);

    $muestra = getMuestra($idMuestra);

    $html = array();

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
        $html['procedencia']=$col12;
        $html['url'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=Muestras&c='.$muestra['carpeta'].'&i='.$col5.'&p=0';
    }

    return $html;
}

function getItem($id)
{
    $query="SELECT idItem, nombre, titulo, descripcion, imagen, dimension, emision, material, color, impresion, precio, procedencia
			FROM item
			WHERE idItem=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11,$col12);
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
		$html['procedencia']=$col12;
    }
    return $html;
}

function getCategoriaEstampa($id)
{
    $query="SELECT c.idCategoriaEstampa, c.nombre, e.name, c.imagenMenu
            FROM categoriaestampa as c inner join categoriaestampa_en as e
            on c.idCategoriaEstampa = e.idCategoriaEstampa
            WHERE c.idCategoriaEstampa=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['name']=$col3;
        $html['imagenMenu']=$col4;
    }
    return $html;
}


?>
