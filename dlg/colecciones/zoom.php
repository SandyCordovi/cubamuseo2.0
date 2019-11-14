<?php
session_start();

include '../../configuracion.php';
include '../../tool.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_colecciones.php';
include '../../accesdb/cui_generales.php';
include '../../modulos/lang.php';



if(isset ($_GET['l']) && $_GET['l'])
{
    $l = $_GET['l'];
}
else
    $l = 'es';

$clang = new cuiLang($l);

$id = $_GET['id'];
$c = $_GET['c'];

$seccion = getSeccionCategoria($c);
$categoria = getCategoria($c);
$item = getItem($id);

if($l == 'en')
{
    $categoria = getCategoriaEN($c);
    $item = getItemEN($id);
}


?>
<p class="cui_titulo_nav" style="margin-bottom: 10px;font-weight: bold;color: #0b0b0b;">
    <?php echo utf8_decode($item['nombre']) ?> | <?php echo utf8_decode($item['titulo']) ?>
</p>
<div>
    <div  class="cui_div_zoom" style="max-width: 100%; margin: 40px;">
        <img class="cui_img_gal_nav cui_img_zoom" src="service/ri.php?s=<?php echo utf8_decode($seccion['nombre']) ?>&c=<?php echo utf8_decode($categoria['carpeta']); ?>&i=<?php echo utf8_decode($item['imagen']); ?>&p=0" />
    </div>
    <div style="padding-left: 20%;padding-right: 20%; ">
        <div class="cui_prev" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;float: left; margin-bottom: 15px;">
            <img src="images/cui_prev.png" height="40px" />
        </div>

        <div class="cui_next" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;float: right; margin-bottom: 15px;">
            <img src="images/cui_next.png" height="40px" />
        </div>
    </div>
</div>

<div style="display: block; padding: 20px; background-color: #ffffff;">
    <div style="max-width:600px; margin: 0 auto; ">        
        <?php if($item['precio'] > 0){?>
		<p  style="text-align: center; padding-top:15px;">
                    <span style="font-style:italic; font-size: 1.1em; "><?php echo $clang->getWnd('c6'); ?> (<?php echo utf8_decode($item['dimension']) ?> pixels) <?php echo $clang->getWnd('c7'); ?> <span class="cui_precio_nav" style="font-size: 0.9em; "><b>$<?php echo $item['precio']; ?></b></span> </span>
                </p>

                <?php if(IsLogin()) {?>

                    <?php if($esta_car){ ?>
                    <div class="cui_row" style="padding: 10px 10px; background-color: #dcdcdc; margin-top: 10px;">
                        <p style="text-align: center; font-size: 1.2em;"><?php echo $clang->getWnd('b1'); ?></p>
                        <div class="cui_row" style="padding-top: 10px; text-align: center;">
                            <div class="cui_btn_blue view_car" style="padding: 5px 10px; float: none; overflow: hidden; display: inline;">
                                 <?php echo $clang->getWnd('b2'); ?>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                        <div id="add_car_shop" class="cui_btn_blue" style="float:right;">
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
                    <div> <span class="cui_padding_20_top cui_padding_20_bottom" style="width:100%; float:left; font-size:13px; font-style:italic;">Para poder comprar este item debe iniciar sesi&oacute;n <a id="cui_winlog" class="cui_enlace_login" href="#">(introducir nombre de usuario y contrase&ntilde;a)</a></span></div>
                    <?php } ?>

		<?php } ?>
    </div>
    
</div>
<script type="text/javascript">           
	$('#cui_winlog').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('user_log'))
			cui_wnd._createWND_tamFijo('dlg/opt_user.php', 30);
		else
			cui_wnd._createWND_tamFijo('dlg/login.php', 30);
	});
        $('.view_car').on('click', function(e){
		e.preventDefault();
		cui_wnd._createWND_tamFijo('dlg/cart.php', 50);
	});

    $('#add_car_shop').on('click', function(){
	    $(this).hide();
	    $('#add_car_shop_load').show();

	    $.ajax({
			type: "POST",
			data: 'cmd=3&item=<?php echo $item['id']; ?>',
			url: 'service/cart.php',
			async: true,
			dataType: "html"
		 }).done(function (data){
			try {
				$('.cui_car_notif').html(data);
				$('#add_car_shop_load').hide();
				$('.cui_car_notif').show();
				$('.view_car').on('click', function(e){
					e.preventDefault();
					cui_wnd._createWND_tamFijo('dlg/cart.php', 50);
				});
			} catch (e) {

			}
		})
	});
</script>
