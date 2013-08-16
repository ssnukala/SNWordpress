<?php
/** Register Retina Core scripts. */
add_action( 'wp_enqueue_scripts', 'retina_register_scripts', 1 );

/** Load Retina Core scripts. */
add_action( 'wp_enqueue_scripts', 'retina_enqueue_scripts' );

/** Register JavaScript and Stylesheet files for the framework. */
function retina_register_scripts() {

	/** Register the 'Superfish Plugin' scripts. */
	wp_register_script( 'retina-js-superfish', esc_url( RETINA_JS_URI . 'superfish/superfish-combine.min.js' ), array( 'jquery' ), '1.5.9', true );
	
	/** Register the 'common' scripts. */
	wp_register_script( 'retina-js-common', esc_url( RETINA_JS_URI . 'common.js' ), array( 'jquery' ), '1.0', true );
	
	/** Register '960.css' for grid. */
	wp_register_style( 'retina-css-960', esc_url( RETINA_CSS_URI . '960.css' ) );
	
	/** Register Google Fonts. */
	$protocol = is_ssl()? 'https' : 'http';
	wp_register_style( 'retina-google-fonts', esc_url( $protocol . '://fonts.googleapis.com/css?family=Open+Sans|Comfortaa' ) );
}

/** Tells WordPress to load the scripts needed for the framework using the wp_enqueue_script() function. */
function retina_enqueue_scripts() {

	/** Load the comment reply script on singular posts with open comments if threaded comments are supported. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Load the 'Superfish Plugin' scripts. */
	wp_enqueue_script( 'retina-js-superfish' );
	
	/** Load the 'common' scripts. */
	wp_enqueue_script( 'retina-js-common' );
	
	/** Load '960.css' for grid. */
	wp_enqueue_style( 'retina-css-960' );
	
	/** Load Google Fonts. */
	wp_enqueue_style( 'retina-google-fonts' );
}
?>