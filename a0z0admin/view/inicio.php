<?php
include 'model/inicio.php';

$v = getVisitas();
$p = getVisitasAVG();
?>
<div class="cui_row admin-contenedor">    
    <div class="cui_row" style="margin-top: 20px; text-align: center;">
        <p style="font-size: 25px;">Visitas</p>
        <p style="font-size: 80px;"><?php echo $v; ?></p>
    </div>
    <div class="cui_row" style="margin-top: 20px; text-align: center;">
        <p style="font-size: 25px;">Promedio de visitas diario</p>
        <p style="font-size: 80px;"><?php echo $p; ?></p>
    </div>
</div>