<?php
include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_colecciones.php';

$id = $_GET['id'];
$idCat = $_GET['idCat'];
$sent = $_GET['sent'];

if($sent==1)$json = getNextInGal($id, $idCat);
else $json = getPrevInGal($id, $idCat);
console.log($json);
echo json_encode($json);

?>
