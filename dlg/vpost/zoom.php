<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_postales.php';

$id = $_GET['id'];
$p = $_GET['p'];

$catPostal = getCategoriaPostal($p);
$postal = getPostal($id);
?>
<p class="cui_titulo_nav" style="margin-bottom: 10px;">
    <?php echo utf8_decode($catPostal['nombre']) ?>
</p>
<div class="cui_row">
    <a class="cui_btn_blue" href="?f=postalenviar-<?php echo $id; ?>" style="float: right;" >
        Seleccionar
    </a>
</div>
<div style="vertical-align: middle; text-align: center; display: inline-table;">
    <div class="cui_prev" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;">
        <img src="images/cui_prev.png" height="100px" />
    </div>
    <div class="cui_div_zoom"    style="display: table-cell; text-align: center; vertical-align: middle; padding: 10px; padding-top: 0; padding-bottom: 40px;">
        <img class="cui_img_gal_nav cui_img_zoom" src="service/ri.php?s=V-Posts&c=<?php echo utf8_decode($catPostal['nombre']); ?>&i=<?php echo utf8_decode($postal['imagen']); ?>&p=0" />
    </div>
     <div class="cui_next" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;">
         <img src="images/cui_next.png" height="100px" />
    </div>
</div>
