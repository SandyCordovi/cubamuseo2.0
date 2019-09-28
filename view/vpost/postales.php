<?php

$l = $clang->getLang();

$texto=getTexto(6);
$menu=getMenuPostales();

if($l == 'en')
{
	$texto=getTextoEN(6);
        $menu=getMenuPostalesEN();
}

?>
<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color: #fff !important;">
        <div class="list-group list-group-flush">
            <?php for($i=0; $i<count($menu); $i++){ ?>
                <ul>
                    <li>
                        <a href="?f=catpostales-<?php echo $l;?>-<?php echo $menu[$i]['id'];?>" class="cui_menu_lateral_item">
                            <div class="cui_row cui_padding_10_bottom cui_padding_20_top">
                                <img src="images/menupostales/<?php echo $menu[$i]['imagen'];?>"/>
                            </div>
                            <div class="cui_padding_20_bottom" style="font-size:14px;">
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
                <div  class="cui_txt_menu cui_txt_light">
                    <?php echo $texto['descripcion'] ?>
                </div>
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

<!--<div class="cui_row">-->
<!--	<div class="cui_w">                    -->
<!--		<div class="cui_row">-->
<!--			<nav class="cui_menu_lateral">-->
<!--                            --><?php //for($i=0; $i<count($menu); $i++){ ?>
<!--                                <ul>-->
<!--                                    <li>-->
<!--					<a href="?f=catpostales---><?php //echo $l;?><!-----><?php //echo $menu[$i]['id'];?><!--" class="cui_menu_lateral_item">-->
<!--						<div class="cui_row cui_padding_10_bottom cui_padding_20_top">-->
<!--							<img src="images/menupostales/--><?php //echo $menu[$i]['imagen'];?><!--"/>-->
<!--						</div>-->
<!--						<div class="cui_padding_20_bottom" style="font-size:14px;">-->
<!--							<span >--><?php //echo utf8_decode($menu[$i]['nombre']); ?><!--</span>-->
<!--						</div>-->
<!--					</a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--				--><?php //} ?>
<!--			</nav>-->
<!--			<div class="cui_contenido">   -->
<!--				<img src="images/home/--><?php //echo $texto['imagen'] ?><!--" class="cui_banner_image"/>-->
<!--				<div class="cui_texto cui_texto_alg">-->
<!--					<h1 class="cui_txt_titulo_session cui_txt_light">--><?php //echo $texto['nombre'] ?><!--</h1>-->
<!--					<div  class="cui_txt_menu cui_txt_light">-->
<!--						--><?php //echo $texto['descripcion'] ?>
<!--					</div>-->
<!--				</div>-->
<!--				-->
<!--			</div>                        -->
<!--		</div>-->
<!--	</div>-->
<!---->
<!--</div>-->