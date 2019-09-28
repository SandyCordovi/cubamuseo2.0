<?php
include '../../tool.php';

$txt = $_GET['txt'];
$func = "";
if(isset ($_GET['func']) && $_GET['func'])
    $func = RemplaceChart('~', "'", $_GET['func']);

?>

<div class="cui_row son" style="padding: 20px;">
    <p style="text-align: center; font-size: 20px;"><?php echo $txt; ?>?</p>
    <div class="cui_row">
        <div class="btn_admin" style="margin-top: 20px; float: right;" onclick="cui_wnd._closeTop();">
            Cancelar
        </div>
        <?php if($func!=""){ ?>
        <div class="btn_admin_del" style="margin-top: 20px; float: right;" onclick="<?php echo $func; ?>;">
            Eliminar
        </div>
        <?php } ?>
    </div>
</div>