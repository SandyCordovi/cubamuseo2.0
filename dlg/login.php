<?php


?>

<div class="cui_row">
    <div class="cui_row"  style="background-color: #ffffff; padding: 20px; padding-bottom: 0;">
        <div class="" style="background-image: url(images/logosp.png); background-repeat: no-repeat; background-position: center center; background-size: 50px; width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; background-color: #fff; ">
        </div>
        <p id="cui_notif_log" style="margin: 10px 0; text-align: center;"></p>
        <form id="myFormLog" class="cui_row" action="modulos/login.php" method="post" style="position: relative;">
            <label class="cui_row" style="text-align: left;">Nombre de usuario</label>
            <input class="cui_input cui_input_user" name="username" />
            <label class="cui_row" style="text-align: left;">Contraseña</label>
            <input class="cui_input cui_input_lock" type="password" name="password" />
            <input type="checkbox" style="border: none; border-color: #bebebe; margin-right: 10px;" name="recorpass" id="recorpass" /><label for="recorpass">No cerrar la sesi&oacute;n.</label>
            <div class="cui_row" style="text-align: center;">
                <input class="cui_btn_flotante" type="submit" value="Entar" />
            </div>            
        </form>        
    </div>
    <div class="cui_row" style="background-color: #fff; padding: 20px; padding-top: 30px; text-align: right;">
        <a href="#" style="text-align: right; font-size: .8em; display: block; margin: 10px 0;">Ha olvidado su contraseña?</a>
        <a href="#" id="cui_link_register" style="text-align: right; display: block; margin: 10px 0;">Aun no tienes cuenta en CubaMuseo? <span style="color: #ff552a;">Crear una cuenta</span></a>
    </div>    
</div>

<script>

$("#myFormLog").submit(function(e)
{
    e.preventDefault();
    $form = $(this);
    var postData = $form.serializeArray();
    var formURL = $form.attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        dataType: "json",
        async: true,
        success:function(data, textStatus, jqXHR)
        {
            if(data.salida.type==0)
            {
                $('#cui_entrar').text(data.salida.msg);
                $('#cui_entrar').addClass('user_log');
                $('#cui_bag').show();
                cui_wnd._closeTop();
            }
            else
            {
                $('#cui_notif_log').text(data.salida.msg);
            }

        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            
        }
    });
});


$('#cui_link_register').on('click', function(e)
{
    e.preventDefault();
    cui_wnd._closeTop();
    cui_wnd._createWND_tamFijo('dlg/register.php', 30);
})
</script>