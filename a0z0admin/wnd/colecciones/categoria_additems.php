<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$id = $_GET['id'];
$item = getCategoria($id);

?>

<div class="row" style="overflow: hidden; padding: 20px;">

    <form id="formWnd" action="service/colleciones/categoria_cmd.php" method="post" enctype="multipart/form-data" class="cui_row">
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Tabla ES</p>
        <input type="file" class="form" name="word_es" placeholder="Tabla de Word" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Tabla EN</p>
        <input type="file" class="form" name="word_en" placeholder="Tabla de Word EN"/>
        <p style="margin-bottom: 5px; text-align: left;">Imagenes(.Zip)</p>
        <input type="file" class="form" name="imagenes_zip" placeholder="Zip Imagenes" required="required" />

        <input type="hidden" name="cmd" value="7" />
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
                    if(data.salida.msg == "ok"){
                        txt = 'La categoría se ha insertado exitosamente';
                        cui_wnd._createWND_tamFijo('wnd/SimpleMsgDlg.php?txt='+txt, 40);
                    }
                    Refresh();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown+"  "+textStatus);
                }
            });
        });

</script>
