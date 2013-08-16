<?php
/** Function for setting the content width of a theme. */
function retina_set_content_width( $width = '' ) {
	global $content_width;
	$content_width = absint( $width );
}

/** Function for getting the theme's content width. */
function retina_get_content_width() {
	global $content_width;
	return $content_width;
}

/** Function for getting the theme's data */
function retina_theme_data() {
	global $retina;
	
	/** If the parent theme data isn't set, let grab it. */
	if ( empty( $retina->theme_data ) ) {
		
		$retina_theme_data = array();
		$theme_data = wp_get_theme( 'retina' );
		$retina_theme_data['Name'] = $theme_data->get( 'Name' );
		$retina_theme_data['ThemeURI'] = $theme_data->get( 'ThemeURI' );
		$retina_theme_data['AuthorURI'] = $theme_data->get( 'AuthorURI' );
		$retina_theme_data['Description'] = $theme_data->get( 'Description' );
		
		$retina->theme_data = $retina_theme_data;
	
	}

	/** Return the parent theme data. */
	return $retina->theme_data;
}
?>