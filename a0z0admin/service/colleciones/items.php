<?php

include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$s = $_POST['p'];
$b = $_POST['b'];
$cat = $_POST['opt'];

$item = getItem($s, $b, $cat);
$total = getTotalItem($b, $cat);


$n = Configuracion::$num_elem_x_pag;
$cant_pag = ceil($total/$n);

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
    <?php for($i=0; $i<count($item); $i++){ ?>
        <tr>
              <td>
                  <strong><?php echo utf8_decode($item[$i]['nombre']).' | '.utf8_decode($item[$i]['titulo']); ?></strong>
              </td>
              <td>
                  <img src="images/edit.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Edit" onclick="Edit(<?php echo $item[$i]['id'] ?>);" />                  
                  <img src="images/trash.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Delete" onclick="Delete(<?php echo $item[$i]['id'] ?>);" />                  
              </td>
<!--              <td style="text-align: center;">
                  <img src="images/up.png" height="20px" style="margin: 0 5px; cursor: pointer;" title="Up" onclick="SortUp(<?php echo $item[$i]['id'] ?>);" />
                  <img src="images/down.png" height="20px" style="margin: 0 5px; cursor: pointer;" title="Down" onclick="SortDown(<?php echo $item[$i]['id'] ?>);" />
              </td>-->
        </tr>
    <?php } ?>
  </tbody>
</table>


<?php if($cant_pag>1){ ?>
<div class="cui_row cui_pag">
    <div id="pag_primera" class="btn" onclick="Pagina(1);">
        Primera
    </div>
    <div class="cui_pag_hide">
        |
    </div>
    <div id="pag_prev" class="btn" onclick="Pagina(<?php echo $s-1<1 ? 1 : $s-1; ?>);">
        Anterior
    </div>
    <div class="pos">
        <?php echo $s; ?> de <?php echo $cant_pag; ?>
    </div>
    <div id="pag_next" class="btn" onclick="Pagina(<?php echo $s+1>$cant_pag ? $cant_pag : $s+1; ?>);">
        Siguiente
    </div>
    <div class="cui_pag_hide">
        |
    </div>
    <div id="pag_ultima" class="btn" onclick="Pagina(<?php echo $cant_pag; ?>);">
        &Uacute;ltima
    </div>
</div>
<?php } ?>