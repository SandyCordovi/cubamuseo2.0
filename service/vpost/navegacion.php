<?php
include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_postales.php';

$id = $_GET['id'];
$idP = $_GET['idP'];
$sent = $_GET['sent'];

if($sent==1)$json = getNextInGal($id, $idP);
else $json = getPrevInGal($id, $idP);

echo json_encode($json);

?>
