<?php
$cmd = $_GET['cmd'];
$txt = "";
$id="";
$nombre="";
if($cmd==1)
{
    $txt = "Crear";
}
else if($cmd==2)
{
    $txt = "Editar";
    $id=$_GET['id'];;
    $nombre=$_GET['nombre'];
}

?>
<div class="cui_row son" style="padding: 20px;">
    <p id="notif" style="font-size: 14px; color: red; text-align: center;"></p>
    <form class="cui_row" id="ajaxform" action="controller/roles.php" method="post">
        <input class="form" required="required" name="nombre" placeholder="Nombre del rol" value="<?php echo $nombre; ?>" />
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
