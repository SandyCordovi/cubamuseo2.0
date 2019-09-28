$.cuiForum = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiForum.defaults = {
   tematica: 1
};

$.cuiForum.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiForum.defaults, options );

        $.when( this._create() ).done( function() {
            _self._loadEvents();
        });
    },

    _create : function()
    {
        this.box = this.$el.find('.cui_input_search');
        this.intell = this.$el.find('.cui_intellisense');
    },

    _loadEvents : function()
    {
        var _self = this;

        $('.btn_newpost').on('click', function(){
            cui_wnd._createWND_tamFijo('dlg/forum/newpost.php?t='+_self.options.tematica, 40);
        });

        
    }
};


$.fn.cuiForum = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiForum' );
            if ( !instance ) {
                $.data( this, 'cuiForum', new $.cuiForum( options, this ) );
            }
    });
    return this;
};