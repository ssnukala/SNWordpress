(function($){
	
	/** Options Tabs */
	function retinaOptionsTabs() {
		
		var relid = $.cookie( 'retina_tab_relid' );
		
		if( relid >= 1  ) {
			retinaOptionsTabControl( relid );
		} else {
			retinaOptionsTabControl( 0 );
		}
		
		$( '.retina-group-tab-link-a' ).click( function() {
			
			relid = $(this).attr( 'data-rel' );
			$.cookie( 'retina_tab_relid', relid );
			retinaOptionsTabControl( relid );		
			
		});
		
	}
	
	function retinaOptionsTabControl( relid ) {
		
		$( '.retina-group-tab' ).each( function() {
				
			if( $(this).attr( 'id' ) == relid + '_section_group' ) {					
				$(this).delay( 400 ).fadeIn( 1200 );				
			} else{					
				$(this).fadeOut( 'fast' );
			}
			
		});
		
		$( '.retina-group-tab-link-li' ).each( function() {
			
			if( $(this).attr('id') != relid + '_section_group_li' && $(this).hasClass( 'active' ) ) {					
				$(this).removeClass( 'active' );				
			}
			
			if( $(this).attr('id') == relid + '_section_group_li' ) {					 
				 $(this).addClass('active');				
			}
		
		});
		
	}
	
	/** jQuery Document Ready */
	$(document).ready(function(){		
		retinaOptionsTabs();		
	});

	/** jQuery Windows Load */
	$(window).load(function(){
	});	

})(jQuery);