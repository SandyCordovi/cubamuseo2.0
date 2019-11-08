<?php

function getTextoEstampa()
{
    $query="SELECT t.nombre, e.name, t.descripcion, e.description, t.imagen
			FROM texto as t inner join texto_en as e
			on t.idTexto = e.idtexto
			WHERE t.idTexto=2";
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

function EditTextoEstampa($nombre, $name, $imagen, $descripcion, $description)
{
    $query="UPDATE texto SET nombre = '$nombre', descripcion = '$descripcion' 
			WHERE idTexto = 2";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    if($imagen != "" or $imagen != null)
    {
		$query="UPDATE texto SET imagen = '$imagen'
				WHERE idTexto = 2";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }    
	if ($stmt)
    {
		$query="UPDATE texto_en SET name = '$name', description = '$description' 
			    WHERE idTexto = 2";
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

function getCategorias($p, $b)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT c.idCategoriaEstampa, c.nombre, c.publicada
            FROM categoriaestampa as c
            WHERE c.nombre like '%$b%'
            ORDER BY c.orden
            LIMIT $ini, $n";
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

function getTotalCategorias($b)
{
    $query="SELECT COUNT(c.idCategoriaEstampa)
            FROM categoriaestampa as c
	    WHERE c.nombre like '%$b%'";
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

function AddCategoriaEstampa($nombre, $name, $imagenMenu)
{
    $orden = getMayorOrdenCategoriaEstampa()+1;
    $query="INSERT INTO categoriaestampa VALUES(null,'$nombre',$orden,'$imagenMenu')";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idCategoriaEstampa
                FROM categoriaestampa
                ORDER BY idCategoriaEstampa DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO categoriaestampa_en VALUES($id_actual,'$name')";
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

function getMayorOrdenCategoriaEstampa()
{
    $query="SELECT c.orden
            FROM categoriaestampa as c
            ORDER BY c.orden DESC LIMIT 0, 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        return $col1;
    }
    return 0;
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

function EditCategoriaEstampa($id, $nombre, $name, $imagenMenu)
{
    $query="UPDATE categoriaestampa SET nombre = '$nombre'
	   WHERE idCategoriaEstampa = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if($imagenMenu != "" or $imagenMenu != null)
    {
            $query="UPDATE categoriaestampa SET imagenMenu = '$imagenMenu'
                    WHERE idCategoriaEstampa = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }
    if ($stmt)
    {
		$query="UPDATE categoriaestampa_en SET name = '$name'
			    WHERE idCategoriaEstampa = $id";
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

function DeleteCategoriaEstampa($id)
{
	//cogiendo el orden actual
	$orden_actual = 0;
	$query="SELECT orden
			FROM categoriaestampa
			WHERE idCategoriaEstampa=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_actual = $col1;
    }
	
    //eliminado las estampas de la categoria
    $query="SELECT idEstampa
			FROM clasificacion_estampa
			WHERE idCategoriaEstampa=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina la estampa  
        DeleteEstampa($col1);
    }
	
	//eliminado las referencia de las estampas de la categoria
    $query="DELETE FROM clasificacion_estampa WHERE idCategoriaEstampa=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminado las muestras de la categoria
    $query="SELECT idMuestra
			FROM clasificacion_muestra
			WHERE idCategoriaEstampa=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina la estampa  
        DeleteMuestra($col1);
    }
	
	//eliminado las referencia de las estampas de la categoria
    $query="DELETE FROM clasificacion_muestra WHERE idCategoriaEstampa=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	    
    //eliminando el ingles
    $query="DELETE FROM categoriaestampa_en WHERE idCategoriaEstampa=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando la categoria
    $query="DELETE FROM categoriaestampa WHERE idCategoriaEstampa=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt) {
		
		//cambiando el orden
		$query="SELECT idCategoriaEstampa
				FROM categoriaestampa
				WHERE orden > $orden_actual";
		$model = new model();
		$stmt = $model->get_stmt($query);
		$stmt->bind_result($col1);
		while ($row = $stmt->fetch())
		{
			//actualiza el orden 
			$query="UPDATE categoriaestampa SET orden = orden -1 
				    WHERE idCategoriaEstampa = $col1";
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

function DeleteEstampa($id)
{
    //eliminado las referencia de las muestras de la seccion
    $query="DELETE FROM clasificacion_estampa WHERE idEstampa=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
		
	//eliminando el ingles
    $query="DELETE FROM estampa_en WHERE idEstampa=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando la muestra
    $query="DELETE FROM estampa WHERE idEstampa=$id";
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

function DeleteMuestra($id)
{
    //eliminado las referencia de las muestras de la seccion
    $query="DELETE FROM clasificacion_muestra WHERE idMuestra=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminado los items de la muestra
    $query="SELECT idItem
			FROM muestra_item
			WHERE idMuestra=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina el item 
        DeleteItem($col1);
    }
	
	//eliminado las referencia de la muestra y los items
    $query="DELETE FROM muestra_item WHERE idMuestra=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	//eliminando el ingles
    $query="DELETE FROM muestra_en WHERE idMuestra=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando la muestra
    $query="DELETE FROM muestra WHERE idMuestra=$id";
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

function SubeCategoriaEstampa($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM categoriaestampa
			WHERE idCategoriaEstampa=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
	$orden_nuevo = $orden_anterior -1;
    }	
	
    $query="UPDATE categoriaestampa SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    $query="UPDATE categoriaestampa SET orden = $orden_nuevo
			WHERE idCategoriaEstampa = $id";
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

function BajaCategoriaEstampa($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM categoriaestampa
			WHERE idCategoriaEstampa=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
		$orden_nuevo = $orden_anterior + 1;
    }	
	
    $query="UPDATE categoriaestampa SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
	$query="UPDATE categoriaestampa SET orden = $orden_nuevo
			WHERE idCategoriaEstampa = $id";
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

function getEstampas($p, $b, $categoria)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT e.idEstampa, e.titulo, e.publicada
			FROM estampa as e inner join clasificacion_estampa as c
			ON c.idEstampa = e.idEstampa
			WHERE e.titulo like '%$b%' and c.idCategoriaEstampa = $categoria
			ORDER BY e.orden LIMIT $ini, $n";

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

function getTotalEstampas($b, $categoria)
{
    $query="SELECT COUNT(e.idEstampa)
			FROM estampa as e inner join clasificacion_estampa as c
			ON c.idEstampa = e.idEstampa
			WHERE e.titulo like '%$b%' and c.idCategoriaEstampa = $categoria
			ORDER BY e.orden";

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

function getCategoriasSP()
{
    $query="SELECT s.idCategoriaEstampa, s.nombre
			FROM categoriaestampa as s
			WHERE 1
			ORDER BY s.orden";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2);
	$n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['titulo']=$col2;
        $n++;
    }
    return $html;
}

function AddEstampa($nombre, $name, $titulo, $title, $imagenGaleria, $descripcion, $description, $categoria)
{
    $orden = 1;
    $query="INSERT INTO estampa VALUES(null,'$imagenGaleria','$descripcion', '$titulo', '$nombre', 1, $orden)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idEstampa
                FROM estampa
                ORDER BY idEstampa DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO estampa_en VALUES($id_actual,'$name','$title','$description')";
        $model = new model();
        $stmt = $model->get_stmt($query);
		
		$query="INSERT INTO clasificacion_estampa VALUES($categoria, $id_actual, $orden)";
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

function EditEstampa($id, $nombre, $name, $titulo, $title, $imagenGaleria, $descripcion, $description, $categoria)
{
    $query="UPDATE estampa
            SET nombre = '$nombre', titulo = '$titulo', texto = '$descripcion'
            WHERE idEstampa = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if($imagenGaleria != "" or $imagenGaleria != null)
    {
		$query="UPDATE estampa SET imagenGaleria = '$imagenGaleria'
			    WHERE idEstampa = $id";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }
    if ($stmt)
    {
		$query="UPDATE estampa_en SET name = '$name', title = '$title', text = '$description'
			    WHERE idEstampa = $id";
		$model = new model();
		$stmt = $model->get_stmt($query);
        if ($stmt)
		{
			$query="UPDATE clasificacion_estampa SET idCategoriaEstampa = $categoria
					WHERE idEstampa = $id";
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

function getEstampa($id)
{
    $query="SELECT i.idEstampa, i.nombre, e.name, i.titulo, e.title, i.texto, e.text, i.imagenGaleria, i.publicada, ca.idCategoriaEstampa
			FROM estampa as i inner join estampa_en as e
			ON e.idEstampa = i.idEstampa
                        inner join clasificacion_estampa as ca
                        ON ca.idEstampa = i.idEstampa
			WHERE i.idEstampa = $id";
			
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10);
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
        $html['imagenGaleria']=$col8;
        $html['publicada']=$col9;
        $html['seccion']=$col10;
        $n++;
    }
    return $html;
}

function ChangePubEstampa($id,$pub)
{	
    $query="UPDATE estampa SET publicada = $pub
            WHERE idEstampa = $id";
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

function ChangePubCatEstampa($id,$pub)
{
    $query="UPDATE categoriaestampa SET publicada = $pub
                    WHERE idCategoriaEstampa = $id";
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

function getMuestras($p, $b, $categoria)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT m.idMuestra, m.titulo, m.publicada
			FROM muestra as m inner join clasificacion_muestra as c
			ON c.idMuestra = m.idMuestra
			WHERE m.titulo like '%$b%' and c.idCategoriaEstampa = $categoria
			ORDER BY m.orden LIMIT $ini, $n";

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

function getMuestrasSP(){
    $query="SELECT m.idMuestra as id, m.nombre as nombre
			FROM muestra as m
			ORDER BY m.orden";

    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2);
    $n = 0;
    $val = array();
    $html = array();
    while ($row = $stmt->fetch())
    {
        $val['id']=$col1;
        $val['nombre']=$col2;
        $html[$n] = $val;
        $n++;
    }
    return $html;
}

function getItemsByMuestras($id){
    $query="SELECT i.idItem as id, i.nombre, i.titulo, i.imagen
			FROM item as i inner join muestra_item as mi
			where mi.idMuestra = ".$id." and mi.idItem = i.idItem
			ORDER BY mi.orden";

    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $n = 0;
    $val = array();
    $html = array();
    while ($row = $stmt->fetch())
    {
        $val['id']=$col1;
        $val['nombre']=$col2;
        $val['titulo']=$col3;
        $val['imagen']=$col4;
        $html[$n] = $val;
        $n++;
    }
    return $html;
}

function getTotalMuestras($b, $categoria)
{
    $query="SELECT COUNT(m.idMuestra)
			FROM muestra as m inner join clasificacion_muestra as c
			ON m.idMuestra = c.idMuestra
			WHERE m.titulo like '%$b%' and c.idCategoriaEstampa = $categoria
			ORDER BY m.orden";

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

function getMuestra($id)
{
    $query="SELECT  m.idMuestra, m.nombre, e.name, m.titulo, e.title, m.descripcion, e.description, m.imagen, m.imagenGaleria, cm.idCategoriaEstampa
			FROM muestra as m inner join muestra_en as e on m.idMuestra = e.idMuestra
                        inner join clasificacion_muestra as cm on cm.idMuestra = m.idMuestra
			WHERE m.idMuestra=".$id;
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
        $html['cant']=8;
        $html['seccion']=$col10;
    }
    return $html;
}

function getMuestraByNombre($nombre)
{
    $query="SELECT  m.idMuestra, m.nombre, e.name, m.titulo, e.title, m.descripcion, e.description, m.imagen, m.imagenGaleria
			FROM muestra as m inner join muestra_en as e on m.idMuestra = e.idMuestra
                        inner join clasificacion_muestra as cm on cm.idMuestra = m.idMuestra
			WHERE m.nombre='".$nombre."'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
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
        $html['cant']=8;
    }
    return $html;
}

function AddMuestra($nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, $categoria)
{
    $orden = 1;
    $query="INSERT INTO muestra VALUES(null,'$nombre','$titulo','$imagen','$imagenGaleria','$descripcion',8, $orden ,1,'$nombre')";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idMuestra
                        FROM muestra
                        ORDER BY idMuestra DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO muestra_en VALUES($id_actual,'$name','$title','$description')";
        $model = new model();
        $stmt = $model->get_stmt($query);

        $query="INSERT INTO clasificacion_muestra VALUES($categoria, $id_actual, $orden, null)";
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

function EditMuestra($id, $nombre, $name, $titulo, $title, $imagen, $imagenGaleria, $descripcion, $description, $categoria)
{
    $query="UPDATE muestra SET nombre = '$nombre', titulo = '$titulo', descripcion = '$descripcion'
			WHERE idMuestra = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="UPDATE clasificacion_muestra SET idCategoriaEstampa = $categoria
                            WHERE idMuestra = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if($imagen)
    {
            $query="UPDATE muestra SET imagen = '$imagen'
                            WHERE idMuestra = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }
    if($imagenGaleria)
    {
            $query="UPDATE muestra SET imagenGaleria = '$imagenGaleria'
                            WHERE idMuestra = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }

    if ($stmt)
    {
        $query="UPDATE muestra_en SET name = '$name', title = '$title', description = '$description'
                    WHERE idMuestra = $id";
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

function getAllItemMuestra($m)
{
    $query="SELECT i.idItem, i.nombre, i.imagen
            FROM muestra_item as mi inner join item as i on mi.idItem=i.idItem
            WHERE mi.idMuestra=".$m;
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


function DeleteItemOfMuestra($m)
{
    //eliminado los items de la categoria
    $query="SELECT idItem
            FROM muestra_item
            WHERE idMuestra=".$m;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina el item
        DeleteItem($col1);
    }
}

function DeleteMuestras($id)
{
    //eliminado las referencia de las categorias de la seccion
    $query="DELETE FROM clasificacion_muestra WHERE idMuestra=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    //eliminado los items de la categoria
    $query="SELECT idItem
			FROM muestra_item
			WHERE idMuestra=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        //elimina el item
        DeleteItem($col1);
    }

	//eliminado las referencia de la categoria y los items
    $query="DELETE FROM muestra_item WHERE idMuestra=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando el ingles
    $query="DELETE FROM muestra_en WHERE idMuestra=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

	//eliminando la categoria
    $query="DELETE FROM muestra WHERE idMuestra=$id";
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

function ChangePubMuestra($id,$pub)
{
    $query="UPDATE muestra SET publicada = $pub
                    WHERE idMuestra = $id";
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

function ChangePrecioMuestra($id, $precio)
{
    $query="UPDATE item
            SET precio = $precio
            WHERE idItem in (select idItem from muestra_item where idMuestra=$id)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if($stmt)return TRUE;
    return FALSE;
}

function AddItem($nombre, $titulo, $title, $imagen, $descripcion, $description, $dimension, $dimensione, $imageSize, $emision, $emisione, $material, $materiale, $color, $colore, $impresion, $impresione, $precio, $muestra)
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

        $query="INSERT INTO muestra_item VALUES($muestra, $id_actual, 1)";
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


?>

