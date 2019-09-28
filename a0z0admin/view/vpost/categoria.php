<?php

include 'model/vpost/vpost.php';

?>
<script src="../lib/ckeditor/ckeditor.js" type="text/javascript"></script>

<div class="cui_row admin-contenedor">
    <h1 class="admin-titulo">CATEGORIAS POSTALES</h1>
    <div class="cui_row" style="margin-top: 20px;">
        <div class="btn_admin" onclick="cui_wnd._createWND_tamFijo('wnd/vpost/categoria_nuevo.php', 70, function(){CreateEditor();});">
            Nuevo
        </div>
        <div class="btn_admin" onclick="Refresh();">
            Refresh
        </div>
        <form id="ajaxform" action="service/vpost/categoria.php" method="post" class="admin_search_box">
            <input id="search_admin" name="b" />
            <input type="submit" value=""/>
            <input type="hidden" name="p" value="1" />
            <input id="opt_h" type="hidden" name="opt" value="20" />
        </form>
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

});

function Load()
{
    $.ajax(
    {
        url : 'service/vpost/categoria.php',
        type: "POST",
        data : "p="+pagina_va+"&b="+$('#search_admin').val(),
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
        url : 'service/vpost/categoria.php',
        type: "POST",
        data : "p="+pagina_va+"&b="+$('#search_admin').val(),
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

function Pagina(p)
{
    pagina_va = p;
    $.ajax(
    {
        url : 'service/vpost/categoria.php',
        type: "POST",
        data : "p="+p+"&b="+$('#search_admin').val(),
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
    cui_wnd._createWND_tamFijo('wnd/vpost/categoria_edit.php?id='+id, 70, function(){CreateEditor();});
}

function Delete(id)
{
    txt = 'Estas seguro que quieres eliminar este elemento';
    cui_wnd._createWND_tamFijo('wnd/MsgDlg.php?txt='+txt+'&func=DeleteElement('+id+')', 40);
}

function DeleteElement(id)
{
    $.ajax({
        url : 'service/vpost/categoria_cmd.php',
        type: "POST",
        data : 'cmd=3&id='+id,
        success:function(data, textStatus, jqXHR)
        {
            cui_wnd._closeAll();
            Refresh();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function PublicUnp(id, o)
{
    o = $(o);
    var p = o.data('public')==1 ? 0 : 1;
    $.ajax({
        url : 'service/vpost/categoria_cmd.php',
        type: "POST",
        data : 'cmd=4&id='+id+'&p='+p,
        success:function(data, textStatus, jqXHR)
        {
            if(p==0)
            {
                o.css('background-color', '#0070C0');
                o.text("Publish");
            }
            else
            {
                o.css('background-color', 'red');
                o.text("Unpublish");
            }
            o.data('public', p);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function SortUp(id)
{
    $.ajax({
        url : 'service/vpost/categoria_cmd.php',
        type: "POST",
        data : 'cmd=5&id='+id+"&opt="+$('#seccion_select').val(),
        success:function(data, textStatus, jqXHR)
        {
            Refresh();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {

        }
    });
}
function SortDown(id)
{
    $.ajax({
        url : 'service/vpost/categoria_cmd.php',
        type: "POST",
        data : 'cmd=6&id='+id+"&opt="+$('#seccion_select').val(),
        success:function(data, textStatus, jqXHR)
        {
            Refresh();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {

        }
    });
}

</script>