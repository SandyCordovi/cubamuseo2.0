<?php
include 'accesdb/cui_forum.php';

$id = 1;
if(count($param)>1)
{
    $id = $param[1];
}

$item = getAllTema($id);
$tema = getAllTematicaById($id);

?>

<script type="text/javascript" src="script/forum/forum.js"> </script>
<div class="cui_row">
    <div class="cui_w">
        <div class="cui_row" style="margin-top: 40px;">
            <p class="cui_txt_titulo_sessionBig cui_txt_light"><?php echo utf8_decode($tema['titulo']); ?></p>
        </div>
        <div class="cui_cajon33" style="padding: 20px;">

            <div class="btn_newpost">
                Nuevo Tema
            </div>

            <?php for($i=0; $i<count($item); $i+=3){ ?>
            <a href="?f=forumitem-<?php echo utf8_decode($item[$i]['id']); ?>" class="cui_forum">
                <img class="img" src="<?php echo utf8_decode($item[$i]['img']); ?>"/>
                <p class="titulo"><?php echo utf8_decode($item[$i]['titulo']); ?></p>
                <div class="pie">
                    <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/like.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['likes']); ?></span>
                    </div>
                   <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/coment.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['comentarios']); ?></span>
                    </div>
                    <div class="cui_cajon33" style="padding: 5px;">
                        <img src="images/view.png" height="15px;" /><span><?php echo utf8_decode($item[$i]['visitas']); ?></span>
                    </div>
                </div>
            </a>
             <?php } ?>
        </div>
        <div class="cui_cajon33" style="padding: 20px;">

            <?php for($i=1; $i<count($item); $i+=3){ ?>
            <a href="?f=forumitem-<?php echo utf8_decode($item[$i]['id']); ?>" class="cui_forum">
                <img class="img" src="<?php echo utf8_decode($item[$i]['img']); ?>"/>
                <p class="titulo"><?php echo utf8_decode($item[$i]['titulo']); ?></p>
                <div class="pie">
                    <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/like.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['likes']); ?></span>
                    </div>
                   <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/coment.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['comentarios']); ?></span>
                    </div>
                    <div class="cui_cajon33" style="padding: 5px;">
                        <img src="images/view.png" height="15px;" /><span><?php echo utf8_decode($item[$i]['visitas']); ?></span>
                    </div>
                </div>
            </a>
             <?php } ?>
             
        </div>
        <div class="cui_cajon33" style="padding: 20px;">

            <?php for($i=2; $i<count($item); $i+=3){ ?>
            <a href="?f=forumitem-<?php echo utf8_decode($item[$i]['id']); ?>" class="cui_forum">
                <img class="img" src="<?php echo utf8_decode($item[$i]['img']); ?>"/>
                <p class="titulo"><?php echo utf8_decode($item[$i]['titulo']); ?></p>
                <div class="pie">
                    <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/like.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['likes']); ?></span>
                    </div>
                   <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/coment.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['comentarios']); ?></span>
                    </div>
                    <div class="cui_cajon33" style="padding: 5px;">
                        <img src="images/view.png" height="15px;" /><span><?php echo utf8_decode($item[$i]['visitas']); ?></span>
                    </div>
                </div>
            </a>
             <?php } ?>

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    

    var cuiForum = new $.cuiForum({
        tematica : <?php echo $id; ?>
    }, '.cui_smart_search');

});
</script>