<?php
session_start();
session_unset();
session_destroy();
session_start();

include '../configuracion.php';
include '../accesdb/model.php';

$username = $_POST['username'];
$pass = $_POST['password'];

if ($username && $pass) {

    $html = ExistUser($username);
    if ($html) {
        if ($pass==$html['password'])
        {
            $_SESSION['cui_auth'] = "yes";
            $_SESSION['email'] = $html['email'];
            $_SESSION['id'] = $html['id'];
            $_SESSION['name'] = $html['name'];
            $_SESSION['id_extreme'] = $html['id_extreme'];
            $_SESSION['username'] = $html['username'];

            if(isset ($_POST['recorpass']) && $_POST['recorpass']=="on")
            {
                if ($HTTP_X_FORWARDED_FOR == "")
                {
                    $ip = getenv(REMOTE_ADDR);
                }

                $id_extreme = md5(uniqid(rand(), true));
                //$id_extreme2 = $email."%".$id_extreme."%".$ip;
                
                setcookie('id_extreme', $id_extreme, time()+60*60*24*30,'/');
                UpdateExtreme($id_extreme, username);
                $_SESSION['id_extreme'] = $id_extreme;
            }

            $jsondata['salida']=array('type'=>"0", 'msg'=> $html['name'], 'data'=>array());
            echo json_encode($jsondata);
            
            //echo '<script>window.location="../'.$v.$lang.'"</script>';
        }
        else
        {
            $jsondata['salida']=array('type'=>"1", 'msg'=> '1', 'data'=>array());
            echo json_encode($jsondata);
            //echo '<script>window.location="../'.$v.$lang.'-1"</script>';
        }
    }
    else
    {
        $jsondata['salida']=array('type'=>"1", 'msg'=> '2', 'data'=>array());
        echo json_encode($jsondata);
        //echo '<script>window.location="../'.$v.$lang.'-2"</script>';
    }
}
else
{
    $jsondata['salida']=array('type'=>"1", 'msg'=> '1', 'data'=>array());
    echo json_encode($jsondata);
    //echo '<script>window.location="../'.$v.$lang.'-1"</script>';
}

   

function ExistUser($e)
{
    $query="SELECT idUsuario, password, nombre, id_extreme, username, email FROM usuario WHERE username='".$e."'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $html = null;
    if($stmt)
    {
        $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
        while ($row = $stmt->fetch())
        {
            $html['id']=$col1;
            $html['password']=utf8_decode($col2);
            $html['name']=utf8_decode($col3);
            $html['id_extreme']=utf8_decode($col4);
            $html['username']=utf8_decode($col5);
            $html['email']=utf8_decode($col6);
        }
    }
    return $html;
}

function UpdateExtreme($id_extreme, $username)
{
    $query = "UPDATE usuario SET id_extreme='".utf8_encode($id_extreme)."' WHERE username='".$username."'";
    $model = new model();
    $model->get_stmt($query);
}

?>
