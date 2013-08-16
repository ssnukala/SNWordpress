<?php
/** Theme Custom Header */
$custom_header_support = array( 
	
	'default-image' => '%s/images/headers/header-default.jpg',
	'random-default' => true,
	'width' => apply_filters( 'retina_header_image_width', 1920 ),
	'height' => apply_filters( 'retina_header_image_height', 400 ),
	'flex-width' => true,
	'flex-height' => true,
	'default-text-color' => 'fff',
	'header-text' => true,
	'wp-head-callback' => 'retina_header_style',
	'admin-head-callback' => 'retina_admin_header_style',
	'admin-preview-callback' => 'retina_admin_header_image'
	
);
add_theme_support( 'custom-header', $custom_header_support );

/** Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI. */
register_default_headers( array(
	
	'retina' => array(
		'url' => '%s/images/headers/header-default.jpg',
		'thumbnail_url' => '%s/images/headers/header-default-thumb.jpg',
		'description' => __( 'Retina', 'retina' )
	)

) );

/** Styles the header image and text displayed on the blog / blog preview in admin. */
function retina_header_style() {
?>
	
	<?php if( get_header_image() ) : ?>
	<style type="text/css">
    #headimg {
        width: 100%;
		height: <?php echo get_custom_header()->height; ?>px;
        background: url(<?php esc_url( header_image() ); ?>) no-repeat top center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
    }
    </style>
    <?php endif; ?>
	
	<?php
	$header_textcolor = get_header_textcolor();
	if( ( !empty( $header_textcolor ) && $header_textcolor != 'blank' ) ) :
	?>
	<style type="text/css">
    #headimg #logo-text a {
        color: #<?php echo esc_html( get_header_textcolor() ); ?>;
    }
    #headimg #logo-text .site-description {
        color: #<?php echo esc_html( get_header_textcolor() ); ?>;
    }
    </style>
    <?php endif; ?>	

<?php
}

/** Styles the header image displayed on the Appearance > Header admin panel. */
function retina_admin_header_style() {
?>

	<style type="text/css">
    .appearance_page_custom-header #headimg {
        width: 100%;
        background: #010101;
        overflow: hidden;
        border: none;
    }
    
    <?php if( get_header_image() ) : ?>
    .appearance_page_custom-header #headimg {
        height: <?php echo get_custom_header()->height; ?>px;
        background: url(<?php esc_url( header_image() ); ?>) no-repeat top center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;		
    }
    <?php endif; ?>
    
    #headimg #logo-text {
        padding: 40px 25px;
    }
    
    #headimg #logo-text a {
        color: #<?php echo esc_html( get_header_textcolor() ); ?>;
        text-decoration: none;
    }
    
    #headimg #logo-text .site-name {
        display: block;
        font-family: Georgia, Times, serif;
        font-size: 36px;
        line-height: 50px; 
        font-weight: normal;	
    }
    
    #headimg #logo-text .site-description {
        display: block;
        font-size: 18px;
        line-height: 28px;
        color: #<?php echo esc_html( get_header_textcolor() ); ?>;
    }
    </style>

<?php
}

/** Markup the header image displayed on the Appearance > Header admin panel. */
function retina_admin_header_image() {	
?>

    <?php
	$header_textcolor = get_header_textcolor();
	if( get_header_image() || !empty( $header_textcolor ) || $header_textcolor != 'blank' ) :
	?>
    <div id="headimg"> 
	  
	  <?php if( ( !empty( $header_textcolor ) && $header_textcolor != 'blank' ) ) : ?>
      <div id="logo-text">
        <span class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" onclick="return false;"><?php bloginfo( 'name' ); ?></a></span>
        <span class="site-description"><?php bloginfo( 'description' ); ?></span>
      </div> <!-- end of #head-text -->
      <?php endif; ?> 
    
    </div>
    <?php endif; ?>

<?php
}
?>