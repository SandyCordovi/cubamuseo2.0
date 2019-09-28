<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/coleciones/colecciones.php';

$cat = $_GET['cat'];
$id = $_GET['id'];
$item = getItemEdit($id);
?>

<div class="row" style="overflow: hidden; padding: 20px;">

    <form id="formWnd" action="service/colleciones/item_cmd.php" method="post" enctype="multipart/form-data" class="cui_row">
        <p style="margin-bottom: 5px; text-align: left;">Titulo</p>
        <input class="form" name="titulo" placeholder="Titulo" required="required" value="<?php echo utf8_decode($item['titulo']); ?>" />
        <p style="margin-bottom: 5px; text-align: left;">Titulo En</p>
        <input class="form" name="titulo_en" placeholder="Titulo En" value="<?php echo utf8_decode($item['title']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Nombre</p>
        <input class="form" name="nombre" placeholder="Nombre" required="required" value="<?php echo utf8_decode($item['nombre']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Dimension</p>
        <input class="form" name="dimension" placeholder="Dimension" value="<?php echo utf8_decode($item['dimension']); ?>" />
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Dimension En</p>
        <input class="form" name="dimension_en" placeholder="Dimension En" value="<?php echo utf8_decode($item['dimensione']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Emision</p>
        <input class="form" name="emision" placeholder="Emision" value="<?php echo utf8_decode($item['emision']); ?>" />
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Emision En</p>
        <input class="form" name="emision_en" placeholder="Emision En" value="<?php echo utf8_decode($item['emisione']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Material</p>
        <input class="form" name="material" placeholder="Material" value="<?php echo utf8_decode($item['material']); ?>" />
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Material En</p>
        <input class="form" name="material_en" placeholder="Material En" value="<?php echo utf8_decode($item['materiale']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Color</p>
        <input class="form" name="color" placeholder="Color" value="<?php echo utf8_decode($item['color']); ?>" />
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Color En</p>
        <input class="form" name="color_en" placeholder="Color En" value="<?php echo utf8_decode($item['colore']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Impresion</p>
        <input class="form" name="impresion" placeholder="Impresion" value="<?php echo utf8_decode($item['impresion']); ?>" />
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Impresion En</p>
        <input class="form" name="impresion_en" placeholder="Impresion En" value="<?php echo utf8_decode($item['impresione']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Precio</p>
        <input class="form" name="precio" placeholder="Precio" value="<?php echo utf8_decode($item['precio']); ?>" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Descripcion</p>
        <textarea id="descrip" name="descrip" style="margin-bottom: 15px; text-align: left;"><?php echo utf8_decode($item['descripcion']); ?></textarea>

        <p style="margin-bottom: 5px; margin-top: 20px; text-align: left;">Descripcion En</p>
        <textarea id="descrip_en" name="descrip_en"> <?php echo utf8_decode($item['description']); ?></textarea>


        <input type="hidden" name="cmd" value="2" />
        <input type="hidden" name="categoria" value="<?php echo $cat; ?>" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input id="btn_submit" type="submit" class="cui_btn_blue" value="Salvar" />
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
            $('#btn_submit').val('Procesando...');
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
                dataType: 'json',
                cache: false,
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
