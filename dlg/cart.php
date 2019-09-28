<?php

session_start();

include '../configuracion.php';
include '../accesdb/model.php';
include '../accesdb/cui_generales.php';

$car  = getCarByUser($_SESSION['username']);
$img = getImagenesByCarrito($car['id']);
$shop = getItemsTiendaByCarrito($car['id']);

$subt_img = 0;
$subt_shop = 0;

?>

<div class="cui_row">
    <div class="cui_row cui_cart_bg" style="padding-bottom:20px;">
        <div class="cui_cart_logo">
        </div>        
        <div class="cui_cart_seccion">
            <!--input type="checkbox" class="cui_cart_check" name="imagenes" id="imagenes" <?php echo $car['imagenes'] ? 'checked' : '' ?> /-->
            <label class="cui_cart_tit">Imagenes </label>
            <!--label class="cui_cart_ad">(Utilice esta marca para incluir o excluir esta secci&oacute;n de su compra)</label-->
        </div> 
            <div class="cui_cart_items cui_cart_shop_images">
                <?php if(count($img)==0){ ?>
                <p style="padding: 40px 0;" >No items</p>
                <?php
                    }else{
                        for($i=0; $i<count($img); $i++){
                        $subt_img += $img[$i]['precio'];
                ?>
                <div id="cui_cart_shop_img_<?php echo $img[$i]['item']; ?>" class="cui_cart_fila cui_cart_shop_image">
                    <img class="cui_cart_image" src="service/ri.php?s=<?php echo utf8_decode($img[$i]['seccion']); ?>&c=<?php echo utf8_decode($img[$i]['categoria']); ?>&i=<?php echo utf8_decode($img[$i]['imagen']); ?>&p=120" />
                    <h3 class="cui_cart_text"><?php echo utf8_decode($img[$i]['titulo']); ?></h3>
                    <img class="cui_cart_trash" src="images/trash.png" title="Quitar elemento del carrito" onclick="DeleteImageShopCart(<?php echo $img[$i]['item']; ?>, <?php echo $car['id']; ?>);"/>
                    <span id="cui_cart_imagen_precio_<?php echo $img[$i]['item']; ?>" class="cui_cart_precio"><?php echo $img[$i]['precio']; ?></span><span class="cui_cart_precio">$</span>
                </div>
                <?php }} ?>

            </div>
        <div class="cui_cart_subtotal">
            <span class="cui_gal_text cui_cart_subtotal_text" id="cui_cart_imagen_subtotal"><?php echo $subt_img; ?></span>  <span class="cui_gal_text cui_cart_subtotal_text">Subtotal: $</span>
        </div>


        
        <div class="cui_cart_seccion">
            <!--input type="checkbox" class="cui_cart_check" name="items" id="items" <?php echo $car['tienda'] ? 'checked' : '' ?> /-->
            <label class="cui_cart_tit">Items </label>
            <!--label class="cui_cart_ad">(Utilice esta marca para incluir o excluir esta secci&oacute;n de su compra)</label-->
        </div> 
        <div class="cui_cart_items cui_cart_shop_items">
            <?php if(count($shop)==0){ ?>
                <p style="padding: 40px 0;" >No items</p>
            <?php
                }else{
                    for($i=0; $i<count($shop); $i++){
                    $subt_shop += $shop[$i]['precio'];
            ?>
                <div id="cui_cart_shop_<?php echo $shop[$i]['item']; ?>" class="cui_cart_fila cui_cart_shop_item">
                        <img class="cui_cart_image" src="service/ri.php?s=Tienda&c=<?php echo $shop[$i]['tematica']; ?>&i=<?php echo $shop[$i]['imagen']; ?>&p=120" />
                        <h3 class="cui_cart_text"><?php echo $shop[$i]['titulo']; ?></h3>
                        <img class="cui_cart_trash" src="images/trash.png" title="Quitar elemento del carrito" onclick="DeleteItemShopCart(<?php echo $shop[$i]['item']; ?>, <?php echo $car['id']; ?>);" />
                        <span id="cui_cart_item_precio_<?php echo $shop[$i]['item']; ?>" class="cui_cart_precio"><?php echo $shop[$i]['precio']; ?></span><span class="cui_cart_precio">$</span>
                    </div>
            <?php }} ?>
            
        </div>
        <div class="cui_cart_subtotal">
            <span class="cui_gal_text cui_cart_subtotal_text" id="cui_cart_tienda_subtotal"> <?php echo $subt_shop; ?></span> <span class="cui_gal_text cui_cart_subtotal_text">Subtotal: $</span>
         </div>
        <div class="cui_cart_total">
            <span id="cui_cart_total" class="cui_cart_total_text"><?php echo ($subt_img+$subt_shop); ?></span><span class="cui_cart_total_text">Total: $</span>
        </div> 
            <div class="cui_cart_cond">
                <span class="cui_gal_text" style="font-size:15px;">Antes de proseguir con la compra debe aceptar las <a href="" class="cui_cart_enlace">Condiciones de compra del sitio</a></span>
            </div>
        <div class="cui_cart_btn">
            <form style="padding:30px 0;" action="/your-server-side-code" method="POST">
			  <script
				src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				data-key="pk_test_RRhA4fUaQLdXzE5KpGAYDrvn"
				data-amount="<?php echo ($subt_img+$subt_shop)*100; ?>"
				data-name="Cuba Museo"
				data-description="Compra"
				data-image="http://cubamuseo.net/images/logocm.png"
				data-locale="auto"
				data-currency="usd"
				data-panel-label = "Pagar {{amount}}"
				data-allow-remember-me = "false"
				data-label="Acepto las Condiciones de Compra">
			  </script>
			</form>
        </div>

        
    </div> 
</div>

