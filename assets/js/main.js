$(function(){
    $( '.sidebar' ).height( $( '.content-on-main' ).height() );


    $( '.item-more-link' ).on( 'click', function ( e ) {
        $( this ).next( '.item-more-content' ).slideToggle( 'fast' );
        e.preventDefault();
    });

});
