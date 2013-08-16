<?php get_header();	?>

<div class="container_16 clearfix">
  
  <div class="grid_10 alpha">
    <div id="content">	  
	  
	  <?php get_template_part( 'loop-meta' ); ?>
	  
	  <?php if ( have_posts() ) : ?>
      
        <?php while ( have_posts() ) : the_post(); ?>
        
          <?php get_template_part( 'content' ); ?>
        
        <?php endwhile; ?>
      
      <?php else : ?>
                  
        <?php get_template_part( 'loop-error' ); ?>
      
      <?php endif; ?>
      
      <?php retina_loop_nav(); ?>
    
    </div> <!-- end #content -->
  </div> <!-- end .grid_10 -->
  
  <?php get_sidebar(); ?>

</div> <!-- end .container_16 -->
  
<?php get_footer(); ?>