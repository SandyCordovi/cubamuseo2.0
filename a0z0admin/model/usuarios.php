<?php
function getUsuarios($r)
{
    $query = "SELECT u.id,u.nombre,email,r.nombre FROM cui_adm_usuarios as u inner join cui_adm_roles as r on u.rol=r.id WHERE rol>=$r";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col0,$col1,$col2,$col3);
    $html=array();
    $i=0;
    while ($row = $stmt->fetch())
    {
        $html[$i]['id']=$col0;
        $html[$i]['nombre']=$col1;
        $html[$i]['email']=$col2;
        $html[$i]['rol']=$col3;
        $i++;
    }
    return $html;
}

function getUsuarioById($id)
{
    $query = "SELECT u.id,u.nombre,email,r.nombre, r.id FROM cui_adm_usuarios as u inner join cui_adm_roles as r on u.rol=r.id WHERE u.id=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col0,$col1,$col2,$col3,$col4);
    $html=array();
    $stmt->fetch(); 
    $html['id']=$col0;
    $html['nombre']=$col1;
    $html['email']=$col2;
    $html['rol']=$col3;
    $html['rolid']=$col4;    
    return $html;
}

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

function CreateUsuario($nombre, $email, $pass, $rol)
{
    $query = "INSERT INTO cui_adm_usuarios (id, nombre, email, pass, rol) VALUES(null, '".utf8_encode($nombre)."', '".utf8_encode($email)."', '".utf8_encode($pass)."', $rol)";
    $model = new model();
    return $model->get_stmt($query);
}

function EditUsuario($id,$nombre, $email, $pass, $rol)
{
    $query = "UPDATE cui_adm_usuarios SET nombre = '".utf8_encode($nombre)."', email='".utf8_encode($email)."', rol=$rol".($pass!=""?", pass='".utf8_encode($pass)."'":"")." WHERE id=$id";
    $model = new model();
    return $model->get_stmt($query);
}

function DeleteUsuario($id)
{
    $query = "DELETE FROM cui_adm_usuarios WHERE id=$id";
    $model = new model();
    return $model->get_stmt($query);
}

?>
