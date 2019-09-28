<?php


?>

<div class="cui_row">
    <div class="cui_row"  style="background-color: #dedede; padding: 20px; padding-bottom: 0;">
        <div class="" style="background-image: url(images/logosp.png); background-repeat: no-repeat; background-position: center center; background-size: 50px; width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; background-color: #fff; ">
        </div>
        <p id="cui_notif_reg" style="margin: 10px 0; text-align: center;"></p>
        <form id="myFormReg" class="cui_row" action="modulos/register.php" method="post" style="position: relative;">
            <label class="cui_row" style="text-align: left;">Nombre y apellidos</label>
            <input class="cui_input cui_input_user" name="name" />
            <label class="cui_row" style="text-align: left;">Nombre de usuario</label>
            <input class="cui_input cui_input_user" name="username" />
            <label class="cui_row" style="text-align: left;">Contraseña</label>
            <input class="cui_input cui_input_lock" type="password" name="password" />
            <label class="cui_row" style="text-align: left;">Email</label>
            <input class="cui_input cui_input_email" name="email" type="email" />
            <div class="cui_row" style="text-align: center;">
                <input class="cui_btn_flotante" type="submit" value="Crear cuenta" />
            </div>
        </form>
    </div>
    <div class="cui_row" style="background-color: #fff; padding: 20px; padding-top: 50px; text-align: center;">
        <p style=" font-size: 1.5em;">Crear una cuenta en CubaMuseo es gratis.</p>
    </div>
</div>

<script>

$("#myFormReg").submit(function(e)
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
                $('#cui_notif_reg').text(data.salida.msg);
            }

        },
        error: function(jqXHR, textStatus, errorThrown)
        {

        }
    });
});

</script>