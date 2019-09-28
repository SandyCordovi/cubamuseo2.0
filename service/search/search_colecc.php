<?php
include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_search.php';

$s = "";
$p = $_POST['p'];
if( isset ($_POST['s']) && $_POST['s'])
{
    $s = $_POST['s'];
}
$s = trim($s);
$s = preg_split('/ /', $s);

$col = getColeccionesSearch($s, $p);
$cant_pag = getColeccionesSearchTotal($s);

$n = Configuracion::$num_elem_x_pag;
$cant_pag = ceil($cant_pag/$n);
?>

<p id="searchresultsreal" class="son">
<?php if(count($col)>0){ ?>

    

    <?php
    for($i=0; $i<count($col); $i++)
    {

        $description = strip_tags($col[$i]['descripcion']);
        if(strlen($description) > 500)
            {
             $description = substr($description, 0, 500) . "...";
        }
    ?>

    <a href="?f=<?php echo $col[$i]['url']; ?>">
        <img src="service/ri.php?s=Tarjetas Postales&c=Las Calles Habaneras&i=A-02.jpg&p=100" alt="" />
        <span class="searchheading"><?php echo $col[$i]['titulo']; ?></span>
        <span class="text-truncate"><?php echo $description; ?></span>
    </a>

    <?php } ?>

    <div class="cui_row cui_pag">
        <div class="btn pag_primera" data-pag="1">
            Primera
        </div>
        <div class="cui_pag_hide">
            |
        </div>
        <div class="btn pag_prev" data-pag="<?php echo $p-1<1 ? 1 : $p-1; ?>">
            Anterior
        </div>
        <div class="pos">
            <?php echo $p; ?> de <?php echo $cant_pag; ?>
        </div>
        <div class="btn pag_next" data-pag="<?php echo $p+1>$cant_pag ? $cant_pag : $p+1; ?>">
            Siguiente
        </div>
        <div class="cui_pag_hide">
            |
        </div>
        <div class="btn pag_ultima" data-pag="<?php echo $cant_pag; ?>">
            &Uacute;ltima
        </div>
    </div>

<?php }else{ ?>
<p style="padding: 50px 0; text-align: center; font-size: 15px;">No item</p>
<?php } ?>
