<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_forum.php';


$s = "";
if( isset ($_POST['s']) && $_POST['s'])
{
    $s = $_POST['s'];
}
$s = trim($s);
$s = preg_split('/ /', $s);
$t = $_GET['t'];

if($t==1)$col = getColecciones($s);
else if($t==2)$col = getEstampa($s);
else if($t==4)$col = getTienda($s);


?>
<p id="searchresults" class="son">
<?php if(count($col)>0){ ?>

    <span class="category"><?php echo $col[0]['cat']; ?></span>

    <?php
    for($i=0; $i<count($col); $i++)
    {

        $description = strip_tags($col[$i]['descripcion']);
        if(strlen($description) > 500)
        {
             $description = substr($description, 0, 500) . "...";
        }

        $img = "";
        if($t==1)
        {
            $seccion = getSeccionCategoria($col[$i]['id']);
            $img = "imagenes/". utf8_decode($seccion['nombre']) ."/".  utf8_decode($col[$i]['nombre']) ."/". utf8_decode($col[$i]['imagenGaleria']);
        }
        else if($t==2)
        {
            $galeriae = getEstampaById($col[$i]['id']);
            $img = "imagenes/Estampas/". utf8_decode($galeriae['nombre']) ."/".  utf8_decode($col[$i]['imagenGaleria']);
        }
        else if($t==4)
        {
            $tematica = getTematicaItem($col[$i]['id']);
            $img = "imagenes/Tienda/". utf8_decode($tematica['nombre']) ."/".  utf8_decode($col[$i]['imagenGaleria']);
        }
    ?>

    <a href="#" data-img="<?php echo $img; ?>" data-titulo='<?php echo $col[$i]['titulo']; ?>' data-id='<?php echo $col[$i]['id']; ?>' >
        <img src="<?php echo $img; ?>" alt="" height="50px" />
        <span class="searchheading"><?php echo $col[$i]['titulo']; ?></span>
        <span class="text-truncate"><?php echo $description; ?></span>
    </a>

    <?php } ?>

<?php } ?>

</p>