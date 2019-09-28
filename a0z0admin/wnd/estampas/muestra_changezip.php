<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/estampas/etampas.php';

$id = $_GET['id'];
$item = getMuestra($id);

?>

<div class="row" style="overflow: hidden; padding: 20px;">

    <form id="formWnd" action="service/colleciones/categoria_cmd.php" method="post" enctype="multipart/form-data" class="cui_row">        
        <p style="margin-bottom: 5px; text-align: left;">Imagenes(.Zip)</p>
        <input type="file" class="form" name="imagenes_zip" placeholder="Zip Imagenes" required="required" />

        <input type="hidden" name="cmd" value="9" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input id="btn_submit" type="submit" class="cui_btn_blue" value="Salvar" />
    </form>

</div>

<script type="text/javascript">

        $("#formWnd").submit(function(e)
        {
            e.preventDefault();
            $('#btn_submit').val('Procesando...');
            $form = $(this);
            //var postData = $form.serializeArray();
            var postData = new FormData(document.getElementById("formWnd"));
            var formURL = $form.attr("action");
            $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success:function(data, textStatus, jqXHR)
                {
                    cui_wnd._closeAll();
                    Refresh();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown+"  "+textStatus);
                }
            });
        });

</script>
