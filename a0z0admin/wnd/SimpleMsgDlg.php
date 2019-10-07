<?php
include '../../tool.php';

$txt = $_GET['txt'];

?>

<div class="cui_row son" style="padding: 20px;">
    <p style="text-align: center; font-size: 20px;"><?php echo $txt; ?></p>
    <div class="cui_row">
        <div class="btn_admin" style="margin-top: 20px; float: right;" onclick="cui_wnd._closeTop();">
            Ok
        </div>
    </div>
</div>