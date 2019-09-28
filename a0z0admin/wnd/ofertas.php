<?php
include '../../configuracion.php';
include '../../tool.php';
include '../model/model.php';
include '../model/usuarios.php';


$txt = "Crear";

?>
<div class="cui_row son">
    <p id="notif" style="font-size: 14px; color: red; text-align: center;"></p>
    <form class="cui_row" id="ajaxform" action="controller/ofertas.php" method="post">
        <input class="form" required="required" name="ref" placeholder="Referencia" value="" />
        <input type="hidden" name="cmd" value="1" />
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
