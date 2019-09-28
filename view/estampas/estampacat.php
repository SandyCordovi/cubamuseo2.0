<?php

include 'accesdb/cui_estampas.php';

$id = 1;
$id = 1;
if(count($param)==2)
{
    $id = $param[1];
}
else if(count($param)==3)
{
    $id = $param[2];
}

$l = $clang->getLang();

$galeriae = getGaleriaEstampasT();
$galeriam = getGaleriaMuestrasT();
$menu=getMenuEstampas();
$titulo = "";

if($id == 0)
{
	$galeriae = getGaleriaEstampasT();
	$galeriam = getGaleriaMuestrasT();
	//$titulo = getTexto(2)['nombre'];
}
else
{
	$galeriae = getGaleriaEstampas($id);
	$galeriam = getGaleriaMuestras($id);
	//$titulo = getCategoriaEstampa($id)['nombre'];
}

if($l == 'en')
{
    if($id == 0)
    {
            $galeriae = getGaleriaEstampasTEN();
            $galeriam = getGaleriaMuestrasTEN();
	    //$titulo = getTextoEN(2)['nombre'];
    }
    else
    {
            $galeriae = getGaleriaEstampasEN($id);
            $galeriam = getGaleriaMuestrasEN($id);
	    //$titulo = getCategoriaEstampa($id)['name'];
    }
	$menu=getMenuEstampasEN();
}

?>
<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <ul>
                <li>
                    <a href="?f=catestampa-<?php echo $l;?>-0" class="cui_menu_lateral_item">
                        <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                            <img src="images/menuestampas/todas.jpg"/>
                        </div>
                        <div class=" cui_padding_20_bottom" style="font-size:14px;">
                            <span ><?php if($l=='es'){ echo 'Todas';}else{echo 'All';} ?></span>
                        </div>
                    </a>
                </li>
            </ul>
            <?php for($i=0; $i<count($menu); $i++){ ?>
                <ul>
                    <li>
                        <a href="?f=catestampa-<?php echo $l;?>-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
                            <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                                <img src="images/menuestampas/<?php echo $menu[$i]['imagen'];?>"/>
                            </div>
                            <div class=" cui_padding_20_bottom" style="font-size:14px;">
                                <span ><?php echo utf8_decode($menu[$i]['nombre']); ?></span>
                            </div>
                        </a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
    <div id="page-content-wrapper">
        <div class="container">
            <h1 class="cui_txt_titulo_session cui_txt_light cui_padding_20_top"><?php echo $titulo; ?></h1>
            <div class="cui_padding_20 cui_padding_50_bottom">
                <div class="cui_cont_galeria">
                    <?php for($i=0; $i<count($galeriae); $i++){ ?>
                        <a href="?f=estampa-<?php echo $l;?>-<?php echo $galeriae[$i]['id'];?>" class="cui_gal_item" href="" >
                            <img class="cui_gal_image" width="100%" src="imagenes/Estampas/<?php echo utf8_decode($galeriae[$i]['carpeta']); ?>/<?php echo utf8_decode($galeriae[$i]['imagen']); ?>" />
                            <h3 class="cui_gal_text"><?php echo utf8_decode($galeriae[$i]['nombre']); ?></h3>
                        </a>
                    <?php } ?>
                    <?php for($i=0; $i<count($galeriam); $i++){ ?>
                        <a href="?f=muestra-<?php echo $l;?>-<?php echo $galeriam[$i]['id'];?>" class="cui_gal_item" href="" >
                            <img class="cui_gal_image" width="100%" src="imagenes/Muestras/<?php echo utf8_decode($galeriam[$i]['carpeta']); ?>/<?php echo utf8_decode($galeriam[$i]['imagen']); ?>" />
                            <h3 class="cui_gal_text"><?php echo utf8_decode($galeriam[$i]['nombre']); ?></h3>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<!--<div class="cui_row">-->
<!--	<div class="cui_w">                    -->
<!--		<div class="cui_row">-->
<!--			<nav class="cui_menu_lateral">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                            <a href="?f=catestampa---><?php //echo $l;?><!---0" class="cui_menu_lateral_item">-->
<!--                                <div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--                                    <img src="images/menuestampas/todas.jpg"/>-->
<!--                                </div>-->
<!--                                <div class=" cui_padding_20_bottom" style="font-size:14px;">-->
<!--                                    <span >--><?php //if($l=='es'){ echo 'Todas';}else{echo 'All';} ?><!--</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            --><?php //for($i=0; $i<count($menu); $i++){ ?>
<!--                                <ul>-->
<!--                                    <li>-->
<!--                                    <a href="?f=catestampa---><?php //echo $l;?><!-----><?php //echo $menu[$i]['id'];?><!--" class="cui_menu_lateral_item">-->
<!--                                    <div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--                                        <img src="images/menuestampas/--><?php //echo $menu[$i]['imagen'];?><!--"/>-->
<!--                                    </div>-->
<!--                                    <div class=" cui_padding_20_bottom" style="font-size:14px;">-->
<!--                                        <span >--><?php //echo utf8_decode($menu[$i]['nombre']); ?><!--</span>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                                        </li>-->
<!--                                </ul>-->
<!--                            --><?php //} ?>
<!--                        </nav>-->
<!--			<div class="cui_contenido">-->
<!--                                <h1 class="cui_txt_titulo_session cui_txt_light cui_padding_20_top">--><?php //echo $titulo; ?><!--</h1>-->
<!--				<div class="cui_padding_20 cui_padding_50_bottom">                                                    -->
<!--					<div class="cui_cont_galeria">-->
<!--						--><?php //for($i=0; $i<count($galeriae); $i++){ ?>
<!--							<a href="?f=estampa---><?php //echo $l;?><!-----><?php //echo $galeriae[$i]['id'];?><!--" class="cui_gal_item" href="" >-->
<!--								<img class="cui_gal_image" width="100%" src="imagenes/Estampas/--><?php //echo utf8_decode($galeriae[$i]['carpeta']); ?><!--/--><?php //echo utf8_decode($galeriae[$i]['imagen']); ?><!--" />-->
<!--								<h3 class="cui_gal_text">--><?php //echo utf8_decode($galeriae[$i]['nombre']); ?><!--</h3>-->
<!--							</a>-->
<!--						--><?php //} ?>
<!--						--><?php //for($i=0; $i<count($galeriam); $i++){ ?>
<!--							<a href="?f=muestra---><?php //echo $l;?><!-----><?php //echo $galeriam[$i]['id'];?><!--" class="cui_gal_item" href="" >-->
<!--								<img class="cui_gal_image" width="100%" src="imagenes/Muestras/--><?php //echo utf8_decode($galeriam[$i]['carpeta']); ?><!--/--><?php //echo utf8_decode($galeriam[$i]['imagen']); ?><!--" />-->
<!--								<h3 class="cui_gal_text">--><?php //echo utf8_decode($galeriam[$i]['nombre']); ?><!--</h3>-->
<!--							</a>-->
<!--						--><?php //} ?>
<!--					</div>												-->
<!--				</div>				-->
<!--			</div>                        -->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->