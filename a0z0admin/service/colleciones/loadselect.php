<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$id = $_POST['id'];
$cat = getCategoriasSPSecc($id);

?>

<?php for($i=0; $i<count($cat); $i++){ ?>
    <option value="<?php echo utf8_decode($cat[$i]['id']); ?>"><?php echo utf8_decode($cat[$i]['titulo']); ?></option>
<?php } ?>