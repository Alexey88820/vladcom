// $(function(){
//     // $('.section-on-main').equalHeights();

//     $('.show-more').click(function(){
//         $(this).next('.more').toggle("fast");
//     });
// });

var Catalog = {
    init: function( config ){
        this.config = config,

        this.bindEvents();


    },

    bindEvents: function(){
        var self = Catalog;
        this.config.showMoreLink.on( 'click', function() {
            $(this).next(self.config.showMoreBlock).slideToggle();
        } );

    }
}

$(function(){

    $('.section-toggle').on('click', function(e){
        $(this).next('.section-content').slideToggle(100);
        e.preventDefault();
    });

    Catalog.init({
        showMoreLink: $('tr.show-more'),
        showMoreBlock: $('tr.more')
    });

});