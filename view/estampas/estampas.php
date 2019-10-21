<?php

$l = $clang->getLang();

$texto=getTexto(2);
$menu=getMenuEstampas();

if($l == 'en')
{
	$texto = getTextoEN(2);
	$menu=getMenuEstampasEN();
}

?>

<div class="d-flex" id="wrapper">

    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <h2 style="text-align: center;color: #777;font-size: 18px;margin: 10px">Temáticas</h2>
            <ul>
                <li>
                    <a href="?f=catestampa-<?php echo $l;?>-0" class="cui_menu_lateral_item">
                        <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                            <img src="images/menuestampas/todas.jpg"/>
                        </div>
                        <div class=" cui_padding_20_bottom" style="font-size:14px;">
                            <span > <?php if($l=='es'){ echo 'Todas';}else{echo 'All';} ?></span>
                        </div>
                    </a>
                </li>
            </ul>
            <?php for($i=0; $i<count($menu); $i++){ ?>
                <ul>
                    <li>
                        <a href="?f=catestampa-<?php echo $l;?>-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
                            <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                                <img src="images/menuestampas/<?php echo $menu[$i]['imagen'];?>"/>
                            </div>
                            <div class=" cui_padding_20_bottom" style="font-size:14px;">
                                <span ><?php echo utf8_decode($menu[$i]['nombre']); ?></span>
                            </div>
                        </a>
                    </li>
                </ul>
            <?php } ?>

        </div>
    </div>

    <div id="page-content-wrapper">
        <div class="container">
            <img src="images/home/<?php echo $texto['imagen'] ?>" class="cui_banner_image"/>
            <div class="cui_texto cui_texto_alg">
                <h1 class="cui_txt_titulo_session cui_txt_light"><?php echo $texto['nombre'] ?></h1>
                <p  class="cui_txt_menu cui_txt_light">
                    <?php echo $texto['descripcion'] ?>
                </p>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<!--            <div class="cui_row">-->
<!--                <div class="cui_w">                    -->
<!--                    <div class="cui_row">-->
<!--                        <nav class="cui_menu_lateral">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                            <a href="?f=catestampa---><?php //echo $l;?><!---0" class="cui_menu_lateral_item">-->
<!--                                <div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--                                    <img src="images/menuestampas/todas.jpg"/>-->
<!--                                </div>-->
<!--                                <div class=" cui_padding_20_bottom" style="font-size:14px;">-->
<!--                                    <span > --><?php //if($l=='es'){ echo 'Todas';}else{echo 'All';} ?><!--</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            --><?php //for($i=0; $i<count($menu); $i++){ ?>
<!--                                <ul>-->
<!--                                    <li>-->
<!--                                    <a href="?f=catestampa---><?php //echo $l;?><!-----><?php //echo $menu[$i]['id'];?><!--" class="cui_menu_lateral_item">-->
<!--                                    <div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--                                        <img src="images/menuestampas/--><?php //echo $menu[$i]['imagen'];?><!--"/>-->
<!--                                    </div>-->
<!--                                    <div class=" cui_padding_20_bottom" style="font-size:14px;">-->
<!--                                        <span >--><?php //echo utf8_decode($menu[$i]['nombre']); ?><!--</span>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                                        </li>-->
<!--                                </ul>-->
<!--                            --><?php //} ?>
<!--                        </nav>-->
<!--                        <div class="cui_contenido">   -->
<!--							<img src="images/home/--><?php //echo $texto['imagen'] ?><!--" class="cui_banner_image"/>-->
<!--							<div class="cui_texto cui_texto_alg">-->
<!--                                <h1 class="cui_txt_titulo_session cui_txt_light">--><?php //echo $texto['nombre'] ?><!--</h1>-->
<!--                                <p  class="cui_txt_menu cui_txt_light">-->
<!--									--><?php //echo $texto['descripcion'] ?>
<!--                                </p>-->
<!--                            </div>-->
<!--                            -->
<!--                        </div>                        -->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->

      