$.cuiTienda = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiTienda.defaults = {
   id: 1
};

$.cuiTienda.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiTienda.defaults, options );

        $.when( this._create() ).done( function() {
            _self._loadEvents();
        });
    },

    _create : function()
    {
       
    },

    _loadEvents : function()
    {
       var _self = this;
       
       $('.cui_item_tienda').on('click', function(){
           cui_wnd._createWND('dlg/tienda/zoom.php?id='+_self.options.id, function(){});
       });

       $('.view_car').on('click', function(e){
            e.preventDefault();
            cui_wnd._createWND_tamFijo('dlg/cart.php', 50);
        });

       $('#add_car_shop').on('click', function(){
           $(this).hide();
           $('#add_car_shop_load').show();

           var envio = '';
           $('.cui_envio_shop').each(function (index, domEle){
               if(domEle.checked)
               {
                   envio = $(domEle).val();
               }
           })

           $.ajax({
                type: "POST",
                data: 'cmd=1&item='+_self.options.id+'&e='+envio,
                url: 'service/cart.php',
                async: true,
                dataType: "html"
             }).done(function (data){
                try {                    
                    $('.cui_car_notif').html(data);
                    $('#add_car_shop_load').hide();
                    $('.cui_car_notif').show();
                    $('.view_car').on('click', function(e){
                        e.preventDefault();
                        cui_wnd._createWND_tamFijo('dlg/cart.php', 50);
                    });
                } catch (e) {

                }
             })

       });
    }
};


$.fn.cuiTienda = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiTienda' );
            if ( !instance ) {
                $.data( this, 'cuiTienda', new $.cuiTienda( options, this ) );
            }
    });
    return this;
};