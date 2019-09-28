<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_postales.php';
include '../../modulos/lang.php';

$all = $_GET['all'];
$id = $_GET['id'];
$cxf = $_GET['cxf'];
$d = $_GET['d'];
$s = $_GET['s'];
$n = $cxf*Configuracion::$fila_x_pag;

if(isset ($_GET['l']) && $_GET['l'])
{
    $l = $_GET['l'];
}
else
    $l = 'es';

$clang = new cuiLang($l);

$catPostal = getCategoriaPostal($id);
$total = getTotalGaleriaCatPostales($id);
$t_elem = $total['total'];
$total = ceil($total['total']/$n);



$galeria = $all==0 ? getGaleriaCatPostales($id, $n, $s) : getAllGaleriaCatPostales($id, $n, $s, $t_elem);

?>

<?php for($i=0; $i<count($galeria); $i++){ ?>
    <div class="cui_gal_item_cat" style="width: <?php echo 100/$cxf; ?>%;">
        <!--<div class="vtn_info_item">
            <h2>V-POST</h2>
            <p style="border-bottom: 1px solid #687595;">
                <a href="postalenviar-<?php echo $l; ?>-<?php echo $galeria[$i]['id']; ?>" >
                    <?php echo $clang->getVpost('t1'); ?>
                </a>
            </p>
            <p class="ver_zoom" data-id="<?php echo $galeria[$i]['id']; ?>">
                <?php echo $clang->getVpost('t2'); ?>
            </p>
        </div>-->
        <a class="click_item" id="cat_<?php echo $galeria[$i]['id']; ?>" href="#"  data-id="<?php echo $galeria[$i]['id']; ?>" >
            <img class="cui_gal_image" src="service/ri.php?s=V-Posts&c=<?php echo utf8_decode($catPostal['nombre']); ?>&i=<?php echo utf8_decode($galeria[$i]['imagen']); ?>&p=<?php echo $d; ?>" />
        </a>
    </div>
<?php } ?>

<?php if($s<$total && $all==0){ ?>
<div class="cui_row cui_pag_gal">    
    <div class="pag_step">
        <?php echo $s; ?> <?php echo $clang->getGaleria('sm5'); ?> <?php echo $total; ?>
    </div>
    <div class="pag_all">
        <?php echo $clang->getGaleria('sm4'); ?>
    </div>
</div>
<?php } ?>
