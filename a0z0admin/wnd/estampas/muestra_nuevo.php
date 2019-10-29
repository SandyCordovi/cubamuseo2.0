<?php
include '../../../configuracion.php';
include '../../../tool.php';
include '../../model/model.php';
include '../../model/estampas/estampas.php';

$categorias = getCategoriasSP();

?>

<div class="row" style="overflow: hidden; padding: 20px;">

    <form id="formWnd" action="service/estampas/muestra_cmd.php" method="post" enctype="multipart/form-data" class="cui_row">
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Categoria</p>
        <div class="cui_row" style="margin-bottom:10px;">
            <select name="seccion_s" class="form" style="width: 500px; margin-bottom: 0; float:left;">
                    <?php for($i=0; $i<count($categorias); $i++){ ?>
                    <option value="<?php echo utf8_decode($categorias[$i]['id']); ?>"><?php echo utf8_decode($categorias[$i]['titulo']); ?></option>
                    <?php } ?>
            </select>
        </div>
        <p style="margin-bottom: 5px; text-align: left;">Titulo</p>
        <input class="form" name="titulo" placeholder="Titulo" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Titulo En</p>
        <input class="form" name="titulo_en" placeholder="Titulo En" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Nombre</p>
        <input class="form" name="nombre" placeholder="Nombre" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Nombre EN</p>
        <input class="form" name="nombre_en" placeholder="Nombre EN" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Imagen de item</p>
        <input type="file" class="form" name="imagen" placeholder="Imagen" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Imagen Galeria</p>
        <input type="file" class="form" name="imagen_galeria" placeholder="Imagen Galeria" required="required" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Descripcion</p>
        <textarea id="descrip" name="descrip" style="margin-bottom: 15px; text-align: left;"></textarea>

        <p style="margin-bottom: 5px; margin-top: 20px; text-align: left;">Descripcion En</p>
        <textarea id="descrip_en" name="descrip_en"></textarea>
		
        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Tabla ES</p>
        <input type="file" class="form" name="word_es" placeholder="Tabla de Word" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Tabla EN</p>
        <input type="file" class="form" name="word_en" placeholder="Tabla de Word EN"/>
		<p style="margin-bottom: 5px; text-align: left;">Imagenes(.Zip)</p>
        <input type="file" class="form" name="imagenes_zip" placeholder="Zip Imagenes" required="required"/>

        <input type="hidden" name="cmd" value="1" />
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
                    console.log(data);
                    if(data.salida.msg == "ok"){
                        txt = 'La muestra se ha insertado exitosamente';
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
