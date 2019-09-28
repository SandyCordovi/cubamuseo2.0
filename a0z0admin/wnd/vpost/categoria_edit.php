<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/vpost/vpost.php';

$id = $_GET['id'];
$item = getCategoriaPostal($id);

?>

<div class="row" style="overflow: hidden; padding: 20px;">

    <form id="formWnd" action="service/vpost/categoria_cmd.php" method="post" enctype="multipart/form-data" class="cui_row">
         <p style="margin-bottom: 5px; text-align: left;">Titulo</p>
        <input class="form" name="titulo" placeholder="Titulo" value='<?php echo utf8_decode($item['titulo']); ?>' required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Titulo En</p>
        <input class="form" name="titulo_en" placeholder="Titulo En" value="<?php echo utf8_decode($item['title']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Nombre</p>
        <input class="form" name="nombre" placeholder="Nombre" value="<?php echo utf8_decode($item['nombre']); ?>" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Nombre EN</p>
        <input class="form" name="nombre_en" placeholder="Nombre EN" value="<?php echo utf8_decode($item['name']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Imagen</p>
        <input type="file" class="form" name="imagen" placeholder="Imagen" />
        <p style="margin-bottom: 5px; text-align: left;">Imagen Menu</p>
        <input type="file" class="form" name="imagen_galeria" placeholder="Imagen Menu" />

	<p style="margin-bottom: 5px; text-align: left; margin-top: 20px;">Imagenes(.Zip)</p>
        <input type="file" class="form" name="imagenes_zip" placeholder="Zip Imagenes" />
	
        <input type="hidden" name="cmd" value="2" />
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
