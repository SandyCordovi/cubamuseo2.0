<?php
include '../../configuracion.php';
include '../../tool.php';
include '../model/model.php';
include '../model/usuarios.php';

$cmd = $_GET['cmd'];
$txt = "";
$id="";
$nombre="";
$email="";
$pass="";
$rol="";
$rolid="";

$roles = getRoles($_GET['r']);

if($cmd==1)
{
    $txt = "Crear";
}
else if($cmd==2)
{
    $txt = "Editar";
    $id=$_GET['id'];
    $html = getUsuarioById($id);
    $nombre=utf8_decode($html['nombre']);
    $email=utf8_decode($html['email']);
    $rol=$html['rol'];
    $rolid=$html['rolid'];
}

?>
<div class="cui_row son" style="padding: 20px;">
    <p id="notif" style="font-size: 14px; color: red; text-align: center;"></p>
    <form class="cui_row" id="ajaxform" action="controller/usuarios.php" method="post">
        <input class="form" required="required" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" />
        <input class="form" required="required" name="email" placeholder="Email" type="email" value="<?php echo $email; ?>" />
        <input class="form" <?php echo $cmd==1?'required="required"':"" ?> name="pass" placeholder="Contrase&ntilde;a" type="password" value="" />
        <select class="form" required="required" name="rol" placeholder="Rol">
            <?php for($i=0; $i<count($roles); $i++){ ?>
            <option value="<?php echo $roles[$i]['id']; ?>" <?php echo $roles[$i]['id']==$rolid?"selected":"" ?>><?php echo $roles[$i]['nombre']; ?></option>
            <?php } ?>
        </select>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="cmd" value="<?php echo $cmd; ?>" />
        <div class="cui_row">
            <!-- Send Button -->
            <button type="submit" id="submit" name="submit" class="form-btn"><?php echo $txt; ?></button>
        </div>
    </form>

    <script>

    $("#ajaxform").submit(function(e)
    {
        $form = $(this);
        var postData = $form.serializeArray();
        var formURL = $form.attr("action");
        $("#submit").text("Trabajando..");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR)
            {
                $("#submit").text("<?php echo $txt; ?>");
                window.location="";
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $("#notif").text("Ha ocurrido un error.");
                $("#submit").text("<?php echo $txt; ?>");
            }
        });
        e.preventDefault();	//STOP default action
    });

    </script>
</div>
