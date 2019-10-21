<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_estampas.php';

$all = $_GET['all'];
$id = $_GET['id'];
$cxf = $_GET['cxf'];
$d = $_GET['d'];
$s = $_GET['s'];
$n = $cxf*Configuracion::$fila_x_pag;

$muestra = getMuestra($id);
$total = getTotalGaleriaMuestra($id);
$t_elem = $total['total'];
$total = ceil($total['total']/$n);

$galeria = $all==0 ?  getGaleriaMuestra($id, $n, $s) : getAllGaleriaMuestra($id, $n, $s, $t_elem);

?>

<?php for($i=0; $i<count($galeria); $i++){ ?>
    <a id="cat_<?php echo $galeria[$i]['id']; ?>" class="cui_gal_item_cat" href="#" style="width: <?php echo 100/$cxf; ?>%;" data-id="<?php echo $galeria[$i]['id']; ?>" >
        <div class="vtn_info_item">
            <h2><?php echo utf8_decode($galeria[$i]['titulo']); ?></h2>
        </div>
        <img class="cui_gal_image" src="service/ri.php?s=Muestras&c=<?php echo utf8_decode($muestra['carpeta']); ?>&i=<?php echo utf8_decode($galeria[$i]['imagen']); ?>&p=<?php echo $d; ?>" />
        <h3 class="cui_gal_text"><?php echo $galeria[$i]['nombre']; ?></h3>
    </a>
<?php } ?>

<?php if($s<$total && $all==0){ ?>
<div class="cui_row cui_pag_gal">    
    <div class="pag_step">
        <?php echo $s; ?> de <?php echo $total; ?>
    </div>
    <div class="pag_all">
        Ver galeria completa
    </div>
</div>
<?php } ?>
