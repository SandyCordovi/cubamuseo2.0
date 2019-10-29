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


<div class="cui_div_zoom"   style="max-width: 100%; margin: 40px;">
        <img class="cui_img_gal_nav cui_img_zoom" src="service/ri.php?s=V-Posts&c=<?php echo utf8_decode($catPostal['nombre']); ?>&i=<?php echo utf8_decode($postal['imagen']); ?>&p=0" />
</div>

<div style="padding-left: 20%;padding-right: 20%; ">

    <div class="cui_prev" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;float: left; margin-bottom: 15px;">
        <img src="images/cui_prev.png" height="40px" />
    </div>

        <a class="cui_btn_blue" href="?f=postalenviar-<?php echo $id; ?>" style=" float: inherit; vertical-align: middle; margin-bottom: 15px;" >
            Seleccionar
        </a>

    <div class="cui_next" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;float: right; margin-bottom: 15px;">
        <img src="images/cui_next.png" height="40px" />
    </div>
</div>


