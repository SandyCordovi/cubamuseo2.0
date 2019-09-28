<?php
session_start();

include '../configuracion.php';
include '../tool.php';
include 'model/model.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

        <title>Administraci&oacute;n</title>
        
        <link href="../style/style.css" rel="stylesheet" type="text/css" />
        <link href="style/cui_style.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="../lib/jquery/jquery-1.10.2.js" ></script>
        <script type="text/javascript" src="../lib/jquery/jquery.form.min.js" ></script>
         <script type="text/javascript" src="../lib/cui_wnd.js"> </script>
        <script type="text/javascript" src="script/cui_js.js" ></script>

        <style type="text/css">
            span:hover{
                border-bottom: none;
            }
        </style>

    </head>

    <body>

         <?php if(!IsLoginAdmin ()){ ?>
        <div class="cui_row" style="margin-top: 20px;">
            <div class="cui_w">
                <div style="padding: 1px; background-color: #dfdfdf; width: 50%; margin: 0 auto; overflow: hidden; border-radius: 5px; padding: 50px;">
                    <div class="cui_cart_logo" style="background-image: url(../images/logosp.png); ">
                    </div>
                    <div class="cui_row" style="background-color: #dfdfdf; padding: 20px; padding-top: 50px; overflow: hidden;">
                        <form class="cui_row" action="controller/login.php" method="post">
                            <input class="form" type="email" required="required" name="email" placeholder="Nombre de usuario" />

                            <input class="form" type="password" required="required"  name="pass" placeholder="Conrase&ntilde;a" />

                            <div class="cui_row">
                                <!-- Send Button -->
                                <button type="submit" id="submit" name="submit" class="form-btn">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } else {
             include 'template.php';
            } ?>

    </body>
</html>