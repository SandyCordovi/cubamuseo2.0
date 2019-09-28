<?php
function getAllTematicas()
{
    $query="SELECT id, img, titulo, likes, tematica, visitas
			FROM forum_tematicas
			WHERE 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $n=0;
    $html = array();    
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['img']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['likes']=$col4;
        $html[$n]['tematica']=$col5;
        $html[$n]['visitas']=$col6;
        $n++;
    }
    return $html;
}

function getAllTematicaById($id)
{
    $query="SELECT id, img, titulo, likes, tematica, visitas
			FROM forum_tematicas
			WHERE id=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $n=0;
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['img']=$col2;
        $html['titulo']=$col3;
        $html['likes']=$col4;
        $html['tematica']=$col5;
        $html['visitas']=$col6;
    }
    return $html;
}

function getAllTema($idTematica)
{
    $query="SELECT id, img, titulo, likes, comentarios, visitas, user
			FROM forum_temas
			WHERE idTematica=$idTematica order by id DESC";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
    $n=0;
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['img']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['likes']=$col4;
        $html[$n]['comentarios']=$col5;
        $html[$n]['visitas']=$col6;
        $html[$n]['user']=$col7;
        $n++;
    }
    return $html;
}


/*COLECCIONES*/
function getColecciones($s)
{
    $s = ConstruyeQ($s);
    $query="SELECT idCategoria, nombre, titulo, descripcion, 'Colecciones' as cat, imagenGaleria FROM categoria WHERE $s limit 0,10";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $html = array();
    $n=0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['descripcion']=$col4;
        $html[$n]['cat']=$col5;
        $html[$n]['url']='categoria-'.$col1;
        $html[$n]['imagenGaleria']=$col6;
        $n++;
    }
    return $html;
}
function getCategoria($id)
{
    $query="SELECT idCategoria, nombre, titulo, descripcion, imagen, cantImagenes
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
        $html['cant']=$col6;  
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

function SaveForumColeciones($id, $titulo, $like, $comentarios, $visitas, $user, $idTematica)
{
    $categoria = getCategoria($id);
    $seccion = getSeccionCategoria($id);
    $img = "imagenes/". utf8_decode($seccion['nombre']) ."/".  utf8_decode($categoria['nombre']) ."/". utf8_decode($categoria['imagen']);
    $query="INSERT INTO forum_temas VALUES(null,'$img','$titulo',$like,$comentarios,$visitas,$user, $idTematica)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
        return TRUE;
    else
        return FALSE;
}


/*ESTAMPAS*/
function getEstampa($s)
{
    $s = ConstruyeQ($s,array("nombre","titulo","texto"));
    $query="SELECT idEstampa, nombre, titulo, texto as descripcion, 'Estampa' as cat, imagenGaleria FROM `estampa` WHERE $s limit 0,10";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $html = array();
    $n=0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['descripcion']=$col4;
        $html[$n]['cat']=$col5;
        $html[$n]['url']='estampa-'.$col1;
        $html[$n]['imagenGaleria']=$col6;
        $n++;
    }
    return $html;
}
function getEstampaById($id)
{
    $query="SELECT e.idEstampa, e.nombre, e.titulo, e.imagenGaleria
			FROM estampa AS e
			INNER JOIN clasificacion_estampa AS c
			ON c.idEstampa = e.idEstampa
			WHERE e.publicada and e.idEstampa=$id
			ORDER BY c.orden";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $n = 0;
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['nombre']=$col2;
        $html['titulo']=$col3;
        $html['imagen']=$col4;
    }
    return $html;
}
function SaveForumEstampa($id, $titulo, $like, $comentarios, $visitas, $user, $idTematica)
{
    $galeriae = getEstampaById($id);
    $img = "imagenes/Estampas/". utf8_decode($galeriae['nombre']) ."/".  utf8_decode($galeriae['imagen']);
    $query="INSERT INTO forum_temas VALUES(null,'$img','$titulo',$like,$comentarios,$visitas,$user, $idTematica)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
        return TRUE;
    else
        return FALSE;
}


/*TIENDA*/
function getTienda($s)
{
    $s = ConstruyeQ($s);
    $query="SELECT idItem, nombre, titulo, descripcion, 'Tienda' as cat, imagen FROM `tienda_item` WHERE $s limit 0,5";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
    $html = array();
    $n=0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['titulo']=$col3;
        $html[$n]['descripcion']=$col4;
        $html[$n]['cat']=$col5;
        $html[$n]['url']='itemtienda-'.$col1;
        $html[$n]['imagenGaleria']=$col6;
        $n++;
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
        $html['imagenA']=$col9;
        $html['tprecioEnvio']=($col7 == 0)?"Gratis":"$".$col7;
        $html['tprecioEnvioF']=($col8 == 0)?"Gratis":"$".$col8;
    }
    return $html;
}
function SaveForumTienda($id, $titulo, $like, $comentarios, $visitas, $user, $idTematica)
{
    $tematica = getTematicaItem($id);
    $col = getItemTienda($id);
    $img = "imagenes/Tienda/". utf8_decode($tematica['nombre']) ."/".  utf8_decode($col['imagen']);
    $query="INSERT INTO forum_temas VALUES(null,'$img','$titulo',$like,$comentarios,$visitas,$user, $idTematica)";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
        return TRUE;
    else
        return FALSE;
}






function getItemForum($id)
{
    $query="SELECT id, img, titulo, likes, comentarios, visitas, user
			FROM forum_temas
			WHERE id =".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
    while ($row = $stmt->fetch())
    {
        $html['id']=$col1;
        $html['img']=$col2;
        $html['titulo']=$col3;
        $html['likes']=$col4;
        $html['comentarios']=$col5;
        $html['visitas']=$col6;
        $html['user']=$col7;
    }
    return $html;
}
function getComent($id)
{
     $query="SELECT id, user, tema, cometario
			FROM forum_comentario
			WHERE tema=$id order by id DESC";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $n=0;
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['user']=$col2;
        $html[$n]['tema']=$col3;
        $html[$n]['cometario']=$col4;
        $n++;
    }
    return $html;
}
function getUserComent($id)
{
    $query="SELECT nombre, username
			FROM usuario
			WHERE idUsuario =".$id;
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2);
    $html = array();
    while ($row = $stmt->fetch())
    {
        $html['nombre']=$col1;
        $html['username']=$col2;
    }
    return $html;
}

function AddComnt($c, $u, $t)
{
    $query="INSERT INTO forum_comentario VALUES(null,$u,$t,'$c')";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt)
        return TRUE;
    else
        return FALSE;
}











function ConstruyeQ($s, $field=array("nombre","titulo","descripcion"))
{
    $sal ="";
    for($i=0; $i<count($s); $i++)
    {
        $t = trim($s[$i]);
        if($t)
        {
            $sal.="(";
            for($k=0; $k<count($field)-1; $k++)
            {
                $sal.=$field[$k]." LIKE '%$t%' or ";
            }
            $sal.=$field[count($field)-1]." LIKE '%$t%') and ";
        }
    }
    $sal.="1";
    return $sal;
}

?>
