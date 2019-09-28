function ShowWindow(url, func)
{
    $(".cuiadmin_fondo").fadeIn();
    $.ajax({
        data: '',
        url: url,
        async: true,
        dataType: "html"
    }).done(function (data){
        try {
            $('.cuiadmin_content').append(data);
            $('.cuiadmin_load').hide();
            $('.cuiadmin_wnd').show(0, function(){
                 if(func)func();
            });
           
        } catch (e) {

        }
    });

}
function HideWindow()
{
    $('.cuiadmin_fondo').hide();
    $('.cuiadmin_content .son').remove();  
    $('.cuiadmin_wnd').hide();
    $('.cuiadmin_load').show();
}