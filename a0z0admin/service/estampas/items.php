<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/estampas/estampas.php';

$s = $_POST['p'];
$b = $_POST['b'];
$categoria = $_POST['opt'];
$items = getItemsByMuestras($categoria);

?>

<table class="grid">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Opciones</th>
        <!--      <th>Orden</th>-->
    </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($items); $i++){ ?>
        <tr>
            <td>
                <strong><?php echo utf8_decode($items[$i]['imagen']).' | '.utf8_decode($items[$i]['titulo']); ?></strong>
            </td>
            <td>
                <img src="images/edit.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Edit" onclick="Edit(<?php echo $items[$i]['id'] ?>);" />
                <img src="images/trash.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Delete" onclick="Delete(<?php echo $items[$i]['id'] ?>);" />
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
