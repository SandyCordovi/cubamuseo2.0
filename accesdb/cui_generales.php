<?php

function getTexto($id)
{
    $query="SELECT idTexto, descripcion, imagen, nombre
			FROM texto
			WHERE idTexto=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['descripcion']=$col2;
        $html['imagen']=$col3;        
		$html['nombre']=$col4;  
    }
    return $html;
}

function getTextoEN($id)
{
    $query="SELECT e.idTexto, e.description, t.imagen, e.name
			FROM texto as t inner join texto_en as e
			on t.idTexto = e.idTexto
			WHERE e.idTexto=".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['descripcion']=$col2;
        $html['imagen']=$col3;   
	$html['nombre']=$col4;		
    }
    return $html;
}

function getMenuColecciones()
{
    $query="SELECT idSeccion, nombre, imagenMenu
			FROM seccion			
			WHERE publicada
			ORDER BY orden";
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

function getMenuColeccionesEN()
{
    $query="SELECT s.idSeccion, e.name, s.imagenMenu
			FROM seccion as s inner join seccion_en as e
			on s.idSeccion = e.idSeccion
			WHERE s.publicada
			ORDER BY s.orden";
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

function getMenuEstampas()
{
    $query="SELECT idCategoriaEstampa, nombre, imagenMenu
			FROM categoriaestampa			
			WHERE publicada
			ORDER BY orden";
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

function getMenuEstampasEN()
{
    $query="SELECT c.idCategoriaEstampa, e.name, c.imagenMenu
			FROM categoriaestampa as c inner join categoriaestampa_en as e
			on c.idCategoriaEstampa = e.idCategoriaEstampa
			WHERE c.publicada
			ORDER BY c.orden";
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

function getMenuTienda()
{
    $query="SELECT idTematica, nombre, imagenMenu
			FROM  tienda_tematica			
			WHERE publicada
			ORDER BY orden";
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

function getMenuTiendaEN()
{
    $query="SELECT t.idTematica, e.name, t.imagenMenu
			FROM  tienda_tematica as t inner join  tienda_tematica_en as e
			on t.idtematica = e.idTematica
			WHERE publicada
			ORDER BY t.orden";
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

function getMenuPostales()
{
    $query="SELECT idCategoriaPostal, nombre, imagenMenu
			FROM  categoriapostal			
			WHERE publicada
			ORDER BY orden";
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

function getMenuPostalesEN()
{
    $query="SELECT c.idCategoriaPostal, e.name, c.imagenMenu
			FROM  categoriapostal as c inner join  categoriapostal_en as e
			on c.idCategoriaPostal = e.idCategoriaPostal
			WHERE publicada
			ORDER BY c.orden";
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

function getUserByIdExtreme($e)
{
    $query="SELECT idUsuario, password, nombre, id_extreme, email, username FROM usuario WHERE id_extreme='".$e."'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $html = null;
    if($stmt)
    {
        $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
        while ($row = $stmt->fetch())
        {
            $html['id']=$col1;
            $html['password']=utf8_decode($col2);
            $html['name']=utf8_decode($col3);
            $html['id_extreme']=utf8_decode($col4);
            $html['email']=utf8_decode($col5);
            $html['username']=utf8_decode($col6);
        }
    }
    return $html;
}


/*CARRITO*/
function getCarByUser($u)
{
    $query="SELECT idCarrito, usuario, paginas, imagenes, tienda  FROM carrito WHERE usuario='$u'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $html = null;
    if($stmt)
    {
        $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
        while ($row = $stmt->fetch())
        {
            $html['id']=$col1;
            $html['usuario']=utf8_decode($col2);
            $html['paginas_check']=utf8_decode($col3);
            $html['imagenes']=utf8_decode($col4);
            $html['tienda']=utf8_decode($col5);
        }
    }

    return $html;
}

function getImagenesByCarrito($carrito)
{
    $query="SELECT i.idItem, i.nombre, i.precio, i.titulo, i.imagen, g.nombre, o.nombre
			FROM carrito_imagen  as c 
			inner join item as i on c.idImagen = i.idItem 
			inner join categoria_item as ci on i.idItem = ci.idItem 
			inner join categoria as g on ci.idCategoria = g.idCategoria
			inner join seccion_categoria as sc on sc.idcategoria = g.idCategoria
			inner join seccion as o on sc.idSeccion = o.idSeccion WHERE c.idCarrito=$carrito";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col1,$col2,$col3,$col4,$col5,$col6,$col7);
    $n = 0;
    $html=array();
    while ($row = $stmt->fetch())
    {
        $html[$n]['item']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['precio']=$col3;
        $html[$n]['titulo']=$col4;
        $html[$n]['imagen']=$col5;	
		$html[$n]['categoria']=$col6;
        $html[$n]['seccion']=$col7;	
        $n++;
    }
    return $html;
}

function getItemsTiendaByCarrito($carrito)
{
    $query="SELECT c.idItemTienda, c.precioEnvio, t.titulo, t.imagen, t.precio, a.nombre
            FROM carrito_tienda as c
            inner join tienda_item as t on c.idItemTienda = t.idItem
            inner join tienda_tematica_item as m on m.idItem = t.idItem
            inner join tienda_tematica as a on a.idTematica = m.idTematica WHERE idCarrito=$carrito";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col1,$col2,$col3,$col4,$col5,$col6);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['item']=$col1;
        $html[$n]['precioEnvio']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['imagen']=$col4;
        $html[$n]['precio']=$col5;
        $html[$n]['tematica']=$col6;
        $n++;
    }
    return $html;
}

function AddImagenCarrito($item, $carrito)
{
    $query="INSERT INTO carrito_imagen VALUES($carrito,$item)";
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

function AddItemTiendaCarrito($item, $carrito, $precioe)
{
    $query="INSERT INTO carrito_tienda VALUES($carrito,$item,$precioe)";
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

function DeleteImagenCarrito($item, $carrito)
{
    $query="DELETE FROM carrito_imagen WHERE idCarrito=$carrito and idImagen=$item";
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

function DeleteItemTiendaCarrito($item, $carrito)
{
    $query="DELETE FROM carrito_tienda WHERE idCarrito=$carrito and idItemTienda=$item";
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

function setVisita()
{
    $now = new DateTime();
    $query = "SELECT id,cantidad,fecha FROM visitas WHERE 1 order by id desc LIMIT 0,1";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $stmt->bind_result($col0,$col1,$col2);
    $stmt->fetch();

    $id=$col0;
    if($id){
        $cantidad = $col1+1;
        $fecha = $col2;

        $fecha = new DateTime($fecha);
        if($fecha->diff($now)->format("%d")==0)
        {
            $query="UPDATE visitas SET cantidad=$cantidad WHERE id=$id";
            $model = new model();
            $model->get_stmt($query);
        }
        else
        {
            $f = date("Y-m-d 00:00:00");
            $query="INSERT INTO visitas VALUES(null,1,'".$f."')";
            $model = new model();
            $model->get_stmt($query);
        }
    }
    else
    {
        $f = date("Y-m-d H:i:s");
        $query="INSERT INTO visitas VALUES(null,1,'".$f."')";
        $model = new model();
        $model->get_stmt($query);
    }
}
?>
