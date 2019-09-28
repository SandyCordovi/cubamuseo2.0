$.cuiAnime = function(options)
{
    this._init( options );
};

$.cuiAnime.defaults = {
   cuiScenes: []
};

$.cuiAnime.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiAnime.defaults, options );

        this.window = $(window);
        this.scroll_star = 0;
        
        $.when( this._createAnime() ).done( function() {
            _self._loadEvents();
        });
    },
    
    _createAnime : function()
    {
        this.scroll_star = this.window.scrollTop();
    },

    _loadEvents : function()
    {
        var _self = this;
        this.window.on('scroll', function(e){
            var move_scroll =  _self.scroll_star - _self.window.scrollTop() <= 0 ? 1 : -1;
            _self.scroll_star = _self.window.scrollTop();
            var scenes = _self.options.cuiScenes;
            for(var i=0; i<scenes.length; i++)
            {
                scenes[i]._scrollControl(move_scroll);
            }
        });

//        $(window).on('scrollstart', function() {
//            _self.scroll_star = _self.window.scrollTop();
//        });

//        $(window).on('scrollstop', function() {
//            var scenes = _self.options.cuiScenes;
//            for(var i=0; i<scenes.length; i++)
//            {
//                scenes[i]._scrollStop();
//            }
//        });
    }
};

$.fn.cuiAnime = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiAnime' );
            if ( !instance ) {
                $.data( this, 'cuiAnime', new $.cuiAnime( options, this ) );
            }
    });
    return this;
};


window.requestAnimFrame = (function() {
        return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function(callback) {
                window.setTimeout(callback, 1000 / 60);
        };
})();

window.cancelRequestAnimFrame = ( function() {
        return window.cancelAnimationFrame          ||
        window.webkitCancelRequestAnimationFrame    ||
        window.mozCancelRequestAnimationFrame       ||
        window.oCancelRequestAnimationFrame         ||
        window.msCancelRequestAnimationFrame        ||
        clearTimeout
} )();