<?php
session_start();
session_unset();
session_destroy();
session_start();

include '../../configuracion.php';
include '../../tool.php';
include '../model/model.php';
include '../component/rsa.php';



$email = $_POST['email'];
$pass = $_POST['pass'];

if ($email && $pass) {

    $html = ExistUser($email);
    if ($html) {
        $pass_db = utf8_decode($html['pass']);
        $rsa = new cuiRSA();
        $pass_db = $rsa->decrypt($pass_db);
        if ($pass==$pass_db)
        {
            $_SESSION['cuiadmin_auth'] = "yes";
            $_SESSION['cuiadmin_email'] = $email;
            $_SESSION['cuiadmin_id'] = $html['id'];
            $_SESSION['cuiadmin_name'] = $html['nombre'];
            $_SESSION['cuiadmin_rol'] = $html['rol'];
            
            echo '<script>window.location="../index.php"</script>';
        }
        else
        {
            echo '<script>window.location="../index.php?n=1"</script>';
        }
    }
    else
    {
        echo '<script>window.location="../index.php?n=2"</script>';
    }
}
else
{
    echo '<script>window.location="../index.php?n=1"</script>';
}

   

function ExistUser($e)
{
    $query="SELECT id, nombre, pass, rol FROM cui_adm_usuarios WHERE email='".$e."'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    $html = null;
    if($stmt)
    {
        $stmt->bind_result($col1, $col2, $col3, $col4);
        while ($row = $stmt->fetch())
        {
            $html['id']=$col1;
            $html['nombre']=utf8_decode($col2);
            $html['pass']=utf8_decode($col3);
            $html['rol']=utf8_decode($col4);
        }
    }
    return $html;
}

?>
