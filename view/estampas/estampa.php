<?php

include 'accesdb/cui_estampas.php';

$id = 1;
if(count($param)==2)
{
    $id = $param[1];
}
else if(count($param)==3)
{
    $id = $param[2];
}

$estampa = getEstampa($id);
$menu=getMenuEstampas();

$l = $clang->getLang();
if($l == 'en')
{
    $estampa = getEstampaEN($id);
    $menu=getMenuEstampasEN();
}

?>

<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <ul>
                <li>
                    <a href="?f=catestampa-<?php echo $l; ?>-0" class="cui_menu_lateral_item">
                        <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                            <img src="images/menuestampas/todas.jpg"/>
                        </div>
                        <div class=" cui_padding_20_bottom" style="font-size:14px;">
                            <span >Todas</span>
                        </div>
                    </a>
                </li>
            </ul>
            <?php for($i=0; $i<count($menu); $i++){ ?>
                <ul>
                    <li>
                        <a href="?f=catestampa-<?php echo $l; ?>-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
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
            <h1 class="cui_txt_titulo_session cui_txt_light"><?php echo utf8_decode($estampa['titulo']); ?></h1>
            <div class="cui_txt_des cui_txt_light">
                <?php echo utf8_decode($estampa['descripcion']); ?>
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
<!--                            <a href="?f=catestampa---><?php //echo $l; ?><!---0" class="cui_menu_lateral_item">-->
<!--                                <div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--                                    <img src="images/menuestampas/todas.jpg"/>-->
<!--                                </div>-->
<!--                                <div class=" cui_padding_20_bottom" style="font-size:14px;">-->
<!--                                    <span >Todas</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            --><?php //for($i=0; $i<count($menu); $i++){ ?>
<!--                                <ul>-->
<!--                                    <li>-->
<!--                                    <a href="?f=catestampa---><?php //echo $l; ?><!-----><?php //echo $menu[$i]['id'];?><!--" class="cui_menu_lateral_item">-->
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
<!--			<div class="cui_contenido">   -->
<!--				-->
<!--				<div class="cui_texto">-->
<!--					<h1 class="cui_txt_titulo_session cui_txt_light">--><?php //echo utf8_decode($estampa['titulo']); ?><!--</h1>-->
<!--					<div class="cui_txt_des cui_txt_light">-->
<!--						--><?php //echo utf8_decode($estampa['descripcion']); ?>
<!--					</div>													-->
<!--				</div>				-->
<!--			</div>                        -->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->