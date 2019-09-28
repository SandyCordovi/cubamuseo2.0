<?php

include 'accesdb/cui_forum.php';

$id = 1;
if(count($param)>1)
{
    $id = $param[1];
}

$item = getItemForum($id);
$coments = getComent($id);

?>

<div class="cui_row">
    <div class="cui_w">
        <div class="cui_row" style="margin-top: 40px;">
            <p class="cui_txt_titulo_sessionBig cui_txt_light"><?php echo utf8_decode($item['titulo']); ?></p>
        </div>
        <img class="cui_row" src="<?php echo utf8_decode($item['img']); ?>" style="margin-bottom: 20px;" />
        <div class="cui_row" style="margin-bottom: 40px;" >
            <div style="float: right; padding: 15px;">
                <img src="images/like.png" width="15px;" /><span style="font-size: 1.5em; margin-left: 5px;"><?php echo utf8_decode($item['likes']); ?></span>
            </div>
            <div style="float: right; padding: 15px;">
                <img src="images/coment.png" width="15px;" /><span style="font-size: 1.5em; margin-left: 5px;"><?php echo utf8_decode($item['comentarios']); ?></span>
            </div>
            <div style="float: right; padding: 15px;">
                <img src="images/view.png" height="15px;" /><span style="font-size: 1.5em; margin-left: 5px;"><?php echo utf8_decode($item['visitas']); ?></span>
            </div>
        </div>

        <div id="comentcont" class="cui_row" style="margin-bottom: 40px;" >

            <?php 
                for($i=0; $i<count($coments); $i++){
                    $user = getUserComent($coments[$i]['user']);
            ?>

            <div class="forum-comentario">
                <div style="width: 100px; float: left;">
                    <img src="user/user.png" />
                </div>
                <div style="margin-left: 100px;">
                    <p style="margin-bottom: 10px;"><strong><?php echo utf8_decode($user['nombre']); ?></strong></p>
                    <p><?php echo utf8_decode($coments[$i]['cometario']); ?></p>
                </div>

            </div>

            <?php } ?>

        </div>

        <?php if(IsLogin ()){ ?>


        <div class="cui_row" style="margin-bottom: 40px;" >
            <form id="myFormComent" class="cui_cajon50" action="service/forum/coment.php" method="post">
                <p class="cui_txt_titulo_session cui_txt_light">Deje su comentario</p>
                <textarea class="cui_textarea" style="height: 300px;" name="coment" ></textarea>
                <input type="hidden" name="u" value="<?php echo $_SESSION['id']; ?>" />
                <input type="hidden" name="t" value="<?php echo $id; ?>" />
                <input type="submit" class="cui_btn_blue" style="float: right;" value="Enviar" />
            </form>
        </div>
        
        <script type="text/javascript">

            $('#myFormComent').on('submit', function(e){
                e.preventDefault();
                var $form = $(this);
                var postData = $form.serializeArray();
                var formURL = $form.attr("action");
                $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    dataType: 'html',
                    success:function(data, textStatus, jqXHR)
                    {
                        $form[0].reset();
                        $('#comentcont').append(data);

                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {

                    }
                });
            });

        </script>

        <?php }else{ ?>

        <div class="cui_row">
            <span style="width:100%; float:left; font-size:18px; font-style:italic; padding: 30px 0;">
                Para poder comentar debe iniciar sesi&oacute;n <a id="cui_winlog" class="cui_enlace_login" href="#">(introducir nombre de usuario y contrase&ntilde;a)</a>
            </span>
        </div>
        <script>

        $('#cui_winlog').on('click', function(e){
            e.preventDefault();
            cui_wnd._closeAll();
            cui_wnd._createWND_tamFijo('dlg/login.php', 30);
        });

        </script>

        <?php } ?>
    </div>
</div>

