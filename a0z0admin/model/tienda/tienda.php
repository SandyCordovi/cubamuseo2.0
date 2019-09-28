<?php

function getTextoTienda()
{
    $query="SELECT t.nombre, e.name, t.descripcion, e.description, t.imagen
			FROM texto as t inner join texto_en as e
			on t.idTexto = e.idtexto
			WHERE t.idTexto = 7";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $html = array();
    while($row = $stmt->fetch())
    {
        $html['nombre']=$col1;
        $html['name']=$col2;
        $html['descripcion']=$col3;
        $html['description']=$col4;
        $html['imagen']=$col5;
    }
    return $html;
}

function EditTextoTienda($nombre, $name, $imagen, $descripcion, $description)
{
    $query="UPDATE texto SET nombre = '$nombre', descripcion = '$descripcion' 
			WHERE idTexto = 7";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    if($imagen != "" or $imagen != null)
    {
		$query="UPDATE texto SET imagen = '$imagen'
				WHERE idTexto = 7";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }    
	if ($stmt)
    {
		$query="UPDATE texto_en SET name = '$name', description = '$description' 
			    WHERE idTexto = 7";
		$model = new model();
		$stmt = $model->get_stmt($query);
        if ($stmt)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }
    else
    {
        return FALSE;
    }
}

function getTematicas($p, $b)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT t.idTematica, t.titulo, t.publicada
			FROM tienda_tematica as t 
			WHERE t.titulo like '%$b%'
			ORDER BY t.orden LIMIT $ini, $n";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3);
	$n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['titulo']=$col2;  
		$html[$n]['publicada']=$col3;  
		$n++;
    }
    return $html;
}

function getTematicasSP()
{
    $query="SELECT t.idTematica, t.titulo, t.publicada
			FROM tienda_tematica as t
			WHERE 1
			ORDER BY t.orden";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3);
	$n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['titulo']=$col2;
        $n++;
    }
    return $html;
}

function getTotalTematicas($b)
{
    $query="SELECT COUNT(t.idTematica)
			FROM tienda_tematica as t
			WHERE t.titulo like '%$b%'
			ORDER BY t.orden";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    $n = 0;
    $html = 0;
    while ($row = $stmt->fetch())
    {
        $html=$col1;
    }
    return $html;
}

function getTematica($id)
{
    $query="SELECT t.idTematica, t.nombre, e.name, t.titulo, e.title, t.imagenMenu, t.publicada
			FROM tienda_tematica as t inner join tienda_tematica_en as e
			on t.idTematica = e.idTematica
			WHERE t.idTematica = ".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['name']=$col3;
        $html['titulo']=$col4;  
        $html['title']=$col5;
        $html['imagenMenu']=$col6;  
		$html['publicada']=$col7;  
    }
    return $html;
}

function DeleteTematica($id)
{
	//cogiendo el orden actual
	$orden_actual = 0;
	$query="SELECT orden
			FROM tienda_tematica
			WHERE idTematica=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_actual = $col1;
    }
	
    //eliminado los items de la tematica
    $query="SELECT idItem
			FROM tienda_tematica_item
			WHERE idTematica=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina el item  
        DeleteItemTienda($col1);
    }
	
	//eliminado las referencia de las items de la tematica
    $query="DELETE FROM tienda_tematica_item WHERE idTematica=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	    
    //eliminando el ingles
    $query="DELETE FROM tienda_tematica_en WHERE idTematica=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando la tematica
    $query="DELETE FROM tienda_tematica WHERE idTematica=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt) 
	{	
		//cambiando el orden
		$query="SELECT idTematica
				FROM tienda_tematica
				WHERE orden > $orden_actual";
		$model = new model();
		$stmt = $model->get_stmt($query);
		$stmt->bind_result($col1);
		while ($row = $stmt->fetch())
		{
			//actualiza el orden 
			$query="UPDATE tienda_tematica SET orden = orden -1 
				    WHERE idTematica = $col1";
			$model = new model();
			$stmt = $model->get_stmt($query);
			if ($stmt) 
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}          	
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function DeleteItemTienda($id)
{
	//eliminado las referencia de la categoria y los items
    $query="DELETE FROM tienda_tematica_item WHERE idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
		
	//eliminado las referencia del item y el carrito
    $query="DELETE FROM carrito_tienda WHERE idItemTienda=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminando el ingles
    $query="DELETE FROM tienda_item_en WHERE idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando el item
    $query="DELETE FROM tienda_item WHERE idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt) {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function ChangePubTematica($id,$pub)
{	
	$query="UPDATE tienda_tematica SET publicada = $pub
			WHERE idTematica = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);
		    
	if ($stmt)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}    
}

