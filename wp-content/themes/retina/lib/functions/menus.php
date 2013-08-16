<?php
/** Register nav menus. */
add_action( 'init', 'retina_register_menus' );

/** Registers the the core menus */
function retina_register_menus() {

	/* Register the 'primary' menu. */
	register_nav_menu( 'retina-primary-menu', __( 'Retina Primary Menu', 'retina' ) );
	
}
?>