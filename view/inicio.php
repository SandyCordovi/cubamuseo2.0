<?php
?>

<script type="text/javascript" src="lib/jquery/timer.js"> </script>
<!--<script type="text/javascript" src="lib/cuiAnime/cui_slice.js"> </script>-->
<script type="text/javascript" src="lib/cuiAnime/cui_scene.js"> </script>
<script type="text/javascript" src="lib/cuiAnime/cui_anime.js"> </script>

<div class="cui_cm_back">
    <h1 class="cui_cm_tit"><?php echo $clang->getHome('tit1'); ?></h1>
    <p class="cui_w cui_cm_text">
       <?php echo $clang->getHome('text1'); ?>
    </p>
</div>
<!--
<div class="cui_row cui_sec1">

    <div class="cui_row">
        <div class="cui_cajon cui_pin11" >
            <a href="colecciones">
                <h2 class="cui_pin11_tit">
                    <?php echo $clang->getHome('tit2'); ?>
                </h2>
            </a>
            <p class="cui_pin11_text">
                <?php echo $clang->getHome('text2'); ?>
            </p>
        </div>
        <div id="pin1" class="cui_cajon cui_pin1">
            <div class="cui_row cui_pin1_img">
                <img id="c1" src="images/colecciones.jpg" width="1900px" height="300px" />
            </div>
        </div>
        
    </div>
    <div id="pin2" class="cui_row cui_pin2">
        <div class="cui_row cui_pin2_back">
             <a href="estampas">
                <h2 class="cui_pin2_tit">
                    <?php echo $clang->getHome('tit3'); ?>
                </h2>
             </a>
            <p class="cui_pin2_text">
                <?php echo $clang->getHome('text3'); ?>
            </p>
        </div>
        <div class="cui_row cui_pin2_img">
            <img id="e1" src="images/estampas.jpg" />
        </div>
    </div>

</div>
-->
<!--
<div class="cui_row cui_sec2">

    <div class="cui_cajon cui_sec3">
        <div class="cui_row cui_pin3_back">
            <div class="cui_row">
                 <a href="postales">
                <h2 class="cui_pin3_tit">
                    <?php echo $clang->getHome('tit4'); ?>
                </h2>
                 </a>
                <p class="cui_pin3_text">
                    <?php echo $clang->getHome('text4'); ?>
                </p>
            </div>
            <div id="pin3" class="cui_row cui_pin3_img">
                <img id="v1" src="images/21.jpg" width="80%"  />
            </div>

        </div>
    </div>

    <div class="cui_cajon cui_sec4">
        <div class="cui_row cui_pin4_back">
            <div class="cui_row">
                <a href="tienda">
                <h2 class="cui_pin4_tit">
                    <?php echo $clang->getHome('tit5'); ?>
                </h2>
                 </a>
                <p class="cui_pin4_text">
                    <?php echo $clang->getHome('text5'); ?>
                </p>
            </div>
            <div id="pin4" class="cui_row cui_pin4_img" style="height: 500px;">
                <img id="t1" src="images/home/tienda.jpg" width="100%"  style="float: left;" />
            </div>

        </div>
    </div>

</div>
-->
<!--
<div class="cui_row cui_sec5">
    <div class="cui_w cui_pin6_back">
         <a href="">
        <h2 class="cui_pin6_tit">
            <?php echo $clang->getHome('tit6'); ?>
        </h2>
         </a>
        <p class="cui_pin6_text">
            <?php echo $clang->getHome('text6'); ?>
        </p>
    </div>
</div>
-->
<script type="text/javascript">

    $(document).ready(function() {

//        var $cuiGal = new $.cuiGalery({
//             intervalo: 7000,
//             height: 300,
//             controles: true
//         },
//         '#cui_mapas');

        var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        var c1 = new $.cuiScene({
            pin: '#pin1',
            offset: h,
            duracion: h,
            from: {x:0},
            to: {x: -1000}
        }, '#c1');

        var e1 = new $.cuiScene({
            pin: '#pin2',
            offset: h,
            duracion: 2*h,
            friccion: 40,
            from: {y:0},
            to: {y: -100}
        }, '#e1');

        var v1 = new $.cuiScene({
            pin: '#pin3',
            offset: h,
            duracion: 2*h,
            from: {y:0},
            to: {y: 150}
        }, '#v1');

        var t1 = new $.cuiScene({
            pin: '#pin4',
            offset: h,
            duracion: 2*h,
            from: {y:0},
            to: {y: 300}
        }, '#t1');

//        var t2 = new $.cuiScene({
//            pin: '#pin5',
//            offset: h,
//            duracion: 2*h,
//            from: {y:0, rotate: 0},
//            to: {y: 150, rotate: -20}
//        }, '#t2');

        var anime = new $.cuiAnime({
            cuiScenes: [c1, e1, v1, t1/*, t2 */]
        });

    });

</script>

