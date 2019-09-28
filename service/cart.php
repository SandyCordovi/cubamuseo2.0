<?php
session_start();

include '../configuracion.php';
include '../accesdb/model.php';
include '../accesdb/cui_generales.php';
include '../accesdb/cui_tienda.php';
include '../accesdb/cui_colecciones.php';

$cmd = $_POST['cmd'];
if($cmd=='1')
{
    $e = $_POST['e'];
    $item = $_POST['item'];
    $item = getItemTienda($item);
    $car  = getCarByUser($_SESSION['username']);
    if(AddItemTiendaCarrito($item['id'], $car['id'], $e=='fuera' ? $item['precioEnvioF'] : $item['precioEnvio']))
        echo '<p style="text-align: center; font-size: 1.2em;">Este item esta en su carrito.</p>
                <div class="cui_row" style="padding-top: 10px; text-align: center;">
                    <div class="cui_btn_blue view_car" style="padding: 5px 10px; float: none; overflow: hidden; display: inline;">
                        Ver carrito
                    </div>
                </div>';
    else {
        
    }
}
else if($cmd==2)
{
    $item = $_POST['item'];
    $carrito = $_POST['car'];
    DeleteItemTiendaCarrito($item, $carrito);
    $jsondata['s']=array('type'=>"0", 'msg'=> '', 'data'=>array());
    echo json_encode($jsondata);
}
else if($cmd=='3')
{
    $item = $_POST['item'];
    $item = getItem($item);
    $car  = getCarByUser($_SESSION['username']);
    if(AddImagenCarrito($item['id'], $car['id']))
        echo '<p style="text-align: center; font-size: 1.2em;">Este item esta en su carrito.</p>
                <div class="cui_row" style="padding-top: 10px; text-align: center;">
                    <div class="cui_btn_blue view_car" style="padding: 5px 10px; float: none; overflow: hidden; display: inline;">
                        Ver carrito
                    </div>
                </div>';
   
}
else if($cmd==4)
{
    $item = $_POST['item'];
    $carrito = $_POST['car'];
    DeleteImagenCarrito($item, $carrito);
    $jsondata['s']=array('type'=>"0", 'msg'=> '', 'data'=>array());
    echo json_encode($jsondata);
}

?>
