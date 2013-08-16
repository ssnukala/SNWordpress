<?php
/** Load the Core Files */
require_once( trailingslashit( get_template_directory() ) . 'lib/init.php' );
new Retina();

/** Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'retina_theme_setup' );

/** Theme setup function. */
function retina_theme_setup() {
	
	/** Add theme support for Feed Links. */
	add_theme_support( 'automatic-feed-links' );
	
	/** Add theme support for Custom Background. */
	add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );
	
	/** Set content width. */
	retina_set_content_width( 580 );
	
}
?>