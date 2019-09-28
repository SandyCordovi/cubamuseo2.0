<?php
function getMenuByRol($r)
{
    $query = "SELECT nombre, link FROM cui_adm_menu WHERE alcance>=$r order by orden";
    $model = new model();
    $stmt = $model->get_stmt($query);
    if(!$stmt)return array();
    $stmt->bind_result($col0,$col1);
    $html=array();
    $i=0;
    while ($row = $stmt->fetch())
    {
        $html[$i]['nombre']=$col0;
        $html[$i]['link']=$col1;
        $i++;
    }
    return $html;
}

?>
