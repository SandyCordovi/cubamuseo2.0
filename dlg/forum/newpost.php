<?php
session_start();

include '../../configuracion.php';
include '../../tool.php';

$t = $_GET['t'];

?>

<?php if(IsLogin ()){ ?>
<div id="padre_acp_forum" class="cui_row" style="padding: 0 10px; padding-bottom: 300px;">
    <p class="cui_txt_menu">En esta tematica solo se trataran temas relasionados con las colecciones de nuestro sitio.</p>
    <div id="myFormSearch" style="width: 500px; height: 50px; background-color: #000; margin: 50px auto; padding: 0  10px 0 10px; position: relative;">
        <input class="cui_input_search" value="" placeholder="Buscar en Cuba Museo" style="float: left; margin: 0; border: none; background-color: transparent; height: 100%; color: #fff; width: 100%; padding: 0 30px; background-position: center right;" />
        <div class="cui_intellisense" style="display: none; position: absolute; width: 100%; z-index: 5; max-height: 300px; overflow: auto; background-color: #efefef; margin: 0; left: 0; top: 50px;">

        </div>
    </div>
    <div class="cui_row" style="text-align: center;">
        <img id="img_acp_forum" src="" style="display: none;" />
        <p id="p_acp_forum" style="display: none; margin: 20px 0; font-size: 18px;"></p>
    </div>
    <div id="btn_acp_forum" class="cui_btn_blue" style="float: right; display: none;">
        Aceptar
    </div>
</div>

<script>

    var box = $('.cui_input_search');
    var intell = $('.cui_intellisense');

box.on('blur', function(){
    intell.fadeOut();
});

box.on('keydown', function(e){
    //e.preventDefault();
});

box.on('keyup', function(e){
    e.preventDefault();
    var key = e.charCode || e.keyCode || 0;
    if(key!=13)
    {
        var box1 = $(this);
        if(box1.val().length==0)
        {
            intell.fadeOut();
            intell.find('.son').remove();
        }
        else
        {
            $.ajax({
                type: "POST",
                data: 's='+box1.val(),
                url: 'service/forum/s_colecciones.php?t=<?php echo $t; ?>',
                async: true,
                dataType: "html"
             }).done(function (data){
                try {

                    intell.html(data);
                    intell.fadeIn();

                    $('#searchresults a').on('click', function(){
                        var a = $(this);
                        $('#img_acp_forum').attr('src', a.data('img')).show();
                        $('#p_acp_forum').text(a.data('titulo')).show();
                        $('#btn_acp_forum').show().on('click', function(){
                            cui_wnd._closeAll();
                            $.ajax({
                                type: "POST",
                                data: 'id='+a.data('id')+'&u=<?php echo $_SESSION['id']; ?>&t=<?php echo $t; ?>',
                                url: 'service/forum/cmd.php',
                                async: true,
                                dataType: "html"
                             }).done(function (data){
                                try {
                                    window.location='';
                                }
                                catch(e){}
                             });
                        });
                        $('#padre_acp_forum').css("padding-bottom", 20);
                    })

                } catch (e) {

                }
             });
        }
    }
    else
    {
        intell.fadeOut();
    }
});



</script>
<?php }else{ ?>

<div class="cui_row">
    <span style="width:100%; float:left; font-size:18px; font-style:italic; padding: 30px 0;">
        Para poder crear un nuevo tema debe iniciar sesi&oacute;n <a id="cui_winlog" class="cui_enlace_login" href="#">(introducir nombre de usuario y contrase&ntilde;a)</a>
    </span>
</div>
<script>

$('#cui_winlog').on('click', function(e){
    e.preventDefault();
    cui_wnd._closeAll();
    cui_wnd._createWND_tamFijo('dlg/login.php', 30);
});

</script>
<?php } ?>