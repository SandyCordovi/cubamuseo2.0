<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="row" style="overflow: hidden; padding: 20px;">

    <form id="formWnd" action="service/tienda/tematica_cmd.php" method="post" enctype="multipart/form-data" class="cui_row">
        <p style="margin-bottom: 5px; text-align: left;">Titulo</p>
        <input class="form" name="titulo" placeholder="Titulo" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Titulo En</p>
        <input class="form" name="titulo_en" placeholder="Titulo En"/>

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Nombre</p>
        <input class="form" name="nombre" placeholder="Nombre" required="required" />
        <p style="margin-bottom: 5px; text-align: left;">Nombre EN</p>
        <input class="form" name="nombre_en" placeholder="Nombre EN" />

        <p style="margin-bottom: 5px; margin-top: 10px; text-align: left;">Imagen Menu</p>
        <input type="file" class="form" name="imagen_menu" placeholder="Imagen Menu" required="required" />

        <input type="hidden" name="cmd" value="1" />
        <input type="submit" class="cui_btn_blue" value="Salvar" />
    </form>
     
</div>

<script type="text/javascript">

        $("#formWnd").submit(function(e)
        {
            e.preventDefault();
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
