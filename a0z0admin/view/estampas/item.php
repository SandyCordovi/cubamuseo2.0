<?php
include 'model/estampas/estampas.php';

$item = getMuestrasSP();

?>
<script src="../lib/ckeditor/ckeditor.js" type="text/javascript"></script>

<div class="cui_row admin-contenedor">
    <h1 class="admin-titulo">Imágenes Muestras</h1>
    <div class="cui_row" style="margin-top: 20px;">
        <form id="ajaxform" action="service/estampas/muestras.php" method="post" class="admin_search_box">
            <input id="search_admin" name="b" />
            <input type="submit" value=""/>
            <input type="hidden" name="p" value="1" />
            <input id="opt_h" type="hidden" name="opt" value="<?php echo utf8_decode($item[0]['id']); ?>" />
        </form>
    </div>
    <div class="cui_row" style="margin-top: 50px;">
        <select id="seccion_select" class="form" style="width: 500px; margin-bottom: 0;">
            <?php for($i=0; $i<count($item); $i++){ ?>
                <option value="<?php echo utf8_decode($item[$i]['id']); ?>"><?php echo utf8_decode($item[$i]['nombre']); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="cui_row cui_result_table" style="margin-top: 0px;">


    </div>

</div>
<script type="text/javascript">
    var pagina_va = 1;
    $(document).ready(function() {

        $("#ajaxform").submit(function(e)
        {
            e.preventDefault();
            $form = $(this);
            var postData = $form.serializeArray();
            var formURL = $form.attr("action");
            $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    datatype: "html",
                    success:function(data, textStatus, jqXHR)
                    {
                        $('.cui_result_table').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {

                    }
                });
        });

        Load();

        $('#seccion_select').on('change', function(){
            pagina_va=1;
            $('#opt_h').val($(this).val());
            Load();
        })

    });

    function Load()
    {
        $.ajax(
            {
                url : 'service/estampas/items.php',
                type: "POST",
                data : "p="+pagina_va+"&b="+$('#search_admin').val()+"&opt="+$('#seccion_select').val(),
                datatype: "html",
                success:function(data, textStatus, jqXHR)
                {
                    $('.cui_result_table').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {

                }
            });
    }

    function Refresh()
    {
        $('#search_admin').val("");
        $.ajax(
            {
                url : 'service/estampas/items.php',
                type: "POST",
                data : "p="+pagina_va+"&b="+$('#search_admin').val()+"&opt="+$('#seccion_select').val(),
                datatype: "html",
                success:function(data, textStatus, jqXHR)
                {
                    $('.cui_result_table').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {

                }
            });
    }

    function Edit(id)
    {
        cui_wnd._createWND_tamFijo('wnd/colecciones/item_edit.php?id='+id+'&cat='+$('#seccion_select').val(), 70, function(){CreateEditor();});
    }

    function Delete(id)
    {
        txt = 'Estas seguro que quieres eliminar este elemento';
        cui_wnd._createWND_tamFijo('wnd/MsgDlg.php?txt='+txt+'&func=DeleteElement('+id+')', 40);
    }


</script>
