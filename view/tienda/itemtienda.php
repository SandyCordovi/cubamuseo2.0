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

$item = getItemTienda($id);
$tematica = getTematicaItem($id);
$menu = getMenuTienda();

if($l == 'en')
{
	$item = getItemTiendaEN($id);
    $menu=getMenuTiendaEN();
}

    $car = getCarByUser($_SESSION['username']);
    $esta_car = EstaCar($id, $car['id']);


?>
<script type="text/javascript" src="script/tienda/tienda.js"> </script>

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
            <h3 class="cui_txt_titulo_session cui_txt_light"><?php echo utf8_decode($item['titulo']); ?></h3>
            <div class="cui_row">
                <div class="cui_cajon50 cui_item_tienda">
                    <img src="imagenes/Tienda/<?php echo $tematica['nombre'];?>/<?php echo $item['imagen'];?>" class="cui_banner_image"/>
                </div>
                <div class="cui_cajon50 cui_padding_50_left cui_padding_20_top" style="text-align:left;">
                    <span class="cui_padding_20_bottom" style="font-weight:bold; width:100%; float:left;">Item <?php echo $item['id']; ?></span>

                    <span class="cui_padding_20_bottom" style="font-weight:bold; width:100%; float:left;">Precio: $<?php echo $item['precio']; ?></span>

                    <div style="float:left; width:100%;">
                        <input class="cui_envio_shop" type="radio" name="envio"  value="dentro" checked="checked"/><span style="padding-left:10px;"><?php echo $clang->getTienda('ck1'); ?> (<?php echo $item['tprecioEnvio']; ?>) </span>
                    </div>
                    <div style="float:left; width:100%;">
                        <input class="cui_envio_shop" type="radio" name="envio"  value="fuera" /><span style="padding-left:10px;"><?php echo $clang->getTienda('ck2'); ?> (<?php echo $item['tprecioEnvioF']; ?>) </span>
                    </div>
                    <?php if(IsLogin()) {?>

                        <?php if($esta_car){ ?>
                            <div class="cui_row" style="padding: 10px 10px; background-color: #dcdcdc; margin-top: 10px;">
                                <p style="text-align: center; font-size: 1.2em;"><?php echo $clang->getWnd('b4'); ?></p>
                                <div class="cui_row" style="padding-top: 10px; text-align: center;">
                                    <div class="cui_btn_blue view_car" style="padding: 5px 10px; float: none; overflow: hidden; display: inline;">
                                        <?php echo $clang->getWnd('b2'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <div id="add_car_shop" class="cui_btn_blue">
                                <?php echo $clang->getWnd('b3'); ?>
                            </div>
                        <?php } ?>

                        <div class="cui_row cui_car_notif" style="padding: 10px 10px; background-color: #dcdcdc; margin-top: 10px; display: none;">

                        </div>

                        <div id="add_car_shop_load" class="cui_generalload" style="padding: 0; display: none;z-index: 10;">
                            <div class="wrapper" style="margin: 0; text-align: center;">
                                <div class="cssload-loader" style="margin: 0;"></div>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div> <span class="cui_padding_20_top" style="width:100%; float:left; font-size:13px; font-style:italic;"><?php echo $clang->getWnd('l1'); ?> <a id="cui_winlog" class="cui_enlace_login" href="#">(<?php echo $clang->getWnd('l2'); ?>)</a></span></div>
                    <?php } ?>
                </div>
            </div>
            <div class="cui_txt_des cui_txt_light cui_padding_20_bottom">
                <?php echo utf8_decode($item['descripcion']); ?>
                <div style="text-align:center;">
                    <a id="cui_contact_v" href="#" style="background-image: url(images/vendedor.png); background-repeat: no-repeat; background-position: left center; background-size: 32px; padding: 20px 35px;">
                        <?php echo $clang->getTienda('v'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>



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
<!--				-->
<!--				<div class="cui_texto">-->
<!--					<h3 class="cui_txt_titulo_session cui_txt_light">--><?php //echo utf8_decode($item['titulo']); ?><!--</h3>-->
<!--					<div class="cui_row"> -->
<!--						<div class="cui_cajon50 cui_item_tienda">-->
<!--							<img src="imagenes/Tienda/--><?php //echo $tematica['nombre'];?><!--/--><?php //echo $item['imagen'];?><!--" class="cui_banner_image"/>-->
<!--						</div>-->
<!--						<div class="cui_cajon50 cui_padding_50_left cui_padding_20_top" style="text-align:left;">-->
<!--							<span class="cui_padding_20_bottom" style="font-weight:bold; width:100%; float:left;">Item --><?php //echo $item['id']; ?><!--</span>-->
<!--							-->
<!--							<span class="cui_padding_20_bottom" style="font-weight:bold; width:100%; float:left;">Precio: $--><?php //echo $item['precio']; ?><!--</span>-->
<!--							-->
<!--							<div style="float:left; width:100%;">-->
<!--                                                            <input class="cui_envio_shop" type="radio" name="envio"  value="dentro" checked="checked"/><span style="padding-left:10px;">--><?php //echo $clang->getTienda('ck1'); ?><!-- (--><?php //echo $item['tprecioEnvio']; ?><!--) </span>-->
<!--							</div>-->
<!--							<div style="float:left; width:100%;">-->
<!--                                                            <input class="cui_envio_shop" type="radio" name="envio"  value="fuera" /><span style="padding-left:10px;">--><?php //echo $clang->getTienda('ck2'); ?><!-- (--><?php //echo $item['tprecioEnvioF']; ?><!--) </span>-->
<!--							</div>-->
<!--							--><?php //if(IsLogin()) {?>
<!---->
<!--                                                            --><?php //if($esta_car){ ?>
<!--                                                            <div class="cui_row" style="padding: 10px 10px; background-color: #dcdcdc; margin-top: 10px;">-->
<!--                                                                <p style="text-align: center; font-size: 1.2em;">--><?php //echo $clang->getWnd('b4'); ?><!--</p>-->
<!--                                                                <div class="cui_row" style="padding-top: 10px; text-align: center;">-->
<!--                                                                    <div class="cui_btn_blue view_car" style="padding: 5px 10px; float: none; overflow: hidden; display: inline;">-->
<!--                                                                        --><?php //echo $clang->getWnd('b2'); ?>
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            --><?php //}else{ ?>
<!--                                                                <div id="add_car_shop" class="cui_btn_blue">-->
<!--                                                                    --><?php //echo $clang->getWnd('b3'); ?>
<!--                                                                </div>-->
<!--                                                            --><?php //} ?>
<!---->
<!--                                                            <div class="cui_row cui_car_notif" style="padding: 10px 10px; background-color: #dcdcdc; margin-top: 10px; display: none;">-->
<!--                                                               -->
<!--                                                            </div>-->
<!---->
<!--                                                             <div id="add_car_shop_load" class="cui_generalload" style="padding: 0; display: none;z-index: 10;">-->
<!--                                                                 <div class="wrapper" style="margin: 0; text-align: center;">-->
<!--                                                                        <div class="cssload-loader" style="margin: 0;"></div>-->
<!--                                                                    </div>-->
<!--                                                             </div>-->
<!---->
<!--							--><?php //} else { ?>
<!--							<div> <span class="cui_padding_20_top" style="width:100%; float:left; font-size:13px; font-style:italic;">--><?php //echo $clang->getWnd('l1'); ?><!-- <a id="cui_winlog" class="cui_enlace_login" href="#">(--><?php //echo $clang->getWnd('l2'); ?><!--)</a></span></div>-->
<!--							--><?php //} ?>
<!--						</div>-->
<!--					</div>-->
<!--					<div class="cui_txt_des cui_txt_light cui_padding_20_bottom">-->
<!--						--><?php //echo utf8_decode($item['descripcion']); ?>
<!--						<div style="text-align:center;">-->
<!--							<a id="cui_contact_v" href="#" style="background-image: url(images/vendedor.png); background-repeat: no-repeat; background-position: left center; background-size: 32px; padding: 20px 35px;">-->
<!--								--><?php //echo $clang->getTienda('v'); ?>
<!--							</a>-->
<!--						</div>-->
<!--					</div>													-->
<!--				</div>				-->
<!--			</div>                        -->
<!--		</div>-->
<!--	</div>-->
        <script type="text/javascript">
            $(document).ready(function() {

                var cuiTienda = new $.cuiTienda({
                    id: <?php echo $id; ?>
                }, '');
				
            });
            $('#cui_winlog').on('click', function(e){
                e.preventDefault();
                if($(this).hasClass('user_log'))
                    cui_wnd._createWND_tamFijo('dlg/opt_user.php', 30);
                else
                    cui_wnd._createWND_tamFijo('dlg/login.php', 30);
            });

            $('#cui_contact_v').on('click', function(e){
                e.preventDefault();
                cui_wnd._createWND_tamFijo('dlg/contactov.php', 40);
            })

            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
	</script>
<!--</div>-->