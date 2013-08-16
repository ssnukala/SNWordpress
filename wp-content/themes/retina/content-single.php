<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h1 class="entry-title entry-title-single"><?php the_title(); ?></h1>
  
  <div class="entry-meta">    
	<?php echo retina_post_date() . retina_post_comments() . retina_post_author() . retina_post_sticky() . retina_post_edit_link(); ?>
  </div><!-- .entry-meta -->
  
  <div class="entry-content clearfix">
  	<?php the_content(); ?>
  </div> <!-- end .entry-content -->
  
  <?php echo retina_link_pages(); ?>
  
  <div class="entry-meta-bottom">
  <?php echo retina_post_category() . retina_post_tags(); ?>
  </div><!-- .entry-meta -->

</div> <!-- end #post-<?php the_ID(); ?> .post_class -->

<?php retina_author(); ?> 

<?php comments_template( '', true ); ?>