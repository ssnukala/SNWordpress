<?php
class RetinaAdmin {
		
		/** Constructor Method */
		function __construct() {
	
			/** Load the admin_init functions. */
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			
			/* Hook the settings page function to 'admin_menu'. */
			add_action( 'admin_menu', array( &$this, 'settings_page_init' ) );		
	
		}
		
		/** Initializes any admin-related features needed for the framework. */
		function admin_init() {
			
			/** Registers admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_register_scripts' ), 1 );
		
			/** Loads admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
			
		}
		
		/** Registers admin JavaScript and Stylesheet files for the framework. */
		function admin_register_scripts() {
			
			/** Register Admin Stylesheet */
			wp_register_style( 'retina-admin-css-style', esc_url( RETINA_ADMIN_URI . 'style.css' ) );
			
			/** Register Admin Scripts */
			wp_register_script( 'retina-admin-js-retina', esc_url( RETINA_ADMIN_URI . 'common.js' ) );
			wp_register_script( 'retina-admin-js-jquery-cookie', esc_url( RETINA_JS_URI . 'jquery-cookie/jquery.cookie.js' ) );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for the framework. */
		function admin_enqueue_scripts() {			
		}
		
		/** Initializes all the theme settings page functionality. This function is used to create the theme settings page */
		function settings_page_init() {
			
			global $retina;
			
			/** Register theme settings. */
			register_setting( 'retina_options_group', 'retina_options', array( &$this, 'retina_options_validate' ) );
			
			/* Create the theme settings page. */
			$retina->settings_page = add_theme_page( 
				esc_html( __( 'Retina Options', 'retina' ) ),	/** Settings page name. */
				esc_html( __( 'Retina Options', 'retina' ) ),	/** Menu item name. */
				$this->settings_page_capability(),				/** Required capability */
				'retina-options', 								/** Screen name */
				array( &$this, 'settings_page' )				/** Callback function */
			);
			
			/* Check if the settings page is being shown before running any functions for it. */
			if ( !empty( $retina->settings_page ) ) {
				
				/** Add contextual help to the theme settings page. */
				add_action( 'load-'. $retina->settings_page, array( &$this, 'settings_page_contextual_help' ) );
				
				/* Load the JavaScript and stylesheets needed for the theme settings screen. */
				add_action( 'admin_enqueue_scripts', array( &$this, 'settings_page_enqueue_scripts' ) );
				
				/** Configure settings Sections and Fileds. */
				$this->settings_sections();
				
				/** Configure default settings. */
				$this->settings_default();				
				
			}
			
		}
		
		/** Returns the required capability for viewing and saving theme settings. */
		function settings_page_capability() {
			return 'edit_theme_options';
		}
		
		/** Displays the theme settings page. */
		function settings_page() {
			require( RETINA_ADMIN_DIR . 'page.php' );
		}
		
		/** Text for the contextual help for the theme settings page in the admin. */
		function settings_page_contextual_help() {
			
			/** Get the parent theme data. */
			$theme = retina_theme_data();
			$AuthorURI = $theme['AuthorURI'];
			$ThemeURI = $theme['ThemeURI'];
		
			/** Get the current screen */
			$screen = get_current_screen();
			
			/** Add theme reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'retina-theme',
				'title' => __( 'Theme Support', 'retina' ),
				'content' => implode( '', file( RETINA_ADMIN_DIR . 'help/support.html' ) ),				
				
				)
			);
			
			/** Add license reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'retina-license',
				'title' => __( 'License', 'retina' ),
				'content' => implode( '', file( RETINA_ADMIN_DIR . 'help/license.html' ) ),				
				
				)
			);
			
			/** Add changelog reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'retina-changelog',
				'title' => __( 'Changelog', 'retina' ),
				'content' => implode( '', file( RETINA_ADMIN_DIR . 'help/changelog.html' ) ),				
				
				)
			);
			
			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'retina' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Retina Project', 'retina' ) . '</a></p>';
			}
			if ( !empty( $ThemeURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $ThemeURI ) . '" target="_blank">' . __( 'Retina Official Page', 'retina' ) . '</a></p>';
			}			
			$screen->set_help_sidebar( $sidebar );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for displaying the theme settings page in the WordPress admin. */
		function settings_page_enqueue_scripts( $hook ) {
			
			/** Load Scripts For Retina Options Page */
			if( $hook === 'appearance_page_retina-options' ) {
				
				/** Load Admin Stylesheet */
				wp_enqueue_style( 'retina-admin-css-style' );
				
				/** Load Admin Scripts */
				wp_enqueue_script( 'retina-admin-js-retina' );
				wp_enqueue_script( 'retina-admin-js-jquery-cookie' );
				
			}
				
		}
		
		/** Configure settings Sections and Fileds */		
		function settings_sections() {
		
			/** Blog Section */
			add_settings_section( 'retina_section_blog', 'Blog Options', array( &$this, 'retina_section_blog_fn' ), 'retina_section_blog_page' );			
			
			add_settings_field( 'retina_field_nav_style', __( 'Navigation Style', 'retina' ), array( &$this, 'retina_field_nav_style_fn' ), 'retina_section_blog_page', 'retina_section_blog' );
			
			/** Post Section */
			add_settings_section( 'retina_section_post', 'Post Options', array( &$this, 'retina_section_post_fn' ), 'retina_section_post_page' );
			
			add_settings_field( 'retina_field_post_style', __( 'Post Style', 'retina' ), array( &$this, 'retina_field_post_style_fn' ), 'retina_section_post_page', 'retina_section_post' );
			add_settings_field( 'retina_field_featured_image_control', __( 'Post Featured Image', 'retina' ), array( &$this, 'retina_field_featured_image_control_fn' ), 'retina_section_post_page', 'retina_section_post' );
			
			/** Footer Section */
			add_settings_section( 'retina_section_footer', 'Footer Options', array( &$this, 'retina_section_footer_fn' ), 'retina_section_footer_page' );
			
			add_settings_field( 'retina_field_copyright_control', __( 'Use Copyright', 'retina' ), array( &$this, 'retina_field_copyright_control_fn' ), 'retina_section_footer_page', 'retina_section_footer' );
			add_settings_field( 'retina_field_copyright', __( 'Enter Copyright Text', 'retina' ), array( &$this, 'retina_field_copyright_fn' ), 'retina_section_footer_page', 'retina_section_footer' );
			
			/** General Section */
			add_settings_section( 'retina_section_general', 'General Options', array( &$this, 'retina_section_general_fn' ), 'retina_section_general_page' );
			
			add_settings_field( 'retina_field_reset_control', __( 'Reset Theme Options', 'retina' ), array( &$this, 'retina_field_reset_control_fn' ), 'retina_section_general_page', 'retina_section_general' );
		
		}
		
		/** Configure default settings. */	
		function get_settings_default()  {
			
			$default = array(
					
				'retina_nav_style' => 'numeric',
				
				'retina_post_style' => 'content',
				'retina_featured_image_control' => 'manual',
				
				'retina_copyright_control' => 0,
				'retina_copyright' => '',
				
				'retina_reset_control' => 0
				
			);
			
			return $default;
			
		}
		function settings_default() {
			global $retina;
			
			$retina_reset_control = false;
			$retina_options = retina_get_settings();
			
			/** Retina Reset Logic */
			if ( !is_array( $retina_options ) ) {			
				$retina_reset_control = true;			
			} 						
			elseif ( $retina_options['retina_reset_control'] == 1 ) {			
				$retina_reset_control = true;			
			}			
			
			/** Let Reset Retina */
			if( $retina_reset_control == true ) {				
				$default = $this->get_settings_default();				
				update_option( 'retina_options' , $default );			
			}
		
		}
		
		/** Retina Pre-defined Range */
		
		/* Boolean Yes | No */		
		function retina_boolean_pd() {			
			return array( 1 => __( 'yes', 'retina' ), 0 => __( 'no', 'retina' ) );		
		}
		
		/* Nav Style Range */		
		function retina_nav_style_pd() {			
			return array( 'numeric' => __( 'Numeric', 'retina' ), 'older-newer' => __( 'Older / Newer', 'retina' ) );			
		}
		
		/* Post Style Range */		
		function retina_post_style_pd() {			
			return array( 'content' => __( 'Content', 'retina' ), 'excerpt' => __( 'Excerpt', 'retina' ) );			
		}
		
		/* Featured Image Range */		
		function retina_featured_image_pd() {			
			return array( 'manual' => __( 'Use Featured Image', 'retina' ), 'auto' => __( 'Use Featured Image Automatically', 'retina' ), 'no' => __( 'No Featured Image', 'retina' ) );			
		}		
		
		/** Retina Options Validation */				
		function retina_options_validate( $input ) {
			
			/** Retina Predefined */
			$default = $this->get_settings_default();
			$retina_boolean_pd = $this->retina_boolean_pd();
			$retina_nav_style_pd = $this->retina_nav_style_pd();
			$retina_post_style_pd = $this->retina_post_style_pd();
			$retina_featured_image_pd = $this->retina_featured_image_pd();						
			
			/* Validation: retina_nav_style */
			if ( ! array_key_exists( $input['retina_nav_style'], $retina_nav_style_pd ) ) {
				 $input['retina_nav_style'] = $default['retina_nav_style'];
			}
			
			/* Validation: retina_post_style */			
			if ( ! array_key_exists( $input['retina_post_style'], $retina_post_style_pd ) ) {
				 $input['retina_post_style'] = $default['retina_post_style'];
			}
			
			/* Validation: retina_featured_image_control */			
			if ( ! array_key_exists( $input['retina_featured_image_control'], $retina_featured_image_pd ) ) {
				 $input['retina_featured_image_control'] = $default['retina_featured_image_control'];
			}										
			
			/* Validation: retina_copyright_control */			
			if ( ! array_key_exists( $input['retina_copyright_control'], $retina_boolean_pd ) ) {
				 $input['retina_copyright_control'] = $default['retina_copyright_control'];
			}
			
			/* Validation: retina_copyright */
			if( !empty( $input['retina_copyright'] ) ) {
				$input['retina_copyright'] = htmlspecialchars ( $input['retina_copyright'] );
			}
			
			/* Validation: retina_reset_control */
			if ( ! array_key_exists( $input['retina_reset_control'], $retina_boolean_pd ) ) {
				 $input['retina_reset_control'] = $default['retina_reset_control'];
			}
			
			add_settings_error( 'retina_options', 'retina_options', __( 'Settings Saved.', 'retina' ), 'updated' );
			
			return $input;
		
		}
		
		/** Blog Section Callback */				
		function retina_section_blog_fn() {
			echo '<div class="retina-section-desc">
			  <p class="description">'. __( 'Customize your blog by using the following settings.', 'retina' ) .'</p>
			</div>';
		}
		
		/* Nav Style Callback */		
		function retina_field_nav_style_fn() {
			
			$retina_options = get_option( 'retina_options' );
			$items = $this->retina_nav_style_pd();
			
			echo '<select id="retina_nav_style" name="retina_options[retina_nav_style]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $retina_options['retina_nav_style'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select navigation style.', 'retina' ) .'</small></div>';
		
		}
		
		/** Post Section Callback */				
		function retina_section_post_fn() {
			echo '<div class="retina-section-desc">
			  <p class="description">'. __( 'Customize your posts by using the following settings.', 'retina' ) .'</p>
			</div>';
		}
		
		/* Post Style Callback */		
		function retina_field_post_style_fn() {
			
			$retina_options = get_option( 'retina_options' );
			$items = $this->retina_post_style_pd();
			
			echo '<select id="retina_post_style" name="retina_options[retina_post_style]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $retina_options['retina_post_style'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select post style.', 'retina' ) .'</small></div>';
		
		}
		
		/* Featured Image Callback */		
		function retina_field_featured_image_control_fn() {
			
			$retina_options = get_option( 'retina_options' );
			$items = $this->retina_featured_image_pd();
			
			echo '<select id="retina_featured_image_control" name="retina_options[retina_featured_image_control]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $retina_options['retina_featured_image_control'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( '<strong>Use Featured Image:</strong> which is set in the post.', 'retina' ) .'</small></div>';
			echo '<div><small>'. __( '<strong>Use Featured Image Automatically:</strong> from the images uploaded to the post.', 'retina' ) .'</small></div>';
			echo '<div><small>'. __( '<strong>No Featured Image:</strong> for the post.', 'retina' ) .'</small></div>';
		
		}
		
		/** Footer Section Callback */				
		function retina_section_footer_fn() {
			echo '<div class="retina-section-desc">
			  <p class="description">'. __( 'Customize your footer by using the following settings.', 'retina' ) .'</p>
			</div>';
		}
		
		/* Copyright Control Callback */		
		function  retina_field_copyright_control_fn() {
			
			$retina_options = get_option( 'retina_options' );
			$items = $this->retina_boolean_pd();
			
			echo '<select id="retina_copyright_control" name="retina_options[retina_copyright_control]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $retina_options['retina_copyright_control'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select yes to override default copyright text.', 'retina' ) .'</small></div>';
		
		}
		
