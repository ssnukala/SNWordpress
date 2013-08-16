<?php
/** Loads the Retina theme setting. */
function retina_get_settings() {
	global $retina;

	/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
	if ( !isset( $retina->settings ) ) {
		$retina->settings = get_option( 'retina_options' );
	}
	
	/** return settings. */
	return $retina->settings;
}
?>