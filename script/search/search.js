$.cuiSearch = function(options, element)
{
    this.$el = $( element );
    this._init( options );
};

$.cuiSearch.defaults = {
   cant: 5
};

$.cuiSearch.prototype = {
    _init : function( options )
    {
        var _self = this;
        this.options = $.extend( true, {}, $.cuiSearch.defaults, options );

        $.when( this._create() ).done( function() {
            _self._loadEvents();
        });
    },

    _create : function()
    {
        this.box = this.$el.find('.cui_input_search');
        this.intell = this.$el.find('.cui_intellisense');
        this.va_c = 1;
        this.va_e = 1;
        this.va_t = 1;
    },

    _loadEvents : function()
    {
        var _self = this;

        this.box.on('blur', function(){
            _self.intell.fadeOut();
        });

        this.box.on('keydown', function(e){
            //e.preventDefault();
        });

        this.box.on('keyup', function(e){
            e.preventDefault();
            var key = e.charCode || e.keyCode || 0;
            if(key!=13)
            {                
                var box = $(this);
                if(box.val().length==0)
                {
                    _self.intell.fadeOut();
                    _self.intell.find('.son').remove();
                }
                else
                {
                    $.ajax({
                        type: "POST",
                        data: 's='+_self.box.val(),
                        url: 'service/search/search.php',
                        async: true,
                        dataType: "html"
                     }).done(function (data){
                        try {

                            _self.intell.html(data);
                            _self.intell.fadeIn();

                        } catch (e) {

                        }
                     });
                }
            }
            else
            {
                _self.intell.fadeOut();
            }
        });

        $('#myFormSearch').on('submit', function(e){
            e.preventDefault();
            _self._loadColecciones();
            _self._loadEstampas();
            _self._loadTienda();
        });

        _self._loadColecciones();
        _self._loadEstampas();
        _self._loadTienda();
    },

    _loadColecciones: function()
    {
        var _self = this;
        var o = $('#colecciones');
        o.find('.cui_pag').find('div.btn').off('click');
        $.ajax({
            type: "POST",
            data: 's='+_self.box.val()+'&p='+_self.va_c,
            url: 'service/search/search_colecc.php',
            async: true,
            dataType: "html"
         }).done(function (data){
            try {
                o.find('.cui_result').html(data);
                o.find('.cui_generalload').hide();
                o.find('.cui_result').show();

                o.find('.cui_pag').find('div.btn').on('click', function(e){
                    var b = $(this);
                    _self.va_c = b.data('pag');
                    _self._loadColecciones();
                });
            } catch (e) {

            }
         });
    },

    _loadEstampas: function()
    {
        var _self = this;
        var o = $('#estampa');
        o.find('.cui_pag').find('div.btn').off('click');
        $.ajax({
            type: "POST",
            data: 's='+_self.box.val()+'&p='+_self.va_e,
            url: 'service/search/search_estam.php',
            async: true,
            dataType: "html"
         }).done(function (data){
            try {
                o.find('.cui_result').html(data);
                o.find('.cui_generalload').hide();
                o.find('.cui_result').show();
                o.find('.cui_pag').find('div.btn').on('click', function(e){
                    var b = $(this);
                    _self.va_e = b.data('pag');
                    _self._loadEstampas();
                });
            } catch (e) {

            }
         });
    },

    _loadTienda: function()
    {
        var _self = this;
        var o = $('#tienda');
        o.find('.cui_pag').find('div.btn').off('click');
        $.ajax({
            type: "POST",
            data: 's='+_self.box.val()+'&p='+_self.va_t,
            url: 'service/search/search_tienda.php',
            async: true,
            dataType: "html"
         }).done(function (data){
            try {
                o.find('.cui_result').html(data);
                o.find('.cui_generalload').hide();
                o.find('.cui_result').show();
                o.find('.cui_pag').find('div.btn').on('click', function(e){
                    var b = $(this);
                    _self.va_t = b.data('pag');
                    _self._loadTienda();
                });
            } catch (e) {

            }
         });
    }
};


$.fn.cuiSearch = function( options ) {
    this.each(function() {
            var instance = $.data( this, 'cuiSearch' );
            if ( !instance ) {
                $.data( this, 'cuiSearch', new $.cuiSearch( options, this ) );
            }
    });
    return this;
};