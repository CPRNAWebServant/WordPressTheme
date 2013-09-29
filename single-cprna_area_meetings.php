<?php get_header();

function get_slug()
{
  global $post; 
  return $post->post_name;
}
?>
<div class="container-fluid">
	<div class="row-fluid">
    <div class="span3">
      <?php get_template_part('area_navigation', 'leftnav'); ?>
		</div>
		<div class="span9">
			<div class="row-fluid">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
              <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="entry-title"><?php the_title(); ?></h2>
                <p>
                  <ul class="nav nav-tabs">
                    <li><a href="../../info/<?php printf(get_slug()); ?>">Info</a></li>
                    <li class="active"><a href="#">Meetings</a></li>
					<li><a href="../../news/<?php the_author(); ?>">News</a></li>
                  </ul>
                </p>
                <div class="entry-content">
                  <?php the_content(); ?>
                  <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
                  <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .entry-content -->
              </div><!-- #post-## -->
			<?php endwhile; // end of the loop. ?>
			</div>
		</div>
	</div><!-- row-fluid -->
</div><!-- container-fluid -->

<?php get_footer(); ?>



