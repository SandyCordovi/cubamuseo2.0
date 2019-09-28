<?php
include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_estampas.php';

$id = $_GET['id'];
$idM = $_GET['idM'];
$sent = $_GET['sent'];

if($sent==1)$json = getNextInGal($id, $idM);
else $json = getPrevInGal($id, $idM);

echo json_encode($json);

?>
