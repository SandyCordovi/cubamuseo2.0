<?php
include 'accesdb/cui_forum.php';

$item = getAllTematicas();

?>

<div class="cui_row">
    <div class="cui_w">
        <div class="cui_row" style="margin-top: 40px;">
            <p class="cui_txt_titulo_sessionBig cui_txt_light">TEMATICAS</p>
        </div>
        <div class="cui_cajon33" style="padding: 20px;">

            <?php for($i=0; $i<count($item); $i+=3){ ?>
            <a href="?f=forumtematica-<?php echo utf8_decode($item[$i]['id']); ?>" class="cui_forum">
                <img class="img" src="<?php echo utf8_decode($item[$i]['img']); ?>"/>
                <p class="titulo"><?php echo utf8_decode($item[$i]['titulo']); ?></p>
                <div class="pie">
                    <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/like.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['likes']); ?></span>
                    </div>
                   <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff; vertical-align: middle;">
                       <img src="images/view.png" height="15px;" /><span><?php echo utf8_decode($item[$i]['tematica']); ?></span>
                    </div>
                    <div class="cui_cajon33" style="padding: 5px;">
                        <img src="images/circle1.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['visitas']); ?></span>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
        <div class="cui_cajon33" style="padding: 20px;">
             <?php for($i=1; $i<count($item); $i+=3){ ?>
            <a href="?f=forumtematica-<?php echo utf8_decode($item[$i]['id']); ?>" class="cui_forum">
                <img class="img" src="<?php echo utf8_decode($item[$i]['img']); ?>"/>
                <p class="titulo"><?php echo utf8_decode($item[$i]['titulo']); ?></p>
                <div class="pie">
                    <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/like.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['likes']); ?></span>
                    </div>
                   <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff; vertical-align: middle;">
                       <img src="images/view.png" height="15px;" /><span><?php echo utf8_decode($item[$i]['tematica']); ?></span>
                    </div>
                    <div class="cui_cajon33" style="padding: 5px;">
                        <img src="images/circle1.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['visitas']); ?></span>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
        <div class="cui_cajon33" style="padding: 20px;">
             <?php for($i=2; $i<count($item); $i+=3){ ?>
            <a href="?f=forumtematica-<?php echo utf8_decode($item[$i]['id']); ?>" class="cui_forum">
                <img class="img" src="<?php echo utf8_decode($item[$i]['img']); ?>"/>
                <p class="titulo"><?php echo utf8_decode($item[$i]['titulo']); ?></p>
                <div class="pie">
                   <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff;">
                        <img src="images/like.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['likes']); ?></span>
                    </div>
                   <div class="cui_cajon33" style="padding: 5px; border-right: 1px solid #fff; vertical-align: middle;">
                       <img src="images/view.png" height="15px;" /><span><?php echo utf8_decode($item[$i]['tematica']); ?></span>
                    </div>
                    <div class="cui_cajon33" style="padding: 5px;">
                        <img src="images/circle1.png" width="15px;" /><span><?php echo utf8_decode($item[$i]['visitas']); ?></span>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
    </div>
</div>