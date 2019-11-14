<?php


//include '../lib/DocxConversion.php';
//$docObj = new DocxConversion("word.docx");
//$docText= $docObj->convertToText();
//$docText = preg_split('/__/', $docText);
//print_r($docText);



?>
<script src="../lib/ckeditor/ckeditor.js" type="text/javascript"></script>

<div class="cui_row admin-contenedor">
    <h1 class="admin-titulo">CLIENTES</h1>
    <div class="cui_row" style="margin-top: 20px;">
        <div class="btn_admin" onclick="cui_wnd._createWND_tamFijo('wnd/clientes/clientes_nuevo.php', 70);">
            Nuevo
        </div>
        <div class="btn_admin" onclick="Refresh();">
            Refresh
        </div>
        <form id="ajaxform" action="service/clientes/clientes.php" method="post" class="admin_search_box">
            <input id="search_admin" name="b" />
            <input type="submit" value=""/>
            <input type="hidden" name="p" value="1" />
        </form>
    </div>
    <div class="cui_row cui_result_table" style="margin-top: 20px;">


    </div>
</div>

<script type="text/javascript">
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

    $.ajax(
    {
        url : 'service/clientes/clientes.php',
        type: "POST",
        data : "p=1&b="+$('#search_admin').val(),
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

function Refresh()
{
    $('#search_admin').val("");
    $.ajax(
    {
        url : 'service/clientes/clientes.php',
        type: "POST",
        data : "p=1&b="+$('#search_admin').val(),
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
    $.ajax(
    {
        url : 'service/clientes/clientes.php',
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
    cui_wnd._createWND_tamFijo('wnd/clientes/clientes_edit.php?id='+id, 70, function(){CreateEditor();});
}

function Delete(id)
{
    txt = 'Estas seguro que quieres eliminar este elemento';
    cui_wnd._createWND_tamFijo('wnd/MsgDlg.php?txt='+txt+'&func=DeleteElement('+id+')', 40);
}

function DeleteElement(id)
{
    $.ajax({
        url : 'service/clientes/clientes_cmd.php',
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
        url : 'service/clientes/clientes_cmd.php',
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


</script>