/** JS Logics */
(function($){
	
	/** Drop Downs */
	function retinaMenu() {
		
		/** Superfish Menu */
		$( '.menu ul' ).supersubs({			
			minWidth: 12,
			maxWidth: 25,
			extraWidth: 0			
		}).superfish({		
			delay: 1200, 
			autoArrows: true,
			dropShadows: false		
		});
		
	}
	
	/** Equal Height Columns */
	function retinaEqualHeightCols() {
		
		var contentHeight = $( '#content' ).height();
		var sidebarHeight = $( '#sidebar' ).height();
		var highestCol = Math.max( contentHeight, sidebarHeight );
		
		if( sidebarHeight < highestCol ) {
			$( '#sidebar' ).height( highestCol ); 
		}
	
	}
	
	/** jQuery Document Ready */
	$(document).ready(function(){
		retinaMenu();
	});
	
	/** jQuery Windows Load */
	$(window).load(function(){
		retinaEqualHeightCols();
	});

})(jQuery);