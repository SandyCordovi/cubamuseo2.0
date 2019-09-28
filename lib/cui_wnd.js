$.cuiWND = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiWND.defaults = {
   
};

$.cuiWND.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiWND.defaults, options );

        this.width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

        this.window = $(window);
        this.zindex = 1099;
        this.collwnd = [];
        this.capa = $('.cui_wndfixed');

        $.when( this._create() ).done( function() {
            _self._loadEvents();
        });
    },

    _create : function()
    {

    },

    _loadEvents : function()
    {

    },
    
    _createWND: function(url, complete, close)
    {
        var tamXapp = this._getTamByResolucion();
        if(tamXapp!=-1)
        {
            var tam = tamXapp;
            this._createWND_tamFijo(url, tam, complete, close);
            return;
        }
        var _self = this;
        this.zindex+=2;

        var html = '<div style="top: '+(_self.window.scrollTop()+10)+'px;  width: 100%; float: left; font-size: 0; position: absolute; z-index: '+this.zindex+'"><div class="cui_wnd" >'+
                         '<div class="cui_row">'+
                             '<img class="cui_wndclose" src="images/close_1.jpg" />'+
                         '</div>'+
                         '<div class="cui_row cui_wndload">'+
                                '<div class="wrapper">'+
                                    '<div class="cssload-loader"></div>'+
                                '</div>'+
                         '</div>'+
                         '<div class="cui_row cui_wndcontent">'+

                         '</div>'+
                     '</div></div>';
        var wnd = $(html);
        this.collwnd.push(wnd);
        this.$el.append(wnd);
        this.capa.css('z-index', this.zindex-1);
        this.capa.show();
        this.$el.show();
        wnd.show();
        var wndelemtn = wnd.find('.cui_wnd');
        wndelemtn.addClass('cui_wndshow');        

        if(url)
        {
            $.ajax({
                data: '',
                url: url,
                async: true,
                dataType: "html"
             }).done(function (data){
                try {
                    var pa = $(data);
                    var cont = wnd.find('.cui_wndcontent').append(pa);
                    wnd.find('.cui_wndload').hide();
                    cont.show();
//                    var w=pa[0].offsetWidth;
//                    if(w){
//                        wndelemtn.width(w);
//                    }
                    if(complete)complete();
                } catch (e) {

                }
             });
        }

        wnd.find('.cui_wndclose').on('click', function(){
            _self.zindex-=2;
            _self.capa.css('z-index', _self.zindex-1);
            var p = $(this).parent().parent().parent();
            p.hide();
            p.remove();
            _self.collwnd.length = _self.collwnd.length-1;
            if(_self.collwnd.length==0)
            {
                _self.$el.hide();
                _self.capa.hide();
            }
            if(close)close();
        })
    },

     _createWND_tamFijo: function(url, tam, complete, close)
    {
        var tamXapp = this._getTamByResolucion();
        if(tamXapp!=-1)tam = tamXapp;
        var _self = this;
        this.zindex+=2;

        var html = '<div class="cui_wnd_padre" style="top: '+(_self.window.scrollTop()+10)+'px;  width: 100%; float: left; font-size: 0; position: absolute; z-index: '+this.zindex+'"><div class="cui_wnd_tam_fijo" '+(tam? 'style="width: '+tam+'%;"':'')+' >'+
                         '<div class="cui_row">'+
                             '<img class="cui_wndclose" src="images/close_1.jpg" />'+
                         '</div>'+
                         '<div class="cui_row cui_wndload">'+
                                '<div class="wrapper">'+
                                    '<div class="cssload-loader"></div>'+
                                '</div>'+
                         '</div>'+
                         '<div class="cui_row cui_wndcontent">'+

                         '</div>'+
                     '</div></div>';
        var wnd = $(html);
        this.collwnd.push(wnd);
        this.$el.append(wnd);
        this.capa.css('z-index', this.zindex-1);
        this.capa.show();
        this.$el.show();
        wnd.show();
        var wndelemtn = wnd.find('.cui_wnd_tam_fijo');
        wndelemtn.addClass('cui_wndshow');

        if(url)
        {
            $.ajax({
                data: '',
                url: url,
                async: true,
                dataType: "html"
             }).done(function (data){
                try {
                    var pa = $(data);
                    var cont = wnd.find('.cui_wndcontent').append(pa);
                    wnd.find('.cui_wndload').hide();
                    cont.show();
//                    var w=pa[0].offsetWidth;
//                    if(w){
//                        wndelemtn.width(w);
//                    }
                    if(complete)complete();
                } catch (e) {

                }
             });
        }

        wnd.find('.cui_wndclose').on('click', function(){
            _self.zindex-=2;
            _self.capa.css('z-index', _self.zindex-1);
            var p = $(this).parent().parent().parent();
            p.hide();
            p.remove();
            _self.collwnd.length = _self.collwnd.length-1;
            if(_self.collwnd.length==0)
            {
                _self.$el.hide();
                _self.capa.hide();
            }
            if(close)close();
        });
    },

    _getTamByResolucion: function()
    {
        if(768<=this.width && this.width<=991)return 70;
        if(481<=this.width && this.width<=767)return 80;
        if(320<=this.width && this.width<=480)return 90;
		if(this.width<320)return 95;
        return -1;
    },

    _closeAll: function(){
        var temp = $('.cui_wnd_padre');
        this.zindex -= temp.length*2;
        this.capa.css('z-index', this.zindex-1);
        temp.remove();
        this.$el.hide();
        this.capa.hide();
        this.collwnd.length=0;
    },

    _closeTop: function(){
        var temp = this.collwnd[this.collwnd.length-1];
        this.zindex -= 2;
        this.capa.css('z-index', this.zindex-1);
        temp.remove();
        this.collwnd.length = this.collwnd.length-1;
        if(this.collwnd.length==0){
            this.$el.hide();
            this.capa.hide();
        }
    }
};

$.fn.cuiWND = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiWND' );
            if ( !instance ) {
                $.data( this, 'cuiWND', new $.cuiWND( options, this ) );
            }
    });
    return this;
};