		/* Copyright Callback */
		function retina_field_copyright_fn() {
			
			$retina_options = get_option('retina_options');
			echo '<textarea type="textarea" id="retina_copyright" name="retina_options[retina_copyright]" rows="7" cols="50">'. esc_html ( $retina_options['retina_copyright'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter the copyright text.', 'retina' ) .'</small></div>';
			echo '<div><small>Example: <strong>&amp;copy; Copyright '.date('Y').' - &lt;a href="'. esc_url( home_url( '/' ) ) .'"&gt;'. get_bloginfo('name') .'&lt;/a&gt;</strong></small></div>';
		
		}
		
		/** General Section Callback */				
		function retina_section_general_fn() {
			echo '<div class="retina-section-desc">
			  <p class="description">'. __( 'Here are the general settings to customize your blog.', 'retina' ) .'</p>
			</div>';
		}
		
		/* Reset Congrol Callback */		
		function retina_field_reset_control_fn() {
			
			$retina_options = get_option('retina_options');			
			$items = $this->retina_boolean_pd();			
			echo '<label><input type="checkbox" id="retina_reset_control" name="retina_options[retina_reset_control]" value="1" /> '. __( 'Reset Theme Options.', 'retina' ) .'</label>';
		
		}
}

/** Initiate Admin */
new RetinaAdmin();
?>