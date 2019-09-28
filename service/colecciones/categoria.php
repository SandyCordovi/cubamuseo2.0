<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_colecciones.php';
include '../../modulos/lang.php';


$all = $_GET['all'];
$id = $_GET['id'];
$cxf = $_GET['cxf'];
$s = $_GET['s'];
$d = -7;//$_GET['d'];
$n = $cxf*Configuracion::$fila_x_pag;

if(isset ($_GET['l']) && $_GET['l'])
{
    $l = $_GET['l'];
}
else
    $l = 'es';


$clang = new cuiLang($l);


$seccion = getSeccionCategoria($id);
$categoria = getCategoria($id);
if($l == 'en')
{
    $categoria = getCategoriaEN($id);
}

$total = getTotalGaleriaCategoria($id);
$t_elem = $total['total'];
$total = ceil($total['total']/$n);

$galeria = $all==0 ?  getGaleriaCategoria($id, $n, $s) : getAllGaleriaCategoria($id, $n, $s, $t_elem);

if($l=='en')
{
    $galeria = $all==0 ?  getGaleriaCategoriaEN($id, $n, $s) : getAllGaleriaCategoriaEN($id, $n, $s, $t_elem);
}

?>

<?php for($i=0; $i<count($galeria); $i++){ ?>
    <div class="cui_gal_item_cat" style="width: <?php echo 100/$cxf; ?>%;">
        <div class="vtn_info_item">
            <h2><?php echo utf8_decode($galeria[$i]['titulo']); ?></h2>
            <!--<p class="ver_detalle" style="border-bottom: 1px solid #687595;" data-id="<?php echo $galeria[$i]['id']; ?>">
                <?php echo $clang->getGaleria('sm2'); ?>
            </p>
            <p class="ver_zoom" data-id="<?php echo $galeria[$i]['id']; ?>">
                <?php echo $clang->getGaleria('sm3'); ?>
            </p>-->
        </div>
        <a id="cat_<?php echo $galeria[$i]['id']; ?>"  href="" data-id="<?php echo $galeria[$i]['id']; ?>" >
            <img class="cui_gal_image" src="service/ri.php?s=<?php echo utf8_decode($seccion['nombre']) ?>&c=<?php echo utf8_decode($categoria['carpeta']); ?>&i=<?php echo utf8_decode($galeria[$i]['imagen']); ?>&p=<?php echo $d; ?>" />
            <h3 class="cui_gal_text"><?php echo utf8_decode($galeria[$i]['nombre']); ?></h3>
        </a>
    </div>
<?php } ?>

<?php if($s<$total && $all==0){ ?>
<div class="cui_row cui_pag_gal">    
    <div class="pag_step">
        <?php echo $s; ?>  <?php echo $clang->getGaleria('sm5'); ?> <?php echo $total; ?>
    </div>
    <div class="pag_all">
       <?php echo $clang->getGaleria('sm4'); ?>
    </div>
</div>
<?php } ?>