<?php

include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/clientes.php';

$s = $_POST['p'];
$b = $_POST['b'];

$item = getClientes($s, $b);
$total = getTotalClientes($b);

$n = Configuracion::$num_elem_x_pag;
$cant_pag = ceil($total/$n);

?>
<table class="grid">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Username</th>
      <th>Email</th>
      <th>Fecha</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0; $i<count($item); $i++){ ?>
        <tr>
              <td>
                  <strong><?php echo utf8_decode($item[$i]['nombre']); ?></strong>
              </td>
              <td>
                  <?php echo utf8_decode($item[$i]['username']); ?>
              </td>
              <td>
                  <?php echo utf8_decode($item[$i]['email']); ?>
              </td>
              <td>
                  <?php echo utf8_decode($item[$i]['fecha_registro']); ?>
              </td>
              <td>                  
                  <img src="images/trash.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Delete" onclick="Delete(<?php echo $item[$i]['id'] ?>)" />                  
              </td>
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