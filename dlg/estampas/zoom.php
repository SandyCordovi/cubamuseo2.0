<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_estampas.php';

$id = $_GET['id'];
$m = $_GET['m'];

$muestra = getMuestra($m);
$item = getItem($id);

?>
<p class="cui_titulo_nav" style="margin-bottom: 10px;">
    <?php echo utf8_decode($item['nombre']) ?> | <?php echo utf8_decode($item['titulo']) ?>
</p>
<div style="vertical-align: middle; text-align: center; display: inline-table;">
    <div class="cui_prev" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;">
        <img src="images/cui_prev.png" height="100px" />
    </div>
    <div class="cui_div_zoom" style="display: table-cell; text-align: center; vertical-align: middle; padding: 10px; padding-top: 0;">
        <img class="cui_img_gal_nav cui_img_zoom" src="service/ri.php?s=Muestras&c=<?php echo utf8_decode($muestra['carpeta']); ?>&i=<?php echo utf8_decode($item['imagen']); ?>&p=0" />
    </div>
     <div class="cui_next" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;">
         <img src="images/cui_next.png" height="100px" />
    </div>
</div>
