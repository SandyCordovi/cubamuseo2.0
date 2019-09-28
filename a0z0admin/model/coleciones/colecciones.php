<?php

function getSecciones($p, $b)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT s.idSeccion, s.titulo, s.publicada
			FROM seccion as s 
			WHERE s.titulo like '%$b%'
			ORDER BY s.orden LIMIT $ini, $n";
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

function getSeccionesSP()
{
    $query="SELECT s.idSeccion, s.titulo, s.publicada
			FROM seccion as s
			WHERE 1
			ORDER BY s.orden";
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

function getCategoriasSPSecc($secc)
{
    $query="SELECT s.idCategoria, s.titulo, s.publicada
			FROM categoria as s inner join seccion_categoria as sc on s.idCategoria=sc.idCategoria
			WHERE sc.idSeccion=$secc
			ORDER BY sc.orden";
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

function getTotalSecciones($b)
{
    $query="SELECT COUNT(s.idSeccion)
			FROM seccion as s
			WHERE s.titulo like '%$b%'
			ORDER BY s.orden";
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

function getSeccion($id)
{
    $query="SELECT s.idSeccion, s.nombre, e.name, s.titulo, e.title, s.descripcion, e.description, s.imagen, s.imagenMenu, s.publicada
			FROM seccion as s inner join seccion_en as e
			on s.idSeccion = e.idSeccion
			WHERE s.idSeccion=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10);
    $html = array();
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
        $html['imagenMenu']=$col9;  
        $html['publicada']=$col10;
    }
    return $html;
}

function AddSeccion($nombre, $name, $titulo, $title, $imagen, $imagenMenu, $descripcion, $description)
{
    $orden = getMayorOrdenSeccion()+1;
    $query="INSERT INTO seccion VALUES(null,'$nombre','$titulo','$descripcion','$imagen','$imagenMenu',1,$orden,1)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idSeccion
                        FROM seccion
                        ORDER BY idSeccion DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO seccion_en VALUES($id_actual,'$name','$title','$description')";
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

function EditSeccion($id, $nombre, $name, $titulo, $title, $imagen, $imagenMenu, $descripcion, $description)
{
    $query="UPDATE seccion SET nombre = '$nombre', titulo = '$titulo', descripcion = '$descripcion' 
			WHERE idSeccion = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    if($imagen != "" or $imagen != null)
    {
            $query="UPDATE seccion SET imagen = '$imagen'
                            WHERE idSeccion = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }
    if($imagenMenu != "" or $imagenMenu != null)
    {
            $query="UPDATE seccion SET imagenMenu = '$imagenMenu'
                            WHERE idSeccion = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }
    if ($stmt)
    {
		$query="UPDATE seccion_en SET name = '$name', title = '$title', description = '$description' 
			    WHERE idSeccion = $id";
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

function getMayorOrdenSeccion()
{
	$query="SELECT s.orden
			FROM seccion as s 
			ORDER BY s.orden DESC LIMIT 0, 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);	
    while ($row = $stmt->fetch())
    {
        return $col1;
    }
    return 0;
}

function DeleteSeccion($id)
{
	//cogiendo el orden actual
	$orden_actual = 0;
	$query="SELECT orden
			FROM seccion
			WHERE idSeccion=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_actual = $col1;
    }
	
    //eliminado las categorias de la seccion
    $query="SELECT idCategoria
                    FROM seccion_categoria
                    WHERE idSeccion=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina la categoria  
        DeleteCategoria($col1);
    }
	
	//eliminado las referencia de las categorias de la seccion
    $query="DELETE FROM seccion_categoria WHERE idSeccion=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	    
    //eliminando el ingles
    $query="DELETE FROM seccion_en WHERE idSeccion=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando la seccion
    $query="DELETE FROM seccion WHERE idSeccion=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt) {
		
		//cambiando el orden
		$query="SELECT idSeccion
				FROM seccion
				WHERE orden > $orden_actual";
		$model = new model();
		$stmt = $model->get_stmt($query);
		$stmt->bind_result($col1);
		while ($row = $stmt->fetch())
		{
			//actualiza el orden 
			$query="UPDATE seccion SET orden = orden -1 
				    WHERE idSeccion = $col1";
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

function DeleteCategoria($id)
{
    //eliminado las referencia de las categorias de la seccion
    $query="DELETE FROM seccion_categoria WHERE idCategoria=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    //eliminado los items de la categoria
    $query="SELECT idItem
			FROM categoria_item
			WHERE idCategoria=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina el item 
        DeleteItem($col1);
    }
	
	//eliminado las referencia de la categoria y los items
    $query="DELETE FROM categoria_item WHERE idCategoria=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminando el ingles
    $query="DELETE FROM categoria_en WHERE idCategoria=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando la categoria
    $query="DELETE FROM categoria WHERE idCategoria=$id";
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

function DeleteItemOfCategoria($cat)
{
    //eliminado los items de la categoria
    $query="SELECT idItem
            FROM categoria_item
            WHERE idCategoria=".$cat;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina el item
        DeleteItem($col1);
    }
}

function getAllItemCateg($cat)
{
    $query="SELECT i.idItem, i.nombre, i.imagen
            FROM categoria_item as ci inner join item as i on ci.idItem=i.idItem
            WHERE ci.idCategoria=".$cat;
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col0,$col1,$col2);
    $html=array();
    $i=0;
    while ($row = $stmt->fetch())
    {
        $html[$i]['id']=$col0;
        $html[$i]['nombre']=$col1;
        $html[$i]['imagen']=$col2;
        $i++;
    }
    return $html;
}

function getItem($p, $b, $cat)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;
    
    $query="SELECT i.idItem, i.nombre, i.titulo
            FROM categoria_item as ci inner join item as i on ci.idItem=i.idItem
            WHERE (i.nombre like '%$b%' or i.titulo like '%$b%') and ci.idCategoria=$cat Order BY i.nombre LIMIT $ini, $n";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col0,$col1,$col2);
    $html=array();
    $i=0;
    while ($row = $stmt->fetch())
    {
        $html[$i]['id']=$col0;
        $html[$i]['nombre']=$col1;
        $html[$i]['titulo']=$col2;
        $i++;
    }
    return $html;
}

