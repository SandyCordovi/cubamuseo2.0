<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_forum.php';

$cmd = $_POST['t'];
if($cmd==1)
{
    $id= $_POST['id'];
    $u= $_POST['u'];
    $t= $_POST['t'];
    $cat = getCategoria($id);
    $s = SaveForumColeciones($id, $cat['titulo'], 0, 0, 0, $u, $t);

    $jsondata['salida']=array('type'=>"0", 'msg'=> $cat, 'action'=>$s);
    echo json_encode($jsondata);
}
else if($cmd==2)
{
    $id= $_POST['id'];
    $u= $_POST['u'];
    $t= $_POST['t'];
    $cat = getEstampaById($id);
    $s = SaveForumEstampa($id, $cat['titulo'], 0, 0, 0, $u, $t);

    $jsondata['salida']=array('type'=>"0", 'msg'=> '', 'action'=>'');
    echo json_encode($jsondata);
}
else if($cmd==4)
{
    $id= $_POST['id'];
    $u= $_POST['u'];
    $t= $_POST['t'];
    $cat = getItemTienda($id);
    $s = SaveForumTienda($id, $cat['titulo'], 0, 0, 0, $u, $t);

    $jsondata['salida']=array('type'=>"0", 'msg'=> '', 'action'=>'');
    echo json_encode($jsondata);
}
?>
