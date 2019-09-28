$.cuiScene = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiScene.defaults = {
   
   css: {},
   pin: "",
   duracion: 0,
   offset: 0,
   limite: {},
   from: {
       x: 0,
       y: 0,
       scale: 1,
       rotate: 0,
       opacidad: -1
   },
   to: {
       x: 0,
       y: 0,
       scale: 1,
       rotate: 0,
       opacidad: -1
   },
   stopup: 0,
   stopdown: 0
};

$.cuiScene.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiScene.defaults, options );

        this.window = $(window);
        var InterExp = navigator.userAgent.indexOf("MSIE") != -1; // Si es IE
        this.h_screen = InterExp ? window.screen.height : window.innerHeight;
        this.w_screen = InterExp ? window.screen.width : window.innerWidth;
        this.w_viewport = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        this.h_viewport = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        this.h_scroll = document.body.scrollHeight;

        this.scale = 1;
        this.rotate = 0;
        this.x = 0;
        this.y=0
        this.opacidad = 1;

        this.pX=0;
        this.pY=0;
        this.pRotate = 0;
        this.pScale = 1;
        this.pOpacidad = 1;

        this.puX=0;
        this.puY=0;
        this.puRotate = 0;
        this.puScale = 1;
        this.puOpacidad = 1;

        this.pdX=0;
        this.pdY=0;
        this.pdRotate = 0;
        this.pdScale = 1;
        this.pdOpacidad = 1;

        this.up=1;
        this.down=0;
        this.event_scroll = false;

        $.when( this._createScene() ).done( function() {
            _self._loadEvents();
        });
    },

    _createScene : function()
    {
        var temp = this.$el.clone();
        var tempP = this.$el.parent();

        if(this.options.pin)
        {
            this.pin = $(this.options.pin);
            this.pin.addClass('cuiPin');
        }
        if(!this.pin)
        {

            this.$el.remove();
            tempP.append('<div class="cuiPin"></div>');
            this.pin = $("div.cuiPin", tempP);
            this.pin.append(temp);
            this.$el = temp
        }

        if(this.options.duracion>0)
        {
            this.h_scroll = document.body.scrollHeight;

            var mb = this.$el.css('margin-bottom') ? this.$el.css('margin-bottom').substr(0, this.$el.css('margin-bottom').length-2) : 0;
            var padding = this.h_scroll < this.h_screen ?  this.options.duracion + Math.abs(this.options.offset) : 0;

            var pb = this.pin.css('padding-bottom').substr(0, this.pin.css('padding-bottom').length-2);
            pb = pb ? parseInt(pb) : 0;
            this.pin.css('padding-bottom', (Math.max(padding, pb))  + 'px');

            this.h_scroll = document.body.scrollHeight;
        }

        this._createPortions();

        this.$el.css('-ms-transition-duration', '1.6s');
        this.$el.css('-webkit-transition-duration', '1.6s');
        this.$el.css('-moz-transition-duration', '1.6s');
        this.$el.css('transition-duration', '1.6s');

        this.$el.css('-ms-transform', 'scale('+this.options.from.scale+','+this.options.from.scale+') ' + 'rotate('+this.options.from.rotate+'deg) ' + 'translate('+this.options.from.x+'px, '+this.options.from.y+'px)');
        this.$el.css('-webkit-transform', 'scale('+this.options.from.scale+','+this.options.from.scale+') ' + 'rotate('+this.options.from.rotate+'deg) ' + 'translate('+this.options.from.x+'px, '+this.options.from.y+'px)');
        this.$el.css('-moz-transform', 'scale('+this.options.from.scale+','+this.options.from.scale+') ' + 'rotate('+this.options.from.rotate+'deg) ' + 'translate('+this.options.from.x+'px, '+this.options.from.y+'px)');
        this.$el.css('transform', 'scale('+this.options.from.scale+','+this.options.from.scale+') ' + 'rotate('+this.options.from.rotate+'deg) ' + 'translate('+this.options.from.x+'px, '+this.options.from.y+'px)');
        if(this.options.from.opacidad!=-1)this.$el.css('opacity', this.options.from.opacidad);
    },

    _loadEvents : function()
    {
        var _self = this;
    },

    _scrollControl: function(move_scroll){
        var o = this;
        if(o.window.scrollTop()-(o.pin.offset().top - o.options.offset) >= 0 && o.window.scrollTop()-(o.pin.offset().top - o.options.offset) <= o.options.duracion )
        {
            var hay = false;
            var scale = "", rotate = "", translate="";
            if(o.options.to.scale!=1)
            {
                o.scale = o.options.from.scale + (move_scroll==1 ? o.puScale : o.pdScale)*(o.window.scrollTop()-(o.pin.offset().top - o.options.offset));
                scale = 'scale('+o.scale+','+o.scale+')';
                hay = true;
            }

            if(o.options.to.rotate!=0)
            {
                o.rotate = o.options.from.rotate + (move_scroll==1 ? o.puRotate : o.pdRotate)*(o.window.scrollTop()-(o.pin.offset().top - o.options.offset));
                rotate = 'rotate('+o.rotate+'deg)';
                hay = true;
            }

            if(o.options.to.x!=0 || o.options.to.y!=0)
            {
                o.x = o.options.from.x + (move_scroll==1 ? o.puX : o.pdX)*(o.window.scrollTop()-(o.pin.offset().top - o.options.offset));
                o.y = o.options.from.y + (move_scroll==1 ? o.puY : o.pdY)*(o.window.scrollTop()-(o.pin.offset().top - o.options.offset));
                translate = 'translate('+o.x+'px, '+o.y+'px)';
                hay = true;                
            }

            if(o.options.to.opacidad!=-1)
            {
                o.opacidad = o.options.from.opacidad + (move_scroll==1 ? o.puOpacidad : o.pdOpacidad)*(o.window.scrollTop()-(o.pin.offset().top - o.options.offset));
                hay = true;
            }

            if(hay)
            {
//                o.$el.css('-ms-transition-duration', '0s');
//                o.$el.css('-webkit-transition-duration', '0s');
//                o.$el.css('-moz-transition-duration', '0s');
//                o.$el.css('transition-duration', '0s');
//                
//                o.$el.css('-ms-transition-duration', '1.6s');
//                o.$el.css('-webkit-transition-duration', '1.6s');
//                o.$el.css('-moz-transition-duration', '1.6s');
//                o.$el.css('transition-duration', '1.6s');

                o.$el.css('-ms-transform', scale + ' ' + rotate + ' ' + translate);
                o.$el.css('-webkit-transform', scale + ' ' + rotate + ' ' + translate);
                o.$el.css('-moz-transform', scale + ' ' + rotate + ' ' + translate);
                o.$el.css('transform', scale + ' ' + rotate + ' ' + translate);
                if(o.options.to.opacidad!=-1)o.$el.css('opacity', o.opacidad);
            }
        }
    },

    _scrollStop: function()
    {
        
    },

    _createPortions: function()
    {
        var porciento = 0/100;
        if(this.options.to.scale!=1)
        {
            this.pScale = (this.options.to.scale-this.options.from.scale)/this.options.duracion;
            var u = (this.options.to.scale-this.options.from.scale) - (this.options.to.scale-this.options.from.scale)*porciento;
            this.puScale = u/this.options.duracion;
            var d = (this.options.to.scale-this.options.from.scale) + (this.options.to.scale-this.options.from.scale)*porciento;
            this.pdScale = d/this.options.duracion;
        }
        if(this.options.to.rotate!=0)
        {
            this.pRotate = (this.options.to.rotate-this.options.from.rotate)/this.options.duracion;
            var u = (this.options.to.rotate-this.options.from.rotate) - (this.options.to.rotate-this.options.from.rotate)*porciento;
            this.puRotate = u/this.options.duracion;
            var d = (this.options.to.rotate-this.options.from.rotate) + (this.options.to.rotate-this.options.from.rotate)*porciento;
            this.pdRotate = d/this.options.duracion;
        }
        if(this.options.to.x!=0)
        {
            this.pX = (this.options.to.x-this.options.from.x)/this.options.duracion;
            var u = (this.options.to.x-this.options.from.x) - (this.options.to.x-this.options.from.x)*porciento;
            this.puX = u/this.options.duracion;
            var d = (this.options.to.x-this.options.from.x) + (this.options.to.x-this.options.from.x)*porciento;
            this.pdX = d/this.options.duracion;
        }
        if(this.options.to.y!=0)
        {
            this.pY = Math.abs(this.options.to.y-this.options.from.y)/this.options.duracion;
            var u = (this.options.to.y-this.options.from.y) - (this.options.to.y-this.options.from.y)*porciento;
            this.puY = u/this.options.duracion;
            var d = (this.options.to.y-this.options.from.y) + (this.options.to.y-this.options.from.y)*porciento;
            this.pdY = d/this.options.duracion;
        }
        if(this.options.to.opacidad!=-1)
        {
            this.pOpacidad = (this.options.to.opacidad-this.options.from.opacidad)/this.options.duracion;
            var u = (this.options.to.opacidad-this.options.from.opacidad) - (this.options.to.opacidad-this.options.from.opacidad)*porciento;
            this.puOpacidad = u/this.options.duracion;
            var d = (this.options.to.opacidad-this.options.from.opacidad) + (this.options.to.opacidad-this.options.from.opacidad)*porciento;
            this.pdOpacidad = d/this.options.duracion;
        }
    }
};

$.fn.cuiScene = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiScene' );
            if ( !instance ) {
                $.data( this, 'cuiScene', new $.cuiScene( options, this ) );
            }
    });
    return this;
};