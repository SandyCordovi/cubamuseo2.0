<?php

include 'accesdb/cui_colecciones.php';

$id = 1;
if(count($param)==2)
{
    $id = $param[1];
}
else if(count($param)==3)
{
    $id = $param[2];
}

$l = $clang->getLang();

$seccion = getSeccion($id);
$galeria = getGaleriaSeccion($id);
$menu=getMenuColecciones();

$galeriaXX = '';
$galeriaXIX = '';

if($seccion['carpeta']=='Biblioteca Virtual')
{
    $galeriaXX = getGaleriaSeccionXX($id);
    $galeriaXIX = getGaleriaSeccionXIX($id);
}

if($l == 'en')
{
	$seccion = getSeccionEN($id);
	$galeria = getGaleriaSeccionEN($id);
	$menu=getMenuColeccionesEN();
}


?>

<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <h2 style="text-align: center;color: #777;font-size: 18px; margin: 20px">Temáticas</h2>
            <?php for($i=0; $i<count($menu); $i++){ ?>
                <ul>
                    <li>
                        <a href="?f=seccion-<?php echo $l;?>-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
                            <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                                <img src="images/menu/<?php echo $menu[$i]['imagen'];?>"/>
                            </div>
                            <div class="cui_padding_20_bottom" style="font-size:14px;">
                                <span <?php echo $id==$menu[$i]['id'] ? 'class="cui_menu_activo"' : ''; ?>><?php echo utf8_decode($menu[$i]['nombre']); ?></span>
                            </div>
                        </a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
    <div id="page-content-wrapper">
        <div class="container">
            <img src="imagenes/<?php echo utf8_decode($seccion['carpeta']); ?>/<?php echo utf8_decode($seccion['imagen']); ?>" class="cui_banner_image"/>
            <div class="cui_texto">
                <h1 class="cui_txt_titulo_session cui_txt_light"><?php echo utf8_decode($seccion['titulo']); ?></h1>
                <div class="cui_tabs">
                    <div class="cui_tabs_btns">
                        <div href="#descripcion" class="cui_tab_btn cui_tab_btn_activo"><?php echo $clang->getGaleria('tab1'); ?></div>
                        <div href="#galeria" class="cui_tab_btn cui_tab_gal" ><?php echo $clang->getGaleria('tab2'); ?></div>
                    </div>
                    <div id="descripcion" class="cui_tabs_content tab_cont_activo cui_padding_20 cui_padding_50_bottom">
                        <div class="cui_txt_des cui_txt_light">
                            <?php echo utf8_decode($seccion['descripcion']); ?>
                        </div>
                    </div>
                    <div id="galeria" class="cui_tabs_content cui_padding_20 cui_padding_50_bottom">

                        <div class="cui_cont_galeria">
                            <?php if($seccion['carpeta']=='Biblioteca Virtual')
                            {
                                ?>
                                <div style="padding:10px; padding-top: 0px;"> <div class="cui_siglo"> <h2>Siglo XIX</h2></div></div>
                                <?php
                                for($i=0; $i<count($galeriaXIX); $i++){ ?>
                                    <div class="cui_gal_item" >
                                        <div class="vtn_info_item">
                                            <h2><?php echo $galeriaXIX[$i]['titulo']; ?></h2>
                                            <!--<p><a href="categoria-<?php echo $l; ?>-<?php echo $galeriaXIX[$i]['id']; ?>" >
                                                                        <?php echo $clang->getGaleria('sm1'); ?>

                                                                    </a></p>-->
                                        </div>
                                        <a href="?f=categoria-<?php echo $l; ?>-<?php echo $galeriaXIX[$i]['id']; ?>" >
                                            <img class="cui_gal_image" width="100%" src="imagenes/<?php echo utf8_decode($seccion['carpeta']); ?>/<?php echo utf8_decode($galeriaXIX[$i]['carpeta']); ?>/<?php echo utf8_decode($galeriaXIX[$i]['imagen']); ?>" />
                                            <h3 class="cui_gal_text"><?php echo utf8_decode($galeriaXIX[$i]['nombre']); ?></h3>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div style="padding:10px; padding-top: 0px;"> <div class="cui_siglo"> <h2>Siglo XX</h2></div></div>
                                <?php
                                for($i=0; $i<count($galeriaXX); $i++){ ?>
                                    <div class="cui_gal_item" >
                                        <div class="vtn_info_item">
                                            <h2><?php echo $galeriaXX[$i]['titulo']; ?></h2>
                                            <!--<p><a href="categoria-<?php echo $l; ?>-<?php echo $galeriaXX[$i]['id']; ?>" >
                                                                        <?php echo $clang->getGaleria('sm1'); ?>

                                                                    </a></p>-->
                                        </div>
                                        <a href="?f=categoria-<?php echo $l; ?>-<?php echo $galeriaXX[$i]['id']; ?>" >
                                            <img class="cui_gal_image" width="100%" src="imagenes/<?php echo utf8_decode($seccion['carpeta']); ?>/<?php echo utf8_decode($galeriaXX[$i]['carpeta']); ?>/<?php echo utf8_decode($galeriaXX[$i]['imagen']); ?>" />
                                            <h3 class="cui_gal_text"><?php echo utf8_decode($galeriaXX[$i]['nombre']); ?></h3>
                                        </a>
                                    </div>
                                <?php  }}
                            else {

                                for($i=0; $i<count($galeria); $i++){ ?>
                                    <div class="cui_gal_item" >
                                        <div class="vtn_info_item">
                                            <h2><?php echo $galeria[$i]['titulo']; ?></h2>
                                            <!--<p><a href="categoria-<?php echo $l; ?>-<?php echo $galeria[$i]['id']; ?>" >
                                                                        <?php echo $clang->getGaleria('sm1'); ?>

                                                                    </a></p>-->
                                        </div>
                                        <a href="?f=categoria-<?php echo $l; ?>-<?php echo $galeria[$i]['id']; ?>" >
                                            <img class="cui_gal_image" width="100%" src="imagenes/<?php echo utf8_decode($seccion['carpeta']); ?>/<?php echo utf8_decode($galeria[$i]['carpeta']); ?>/<?php echo utf8_decode($galeria[$i]['imagen']); ?>" />
                                            <h3 class="cui_gal_text"><?php echo utf8_decode($galeria[$i]['nombre']); ?></h3>
                                        </a>
                                    </div>
                                <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



        
	<script>
	$(document).ready(function() {		
		$('.cui_tab_btn').on('click', function(){
			clickTabs(this);
		});

//                $('a.cui_gal_item').on('mouseover', function(){
//
//                    $('a.cui_gal_item').on('mousemove', function(e){
//                        var temp = $('.vtn_info_item');
//                        temp.css('left', e.pageX);
//                        temp.css('top', e.pageY);
//                    });
//
//                });
	});

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	</script>
</div>
