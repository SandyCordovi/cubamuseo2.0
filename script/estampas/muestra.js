$.cuiMuestra = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiMuestra.defaults = {
   id: 14,
   cantXfila: 8
};

$.cuiMuestra.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiMuestra.defaults, options );

        $.when( this._create() ).done( function() {            
            _self._loadEvents();
        });
    },

    _create : function()
    {
       this.$item_actual = -1;
    },

    _loadEvents : function()
    {
        var _self = this;
        window.onload = function(){
            _self._loadPorsion(1);
        }
//        $(window).on('load', function(){
//            _self._loadPorsion(1);
//        })
    },

    _loadPorsion: function(s)
    {
        this.dimencion = (this.$el.width() - 20*this.options.cantXfila)/this.options.cantXfila;
        var _self = this;
        $.ajax({
            data: 'id='+_self.options.id+'&s='+s+'&cxf='+_self.options.cantXfila+'&d='+_self.dimencion+'&all=0',
            url: 'service/estampas/muestra.php',
            async: true,
            dataType: "html"
         }).done(function (data){
            try 
            {
                _self.$el.find('.cui_generalload').remove();
                _self.$el.find('.son').remove();
                _self.$el.append(data);

                $('.cui_pag_gal').find('.pag_step').on('click', function(){
                    $('.cui_pag_gal').remove();
                    var load = '<div class="cui_generalload">'+
                                    '<div class="wrapper">'+
                                        '<div class="cssload-loader"></div>'+
                                    '</div>'+
                                 '</div>';
                    _self.$el.append(load);
                    _self._loadPorsion(s+1);
                });
                $('.cui_pag_gal').find('.pag_all').on('click', function(){
                    $('.cui_pag_gal').remove();
                    _self._loadAllGal(s+1);
                });
                
                $('a.cui_gal_item_cat').off();
                $('a.cui_gal_item_cat').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/estampas/muestra.php?id='+_self.$item_actual+'&m='+_self.options.id, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });

                        $('.cui_img_ozoom').on('click', function(){
                            cui_wnd._createWND('dlg/estampas/zoom.php?id='+_self.$item_actual+'&m='+_self.options.id, function(){
                                $('.cui_prev').off();
                                $('.cui_prev').on('click', function(){
                                    _self._prev();
                                });

                                $('.cui_next').off();
                                $('.cui_next').on('click', function(){
                                    _self._next();
                                });
                            });
                        })
                    });
                });
            } 
            catch (e)
            {

            }
         });
    },

    _loadAllGal: function(s)
    {
        this.dimencion = (this.$el.width() - 20*this.options.cantXfila)/this.options.cantXfila;
        var _self = this;
        var load = '<div class="cui_generalload">'+
                        '<div class="wrapper">'+
                            '<div class="cssload-loader"></div>'+
                        '</div>'+
                     '</div>';
        _self.$el.append(load);
        
        $.ajax({
            data: 'id='+_self.options.id+'&s='+s+'&cxf='+_self.options.cantXfila+'&d='+_self.dimencion+'&all=1',
            url: 'service/estampas/muestra.php',
            async: true,
            dataType: "html"
         }).done(function (data){
            try
            {
                _self.$el.find('.cui_generalload').remove();
                _self.$el.find('.son').remove();
                _self.$el.append(data);

                $('a.cui_gal_item_cat').off();
                $('a.cui_gal_item_cat').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/estampas/muestra.php?id='+_self.$item_actual+'&m='+_self.options.id, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });

                        $('.cui_img_ozoom').on('click', function(){
                            cui_wnd._createWND('dlg/estampas/zoom.php?id='+_self.$item_actual+'&m='+_self.options.id, function(){
                                $('.cui_prev').off();
                                $('.cui_prev').on('click', function(){
                                    _self._prev();
                                });

                                $('.cui_next').off();
                                $('.cui_next').on('click', function(){
                                    _self._next();
                                });
                            });
                        })
                    });
                });
            }
            catch (e)
            {

            }
         });
    },

    _prev: function()
    {
        $('.cui_img_gal_nav').attr('src', 'images/load.gif');
        var _self = this;
        $.ajax({
            data: 'id='+_self.$item_actual+'&idM='+_self.options.id+'&sent=-1',
            url: 'service/estampas/navegacion.php',
            async: true,
            dataType: "json"
         }).done(function (data){
            try
            {
                $('.cui_img_ozoom').attr('src', data.url);
                $('.cui_img_zoom').attr('src', data.urlZoom);
                _self.$item_actual = data.id;

                $('.cui_titulo_nav').text(data.nombre+' | '+data.titulo);
                $('.cui_descr_nav').text(data.descripcion);

                if($('#cat_'+data.id).length==0)
                {
                   // alert("Paso");
                }
            }
            catch (e)
            {

            }
         });
    },

    _next: function()
    {
        $('.cui_img_gal_nav').attr('src', 'images/load.gif');
        var _self = this;
        $.ajax({
            data: 'id='+_self.$item_actual+'&idM='+_self.options.id+'&sent=1',
            url: 'service/estampas/navegacion.php',
            async: true,
            dataType: "json"
         }).done(function (data){
            try
            {
                $('.cui_img_ozoom').attr('src', data.url);
                $('.cui_img_zoom').attr('src', data.urlZoom);
                _self.$item_actual = data.id;

                $('.cui_titulo_nav').text(data.nombre+' | '+data.titulo);
                $('.cui_descr_nav').text(data.descripcion);

                if($('#cat_'+data.id).length==0)
                {
                    //alert("Paso");
                }
            }
            catch (e)
            {

            }
         });
    }
};


$.fn.cuiMuestra = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiMuestra' );
            if ( !instance ) {
                $.data( this, 'cuiMuestra', new $.cuiMuestra( options, this ) );
            }
    });
    return this;
};