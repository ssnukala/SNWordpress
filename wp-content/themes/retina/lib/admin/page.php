<div class="wrap retina-settings">
  
  <?php 
  /** Get the parent theme data. */
  $retina_theme_data = retina_theme_data();
  screen_icon();
  ?>
  
  <h2><?php echo sprintf( __( '%1$s Theme Settings', 'retina' ), $retina_theme_data['Name'] ); ?></h2>    
  
  <?php settings_errors( 'retina_options' ); ?>
  
  <form action="options.php" method="post" id="retina-form-wrapper">
    
    <div id="retina-form-header" class="retina-clearfix">
      <input type="submit" name="" id="" class="button button-primary" value="<?php _e( 'Save Changes', 'retina' ); ?>">
    </div>
	
	<?php settings_fields('retina_options_group'); ?>
    
    <div id="retina-sidebar">
      
      <ul id="retina-group-menu">
        <li id="0_section_group_li" class="retina-group-tab-link-li active"><a href="javascript:void(0);" id="0_section_group_li_a" class="retina-group-tab-link-a" data-rel="0"><span><?php _e( 'Blog Settings', 'retina' ); ?></span></a></li>
        <li id="1_section_group_li" class="retina-group-tab-link-li"><a href="javascript:void(0);" id="1_section_group_li_a" class="retina-group-tab-link-a" data-rel="1"><span><?php _e( 'Post Settings', 'retina' ); ?></span></a></li>
        <li id="2_section_group_li" class="retina-group-tab-link-li"><a href="javascript:void(0);" id="2_section_group_li_a" class="retina-group-tab-link-a" data-rel="2"><span><?php _e( 'Footer Settings', 'retina' ); ?></span></a></li>
        <li id="3_section_group_li" class="retina-group-tab-link-li"><a href="javascript:void(0);" id="3_section_group_li_a" class="retina-group-tab-link-a" data-rel="3"><span><?php _e( 'General Settings', 'retina' ); ?></span></a></li>
      </ul>
    
    </div>
    
    <div id="retina-main">
    
      <div id="0_section_group" class="retina-group-tab">
        <?php do_settings_sections( 'retina_section_blog_page' ); ?>
      </div>
      
      <div id="1_section_group" class="retina-group-tab">
        <?php do_settings_sections( 'retina_section_post_page' ); ?>
      </div>
      
      <div id="2_section_group" class="retina-group-tab">
        <?php do_settings_sections( 'retina_section_footer_page' ); ?>
      </div>
      
      <div id="3_section_group" class="retina-group-tab">
        <?php do_settings_sections( 'retina_section_general_page' ); ?>
      </div>
    
    </div>
    
    <div class="clear"></div>
    
    <div id="retina-form-footer" class="retina-clearfix">
      <input type="submit" name="" id="" class="button button-primary" value="<?php _e( 'Save Changes', 'retina' ); ?>">
    </div>
    
  </form>

</div>