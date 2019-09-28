<?php

function getTextoVpost()
{
    $query="SELECT t.nombre, e.name, t.descripcion, e.description, t.imagen
			FROM texto as t inner join texto_en as e
			on t.idTexto = e.idtexto
			WHERE t.idTexto = 6";
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

function EditTextoVpost($nombre, $name, $imagen, $descripcion, $description)
{
    $query="UPDATE texto SET nombre = '$nombre', descripcion = '$descripcion' 
			WHERE idTexto = 6";
    $model = new model();
    $stmt = $model->get_stmt($query);
	
    if($imagen != "" or $imagen != null)
    {
		$query="UPDATE texto SET imagen = '$imagen'
				WHERE idTexto = 6";
		$model = new model();
		$stmt = $model->get_stmt($query);
    }    
	if ($stmt)
    {
		$query="UPDATE texto_en SET name = '$name', description = '$description' 
			    WHERE idTexto = 6";
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

    $query="SELECT c.idCategoriaPostal, c.titulo, c.publicada
			FROM categoriapostal as c 
			WHERE c.titulo like '%$b%'
			ORDER BY c.orden LIMIT $ini, $n";
			
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
    $query="SELECT COUNT(c.idCategoriaPostal)
			FROM categoriapostal as c 
			WHERE c.titulo like '%$b%'
			ORDER BY c.orden";
	
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

function getCategoriaPostal($id)
{
    $query="SELECT c.idCategoriaPostal, c.nombre, e.name, c.titulo, e.title, c.imagenMenu
			FROM categoriapostal as c inner join categoriapostal_en as e on c.idCategoriaPostal = e.idCategoriaPostal
			WHERE c.idCategoriaPostal=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['name']=$col3;
        $html['titulo']=$col4;  
        $html['title']=$col5;
        $html['imagenMenu']=$col6;
    }
    return $html;
}

function AddCategoria($nombre, $name, $titulo, $title, $imagenMenu)
{
    $orden = getMayorOrdenCategoriaPostal()+1;
    $query="INSERT INTO categoriapostal VALUES(null,'$nombre','$titulo',$orden,1,5,'$imagenMenu')";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
    {
        $id_actual = 0;
        $query="SELECT idCategoriaPostal
                FROM categoriapostal
                ORDER BY idCategoriaPostal DESC LIMIT 0, 1";
        $model = new model();
        $stmt = $model->get_stmt($query);
        $stmt->bind_result($col1);
        while ($row = $stmt->fetch())
        {
                $id_actual = $col1;
        }
        $query="INSERT INTO categoriapostal_en VALUES($id_actual,'$name','$title')";
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

function getMayorOrdenCategoriaPostal()
{
    $query="SELECT c.orden
            FROM categoriapostal as c
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

function getCategoriaByNombre($nombre)
{
    $query="SELECT c.idCategoriaPostal, c.nombre, e.name, c.titulo, e.title, c.imagenMenu
	    FROM categoriapostal as c inner join categoriapostal_en as e on c.idCategoriaPostal = e.idCategoriaPostal
	    WHERE c.nombre='".$nombre."'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['name']=$col3;
        $html['titulo']=$col4;
        $html['title']=$col5;
        $html['imagenMenu']=$col6;
    }
    return $html;
}

function AddPostal($nombre, $precio, $imagen, $orden, $categoria)
{
    $orden = 1;
    $query="INSERT INTO postal VALUES(null,'$nombre',$precio,'$imagen',1,$orden,$categoria)";
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

function getAllPostalCateg($cat)
{
    $query="SELECT p.idPostal, p.imagen
            FROM postal as p
            WHERE p.idCategoria=".$cat;
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col0,$col1);
    $html=array();
    $i=0;
    while ($row = $stmt->fetch())
    {
        $html[$i]['id']=$col0;
        $html[$i]['imagen']=$col1;
        $i++;
    }
    return $html;
}

function DeletePostalesCategoria($id)
{
    //eliminado las referencia de la categoria y los items
    $query="DELETE FROM postal WHERE idCategoria=$id";
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

function DeleteCategoriaPostal($id)
{
    DeletePostalesCategoria($id);
    $query="DELETE FROM categoriapostal WHERE idCategoriaPostal=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);

    if ($stmt) {
        $query="DELETE FROM categoriapostal_en WHERE idCategoriaPostal=$id";
        $model = new model();
        $stmt = $model->get_stmt($query);
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function EditCategoriaPostal($id, $nombre, $name, $titulo, $title, $imagenMenu)
{
    $query="UPDATE categoriapostal SET nombre = '$nombre', titulo = '$titulo'
	    WHERE idCategoriaPostal = $id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    
    if($imagenMenu)
    {
            $query="UPDATE categoriapostal SET imagenMenu = '$imagenMenu'
                    WHERE idCategoriaPostal = $id";
            $model = new model();
            $stmt = $model->get_stmt($query);
    }
    if ($stmt)
    {
        $query="UPDATE categoriapostal_en SET name = '$name', title = '$title'
                    WHERE idCategoriaPostal = $id";
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

function ChangePubCategoria($id,$pub)
{
    $query="UPDATE categoriapostal SET publicada = $pub
            WHERE idCategoriaPostal = $id";
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

function SubeCategoriaPostal($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM categoriapostal
			WHERE idCategoriaPostal=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
	$orden_nuevo = $orden_anterior -1;
    }

    $query="UPDATE categoriapostal SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="UPDATE categoriapostal SET orden = $orden_nuevo
			WHERE idCategoriaPostal = $id";
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

function BajaCategoriaPostal($id)
{
	//cogiendo el orden actual
	$orden_anterior = 0;
	$orden_nuevo = 0;
	$query="SELECT orden
			FROM categoriapostal
			WHERE idCategoriaPostal=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    while ($row = $stmt->fetch())
    {
        $orden_anterior = $col1;
	$orden_nuevo = $orden_anterior +1;
    }

    $query="UPDATE categoriapostal SET orden = $orden_anterior
			WHERE orden = $orden_nuevo";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="UPDATE categoriapostal SET orden = $orden_nuevo
			WHERE idCategoriaPostal = $id";
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