function SubeTematica($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM tienda_tematica
			WHERE idTematica=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
		$orden_nuevo = $orden_anterior -1;
    }	
	
    $query="UPDATE tienda_tematica SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    $query="UPDATE tienda_tematica SET orden = $orden_nuevo
			WHERE idTematica = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);
		    
	if ($stmt)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}    
}

function BajaTematica($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM tienda_tematica
			WHERE idTematica=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
		$orden_nuevo = $orden_anterior + 1;
    }	
	
    $query="UPDATE tienda_tematica SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	$query="UPDATE tienda_tematica SET orden = $orden_nuevo
			WHERE idTematica = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);
		    
	if ($stmt)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}    
}

function AddTematica($nombre, $name, $titulo, $title, $imagenMenu)
{
    $orden = getMayorOrdenTematica()+1;
    $query="INSERT INTO tienda_tematica VALUES(null,'$nombre','$titulo',1,$orden,'$imagenMenu')";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idTematica
				FROM tienda_tematica
				ORDER BY idTematica DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO tienda_tematica_en VALUES($id_actual,'$name','$title')";
        $model = new model();
        $stmt = $model->get_stmt($query);
        if ($stmt)
        {
                return TRUE;
        }
        else
        {
                return FALSE;
        }
    }
    else
    {
        return FALSE;
    }
}

function EditTematica($id, $nombre, $name, $titulo, $title, $imagenMenu)
{
    $query="UPDATE tienda_tematica SET nombre = '$nombre', titulo = '$titulo'
			WHERE idTematica = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    if($imagenMenu != "" or $imagenMenu != null)
    {
		$query="UPDATE tienda_tematica SET imagenMenu = '$imagenMenu'
				WHERE idTematica = $id";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }
    if ($stmt)
    {
		$query="UPDATE tienda_tematica_en SET name = '$name', title = '$title'
			    WHERE idTematica = $id";
		$model = new model();
		$stmt = $model->get_stmt($query);
        if ($stmt)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }
    else
    {
        return FALSE;
    }
}

function getMayorOrdenTematica()
{
	$query="SELECT t.orden
			FROM tienda_tematica as t 
			ORDER BY t.orden DESC LIMIT 0, 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);	
    while ($row = $stmt->fetch())
    {
        return $col1;
    }
    return 0;
}

function getItems($p, $b, $tematica)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT i.idItem, i.titulo, i.estado
			FROM tienda_item as i inner join tienda_tematica_item as t
			ON t.idItem = i.idItem
			WHERE i.titulo like '%$b%' and t.idTematica = $tematica
			ORDER BY t.orden LIMIT $ini, $n";
			
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3);
	$n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['titulo']=$col2;
        $html[$n]['publicada']=$col3;

		$n++;
    }
    return $html;
}

function getTotalItems($b, $tematica)
{
    $query="SELECT COUNT(i.idItem)
			FROM tienda_item as i inner join tienda_tematica_item as t
			ON t.idItem = i.idItem
			WHERE i.titulo like '%$b%' and t.idTematica = $tematica
			ORDER BY t.orden";
	
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    $n = 0;
    $html = 0;
    while ($row = $stmt->fetch())
    {
        $html=$col1;
    }
    return $html;
}

function getItem($id)
{
    $query="SELECT i.idItem, i.nombre, e.name, i.titulo, e.title, i.descripcion, e.description,  i.imagen, i.imagen_ampliada, i.precio, i.precio_envio, i.precio_envio_fuera
			FROM tienda_item as i inner join tienda_item_en as e
			ON e.idItem = i.idItem
			WHERE i.idItem = $id";
			
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12);
	$n = 0;
    while ($row = $stmt->fetch())
    {
	$html['id']=$col1;
        $html['nombre']=$col2;
        $html['name']=$col3;
        $html['titulo']=$col4;  
        $html['title']=$col5;
        $html['descripcion']=$col6;
        $html['description']=$col7;
        $html['imagen']=$col8;
        $html['imagenAmpliada']=$col9;  
        $html['precio']=$col10;
	$html['precio_us']=$col11;
	$html['precio_nus']=$col12;
	$n++;
    }
    return $html;
}

