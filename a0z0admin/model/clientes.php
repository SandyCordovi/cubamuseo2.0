<?php

function getClientes($p, $b)
{
    $n=Configuracion::$num_elem_x_pag;
    $ini=($p - 1) * $n;

    $query="SELECT idUsuario, nombre, fecha_registro, email, username, password
			FROM usuario
			WHERE nombre like '%$b%' or username like '%$b%' or email like '%$b%'
			ORDER BY idUsuario DESC LIMIT $ini, $n";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
	$n = 0;
    while ($row = $stmt->fetch())
    {
        $html[$n]['id']=$col1;
        $html[$n]['nombre']=$col2;
        $html[$n]['fecha_registro']=$col3;
        $html[$n]['email']=$col4;
        $html[$n]['username']=$col5;
        $html[$n]['password']=$col6;
        $n++;
    }
    return $html;
}

function getTotalClientes($b)
{
    $query="SELECT COUNT(idUsuario)
			FROM usuario
			WHERE nombre like '%$b%' or username like '%$b%' or email like '%$b%'
			ORDER BY idUsuario DESC";
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

function ExistUser($e)
{
    $query="SELECT idUsuario FROM usuario WHERE username='".$e."'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if ($stmt) {
        $stmt->bind_result($col1);
        $html = -1;
        while ($row = $stmt->fetch())
        {
            $html= $col1;
        }
        return $html!=-1;
    }
    return FALSE;

}

function AddUser($n, $e, $p, $u)
{    
    $fecha = date("Y-m-d / H:i:s");
    $query="INSERT INTO usuario VALUES(null, '$n', '$fecha', '$e', '$p', 'activo', '$u', '')";
    $model = new model();
    $stmt = $model->get_stmt($query);

    $query="INSERT INTO carrito VALUES(null, '$u', TRUE, TRUE, TRUE)";
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

function DeleteCliente($id)
{
    $query="DELETE FROM usuario WHERE idUsuario=$id";
    $model = new model();
    $stmt = $model->get_stmt($query);
}

?>
