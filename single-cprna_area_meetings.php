<?php get_header();

function get_slug()
{
  global $post; 
  return $post->post_name;
}
?>
<div class="hidden-xs col-sm-3">
  <?php get_template_part('area_navigation', 'leftnav'); ?>
</div>
<div class="col-xs-12 col-sm-9">
  <div class="row-fluid">
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="entry-content">
              <ul class="nav nav-tabs">
                <li><a href="../../info/<?php printf(get_slug()); ?>">Info</a></li>
                <li class="active"><a href="#">Meetings</a></li>
                <li><a href="../../news/<?php the_author(); ?>">News</a></li>
                <li class="pull-right"><div><button type="button" class="btn" data-toggle="modal" data-target="#meetingFormatModal" >Meeting Format Code Legend</a></div></li>
              </ul>
              <p>
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
                <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
              </p>
            </div><!-- .entry-content -->
          </div><!-- #post-## -->
  <?php endwhile; // end of the loop. ?>
  </div>
</div>
<?php get_footer(); ?>



