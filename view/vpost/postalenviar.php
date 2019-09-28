<?php

include 'accesdb/cui_postales.php';

$id = 1;
if(count($param)>1)
{
    $id = $param[1];
}
$postal = getPostal($id);
$catPostal = getCategoriaPostal($postal['categoria']);
$menu=getMenuPostales();

?>
<style type="text/css">

@font-face {
  font-family: 'Capture_it';
  font-style: normal;
  src: url('lib/font/Capture_it.ttf');
}
@font-face {
  font-family: 'Windsong';
  font-style: normal;
  src: url('lib/font/Windsong.ttf');
}
@font-face {
  font-family: 'CaviarDreams';
  font-style: normal;
  src: url('lib/font/CaviarDreams.ttf');
}

@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  src: url('lib/font/Pacifico.ttf');
}

</style>
<link rel="stylesheet" href="lib/jquery/jquery-ui.min.css"/>
<script type="text/javascript" src="lib/jquery/jquery-ui.min.js"> </script>

<script type="text/javascript" src="lib/colorpicker/jqColorPicker.min.js"></script>

<script type="text/javascript" src="lib/jquery/jquery.form.min.js"> </script>
<script type="text/javascript" src="script/vpost/postales.js"> </script>

<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <?php for($i=0; $i<count($menu); $i++){ ?>
                <ul>
                    <li>
                        <a href="?f=catpostales-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
                            <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                                <img src="images/menupostales/<?php echo $menu[$i]['imagen'];?>"/>
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

            <h3 class="cui_txt_titulo_session cui_txt_light"><?php echo utf8_decode($catPostal['titulo']); ?></h3>
            <div class="cui_row">
                <div class="cui_cajon50 cui_item_tienda">
                    <img id="cui_img_vp_send_real" src="imagenes/V-Posts/<?php echo $catPostal['nombre'];?>/<?php echo $postal['imagen'];?>" class="cui_banner_image"/>
                </div>
                <div class="cui_cajon50 cui_padding_50_left cui_padding_20_top" style="text-align:left;">
                    <span class="cui_padding_20_bottom cui_postales_mensajes">Usted puede personalizar esta postal con la frase o texto que usted desee.</span>

                    <div id="personalizar" class="cui_btn_blue">
                        Personalizar
                    </div>
                </div>
                <input type="hidden" id="isedit_vp" value="0" />
            </div>
            <div class="cui_row cui_postales_box" style="display: block;">
                <p id="cui_notif_log" class="cui_postales_notif cui_txt_titulo" style="color: red; padding: 10px 0;"></p>
                <form id="myFormPost" class="cui_row" action="service/vpost/send.php" method="post" style="position: relative;">
                    <div class="cui_cajon50" style="padding-right: 10px;">
                        <p class="cui_txt_titulo_session">Para:</p>
                        <label class="cui_row" style="text-align: left;">Nombre</label>
                        <input id="pnombre" class="cui_input cui_postales_input" required="required" name="pnombre"/>
                        <label class="cui_row" style="text-align: left;">Email</label>
                        <input id="pemail" class="cui_input cui_postales_input" required="required" type="email" name="pemail"/>
                    </div>
                    <div class="cui_cajon50" style="padding-left: 10px;">
                        <p class="cui_txt_titulo_session">De:</p>
                        <label class="cui_row" style="text-align: left;">Nombre</label>
                        <input class="cui_input cui_postales_input" required="required" name="dnombre"/>
                        <label class="cui_row" style="text-align: left;">Email</label>
                        <input class="cui_input cui_postales_input" required="required" type="email" name="demail"/>
                    </div>

                    <label class="cui_row" style="text-align: left;">Mensaje</label>
                    <textarea class="cui_input cui_postales_height" name="msg"></textarea>
                    <div class="cui_row" style="text-align: center;">
                        <input class="cui_btn_blue" type="submit" value="Enviar" />
                    </div>
                    <input id="cui_url_send_vp" type="hidden" name="url" value="" />
                </form>
            </div>
            <div id="cui_load_envio" class="cui_row" style="padding: 100px 0; display: none;">
                <div id="add_car_shop_load" class="cui_generalload" style="display: block; z-index: 10;">
                    <div class="wrapper" style="text-align: center;">
                        <div class="cssload-loader" style="margin: 0;"></div>
                    </div>
                </div>
                <p class="cui_txt_titulo" style="color:#182535; ">Enviando</p>
            </div>
            <div id="cui_notif_envio" class="cui_row" style="padding: 50px 0; display: none;">
                <p class="cui_txt_titulo" style="display: block;">
                    Su postal ha sido envia correctamente.
                </p>
                <div class="cui_btn_blue" style="margin: 20px auto; float: none; display: table;">
                    Enviar esta postal a otro amigo
                </div>
            </div>

        </div>
    </div>
</div>



<!--<div class="cui_row">-->
<!--	<div class="cui_w">                    -->
<!--		<div class="cui_row">-->
<!--			<nav class="cui_menu_lateral">-->
<!--                            --><?php //for($i=0; $i<count($menu); $i++){ ?>
<!--                                <ul>-->
<!--                                    <li>-->
<!--					<a href="?f=catpostales---><?php //echo $menu[$i]['id'];?><!--" class="cui_menu_lateral_item">-->
<!--						<div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--							<img src="images/menupostales/--><?php //echo $menu[$i]['imagen'];?><!--"/>-->
<!--						</div>-->
<!--						<div class="cui_padding_20_bottom" style="font-size:14px;">-->
<!--							<span >--><?php //echo utf8_decode($menu[$i]['nombre']); ?><!--</span>-->
<!--						</div>-->
<!--					</a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--				--><?php //} ?>
<!--			</nav>-->
<!--			<div class="cui_contenido">   -->
<!--				-->
<!--				<div class="cui_texto">-->
<!--					<h3 class="cui_txt_titulo_session cui_txt_light">--><?php //echo utf8_decode($catPostal['titulo']); ?><!--</h3>-->
<!--					<div class="cui_row"> -->
<!--						<div class="cui_cajon50 cui_item_tienda">-->
<!--							<img id="cui_img_vp_send_real" src="imagenes/V-Posts/--><?php //echo $catPostal['nombre'];?><!--/--><?php //echo $postal['imagen'];?><!--" class="cui_banner_image"/>-->
<!--						</div>-->
<!--						<div class="cui_cajon50 cui_padding_50_left cui_padding_20_top" style="text-align:left;">-->
<!--							<span class="cui_padding_20_bottom cui_postales_mensajes">Usted puede personalizar esta postal con la frase o texto que usted desee.</span>-->
<!--							-->
<!--							<div id="personalizar" class="cui_btn_blue">-->
<!--								Personalizar-->
<!--							</div>-->
<!--						</div>-->
<!--                                            <input type="hidden" id="isedit_vp" value="0" />-->
<!--					</div>-->
<!--                                        <div class="cui_row cui_postales_box" style="display: block;">-->
<!--                                            <p id="cui_notif_log" class="cui_postales_notif cui_txt_titulo" style="color: red; padding: 10px 0;"></p>-->
<!--                                            <form id="myFormPost" class="cui_row" action="service/vpost/send.php" method="post" style="position: relative;">-->
<!--                                                <div class="cui_cajon50" style="padding-right: 10px;">-->
<!--                                                    <p class="cui_txt_titulo_session">Para:</p>-->
<!--                                                    <label class="cui_row" style="text-align: left;">Nombre</label>-->
<!--                                                    <input id="pnombre" class="cui_input cui_postales_input" required="required" name="pnombre"/>-->
<!--                                                    <label class="cui_row" style="text-align: left;">Email</label>-->
<!--                                                    <input id="pemail" class="cui_input cui_postales_input" required="required" type="email" name="pemail"/>-->
<!--                                                </div>-->
<!--                                                <div class="cui_cajon50" style="padding-left: 10px;">-->
<!--                                                    <p class="cui_txt_titulo_session">De:</p>-->
<!--                                                    <label class="cui_row" style="text-align: left;">Nombre</label>-->
<!--                                                    <input class="cui_input cui_postales_input" required="required" name="dnombre"/>-->
<!--                                                    <label class="cui_row" style="text-align: left;">Email</label>-->
<!--                                                    <input class="cui_input cui_postales_input" required="required" type="email" name="demail"/>-->
<!--                                                </div>-->
<!---->
<!--                                                <label class="cui_row" style="text-align: left;">Mensaje</label>-->
<!--                                                <textarea class="cui_input cui_postales_height" name="msg"></textarea>-->
<!--                                                <div class="cui_row" style="text-align: center;">-->
<!--                                                    <input class="cui_btn_blue" type="submit" value="Enviar" />-->
<!--                                                </div>-->
<!--                                                <input id="cui_url_send_vp" type="hidden" name="url" value="" />-->
<!--                                            </form>                                            -->
<!--					</div>-->
<!--                                        <div id="cui_load_envio" class="cui_row" style="padding: 100px 0; display: none;">-->
<!--                                            <div id="add_car_shop_load" class="cui_generalload" style="display: block; z-index: 10;">-->
<!--                                                <div class="wrapper" style="text-align: center;">-->
<!--                                                    <div class="cssload-loader" style="margin: 0;"></div>-->
<!--                                                </div>-->
<!--                                             </div>-->
<!--                                            <p class="cui_txt_titulo" style="color:#182535; ">Enviando</p>-->
<!--                                        </div>-->
<!--                                        <div id="cui_notif_envio" class="cui_row" style="padding: 50px 0; display: none;">-->
<!--                                            <p class="cui_txt_titulo" style="display: block;">-->
<!--                                                Su postal ha sido envia correctamente.-->
<!--                                            </p>-->
<!--                                            <div class="cui_btn_blue" style="margin: 20px auto; float: none; display: table;">-->
<!--                                                Enviar esta postal a otro amigo-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--				</div>				-->
<!--			</div>                        -->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->

<script type="text/javascript">
    $(document).ready(function() {

        var cuiPos = new $.cuiPostal({
            id: <?php echo $id; ?>,
            cantXfila: <?php echo $catPostal['cant']; ?>
        }, '');

    });

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>