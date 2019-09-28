<?php
function getVisitas()
{
    $query = "SELECT SUM(cantidad) FROM visitas WHERE 1";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return 0;
    $stmt->bind_result($col0);
    $html=0;
    $stmt->fetch();
    $html=$col0?$col0:0;
    return $html;
}

function getVisitasAVG()
{
    $query = "SELECT AVG(cantidad) FROM visitas WHERE fecha>'2016-04-05 17:44:51'";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return 0;
    $stmt->bind_result($col0);
    $html=0;
    $stmt->fetch();
    $html=$col0?$col0:0;
    return ceil($html);
}

?>