function AddItem($nombre, $name, $titulo, $title, $imagen, $imagenAmpliada, $descripcion, $description, $precio, $precio_us, $precio_nus, $tematica)
{
    $orden = getMayorOrdenItem($tematica)+1;
    $query="INSERT INTO tienda_item VALUES(null,'$titulo','$nombre', $precio, '$imagen', 1, '$descripcion',$precio_us,$precio_nus,'$imagenAmpliada')";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idItem
                FROM tienda_item
                ORDER BY idItem DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO tienda_item_en VALUES($id_actual,'$title','$name','$description')";
        $model = new model();
        $stmt = $model->get_stmt($query);
		
		$query="INSERT INTO tienda_tematica_item VALUES($tematica, $id_actual, $orden)";
        $model = new model();
        $stmt = $model->get_stmt($query);
		
        if ($stmt)
        {
                return TRUE;
        }
        else
        {
                return FALSE;
        }
    }
    else
    {
        return FALSE;
    }
}

function getMayorOrdenItem($tematica)
{
	$query="SELECT t.orden
			FROM tienda_tematica_item as t
			WHERE idTematica = $tematica
			ORDER BY t.orden DESC LIMIT 0, 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);	
    while ($row = $stmt->fetch())
    {
        return $col1;
    }
    return 0;
}

function EditItem($id, $nombre, $name, $titulo, $title, $imagen, $imagenAmpliada, $precio, $precio_us, $precio_nus, $descripcion, $description, $tematica)
{
    $query="UPDATE tienda_item
            SET nombre = '$nombre', titulo = '$titulo', descripcion = '$descripcion', precio = $precio, precio_envio = $precio_us, precio_envio_fuera = $precio_nus
            WHERE idItem = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if($imagen != "" or $imagen != null)
    {
		$query="UPDATE tienda_item SET imagen = '$imagen'
			WHERE idItem = $id";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }
     if($imagenAmpliada != "" or $imagenAmpliada != null)
    {
		$query="UPDATE tienda_item SET imagen_ampliada = '$imagenAmpliada'
			WHERE idItem = $id";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }
    if ($stmt)
    {
		$query="UPDATE tienda_item_en SET name = '$name', title = '$title', description = '$description'
			    WHERE idItem = $id";
		$model = new model();
		$stmt = $model->get_stmt($query);
                 if ($stmt)
		{
                    $query="UPDATE tienda_tematica_item SET idTematica = $tematica
			    WHERE idItem = $id";
                    $model = new model();
                    $stmt = $model->get_stmt($query);
                     if ($stmt)
                    {

                            return TRUE;
                    }
                    else
                    {
                            return FALSE;
                    }
		}
		else
		{
			return FALSE;
		}
    }
    else
    {
        return FALSE;
    }
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

function ChangePubItem($id,$pub)
{
    $query="UPDATE tienda_item SET estado = $pub
                    WHERE idItem = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if ($stmt)
    {
            return TRUE;
    }
    else
    {
            return FALSE;
    }
}

function SubeItem($id, $tematica)
{
    //cogiendo el orden actual
    $orden_anterior = 0;
    $orden_nuevo = 0;
    $query="SELECT orden
            FROM tienda_tematica_item
            WHERE idTematica=$tematica and idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
	$orden_nuevo = $orden_anterior -1;
    }

    $query="UPDATE tienda_tematica_item SET orden = $orden_anterior
	    WHERE orden = $orden_nuevo and idTematica = $tematica";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="UPDATE tienda_tematica_item SET orden = $orden_nuevo
            WHERE idItem = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if ($stmt)
    {
            return TRUE;
    }
    else
    {
            return FALSE;
    }
}

function BajaItem($id, $tematica)
{
    //cogiendo el orden actual
    $orden_anterior = 0;
    $orden_nuevo = 0;
    $query="SELECT orden
            FROM tienda_tematica_item
            WHERE idTematica=$tematica and idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
		$orden_nuevo = $orden_anterior + 1;
    }

    $query="UPDATE tienda_tematica_item SET orden = $orden_anterior
	    WHERE orden = $orden_nuevo and idTematica = $tematica";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="UPDATE tienda_tematica_item SET orden = $orden_nuevo
            WHERE idItem = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if ($stmt)
    {
            return TRUE;
    }
    else
    {
            return FALSE;
    }
}



?>

