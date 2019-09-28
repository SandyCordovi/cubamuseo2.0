<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_tienda.php';

$id = $_GET['id'];

$tem = getTematicaItem($id);
$item = getItemTienda($id);

?>
<div style="vertical-align: middle; text-align: center; display: inline-table;">    
    <div  style="display: table-cell; text-align: center; vertical-align: middle; padding: 10px; padding-top: 0;">
        <img class="cui_img_gal_nav cui_img_zoom" src="service/ri.php?s=Tienda&c=<?php echo utf8_decode($tem['nombre']); ?>&i=<?php echo utf8_decode($item['imagenAmpliada']); ?>&p=0" />
    </div>
</div>
