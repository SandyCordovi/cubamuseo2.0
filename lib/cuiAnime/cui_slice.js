$.cuiGalery = function( options, element )
{
    this.$el = $( element );
    this._init( options );
};

$.cuiGalery.defaults = {
    height: 'auto',
    titulo: "",
    fecha: "",
    intervalo: false,
    nombres: [],
    visibles: 1,
    controles: false
};

$.cuiGalery.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiGalery.defaults, options );
        this.$ul = $('ul', this.$el);
        this.$li = $('li', this.$ul);
        this.$img = $('div.cui_slice div.cui_img', this.$li);
        this.$info = $('div.cui_slice div.cui_info', this.$li);
        this.$prev = $('.cuiPrev', this.$el);
        this.$next = $('.cuiNext', this.$el);
        this.$titulo = $('.cuiTitulo', this.$el).html(this.options.titulo);
        if(!this.options.titulo)this.$titulo.hide();
        this.$nombre = $('.cuiNombre', this.$el).text(this.options.nombres.length>0 ? this.options.nombres[0] : '');
        if(this.options.nombres.length==0)this.$nombre.hide();
        this.va=0;
        this.height = this.options.height;
        this.$ul.css('marginLeft', "0%");
        this.intervalo = this.options.intervalo;
        $.when( this._createGalery() ).done( function() {
            _self._loadEvents();
        });
    },

    _createGalery : function()
    {
        //this.$el.css('height', this.height+'px');

        this.$ul.css('width', (this.$li.length*100/this.options.visibles)+'%');
        this.$li.css('width', (100/this.$li.length)+'%');
        if(this.options.height!='auto')
        {
            this.$ul.css('height', this.height+'px');
            this.$li.css('height', this.height+'px');
            //this.$img.css('height', this.height+'px');
            //this.$info.css('height', this.height+'px');
            this.$prev.css('height', this.height+'px');
            this.$next.css('height', this.height+'px');
        }
        if(this.$li.length<=this.options.visibles || !this.options.controles)
        {
            this.$prev.hide();
            this.$next.hide();
            this.$li.css('padding', '0px');
        }
        else
        {
            this.$li.css('padding', '0px 25px');
        }
    },

     _loadEvents : function(){
        var _self = this;
        this.$prev.off();
        this.$next.off();
        this.$prev.on('click', function(){
            _self.va--;
            if(_self.va<0)
            {
                _self.va=_self.$li.length-1;
            }
            _self.$ul.animate({
                'marginLeft': -(_self.va*100/_self.options.visibles)+"%"
            }, 300);
            _self.$nombre.text(_self.options.nombres.length>_self.va ? _self.options.nombres[_self.va] : '');
        });

        var next = function()
        {
             _self.va++;
            if(_self.va>=_self.$li.length)
            {
                _self.va=0;
            }
             _self.$ul.animate({
                'marginLeft': -(_self.va*100/_self.options.visibles)+"%"
            }, 300);
            _self.$nombre.text(_self.options.nombres.length>_self.va ? _self.options.nombres[_self.va] : '');
        };

        this.$next.on('click', function(){
           next();
        });

        if(_self.intervalo && _self.$li.length>_self.options.visibles)
        {
           $.timer(_self.intervalo, function(){
                next();
           })
        }
     }
};


$.fn.cuiGalery = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiGalery' );
            if ( !instance ) {
                $.data( this, 'cuiGalery', new $.cuiGalery( options, this ) );
            }
    });
    return this;
};