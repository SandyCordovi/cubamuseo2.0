<?php
include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_forum.php';

$coment = utf8_encode($_POST['coment']);
$u = $_POST['u'];
$t = $_POST['t'];

AddComnt($coment, $u, $t);
$us = getUserComent($u);
?>


<div class="forum-comentario">
    <div style="width: 100px; float: left;">
        <img src="user/user.png" />
    </div>
    <div style="margin-left: 100px;">
        <p style="margin-bottom: 10px;"><strong><?php echo utf8_decode($us['nombre']); ?></strong></p>
        <p><?php echo utf8_decode($coment); ?></p>
    </div>
</div>
