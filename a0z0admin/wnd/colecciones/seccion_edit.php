<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$id = $_GET['id'];
$item = getSeccion($id);

?>

<div class="row" style="overflow: hidden; padding: 20px;">

    <form id="formWnd" action="service/colleciones/seccion_cmd.php" method="post" enctype="multipart/form-data" class="cui_row">
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
        <input type="file" class="form" name="imagen_menu" placeholder="Imagen Menu" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Descripcion</p>
        <textarea id="descrip" name="descrip" style="margin-bottom: 15px; text-align: left;"> <?php echo utf8_decode($item['descripcion']); ?></textarea>

        <p style="margin-bottom: 5px; margin-top: 20px; text-align: left;">Descripcion En</p>
        <textarea id="descrip_en" name="descrip_en"><?php echo utf8_decode($item['description']); ?></textarea>


        <input type="hidden" name="cmd" value="2" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="submit" class="cui_btn_blue" value="Salvar" />
    </form>

</div>

<script type="text/javascript">
        var editor, editor_en;
        function CreateEditor(){
            editor = CKEDITOR.replace( 'descrip',{
                filebrowserImageBrowseUrl : 'controller/colecciones/brows.php',
                filebrowserImageUploadUrl : 'controller/colecciones/upload.php?type=image',
                filebrowserWindowWidth  : 800,
                filebrowserWindowHeight : 500
            });

             editor_en = CKEDITOR.replace( 'descrip_en',{
                filebrowserImageBrowseUrl : 'controller/colecciones/brows.php',
                filebrowserImageUploadUrl : 'controller/colecciones/upload.php?type=image',
                filebrowserWindowWidth  : 800,
                filebrowserWindowHeight : 500
            });
        }

        $("#formWnd").submit(function(e)
        {
            e.preventDefault();
            $('#descrip').text(editor.getData());
            $('#descrip_en').text(editor_en.getData());
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

                }
            });
        });

</script>
