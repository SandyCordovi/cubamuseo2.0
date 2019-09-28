<?php
include '../../configuracion.php';
include '../../tool.php';
include '../model/model.php';
include '../model/ofertas.php';

$cmd = $_POST['cmd'];
$ref = $_POST['ref'];

if($cmd==1)
{
    CreateOferta($ref);
}
else if($cmd==3)
{
    $id = $_POST['id'];
    DeleteUsuario($id);
}

?>
