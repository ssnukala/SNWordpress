<?php if ( is_category() ) : ?>      

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php printf( __( 'Category Archives: %s', 'retina' ), '<span>' . ucwords( strtolower ( single_cat_title( '', false ) ) ) . '</span>' ); ?></h1>
  <div class="loop-meta-description"><?php echo category_description(); ?></div>
</div> <!-- end #loop-meta -->

<?php elseif ( is_tag() ) : ?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php printf( __( 'Tag Archives: %s', 'retina' ), '<span>' . ucwords( strtolower ( single_tag_title( '', false ) ) ) . '</span>' ); ?></h1>
  <div class="loop-meta-description"><?php echo tag_description(); ?></div>
</div> <!-- end #loop-meta -->

<?php 
elseif ( is_author() ) :
$user_id = get_query_var( 'author' );
?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php printf( __( 'Author Archives: %s', 'retina' ), '<span>' . ucwords( strtolower ( get_the_author_meta( 'display_name', $user_id ) ) ) . '</span>' ); ?></h1>
  <div class="loop-meta-description"><?php echo wpautop( get_the_author_meta( 'description', $user_id ) ); ?></div>
</div> <!-- end #loop-meta -->

<?php elseif ( is_search() ) : ?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php printf( __( 'Search Results: %s', 'retina' ), '<span>' . ucwords( strtolower ( esc_attr ( get_search_query() ) ) ) . '</span>' ); ?></h1>
  <div class="loop-meta-description"><?php printf( __( 'You are browsing the search results for %s', 'retina' ), esc_attr( get_search_query() ) ); ?></div>
</div> <!-- end #loop-meta -->

<?php elseif ( is_day() ) : ?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php printf( __( 'Daily Archives: %s', 'retina' ), '<span>' . get_the_date() . '</span>' ); ?></h1>
  <div class="loop-meta-description"><?php _e( 'You are browsing the site archives by date.', 'retina' ); ?></div>
</div> <!-- end #loop-meta -->

<?php elseif ( is_month() ) : ?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php printf( __( 'Monthly Archives: %s', 'retina' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?></h1>
  <div class="loop-meta-description"><?php _e( 'You are browsing the site archives by month.', 'retina' ); ?></div>
</div> <!-- end #loop-meta -->

<?php elseif ( is_year() ) : ?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php printf( __( 'Yearly Archives: %s', 'retina' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?></h1>
  <div class="loop-meta-description"><?php _e( 'You are browsing the site archives by year.', 'retina' ); ?></div>
</div> <!-- end #loop-meta -->

<?php elseif ( is_archive() ) : ?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php _e( 'Archives', 'retina' ); ?></h1>
  <div class="loop-meta-description"><?php _e( 'You are browsing the site archives.', 'retina' ); ?></div>
</div> <!-- end #loop-meta -->

<?php elseif ( is_404() ) : ?>

<div id="loop-meta">
  <h1 class="loop-meta-title"><?php _e( '404', 'retina' ); ?></h1>
  <div class="loop-meta-description"><?php _e( 'Whoah! You broke something!', 'retina' ); ?></div>
</div> <!-- end #loop-meta -->

<?php endif; ?>