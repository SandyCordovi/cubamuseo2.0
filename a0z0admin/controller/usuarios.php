<?php
include '../../configuracion.php';
include '../../tool.php';
include '../model/model.php';
include '../model/usuarios.php';
include '../component/rsa.php';

$cmd = $_POST['cmd'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];

if($cmd==1)
{
    $rsa = new cuiRSA();
    $pass = $rsa->encrypt($pass);
    CreateUsuario($nombre, $email, $pass, $rol);
}
else if($cmd==2)
{
    $id = $_POST['id'];   
    if($pass!="")
    {
        $rsa = new cuiRSA();
        $pass = $rsa->encrypt($pass);
    }
    EditUsuario($id, $nombre, $email, $pass, $rol);
}
else if($cmd==3)
{
    $id = $_POST['id'];
    DeleteUsuario($id);
}

?>
