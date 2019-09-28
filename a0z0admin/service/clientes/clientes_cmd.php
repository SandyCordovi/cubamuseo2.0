<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/clientes.php';

$cmd = $_POST['cmd'];
if($cmd==1)
{
    $nombre = utf8_encode($_POST['nombre']);
    $username = utf8_encode($_POST['username']);
    $email = utf8_encode($_POST['email']);
    $password = utf8_encode($_POST['password']);

    if(!ExistUser($username))
    {
        AddUser($nombre, $email, $password, $username);

        $jsondata['salida']=array('type'=>"0", 'msg'=>'ok', 'data'=>array());
        echo json_encode($jsondata);
    }
    else
    {
        $jsondata['salida']=array('type'=>"0", 'msg'=>'Usiario existente', 'data'=>array());
        echo json_encode($jsondata);
    }
    
}
else if($cmd==3)
{
    $id = $_POST['id'];
    DeleteCliente($id);
}

?>
