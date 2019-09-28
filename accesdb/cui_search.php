<?php

function getColecciones($s)
{
    $s = ConstruyeQ($s);
    $query="SELECT idCategoria, nombre, titulo, descripcion, 'Colecciones' as cat FROM categoria WHERE $s limit 0,5";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
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
        $n++;
    }
    return $html;
}

function getEstampa($s)
{
    $s = ConstruyeQ($s,array("nombre","titulo","texto"));
    $query="SELECT idEstampa, nombre, titulo, texto as descripcion, 'Estampa' as cat FROM `estampa` WHERE $s limit 0,5";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
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
        $n++;
    }
    return $html;
}

function getTienda($s)
{
    $s = ConstruyeQ($s);
    $query="SELECT idItem, nombre, titulo, descripcion, 'Tienda' as cat FROM `tienda_item` WHERE $s limit 0,5";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
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
        $n++;
    }
    return $html;
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

function getColeccionesSearch($s, $p)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $s = ConstruyeQ($s);
    $query="SELECT idCategoria, nombre, titulo, descripcion, 'Colecciones' as cat FROM categoria WHERE $s limit $ini,$n";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
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
        $n++;
    }
    return $html;
}

function getColeccionesSearchTotal($s)
{
    $s = ConstruyeQ($s);
    $query="SELECT count(idCategoria) FROM categoria WHERE $s";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    $html = 0;
    while ($row = $stmt->fetch())
    {
        $html = $col1;
    }
    return $html;
}

function getEstampaSearch($s, $p)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $s = ConstruyeQ($s,array("nombre","titulo","texto"));
    $query="SELECT idEstampa, nombre, titulo, texto as descripcion, 'Estampa' as cat FROM estampa WHERE $s limit $ini,$n";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
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
        $n++;
    }
    return $html;
}

function getEstampaSearchTotal($s)
{
    $s = ConstruyeQ($s,array("nombre","titulo","texto"));
    $query="SELECT count(idEstampa) FROM estampa WHERE $s";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    $html = 0;
    while ($row = $stmt->fetch())
    {
        $html = $col1;
    }
    return $html;
}

function getTiendaSearch($s, $p)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $s = ConstruyeQ($s);
    $query="SELECT idItem, nombre, titulo, descripcion, 'Tienda' as cat FROM tienda_item WHERE $s limit $ini,$n";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
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
        $n++;
    }
    return $html;
}

function getTiendaSearchTotal($s)
{
    $s = ConstruyeQ($s);
    $query="SELECT count(idItem) FROM tienda_item WHERE $s";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1);
    $html = 0;
    while ($row = $stmt->fetch())
    {
        $html = $col1;
    }
    return $html;
}
?>
