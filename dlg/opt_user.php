<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="cui_row"  style="background-color: #dedede; padding: 20px; padding-bottom: 0;">
    <div class="" style="background-image: url(images/hombre_perfil.png); background-repeat: no-repeat; background-position: center center; background-size: auto 90px; width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; background-color: #fff; ">
    </div>
    <a href="dlg/perfil.php" class="cui_row click_href" style="padding: 20px 0; border-bottom: 1px solid #aeaeae; text-align: center; font-size: 1.2em; cursor: pointer;">
        Perfil
    </a>
    <a href="dlg/cart.php" class="cui_row click_href" style="padding: 20px 0; border-bottom: 1px solid #aeaeae; text-align: center; font-size: 1.2em; cursor: pointer;">
        Mi carrito de compras
    </a>
    <a href="dlg/compras.php" class="cui_row click_href" style="padding: 20px 0; border-bottom: 1px solid #aeaeae; text-align: center; font-size: 1.2em; cursor: pointer;">
        Mis compras
    </a>
    <a href="modulos/logout.php" class="cui_row" style="padding: 20px 0; border-bottom: 1px solid #aeaeae; text-align: center; font-size: 1.2em; cursor: pointer;">
        Salir
    </a>
</div>

<script type="text/javascript">

$('a.click_href').on('click', function(e){
    e.preventDefault();
    var temp = $(this);
    cui_wnd._createWND_tamFijo(temp.attr('href'), 50);
})

</script>
