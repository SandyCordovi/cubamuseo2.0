<?php

function getPostal($id)
{
    $query="SELECT idPostal, nombre, imagen, idCategoria
			FROM postal
			WHERE idPostal=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['imagen']=$col3;  
        $html['categoria']=$col4;
    }
    return $html;
}

function getCategoriaPostal($id)
{
    $query="SELECT idCategoriaPostal, nombre, titulo, imagenMenu, cantImagenes
			FROM categoriapostal
			WHERE idCategoriaPostal=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4,$col5);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
		$html['titulo']=$col3;
        $html['imagen']=$col4;  
		$html['cant']=$col5;
    }
    return $html;
}

function getCategoriaPostalEN($id)
{
    $query="SELECT c.idCategoriaPostal, c.nombre, e.title, c.imagenMenu, c.cantImagenes
			FROM categoriapostal as c inner join categoriapostal_en as e
			ON c.idCategoriaPostal = e.idCategoriaPostal
			WHERE c.idCategoriaPostal=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4,$col5);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
		$html['titulo']=$col3;
        $html['imagen']=$col4;
		$html['cant']=$col5;
    }
    return $html;
}

function getGaleriaCatPostales($cat, $n, $s)
{
    $ini=($s - 1) * $n;
    
    $query="SELECT idPostal, nombre, imagen 
			FROM postal
			WHERE publicada = 1 AND idCategoria = ".$cat." Order by nombre LIMIT ".$ini.", ".$n;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;  
        $html[$n]['imagen']=$col3;
        $n++;
    }
    return $html;
}

function getAllGaleriaCatPostales($cat, $n, $s, $total)
{
    $ini=($s - 1) * $n;

	$query="SELECT idPostal, nombre, imagen 
			FROM postal
			WHERE publicada = 1 AND idCategoria = ".$cat." Order by nombre LIMIT ".$ini.", ".($total-$ini);
   
   $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['imagen']=$col3;
        $n++;
    }
    return $html;
}

function getTotalGaleriaCatPostales($cat)
{
    $query="SELECT COUNT(idPostal)
            FROM postal
            WHERE publicada AND idCategoria= ".$cat;
			
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    
    while ($row = $stmt->fetch())
    {
        $html['total']=$col1;
    }
    return $html;
}

function getNextInGal($id, $idCategoria)
{
    $postal = getPostal($id);
    $query="SELECT idPostal, nombre, imagen, idCategoria
            FROM postal
            WHERE publicada AND idCategoria = ".$idCategoria." AND imagen>'".$postal['imagen']."' Order by nombre Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);

    $catPostal = getCategoriaPostal($idCategoria);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$catPostal['nombre'];
        $html['imagen']=$col3;
        $html['categoria']=$col4;
        $html['url'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p=0';
    }

    if(count($html)==0)
    {
        $html = getPrimeroInGal($idCategoria);
    }

    return $html;
}

function getPrimeroInGal($idCategoria)
{
	$query="SELECT idPostal, nombre, imagen, idCategoria
            FROM postal
            WHERE publicada AND idCategoria = ".$idCategoria." Order by imagen Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);

    $catPostal = getCategoriaPostal($idCategoria);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$catPostal['nombre'];
        $html['imagen']=$col3;
        $html['categoria']=$col4;
        $html['url'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p=0';
    }

    return $html;
}

function getPrevInGal($id, $idCategoria)
{
    $postal = getPostal($id);
    $query="SELECT idPostal, nombre, imagen, idCategoria
            FROM postal
            WHERE publicada AND idCategoria = ".$idCategoria." AND imagen<'".$postal['imagen']."' Order by imagen DESC Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);

    $catPostal = getCategoriaPostal($idCategoria);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$catPostal['nombre'];
        $html['imagen']=$col3;
        $html['categoria']=$col4;
        $html['url'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p=0';
    }

    if(count($html)==0)
    {
        $html = getUltimoInGal($idCategoria);
    }

    return $html;
}

function getUltimoInGal($idCategoria)
{
   $query="SELECT idPostal, nombre, imagen, idCategoria
            FROM postal
            WHERE publicada AND idCategoria = ".$idCategoria." Order by imagen DESC Limit 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);

    $catPostal = getCategoriaPostal($idCategoria);

    $html = array();

    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$catPostal['nombre'];
        $html['imagen']=$col3;
        $html['categoria']=$col4;
        $html['url'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p='.Configuracion::$dimencion_navegacion;//'imagenes/'.$seccion['nombre'].'/'.$categoria['nombre'].'/'.$col5;
        $html['urlZoom'] = 'service/ri.php?s=V-Posts&c='.$catPostal['nombre'].'&i='.$col3.'&p=0';
    }

    return $html;
}

?>
