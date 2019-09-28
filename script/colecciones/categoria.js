$.cuiCategoria = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiCategoria.defaults = {
   id: 1,
   cantXfila: 7,
   l: 'es'
};

$.cuiCategoria.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiCategoria.defaults, options );

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

		
    },

    _loadPorsion: function(s)
    {
        this.dimencion = (this.$el.width() - 20*this.options.cantXfila)/this.options.cantXfila;
        var _self = this;
        $.ajax({
            data: 'id='+_self.options.id+'&s='+s+'&cxf='+_self.options.cantXfila+'&d='+_self.dimencion+'&all=0&l='+_self.options.l,
            url: 'service/colecciones/categoria.php',
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
                
                $('.cui_gal_item_cat a').off();
                $('.cui_gal_item_cat a').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/colecciones/categoria.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });

                        $('.cui_img_ozoom').on('click', function(){
                            cui_wnd._createWND('dlg/colecciones/zoom.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
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
                
                $('.ver_detalle').off();
                $('.ver_detalle').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/colecciones/categoria.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });

                        $('.cui_img_ozoom').on('click', function(){
                            cui_wnd._createWND('dlg/colecciones/zoom.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
                                $('.cui_prev').off();
                                $('.cui_prev').on('click', function(){
                                    _self._prev();
                                });

                                $('.cui_next').off();
                                $('.cui_next').on('click', function(){
                                    _self._next();
                                });
                            });
                        });
                    });
                });

                $('.ver_zoom').off();
                $('.ver_zoom').on('click', function(){
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/colecciones/zoom.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });
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
            data: 'id='+_self.options.id+'&s='+s+'&cxf='+_self.options.cantXfila+'&d='+_self.dimencion+'&all=1&l='+_self.options.l,
            url: 'service/colecciones/categoria.php',
            async: true,
            dataType: "html"
         }).done(function (data){
            try
            {
                _self.$el.find('.cui_generalload').remove();
                _self.$el.find('.son').remove();
                _self.$el.append(data);

                $('.cui_gal_item_cat a').off();
                $('.cui_gal_item_cat a').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/colecciones/categoria.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });

                        $('.cui_img_ozoom').on('click', function(){
                            cui_wnd._createWND('dlg/colecciones/zoom.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
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

                $('.ver_detalle').off();
                $('.ver_detalle').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/colecciones/categoria.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });

                        $('.cui_img_ozoom').on('click', function(){
                            cui_wnd._createWND('dlg/colecciones/zoom.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
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

                $('.ver_zoom').off();
                $('.ver_zoom').on('click', function(){
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/colecciones/zoom.php?id='+_self.$item_actual+'&c='+_self.options.id+'&l='+_self.options.l, function(){
                        $('.cui_prev').off();
                        $('.cui_prev').on('click', function(){
                            _self._prev();
                        });

                        $('.cui_next').off();
                        $('.cui_next').on('click', function(){
                            _self._next();
                        });
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
            data: 'id='+_self.$item_actual+'&idCat='+_self.options.id+'&sent=-1&l='+_self.options.l,
            url: 'service/colecciones/navegacion.php',
            async: true,
            dataType: "json"
         }).done(function (data){
            try
            {
                $('.cui_img_ozoom').attr('src', data.url);
                $('.cui_img_zoom').attr('src', data.urlZoom);
                _self.$item_actual = data.id;

                $('.cui_titulo_nav').text(data.nombre+' | '+data.titulo);
                $('.cui_descr_nav').html(data.descripcion);
                $('.cui_emision_nav').text(data.emision);
                $('.cui_color_nav').text(data.color);
                $('.cui_material_nav').text(data.material);
                $('.cui_impresion_nav').text(data.impresion);
                $('.cui_dimension_nav').text(data.dimension);
                $('.cui_precio_nav').text(data.precio);

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
            data: 'id='+_self.$item_actual+'&idCat='+_self.options.id+'&sent=1&l='+_self.options.l,
            url: 'service/colecciones/navegacion.php',
            async: true,
            dataType: "json"
         }).done(function (data){
            try
            {
                $('.cui_img_ozoom').attr('src', data.url);
                $('.cui_img_zoom').attr('src', data.urlZoom);
                _self.$item_actual = data.id;

                $('.cui_titulo_nav').text(data.nombre+' | '+data.titulo);
                $('.cui_descr_nav').html(data.descripcion);
                $('.cui_emision_nav').text(data.emision);
                $('.cui_color_nav').text(data.color);
                $('.cui_material_nav').text(data.material);
                $('.cui_impresion_nav').text(data.impresion);
                $('.cui_dimension_nav').text(data.dimension);
                $('.cui_precio_nav').text(data.precio);

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


$.fn.cuiCategoria = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiCategoria' );
            if ( !instance ) {
                $.data( this, 'cuiCategoria', new $.cuiCategoria( options, this ) );
            }
    });
    return this;
};