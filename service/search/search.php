<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_search.php';


$s = "";
if( isset ($_POST['s']) && $_POST['s'])
{
    $s = $_POST['s'];
}
$s = trim($s);
$s = preg_split('/ /', $s);

$col = getColecciones($s);
$est = getEstampa($s);
$tie = getTienda($s);

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
    ?>

    <a href="?f=<?php echo $col[$i]['url']; ?>">
        <img src="service/ri.php?s=Tarjetas Postales&c=Las Calles Habaneras&i=A-02.jpg&p=46" alt="" />
        <span class="searchheading"><?php echo $col[$i]['titulo']; ?></span>
        <span class="text-truncate"><?php echo $description; ?></span>
    </a>

    <?php } ?>

<?php } ?>


<?php if(count($est)>0){ ?>

    <span class="category"><?php echo $est[0]['cat']; ?></span>

    <?php
    for($i=0; $i<count($est); $i++)
    {

        $description = strip_tags($est[$i]['descripcion']);
        if(strlen($description) > 80)
        {
             $description = substr($description, 0, 80) . "...";
        }
    ?>

    <a href="?f=<?php echo $est[$i]['url']; ?>">
        <img src="service/ri.php?s=Tarjetas Postales&c=Las Calles Habaneras&i=A-02.jpg&p=46" alt="" />
        <span class="searchheading"><?php echo $est[$i]['nombre']; ?></span>
        <span class="text-truncate"><?php echo $description; ?></span>
    </a>

    <?php } ?>

<?php } ?>


<?php if(count($tie)>0){ ?>

    <span class="category"><?php echo $tie[0]['cat']; ?></span>

    <?php
    for($i=0; $i<count($tie); $i++)
    {

        $description = strip_tags($tie[$i]['descripcion']);
        if(strlen($description) > 80)
        {
             $description = substr($description, 0, 80) . "...";
        }
    ?>

    <a href="<?php echo $tie[$i]['url']; ?>">
        <img src="service/ri.php?s=Tarjetas Postales&c=Las Calles Habaneras&i=A-02.jpg&p=46" alt="" />
        <span class="searchheading"><?php echo $tie[$i]['nombre']; ?></span>
        <span class="text-truncate"><?php echo $description; ?></span>
    </a>

    <?php } ?>

<?php } ?>

</p>