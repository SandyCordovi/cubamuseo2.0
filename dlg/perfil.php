<?php
session_start();

?>

<div class="cui_row">
    <div class="cui_row"  style="background-color: #dedede; padding: 20px; padding-bottom: 0;">
        <div class="" style="background-image: url(images/hombre_perfil.png); background-repeat: no-repeat; background-position: center center; background-size: auto 90px; width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; background-color: #fff; ">
        </div>

        <div class="cui_row">
            <p style="text-align: center; margin: 20px 0; font-size: 2em;"><?php echo $_SESSION['username']; ?></p>
        </div>
        <div class="cui_row">
            <div class="cui_tabs">
                    <div class="cui_tabs_btns">
                            <div href="#perfil_data_general" class="cui_tab_btn cui_tab_btn_activo">Datos Generales</div>
                            <div href="#perfil_foto" class="cui_tab_btn" style="left: 200px;">Foto</div>
                    </div>
                    <div id="perfil_data_general" class="cui_tabs_content tab_cont_activo cui_padding_20 cui_padding_50_bottom">
                        <div class="cui_row">
                            <form id="myFormPerfilDataG" class="cui_row" action="#" method="post" style="position: relative;">
                                <label class="cui_row" style="text-align: left;">Nombre y apellidos</label>
                                <input class="cui_input cui_input_user" name="name" value="<?php echo $_SESSION['name']; ?>" />                                              
                                <label class="cui_row" style="text-align: left;">Email</label>
                                <input class="cui_input cui_input_email" name="email" type="email" value="<?php echo $_SESSION['email']; ?>" />
                                <label class="cui_row" style="text-align: left;">Contraseña</label>
                                <input class="cui_input cui_input_lock" type="password" name="password" />
                                <label class="cui_row" style="text-align: left;">Repetir contraseña</label>
                                <input class="cui_input cui_input_lock" type="password" name="rept_password" />
                                <div class="cui_row" style="text-align: center;">
                                    <input class="cui_btn_flotante" type="submit" value="Cambiar" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="perfil_foto" class="cui_tabs_content cui_padding_20 cui_padding_50_bottom">
                        <div class="cui_row">
                            <img src="user/user.png" height="75px" />
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
            $('.cui_tab_btn').on('click', function(){
                    clickTabs(this);
            })
    });
</script>