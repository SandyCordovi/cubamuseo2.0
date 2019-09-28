<?php
session_start();
session_unset();
session_destroy();
session_start();

include '../configuracion.php';
include '../accesdb/model.php';

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];
//$lang = $_POST['lang'];


if ($name && $email && $pass && $username) {
    if(!ExistUser($username))
    {
        if(AddUser($name, $email, $pass, $username))
        {
            $_SESSION['cui_auth'] = "yes";
            $_SESSION['email'] = $email;
            $_SESSION['id'] = geIdByUser($username);
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;

            
            //echo '<script>window.location="../'.$v.$lang.'"</script>';
            $jsondata['salida']=array('type'=>"0", 'msg'=> $name, 'data'=>array());
            echo json_encode($jsondata);
        }
        else
        {
            //echo '<script>window.location="../'.$v.$lang.'-3"</script>';
            $jsondata['salida']=array('type'=>"1", 'msg'=> '3', 'data'=>array());
            echo json_encode($jsondata);
        }
    }
    else
    {
        //echo '<script>window.location="../'.$v.$lang.'-4"</script>';
        $jsondata['salida']=array('type'=>"1", 'msg'=> '4', 'data'=>array());
        echo json_encode($jsondata);
    }
}
else
{
    //echo '<script>window.location="../'.$v.$lang.'-3"</script>';
    $jsondata['salida']=array('type'=>"1", 'msg'=> '3', 'data'=>array());
    echo json_encode($jsondata);
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
    $n = utf8_encode($n);
    $e = utf8_encode($e);
    $p = utf8_encode($p);
    $u = utf8_encode($u);
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

function geIdByUser($e)
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
        return $html;
    }
    return -1;

}

?>
