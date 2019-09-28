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

$muestra = getMuestra($id);
$menu=getMenuEstampas();

$l = $clang->getLang();
if($l == 'en')
{
    $muestra = getMuestraEN($id);
    $menu=getMenuEstampasEN();
}

?>	
<script type="text/javascript" src="script/estampas/muestra.js"> </script>

<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <ul>
                <li>
                    <a href="?f=catestampa-0" class="cui_menu_lateral_item">
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
                        <a href="?f=catestampa-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
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
            <img src="imagenes/Muestras/<?php echo utf8_decode($muestra['carpeta']) ?>/<?php echo utf8_decode($muestra['imagen']) ?>" class="cui_banner_image"/>
            <div class="cui_texto">
                <h1 class="cui_txt_titulo_session cui_txt_light"><?php echo utf8_decode($muestra['titulo']); ?></h1>
                <div class="cui_tabs">
                    <div class="cui_tabs_btns">
                        <div href="#descripcion" class="cui_tab_btn cui_tab_btn_activo"><?php echo $clang->getGaleria('tab1'); ?></div>
                        <div href="#galeria" class="cui_tab_btn" ><?php echo $clang->getGaleria('tab3'); ?></div>
                    </div>
                    <div id="descripcion" class="cui_tabs_content tab_cont_activo cui_padding_20 cui_padding_50_bottom">
                        <div class="cui_txt_des cui_txt_light">
                            <?php echo utf8_decode($muestra['descripcion']); ?>
                        </div>
                    </div>
                    <div id="galeria" class="cui_tabs_content cui_padding_20 cui_padding_50_bottom">
                        <div id="cui_cont_galeria" class="cui_cont_galeria">

                            <div class="cui_row son">
                                <div class="cui_generalload" style="padding: 20px 0;">
                                    <div class="wrapper">
                                        <div class="cssload-loader"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!--<div class="cui_row">-->
<!--	<div class="cui_w">-->
<!--		<div class="cui_row">-->
<!--			<nav class="cui_menu_lateral">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                            <a href="?f=catestampa-0" class="cui_menu_lateral_item">-->
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
<!--                                    <a href="?f=catestampa---><?php //echo $menu[$i]['id'];?><!--" class="cui_menu_lateral_item">-->
<!--                                    <div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--                                        <img src="images/menuestampas/--><?php //echo $menu[$i]['imagen'];?><!--"/>-->
<!--                                    </div>-->
<!--                                    <div class=" cui_padding_20_bottom" style="font-size:14px;">-->
<!--                                        <span >--><?php //echo utf8_decode($menu[$i]['nombre']); ?><!--</span>-->
<!--                                    </div>-->
<!--                                </a> -->
<!--                                        </li>-->
<!--                                </ul>-->
<!--                            --><?php //} ?>
<!--                        </nav>-->
<!--			<div class="cui_contenido">-->
<!--				<img src="imagenes/Muestras/--><?php //echo utf8_decode($muestra['carpeta']) ?><!--/--><?php //echo utf8_decode($muestra['imagen']) ?><!--" class="cui_banner_image"/>-->
<!--				<div class="cui_texto">-->
<!--					<h1 class="cui_txt_titulo_session cui_txt_light">--><?php //echo utf8_decode($muestra['titulo']); ?><!--</h1>-->
<!--					<div class="cui_tabs">-->
<!--						<div class="cui_tabs_btns">-->
<!--							<div href="#descripcion" class="cui_tab_btn cui_tab_btn_activo">--><?php //echo $clang->getGaleria('tab1'); ?><!--</div>-->
<!--							<div href="#galeria" class="cui_tab_btn" style="left: 200px;">--><?php //echo $clang->getGaleria('tab2'); ?><!--</div>-->
<!--						</div>-->
<!--						<div id="descripcion" class="cui_tabs_content tab_cont_activo cui_padding_20 cui_padding_50_bottom">-->
<!--							<div class="cui_txt_des cui_txt_light">-->
<!--								--><?php //echo utf8_decode($muestra['descripcion']); ?>
<!--							</div>-->
<!--						</div>-->
<!--						<div id="galeria" class="cui_tabs_content cui_padding_20 cui_padding_50_bottom">-->
<!--							<div id="cui_cont_galeria" class="cui_cont_galeria">-->
<!---->
<!--								<div class="cui_row son">-->
<!--									<div class="cui_generalload" style="padding: 20px 0;">-->
<!--											<div class="wrapper">-->
<!--												<div class="cssload-loader"></div>-->
<!--											</div>-->
<!--									 </div>-->
<!--								</div>-->
<!--								-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
	<script>
	$(document).ready(function() {

            var cuiMues = new $.cuiMuestra({
                id: <?php echo $id; ?>,
                cantXfila: <?php echo Configuracion::$item_x_fila_gal; ?>
            }, '.cui_cont_galeria');

            $('.cui_tab_btn').on('click', function(){
                    clickTabs(this);
            });

	});

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
	</script>
<!--</div>-->