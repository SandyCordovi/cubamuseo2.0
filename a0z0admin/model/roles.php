<?php

function getRoles($r)
{
    $query = "SELECT id, nombre FROM cui_adm_roles WHERE id>=$r";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col0,$col1);
    $html=array();
    $i=0;
    while ($row = $stmt->fetch())
    {
        $html[$i]['id']=$col0;
        $html[$i]['nombre']=$col1;
        $i++;
    }
    return $html;
}

function CreateRol($n)
{
    $query = "INSERT INTO cui_adm_roles (id, nombre, alcance) VALUES(null, '$n', 100)";
    $model = new model();
    return $model->get_stmt($query);
}

function EditRol($n, $id)
{
    $query = "UPDATE cui_adm_roles SET nombre = '$n' WHERE id=$id";
    $model = new model();
    return $model->get_stmt($query);
}

function DeleteRol($id)
{
    $query = "DELETE FROM cui_adm_roles WHERE id=$id";
    $model = new model();
    return $model->get_stmt($query);
}
?>
