<?php

include 'accesdb/cui_tienda.php';

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

$tematica = getTematicaTienda($id);
$galeria = getGaleriaTienda($id);
$menu=getMenuTienda();

if($l == 'en')
{
	$tematica = getTematicaTiendaEN($id);
        $galeria = getGaleriaTiendaEN($id);
        $menu=getMenuTiendaEN();
}

?>

<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <?php for($i=0; $i<count($menu); $i++){ ?>
                <ul>
                    <li>
                        <a href="?f=cattienda-<?php echo $l;?>-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
                            <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                                <img src="images/menutienda/<?php echo $menu[$i]['imagen'];?>"/>
                            </div>
                            <div class="cui_padding_20_bottom" style="font-size:14px;">
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
            <h1 class="cui_txt_titulo_session cui_txt_light cui_padding_20_top"><?php echo utf8_decode($tematica['titulo']); ?></h1>
            <div class="cui_padding_20 cui_padding_50_bottom">
                <div class="cui_cont_galeria">
                    <?php for($i=0; $i<count($galeria); $i++){ ?>
                        <a href="?f=itemtienda-<?php echo $l;?>-<?php echo $galeria[$i]['id'];?>" class="cui_gal_item" href="" >
                            <img class="cui_gal_image" width="100%" src="imagenes/Tienda/<?php echo utf8_decode($tematica['carpeta']); ?>/<?php echo utf8_decode($galeria[$i]['imagen']); ?>" />
                            <h3 class="cui_gal_text"><?php echo utf8_decode($galeria[$i]['nombre']); ?></h3>
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
<!--				--><?php //for($i=0; $i<count($menu); $i++){ ?>
<!--                            <ul>-->
<!--                                <li>-->
<!--                        <a href="?f=cattienda---><?php //echo $l;?><!-----><?php //echo $menu[$i]['id'];?><!--" class="cui_menu_lateral_item">-->
<!--                            <div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--                                <img src="images/menutienda/--><?php //echo $menu[$i]['imagen'];?><!--"/>-->
<!--                            </div>-->
<!--                            <div class="cui_padding_20_bottom" style="font-size:14px;">-->
<!--                                <span >--><?php //echo utf8_decode($menu[$i]['nombre']); ?><!--</span>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                    --><?php //} ?>
<!--			</nav>-->
<!--			<div class="cui_contenido">   -->
<!--				<h1 class="cui_txt_titulo_session cui_txt_light cui_padding_20_top">--><?php //echo utf8_decode($tematica['titulo']); ?><!--</h1>-->
<!--				<div class="cui_padding_20 cui_padding_50_bottom">                                                    -->
<!--					<div class="cui_cont_galeria">-->
<!--						--><?php //for($i=0; $i<count($galeria); $i++){ ?>
<!--							<a href="?f=itemtienda---><?php //echo $l;?><!-----><?php //echo $galeria[$i]['id'];?><!--" class="cui_gal_item" href="" >-->
<!--								<img class="cui_gal_image" width="100%" src="imagenes/Tienda/--><?php //echo utf8_decode($tematica['carpeta']); ?><!--/--><?php //echo utf8_decode($galeria[$i]['imagen']); ?><!--" />-->
<!--								<h3 class="cui_gal_text">--><?php //echo utf8_decode($galeria[$i]['nombre']); ?><!--</h3>-->
<!--							</a>-->
<!--						--><?php //} ?>
<!--					</div>												-->
<!--				</div>				-->
<!--			</div>                        -->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->