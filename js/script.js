(function( $ ) {

	$( 'document' ).ready( function() {

		$( '.exitButton' ).click( function() {
			$( '.navbar-toggle' ).trigger( 'click' );
		});

		$( '#foodrecipe-post-display' ).change( function() {
			$.ajax( {
				method: "POST",
				url: foodrecipe_object.ajax_url,
				data: {
					'count': $( this ).val(),
					'action': 'foodrecipe_display'
				},
				success: function( data ) {
					if ( data == '1' ) {
						window.location.href = window.location.href;
					}
				}
			} );
		} );

		$( '#foodrecipe-post-order' ).change( function() {
			//window.location.href = window.location.href;
			$.ajax( {
				method: "POST",
				url: foodrecipe_object.ajax_url,
				data: {
					'order': $( this ).val(),
					'action': 'foodrecipe_display'
				},
				success: function( data ) {
					if ( data == '1' ) {
						window.location.href = window.location.href;
					}
				}
			} );
		} );

		$( 'select' ).selectpicker();

		$( '.scrollTop' ).click( function( event ) {
			event.preventDefault();
			$( 'html' ).animate({
				scrollTop: 0
			}, 500);
		} );

	} );
})( jQuery );
