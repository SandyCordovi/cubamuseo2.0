<?php

?>

<div class="cui_row">
    <div class="cui_row"  style="background-color: #FFFFFF; padding: 20px; padding-bottom: 40px;">
        <div class="" style="background-image: url(images/logocm.png); background-repeat: no-repeat; background-position: center center; background-size: 100%; width: 50%; height: 150px; margin: 0 auto; background-color: #fff; ">
        </div>
        <p id="cui_notif_log" style="margin: 10px 0; text-align: center;"></p>
        <form id="myFormContact" class="cui_row" action="service/contacto.php" method="post" style="position: relative;">
            <label class="cui_row" style="text-align: left;">Nombre</label>
            <input class="cui_input cui_input_user" name="nombre" />
            <label class="cui_row" style="text-align: left;">Correo</label>
            <input class="cui_input cui_input_email" name="email" />
            <label class="cui_row" style="text-align: left;">Mensaje</label>
            <textarea class="cui_input" style="height:150px;" name="mensaje"></textarea>
            <div class="cui_row" style="text-align: center;">
                <input class="cui_btn_blue" type="submit" value="Enviar Mensaje" />
            </div>            
        </form>        
    </div>  
</div>

<script>

$("#myFormContact").submit(function(e)
{
    e.preventDefault();
    $form = $(this);
    var postData = $form.serializeArray();
    var formURL = $form.attr("action");
    console.log(formURL);
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        dataType: "json",
        async: true,
        success:function(data, textStatus, jqXHR)
        {
            cui_wnd._closeTop();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            
        }
    });
});
</script>