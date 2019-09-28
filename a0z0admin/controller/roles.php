<?php
include '../../configuracion.php';
include '../../tool.php';
include '../model/model.php';
include '../model/roles.php';

$cmd = $_POST['cmd'];
$nombre = $_POST['nombre'];

if($cmd==1)CreateRol($nombre);
else if($cmd==2)
{
    $id = $_POST['id'];
    EditRol($nombre, $id);
}
else if($cmd==3)
{
    $id = $_POST['id'];
    DeleteRol($id);
}
?>
