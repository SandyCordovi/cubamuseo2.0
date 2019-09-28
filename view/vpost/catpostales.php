<?php

include 'accesdb/cui_postales.php';

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

$catPostal = getCategoriaPostal($id);
$menu=getMenuPostales();

if($l == 'en')
{
	$catPostal = getCategoriaPostalEN($id);
    $menu=getMenuPostalesEN();
}



?>

<script type="text/javascript" src="script/vpost/postales.js"> </script>

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
            <h1 class="cui_txt_titulo_session cui_txt_light cui_padding_20_top"><?php echo utf8_decode($catPostal['titulo']); ?></h1>
            <div class="cui_tabs cui_padding_50_bottom">
                <div id="galeria" class=" cui_padding_20 cui_padding_50_bottom">
                    <div id="cui_cont_galeria" class="cui_cont_galeria">
                        <div class="cui_row son">
                            <div class="cui_generalload" style="padding: 20px 0;">
                                <div class="wrapper">
                                    <div class="cssload-loader"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--<div class="cui_row">-->
<!--	<div class="cui_w">-->
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
<!--			<div class="cui_contenido">-->
<!--				<div class="cui_texto">-->
<!--                            <h1 class="cui_txt_titulo_session cui_txt_light cui_padding_20_top">--><?php //echo utf8_decode($catPostal['titulo']); ?><!--</h1>-->
<!--                            <div class="cui_tabs cui_padding_50_bottom">-->
<!--                            <div id="galeria" class=" cui_padding_20 cui_padding_50_bottom">-->
<!--                                <div id="cui_cont_galeria" class="cui_cont_galeria">-->
<!--                                    <div class="cui_row son">-->
<!--                                        <div class="cui_generalload" style="padding: 20px 0;">-->
<!--                                            <div class="wrapper">-->
<!--                                                    <div class="cssload-loader"></div>-->
<!--                                            </div>-->
<!--                                         </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            </div>-->
<!--							</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
    <script type="text/javascript">
	$(document).ready(function() {

            var cuiPos = new $.cuiPostal({
                id: <?php echo $id; ?>,
                cantXfila: <?php echo $catPostal['cant']; ?>,
				l:  '<?php echo $l; ?>'
            }, '.cui_cont_galeria');

            $('.cui_tab_btn').on('click', function(){
                    clickTabs(this);
            });

	});

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</div>