function getTotalItem($b, $cat)
{
    $query="SELECT COUNT(i.idItem)
            FROM categoria_item as ci inner join item as i on ci.idItem=i.idItem
            WHERE (i.nombre like '%$b%' or i.titulo like '%$b%') and ci.idCategoria=$cat";

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

function DeleteItem($id)
{
	//eliminado las referencia de la categoria y los items
    $query="DELETE FROM categoria_item WHERE idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminado las referencia de la muestra y los items
    $query="DELETE FROM muestra_item WHERE idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminado las referencia del item y el carrito
    $query="DELETE FROM carrito_imagen WHERE idImagen=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminando el ingles
    $query="DELETE FROM item_en WHERE idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando el item
    $query="DELETE FROM item WHERE idItem=$id";
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

function SubeSeccion($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM seccion
			WHERE idSeccion=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
	$orden_nuevo = $orden_anterior -1;
    }	
	
    $query="UPDATE seccion SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    $query="UPDATE seccion SET orden = $orden_nuevo
			WHERE idSeccion = $id";
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

function SubeCategoria($id)
{
    //cogiendo el orden actual
    $orden_anterior = 0;
    $orden_nuevo = 0;
    $query="SELECT orden
                    FROM seccion_categoria
                    WHERE idCategoria=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
	$orden_nuevo = $orden_anterior -1;
    }

    $query="UPDATE seccion_categoria SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="UPDATE seccion_categoria SET orden = $orden_nuevo
			WHERE idCategoria = $id";
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

function BajaSeccion($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM seccion
			WHERE idSeccion=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
		$orden_nuevo = $orden_anterior + 1;
    }	
	
    $query="UPDATE seccion SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	$query="UPDATE seccion SET orden = $orden_nuevo
			WHERE idSeccion = $id";
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

function BajaCategoria($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM seccion_categoria
			WHERE idCategoria=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
        $orden_nuevo = $orden_anterior + 1;
    }

    $query="UPDATE seccion_categoria SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);

	$query="UPDATE seccion_categoria SET orden = $orden_nuevo
			WHERE idCategoria = $id";
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

function ChangePubSeccion($id,$pub)
{	
    $query="UPDATE seccion SET publicada = $pub
                    WHERE idSeccion = $id";
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

function ChangePubCategoria($id,$pub)
{
    $query="UPDATE categoria SET publicada = $pub
                    WHERE idCategoria = $id";
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

function getCategorias($p, $b, $seccion)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT c.idCategoria, c.titulo, c.publicada
			FROM categoria as c inner join seccion_categoria as s
			ON c.idCategoria = s.idCategoria
			WHERE c.titulo like '%$b%' and s.idSeccion = $seccion
			ORDER BY s.orden LIMIT $ini, $n";
			
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

function getTotalCategorias($b, $seccion)
{
    $query="SELECT COUNT(c.idCategoria)
			FROM categoria as c inner join seccion_categoria as s
			ON c.idCategoria = s.idCategoria
			WHERE c.titulo like '%$b%' and s.idSeccion = $seccion
			ORDER BY s.orden";
	
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

function getCategoria($id)
{
    $query="SELECT c.idCategoria, c.nombre, e.name, c.titulo, e.title, c.descripcion, e.description, c.imagen, c.imagenGaleria, c.cantImagenes, sc.idSeccion
			FROM categoria as c inner join categoria_en as e on c.idCategoria = e.idCategoria
                        inner join seccion_categoria as sc on c.idCategoria=sc.idCategoria
			WHERE c.idCategoria=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
    $html = array();
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
        $html['imagenGaleria']=$col9;  
        $html['cant']=$col10;
        $html['seccion']=$col11;
    }
    return $html;
}

function getCategoriaByNombre($nombre)
{
    $query="SELECT c.idCategoria, c.nombre, e.name, c.titulo, e.title, c.descripcion, e.description, c.imagen, c.imagenGaleria, c.cantImagenes
			FROM categoria as c inner join categoria_en as e
			on c.idCategoria = e.idCategoria
			WHERE c.nombre='".$nombre."'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10);
    $html = array();
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
        $html['imagenGaleria']=$col9;  
        $html['cant']=$col10;
    }
    return $html;
}

function AddCategoria($nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, $cantImagenes, $seccion,$siglo)
{
    $orden = getMayorOrdenCategoria($seccion)+1;
    $query="INSERT INTO categoria VALUES(null,'$nombre','$titulo','$imagenGaleria','$imagen','$descripcion',1,$cantImagenes,1,'$nombre')";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idCategoria
                        FROM categoria
                        ORDER BY idCategoria DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO categoria_en VALUES($id_actual,'$name','$title','$description')";
        $model = new model();
        $stmt = $model->get_stmt($query);
		
        $query="INSERT INTO seccion_categoria VALUES($seccion, $id_actual, $orden, $siglo)";
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

function getLastCategoria()
{
    $id_actual = 0;
    $query="SELECT idCategoria
                    FROM categoria
                    ORDER BY idCategoria DESC LIMIT 0, 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $id_actual = $col1;
    }
    return $id_actual;
}

function EditCategoria($id, $nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, $cantImagenes, $seccion, $siglo)
{
    $query="UPDATE categoria SET nombre = '$nombre', titulo = '$titulo', descripcion = '$descripcion'
			WHERE idCategoria = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="UPDATE seccion_categoria SET idSeccion = $seccion
                            WHERE idCategoria = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if($imagen)
    {
            $query="UPDATE categoria SET imagen = '$imagen'
                            WHERE idCategoria = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }
    if($imagenGaleria)
    {
            $query="UPDATE categoria SET imagenGaleria = '$imagenGaleria'
                            WHERE idCategoria = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }

    if ($stmt)
    {
        $query="UPDATE categoria_en SET name = '$name', title = '$title', description = '$description'
                    WHERE idCategoria = $id";
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

function getMayorOrdenCategoria($seccion)
{
	$query="SELECT s.orden
			FROM seccion_categoria as s 
			WHERE idSeccion = $seccion
			ORDER BY s.orden DESC LIMIT 0, 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);	
    while ($row = $stmt->fetch())
    {
        return $col1;
    }
    return 0;
}

function getTextoGaleria()
{
    $query="SELECT t.nombre, e.name, t.descripcion, e.description, t.imagen
			FROM texto as t inner join texto_en as e
			on t.idTexto = e.idtexto
			WHERE t.idTexto=1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['nombre']=$col1;
        $html['name']=$col2;
        $html['descripcion']=$col3;
        $html['description']=$col4;
        $html['imagen']=$col5;
    }
    return $html;
}

function EditTextoGaleria($nombre, $name, $imagen, $descripcion, $description)
{
    $query="UPDATE texto SET nombre = '$nombre', descripcion = '$descripcion' 
			WHERE idTexto = 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    if($imagen != "" or $imagen != null)
    {
		$query="UPDATE texto SET imagen = '$imagen'
				WHERE idTexto = 1";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }    
	if ($stmt)
    {
		$query="UPDATE texto_en SET name = '$name', description = '$description' 
			    WHERE idTexto = 1";
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

function AddItem($nombre, $titulo, $title, $imagen, $descripcion, $description, $dimension, $dimensione, $imageSize, $emision, $emisione, $material, $materiale, $color, $colore, $impresion, $impresione, $precio, $categoria)
{
    $query="INSERT INTO item VALUES(null,'$nombre','$titulo','$imagen','$descripcion','$dimension','$imageSize','$emision','$material','$color','$impresion',0,1,1)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idItem
                        FROM item
                        ORDER BY idItem DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO item_en VALUES($id_actual,'$title','$description','$emisione','$materiale','$colore','$impresione','$dimensione')";
        $model = new model();
        $stmt = $model->get_stmt($query);
		
        $query="INSERT INTO categoria_item VALUES($categoria, $id_actual, 1)";
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

function EditItem($id, $titulo, $title, $descripcion, $description, $dimension, $dimensione, $emision, $emisione, $material, $materiale, $color, $colore, $impresion, $impresione, $precio)
{
    $query="UPDATE item 
			SET titulo = '$titulo',
			    descripcion = '$descripcion',
				dimension = '$dimension',
				emision = '$emision',
				material = '$material',
				color = '$color',
				impresion = '$impresion',
				precio = $precio
			WHERE idItem = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $query="UPDATE item_en
			    SET title = '$title',
					description = '$description',
					dimension = '$dimensione',
					emision = '$emisione',
					material = '$materiale',
					color = '$colore',
					impresion = '$impresione'
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

function getItemEdit($id)
{
    $query="SELECT i.idItem, i.nombre, i.titulo, e.title, i.imagen, i.descripcion, e.description, i.dimension, e.dimension, i.emision, e.emision, i.color, e.color, i.material, e.material, i.impresion, e.impresion, i.precio
			FROM item as i inner join item_en as e
			on i.idItem = e.idItem
			WHERE i.idItem=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;  
        $html['title']=$col4;
        $html['imagen']=$col5;
        $html['descripcion']=$col6;
        $html['description']=$col7;
        $html['dimension']=$col8;
        $html['dimensione']=$col9;
        $html['emision']=$col10;
        $html['emisione']=$col11;
        $html['color']=$col12;
        $html['colore']=$col13;
        $html['material']=$col14;
        $html['materiale']=$col15;
        $html['impresion']=$col16;
        $html['impresione']=$col17;
        $html['precio']=$col18;
    }
    return $html;
}

function ChangePrecioCategoria($id, $precio)
{
    $query="UPDATE item
            SET precio = $precio
            WHERE idItem in (select idItem from categoria_item where idCategoria=$id)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if($stmt)return TRUE;
    return FALSE;
}
?>

