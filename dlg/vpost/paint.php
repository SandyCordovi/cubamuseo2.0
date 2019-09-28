<?php
include '../../configuracion.php';
include '../../accesdb/model.php';
include '../../accesdb/cui_postales.php';

$id = $_GET['id'];
$postal = getPostal($id);
$catPostal = getCategoriaPostal($postal['categoria']);
?>

<div class="cui_row">
    <div style="width: 100%; float: left; background-color: #182535; padding: 10px 0; text-align: center; overflow: hidden;">
        <div style="overflow: hidden; display: inline-table;">
            <div id="colorSelector" style="height: 34px; width: 34px; border: 2px #fff solid; background-color: #fff; margin-right: 20px; display: block; float: left;"></div>
<!--            <img height="36px" src="images/fontpicker.png" style="margin-right: 20px; display: block; float: left;" />-->
            <select id="cui_font_family" style="margin-right: 20px; display: block; float: left; height: 36px; font-family: Capture_it; font-size: 20px; width: 180px;">
                <option style="font-family: Capture_it; font-size: 20px;" value="Capture_it">Capture_it</option>
                <option style="font-family: Windsong; font-size: 20px;" value="Windsong">Windsong</option>
                <option style="font-family: CaviarDreams; font-size: 20px;" value="CaviarDreams">CaviarDreams</option>
                <option style="font-family: Open Sans; font-size: 20px;" value="Open Sans">Open Sans</option>
                <option style="font-family: Pacifico; font-size: 20px;" value="Pacifico">Pacifico</option>
            </select>
            <select id="cui_font_size" style="margin-right: 20px; display: block; float: left; height: 36px;">
                <option value="10">10pt</option>
                <option value="12">12pt</option>
                <option value="14">14pt</option>
                <option value="16">16pt</option>
                <option value="18">18pt</option>
                <option value="24">24pt</option>
                <option value="30" selected>30pt</option>
                <option value="40">40pt</option>
                <option value="50">50pt</option>
                <option value="60">60pt</option>
            </select>
            
            <div id="vprevia_vp" style="margin-right: 20px; display: block; float: left; background-color: #5c84b5; color: #fff; padding: 7px 10px; height: 36px; border-radius: 5px; cursor: pointer;">
                Vista previa
            </div>
            <div id="salvar_vp" style="margin-right: 20px; display: block; float: left; background-color: #5c84b5; color: #fff; padding: 7px 10px; height: 36px; border-radius: 5px; cursor: pointer;">
                Salvar para enviar
            </div>
            <div id="limpiar_vp" style=" display: block; float: left; background-color: #df5114; color: #fff; padding: 5px 10px; padding: 7px 10px; height: 36px; border-radius: 5px; cursor: pointer;">
                Limpiar
            </div>
        </div>
        

    </div>
    <div class="cui_row" style="padding: 50px; overflow: hidden; display: inline; position: relative;">
        <div id="cui_box_paint" style="position: absolute; width: 270px; height: 160px; border: 3px #182535 dotted; z-index: 10; background-color: rgba(24,37,53,.2 ); display: none;">
            <textarea id="cui_txt_vp" placeholder="ESCRIBA SU TEXTO PERSONALIZADO AQU&Iacute;" rows="5" cols="20" style="font-family: Capture_it;"></textarea>
            <div id="handle" style="width: 40px; height: 40px; background-color: #182535; background-image: url(images/moveico1.png); background-position: center center; background-repeat: no-repeat;  position: absolute; top: -41px; right: 0; border-radius: 10px 10px 0 0;"></div>
        </div>
        <img id="cui_img_paint" style="position: relative;  z-index: 9;" src="images/load.gif"/>
    </div>
    <input id="cui_url_base" type="hidden" value="s=V-Posts&c=<?php echo utf8_decode($catPostal['nombre']); ?>&i=<?php echo utf8_decode($postal['imagen']); ?>&p=700" />
    <input id="cui_color_hi" type="hidden" value="ffffff" />
</div>