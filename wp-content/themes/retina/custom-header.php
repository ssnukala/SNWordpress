<?php
$header_textcolor = get_header_textcolor();
if( get_header_image() || !empty( $header_textcolor ) || $header_textcolor != 'blank' ) :
?>
<div id="headimg"> 
  
  <?php if( ( !empty( $header_textcolor ) && $header_textcolor != 'blank' ) ) : ?>
  <div class="container_16 clearfix">
    <div class="grid_16 alpha omega">
      
      <div id="logo-text">
        <span class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
        <span class="site-description"><?php bloginfo( 'description' ); ?></span>
      </div> <!-- end of #head-text -->
    
    </div>
  </div>
  <?php endif; ?>

</div>
<?php endif; ?>