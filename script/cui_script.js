function clickTabs(o){
    $('.cui_tab_btn').removeClass('cui_tab_btn_activo');
    o = $(o).addClass('cui_tab_btn_activo');
    $('.cui_tabs_content').removeClass('tab_cont_activo');
    $(o.attr('href')).addClass('tab_cont_activo');
}

function DeleteItemShopCart(item, car)
{
    $.ajax({
        type: "POST",
        data: 'cmd=2&item='+item+'&car='+car,
        url: 'service/cart.php',
        async: true,
        dataType: "json"
     }).done(function (data){
        try {
            precio_temp = $('#cui_cart_item_precio_'+item).text();
            
            $('#cui_cart_shop_'+item).hide(300, function(){
                $(this).remove();
                if($('.cui_cart_shop_item').length==0){
                    $('.cui_cart_shop_items').append('<p style="padding: 40px 0;" >No items</p>');
                    total = $('#cui_cart_total').text();
                    nuevo_total = parseFloat(total) - parseFloat(precio_temp);
                    $('#cui_cart_tienda_subtotal').text("0");
                    if(nuevo_total > 0)
                    {
                        $('#cui_cart_total').text(nuevo_total);
                    }
                    else
                    {
                        $('#cui_cart_total').text("0");
                    }
                }
                else
                    {
                        subtotal = $('#cui_cart_tienda_subtotal').text();
                        nuevo_sub = parseFloat(subtotal) - parseFloat(precio_temp);
                        total = $('#cui_cart_total').text();
                        nuevo_total = parseFloat(total) - parseFloat(precio_temp);
                        $('#cui_cart_tienda_subtotal').text(nuevo_sub);
                        $('#cui_cart_total').text(nuevo_total);
                    }
            });
        } catch (e) {

        }
     })
}

function DeleteImageShopCart(item, car)
{
    $.ajax({
        type: "POST",
        data: 'cmd=4&item='+item+'&car='+car,
        url: 'service/cart.php',
        async: true,
        dataType: "json"
     }).done(function (data){
        try {
            precio_temp = $('#cui_cart_imagen_precio_'+item).text();
            $('#cui_cart_shop_img_'+item).hide(300, function(){
                $(this).remove();
                if($('.cui_cart_shop_image').length==0){
                    $('.cui_cart_shop_images').append('<p style="padding: 40px 0;" >No items</p>');
                    total = $('#cui_cart_total').text();
                    nuevo_total = parseInt(total) - parseInt(precio_temp);
                    $('#cui_cart_imagen_subtotal').text("0");
                    if(nuevo_total > 0)
                    {
                        $('#cui_cart_total').text(nuevo_total);
                    }
                    else
                    {
                        $('#cui_cart_total').text("0");
                    }
                }
                else
                    {
                        subtotal = $('#cui_cart_imagen_subtotal').text();
                        nuevo_sub = parseInt(subtotal) - parseInt(precio_temp);
                        total = $('#cui_cart_total').text();
                        nuevo_total = parseInt(total) - parseInt(precio_temp);
                        $('#cui_cart_imagen_subtotal').text(nuevo_sub);
                        $('#cui_cart_total').text(nuevo_total);
                    }
            });
        } catch (e) {

        }
     })
}

function OpenMenuLateral()
{
    $('html, body').css('overflow', 'hidden');
    $('nav.cui_menu').show();
}
function CloseMenuLateral()
{
    $('html, body').css('overflow', 'auto');
    $('nav.cui_menu').hide();
}

function OpenMenuLateralIzq()
{
    $('html, body').css('overflow', 'hidden');
    $('nav.cui_menu_lateral').show();
}
function CloseMenuLateralIzq()
{
    $('html, body').css('overflow', 'auto');
    $('nav.cui_menu_lateral').hide();
}




