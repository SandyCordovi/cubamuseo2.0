<?php

function getGaleriaTienda($categoria)
{
    $query="SELECT i.idItem, i.nombre, i.titulo, i.imagen
			FROM  tienda_item AS i
			INNER JOIN tienda_tematica_item AS t
			ON i.idItem = t.idItem
			WHERE t.idTematica = ".$categoria."
			ORDER BY t.orden
			";
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


function getGaleriaTiendaEN($categoria)
{
    $query="SELECT i.idItem, e.name, i.titulo, i.imagen
			FROM  tienda_item AS i
			INNER JOIN tienda_tematica_item AS t
			ON i.idItem = t.idItem
			INNER JOIN tienda_item_en as e
			ON e.idItem = i.idItem
			WHERE t.idTematica = ".$categoria."
			ORDER BY t.orden
			";
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

function getTematicaTienda($id)
{
    $query="SELECT idTematica, nombre, titulo, imagenMenu
			FROM tienda_tematica
			WHERE idTematica=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
		$html['imagen']=$col4;
                $html['carpeta']=$col2;
    }
    return $html;
}

function getTematicaTiendaEN($id)
{
    $query="SELECT t.idTematica, e.name, e.title, t.imagenMenu, t.nombre
			FROM tienda_tematica as t inner join tienda_tematica_en as e
			WHERE t.idTematica=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;
		$html['imagen']=$col4;
		$html['carpeta']=$col5;
    }
    return $html;
}

function getItemTienda($id)
{
    $query="SELECT idItem, nombre, titulo, imagen, precio, descripcion, precio_envio, precio_envio_fuera, imagen_ampliada
			FROM tienda_item
			WHERE idItem =".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['imagen']=$col4;
        $html['precio']=$col5;
        $html['descripcion']=$col6;
        $html['precioEnvio']=$col7;  
        $html['precioEnvioF']=$col8;
        $html['imagenAmpliada']=$col9;
        $html['tprecioEnvio']=($col7 == 0)?"Gratis":"$".$col7;
        $html['tprecioEnvioF']=($col8 == 0)?"Gratis":"$".$col8;	
    }
    return $html;
}

function getItemTiendaEN($id)
{
    $query="SELECT i.idItem, e.name, e.title, i.imagen, i.precio, e.description, i.precio_envio, i.precio_envio_fuera, i.imagen_ampliada
			FROM tienda_item as i 
			INNER JOIN tienda_item_en as e
			ON i.idItem = e.idItem
			WHERE i.idItem =".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['imagen']=$col4;
        $html['precio']=$col5;
        $html['descripcion']=$col6;
        $html['precioEnvio']=$col7;  
        $html['precioEnvioF']=$col8;
        $html['imagenAmpliada']=$col9;
        $html['tprecioEnvio']=($col7 == 0)?"Gratis":"$".$col7;
        $html['tprecioEnvioF']=($col8 == 0)?"Gratis":"$".$col8;	
    }
    return $html;
}


function getTematicaItem($item)
{
    $query="SELECT t.idTematica, t.nombre, t.titulo, t.imagenMenu
			FROM  tienda_tematica AS t
			INNER JOIN tienda_tematica_item AS i
			ON i.idTematica = t.idTematica
			WHERE i.idItem = ".$item;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);    
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;   
        $html['imagen']=$col4;		
    }
    return $html;
}

function EstaCar($id, $car)
{
    $query="SELECT idItemTienda FROM carrito_tienda WHERE idItemTienda=$id and idCarrito=$car";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return FALSE;
    $stmt->bind_result($col1);
    $row = $stmt->fetch();
    $html=$col1;
    return $html;
}


?>
