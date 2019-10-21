<?php

?>

<div class="cui_row">
    <div class="cui_row"  style="background-color: #ffffff; padding: 20px; padding-bottom: 40px;">
        <div class="" style="background-image: url(images/vendedor.png); background-repeat: no-repeat; background-position: center center; background-size: 70px; width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; background-color: #fff; ">
        </div>
        <p id="cui_notif_log" style="margin: 10px 0; text-align: center;"></p>
        <form id="myFormContact" class="cui_row" action="" method="post" style="position: relative;">
            <label class="cui_row" style="text-align: left;">Nombre</label>
            <input class="cui_input cui_input_user" name="nombre" />
            <label class="cui_row" style="text-align: left;">Email</label>
            <input class="cui_input cui_input_email" name="email" />
            <label class="cui_row" style="text-align: left;">Mensaje</label>
            <textarea class="cui_input" style="height:150px;" name="mensaje"></textarea>
            <div class="cui_row" style="text-align: center;">
                <input class="cui_btn_flotante" type="submit" value="Enviar Mensaje" />
            </div>            
        </form>        
    </div>  
</div>