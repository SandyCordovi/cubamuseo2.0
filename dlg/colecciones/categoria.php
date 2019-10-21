<?php

session_start();

include '../../configuracion.php';
include '../../tool.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_colecciones.php';
include '../../accesdb/cui_generales.php';
include '../../modulos/lang.php';

$id = $_GET['id'];
$c = $_GET['c'];

if(isset ($_GET['l']) && $_GET['l'])
{
    $l = $_GET['l'];
}
else
    $l = 'es';


$clang = new cuiLang($l);

$seccion = getSeccionCategoria($c);
$categoria = getCategoria($c);
$item = getItem($id);

if($l == 'en')
{
    $categoria = getCategoriaEN($c);
    $item = getItemEN($id);
}
if(isset($_SESSION['username'])){
    $car = getCarByUser($_SESSION['username']);
    $esta_car = EstaCarItem($id, $car['id']);
}else{
    $esta_car = false;
}


?>
<p class="cui_titulo_nav">
    <?php echo utf8_decode($item['nombre']) ?> | <?php echo utf8_decode($item['titulo']) ?>
</p>
<div class="cui_zoom_btn">
    <div class="cui_prev cui_prev_btn">
        <img src="images/cui_prev.png" height="100px" />
    </div>
    <div  class="cui_item_img">
        <img class="cui_img_gal_nav cui_img_ozoom cui_item_img_r" src="service/ri.php?s=<?php echo utf8_decode($seccion['nombre']) ?>&c=<?php echo utf8_decode($categoria['carpeta']); ?>&i=<?php echo utf8_decode($item['imagen']); ?>&p=<?php echo Configuracion::$dimencion_navegacion; ?>" title="Ver imagen ampliada" />
    </div>
    <div class="cui_next cui_next_btn">
         <img src="images/cui_next.png" height="100px" />
    </div>
</div>
<div style="display: block; padding: 20px; background-color: #FFFFFF;">
    <div style="max-width: 550px; margin: 0 auto;">
        <div class="cui_descr_nav" id="show_div" style="text-align: left; font-size: .9em; display: block; ">
            <?php
            $description = $item[descripcion];
            if(strlen($description) > 500): ?>
                <?= $description_cut = utf8_decode(substr($description, 0, 500)) . " ..."; ?>

                <button class="more_text" style=" text-align: left; font-size: .9em; color:#5c84b5; background-color: transparent; border-style: hidden;
                        " onclick=javascript:see_more('hidden_div','show_div') >
                    (Ver más)
                </button>
            <?php endif; ?>

            <?php if(strlen($description) <= 500)
                echo utf8_decode($description);  ?>

        </div>
        <div class="cui_descr_nav" id="hidden_div" style="text-align: left; font-size: .9em; display: none;">
            <?php
            $description = $item[descripcion];
            echo utf8_decode($description);
            ?>
            <button class="more_text"  style="text-align: left; font-size: .9em; color:#5c84b5; background-color: transparent; border-style: hidden;
                        " onclick="javascript:see_more('hidden_div','show_div')" >
                (Ver menos)
            </button>

        </div>
        <?php if((trim($item['emision']) != null) && strlen(trim($item['emision']))>0){?>
        <p style="text-align: left; font-size: .9em; padding-top:5px;">
            <span style="font-weight:bold; font-size: 0.9em; "><?php echo $clang->getWnd('c1'); ?>:</span> <span class="cui_emision_nav" style="font-size: 0.9em; "><?php echo utf8_decode($item['emision']) ?></span>
        </p>
        <?php } ?>
		<?php if((trim($item['color']) != null) && strlen(trim($item['color']))> 0 ){?>		
		<p  style="text-align: left; font-size: .9em; padding-top:5px;">
            <span style="font-weight:bold; font-size: 0.9em; "><?php echo $clang->getWnd('c2'); ?>:</span> <span class="cui_color_nav" style="font-size: 0.9em; "><?php echo utf8_decode($item['color']) ?></span>
        </p>
		<?php } ?>
		<?php if((trim($item['material']) != null) && strlen(trim($item['material']))>0){?>		
		<p style="text-align: left; font-size: .9em; padding-top:5px;">
            <span style="font-weight:bold; font-size: 0.9em; "><?php echo $clang->getWnd('c3'); ?>:</span> <span class="cui_material_nav" style="font-size: 0.9em; "><?php echo utf8_decode($item['material']) ?></span>
        </p>
		<?php } ?>
		<?php if((trim($item['impresion']) != null) && strlen(trim($item['impresion']))>0){?>		
		<p  style="text-align: left; font-size: .9em; padding-top:5px;">
            <span style="font-weight:bold; font-size: 0.9em; "><?php echo $clang->getWnd('c4'); ?>:</span> <span class="cui_impresion_nav" style="font-size: 0.9em; "><?php echo utf8_decode($item['impresion']) ?></span>
        </p>
		<?php } ?>
        <?php if((trim($item['dimension']) != null) && strlen(trim($item['dimension']))>0){?>
		<p style="text-align: left; font-size: .9em; padding-top:5px;">
            <span style="font-weight:bold; font-size: 0.9em; "><?php echo $clang->getWnd('c5'); ?>:</span> <span class="cui_dimension_nav"  style="font-size: 0.9em; "><?php echo utf8_decode($item['dimension']) ?></span>
        </p>
		<?php } ?>
         <?php if($item['precio'] > 0){?>
		<p  style="text-align: center; padding-top:15px;">
                    <span style="font-size: 1.1em; "><?php echo $clang->getWnd('c6'); ?> (<span class="cui_dimension_nav"  style="font-size: 0.9em; "><?php echo utf8_decode($item['dimension']) ?></span> pixels) <?php echo $clang->getWnd('c7'); ?> <b>$<span class="cui_precio_nav" style="font-size: 0.9em; "><?php echo $item['precio']; ?></span></b> </span>
                </p>

                <?php if(IsLogin()) {?>

                    <?php if($esta_car){ ?>
                    <div class="cui_row" style="padding: 10px 10px; background-color: #fff; margin-top: 20px;">
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
                    <div> <span class="cui_padding_20_top cui_padding_20_bottom" style="width:100%; float:left; font-size:13px;"><?php echo $clang->getWnd('l1'); ?> <a id="cui_winlog" class="cui_enlace_login" href="#">(<?php echo $clang->getWnd('l2'); ?>)</a></span></div>
                    <?php } ?>

		<?php } ?>
    </div>
    
</div>
<script type="text/javascript">

    function see_more(div_id,div2_id){
        if(document.getElementById(div_id).style.display=='none'){
            document.getElementById(div_id).style.display='block';
            document.getElementById(div2_id).style.display='none';
        }
        else{
            document.getElementById(div_id).style.display='none';
            document.getElementById(div2_id).style.display='block';
        }
    }

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
