<?php

include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_estampas.php';

$id = $_GET['id'];
$m = $_GET['m'];

$muestra = getMuestra($m);
$item = getItem($id);

?>
<p class="cui_titulo_nav" style="color: #0b0b0b; font-weight: bold;">
    <?php echo utf8_decode($item['nombre']) ?> | <?php echo utf8_decode($item['titulo']) ?>
</p>
<div style="vertical-align: middle; text-align: center; display: inline-table;">
    <div class="cui_prev" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;">
        <img src="images/cui_prev.png" height="100px" />
    </div>
    <div  style="display: table-cell; text-align: center; vertical-align: middle; padding: 0px; width: 500px; height: 500px;">
        <img class="cui_img_gal_nav cui_img_zoom" style="cursor: pointer; max-width: 500px; max-height: 500px;" src="service/ri.php?s=Muestras&c=<?php echo utf8_decode($muestra['carpeta']); ?>&i=<?php echo utf8_decode($item['imagen']); ?>&p=<?php echo Configuracion::$dimencion_navegacion; ?>" />
    </div>
    <div class="cui_next" style="display: table-cell; vertical-align: middle; opacity: .75; cursor: pointer;">
         <img src="images/cui_next.png" height="100px" />
    </div>
</div>
<div style="display: block; padding: 20px; background-color: #FFFFFF;">
    <div style="max-width: 550px;">
        <div class="cui_descr_nav" id="show_div" style="text-align: left; font-size: .9em;color: #0b0b0b;">
            <?php
            $description = $item[descripcion];
            if(strlen($description) >= 500): ?>
                <?= $description_cut = utf8_decode(substr($description, 0, 500)) . " ..."; ?>

                <button class="more_text" style=" text-align: left; font-size: .9em; color:#5c84b5; background-color: transparent; border-style: hidden;
                        " onclick=javascript:see_more('hidden_div','show_div') >
                    (Ver más)
                </button>
            <?php endif; ?>

            <?php if(strlen($description) < 500)
                echo utf8_decode($description);  ?>

        </div>
        <div class="cui_descr_nav" id="hidden_div" style="text-align: left; font-size: .9em; display: none;color: #0b0b0b;">
            <?php
            $description = $item[descripcion];
            echo utf8_decode($description);
            ?>
            <button class="more_text"  style="text-align: left; font-size: .9em; color:#5c84b5; background-color: transparent; border-style: hidden;
                        " onclick="javascript:see_more('hidden_div','show_div')" >
                (Ver menos)
            </button>

        </div>

    </div>
    </div>
    
</div>

<script type="text/javascript">
    function see_more(div_id,div2_id){
        if(document.getElementById(div_id).style.display=='none'){
            document.getElementById(div_id).style.display='block';
            document.getElementById(div2_id).style.display='none';
        }
        else{
            document.getElementById(div_id).style.display='none';
            document.getElementById(div2_id).style.display='block';
        }
    }
</script>
