$.cuiPostal = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiPostal.defaults = {
   id: 14,
   cantXfila: 7,
    l: 'es'
};

$.cuiPostal.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiPostal.defaults, options );

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

        $('#personalizar').on('click', function(){
            cui_wnd._createWND_tamFijo('dlg/vpost/paint.php?id='+_self.options.id, 60,function(){_self._paint()});
        });

        $('#cui_img_vp_send_real').on('click', function(){
            cui_wnd._createWND_tamFijo('dlg/vpost/paint.php?id='+_self.options.id, 60,function(){_self._paint()});
        });

        $("#myFormPost").on('submit', function(e)
        {
            e.preventDefault();
            $('#cui_url_send_vp').val($('#cui_img_vp_send_real').attr('src'));
            $('.cui_postales_box').hide();
            $('#cui_load_envio').fadeIn();
            var $form = $(this);
            var postData = $form.serializeArray();
            var formURL = $form.attr("action");
            $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR)
                {
                    if(data.salida.type==1)
                    {
                        $('.cui_postales_box #cui_notif_log').text(data.salida.msg);
                        $('#cui_load_envio').hide();
                        $('.cui_postales_box').fadeIn();
                    }
                    else if(data.salida.type==0)
                    {
                        $('#cui_notif_envio p').text(data.salida.msg);
                        $('#cui_notif_envio div.cui_btn_blue').text(data.salida.action);
                        $('#cui_load_envio').hide();
                        $('#cui_notif_envio').fadeIn();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {

                }
            });
        });

        $('#cui_notif_envio div.cui_btn_blue').on('click', function(e){
            $('#pemail').val('');
            $('#pnombre').val('');
            $('#cui_notif_log').text('');
            $('#cui_notif_envio').hide();
            $('.cui_postales_box').fadeIn();
        });
    },

    _loadPorsion: function(s)
    {
        this.dimencion = (this.$el.width() - 20*this.options.cantXfila)/this.options.cantXfila;
        var _self = this;
        $.ajax({
            data: 'id='+_self.options.id+'&s='+s+'&cxf='+_self.options.cantXfila+'&d='+_self.dimencion+'&all=0&l='+_self.options.l,
            url: 'service/vpost/postales.php',
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
                
                $('.cui_gal_item_cat a.click_item').off();
                $('.cui_gal_item_cat a.click_item').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/vpost/zoom.php?id='+_self.$item_actual+'&p='+_self.options.id+'&l='+_self.options.l, function(){
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

                $('.ver_zoom').off();
                $('.ver_zoom').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/vpost/zoom.php?id='+_self.$item_actual+'&p='+_self.options.id+'&l='+_self.options.l, function(){
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
            url: 'service/vpost/postales.php',
            async: true,
            dataType: "html"
         }).done(function (data){
            try
            {
                _self.$el.find('.cui_generalload').remove();
                _self.$el.find('.son').remove();
                _self.$el.append(data);

                $('.cui_gal_item_cat a.click_item').off();
                $('.cui_gal_item_cat a.click_item').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/vpost/zoom.php?id='+_self.$item_actual+'&p='+_self.options.id+'&l='+_self.options.l, function(){
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

                $('.ver_zoom').off();
                $('.ver_zoom').on('click', function(e){
                    e.preventDefault();
                    _self.$item_actual = +$(this).data('id');
                    cui_wnd._createWND('dlg/vpost/zoom.php?id='+_self.$item_actual+'&p='+_self.options.id+'&l='+_self.options.l, function(){
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
            data: 'id='+_self.$item_actual+'&idP='+_self.options.id+'&sent=-1&l='+_self.options.l,
            url: 'service/vpost/navegacion.php',
            async: true,
            dataType: "json"
         }).done(function (data){
            try
            {
                $('.cui_img_ozoom').attr('src', data.url);
                $('.cui_img_zoom').attr('src', data.urlZoom);
                _self.$item_actual = data.id;

                $('.cui_titulo_nav').text(data.nombre);
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
            data: 'id='+_self.$item_actual+'&idP='+_self.options.id+'&sent=1&l='+_self.options.l,
            url: 'service/vpost/navegacion.php',
            async: true,
            dataType: "json"
         }).done(function (data){
            try
            {
                $('.cui_img_ozoom').attr('src', data.url);
                $('.cui_img_zoom').attr('src', data.urlZoom);
                _self.$item_actual = data.id;

                $('.cui_titulo_nav').text(data.nombre);
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
    },

    _paint: function()
    {
        var paint = new $.Paint('#cui_img_paint', '#cui_box_paint');
    }
};

$.Paint = function(img, box)
{
    this._init($(img), $(box));
};

$.Paint.prototype = {
    _init : function($img, $box)
    {
        var _self = this;
        this.$img = $img;
        this.$box = $box;

        this.img_w = this.$img.width();
        this.img_h = this.$img.height();
        this.img_l = this.$img[0].offsetLeft;
        this.img_t = this.$img[0].offsetTop;

        
        
        $.when( this._create() ).done( function() {
            _self._loadEvents();
        });
    },

    _create : function()
    {
        this.$box.css({
            "width" : this.img_w*3/4,
            "left" : this.img_l+"px",
            "top" : this.img_t+"px"
        });

        $( "#cui_box_paint" ).resizable({
            containment: "#cui_img_paint"
        });
        $( "#cui_box_paint" ).draggable({
            containment: "#cui_img_paint" ,
            handle: "#handle"
        });        
    },

    _loadEvents : function()
    {
        var _self=this;

        if($('#isedit_vp').val()==0)
        {
            this.$img.attr('src', 'service/ri.php?'+$('#cui_url_base').val());
        }
        else
        {
            this.$img.attr('src', $('#cui_img_vp_send_real').attr('src'));
        }

        this.$img.on('load', function(){
            _self.$box.hide();
            $('#cui_txt_vp').val('');
            _self.img_w = _self.$img.width();
            _self.img_h = _self.$img.height();
            _self.img_l = _self.$img[0].offsetLeft;
            _self.img_t = _self.$img[0].offsetTop;
           _self.$box.css({
                "width" : _self.img_w*3/4,
                "height": "200px",
                "left" : _self.img_l+"px",
                "top" : _self.img_t+"px"
            });
            _self.$box.fadeIn();
        });

        $('#colorSelector').colorPicker({
            buildCallback: function($elm) {
                this.$colorPatch = $elm.prepend('<div class="cp-disp">').find('.cp-disp');
            },
            cssAddon:
                '.cp-color-picker{z-index: '+cui_wnd.zindex+';}'+
                '.cp-disp {padding:10px; margin-bottom:6px; font-size:15px; height:30px; line-height:8px}' +
                '.cp-xy-slider {width:200px; height:200px;}' +
                '.cp-xy-cursor {width:16px; height:16px; border-width:2px; margin:-8px}' +
                '.cp-z-slider {height:200px; width:30px;}' +
                '.cp-z-cursor {border-width:8px; margin-top:-8px;}' +
                '.cp-alpha {height:0px;}' +
                '.cp-alpha-cursor {border-width:0px; margin-left:0px;}',

            renderCallback: function($elm, toggled) {
                var colors = this.color.colors;
                this.$colorPatch.css({
                    backgroundColor: '#' + colors.HEX,
                    color: colors.RGBLuminance > 0.22 ? '#222' : '#ddd'
                }).text('#' + colors.HEX);

                $('#cui_txt_vp').css('color', '#' + colors.HEX);
                $('#cui_color_hi').val(colors.HEX);
            }
        });

        $('#cui_font_size').on('change', function(){
            _self.$box.find('textarea').css('font-size', $(this).val()+'pt');
        });

        $('#cui_font_family').on('change', function(){
            _self.$box.find('textarea').css('font-family', $(this).val());
            $(this).css('font-family', $(this).val());
        });

        $('#vprevia_vp').on('click', function(){
            var url = "service/rivpost.php?";
            var base = $('#cui_url_base').val();
            url+=base;
            url+="&color="+$('#cui_color_hi').val();
            url+="&font="+$("#cui_font_family").val();
            url+="&font_size="+$("#cui_font_size").val();
            url+="&x="+(_self.$box[0].offsetLeft - _self.$img[0].offsetLeft);
            url+="&y="+(_self.$box[0].offsetTop - _self.$img[0].offsetTop);
            url+="&txt="+_self.$box.find('textarea').val();
            url+="&w="+_self.$box.find('textarea').width();
            url+="&h="+_self.$box.find('textarea').height();

            cui_wnd._createWND_tamFijo('dlg/vpost/vistaprevia.php', 60,function(){
                $('#cui_img_vistaprevia').attr('src', url);
            });
        });

        $('#salvar_vp').on('click', function(){
            var url = "service/rivpost.php?";
            var base = $('#cui_url_base').val();
            url+=base;
            url+="&color="+$('#cui_color_hi').val();
            url+="&font="+$("#cui_font_family").val();
            url+="&font_size="+$("#cui_font_size").val();
            url+="&x="+(_self.$box[0].offsetLeft - _self.$img[0].offsetLeft);
            url+="&y="+(_self.$box[0].offsetTop - _self.$img[0].offsetTop);
            url+="&txt="+_self.$box.find('textarea').val();
            url+="&w="+_self.$box.find('textarea').width();
            url+="&h="+_self.$box.find('textarea').height();
            $('#cui_img_vp_send_real').attr('src', 'images/load.gif');
            $('#cui_img_vp_send_real').attr('src', url);
            $('#isedit_vp').val('1');
            cui_wnd._closeAll();
        });
    }
};

$.fn.cuiPostal = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiPostal' );
            if ( !instance ) {
                $.data( this, 'cuiPostal', new $.cuiPostal( options, this ) );
            }
    });
    return this;
};