<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div class="col-xs-12 col-sm-9">
  <h1 class="page-title">
    <span> <?php echo single_cat_title( '', false ); ?></span>
  </h1>
  <?php
    $category_description = category_description();
    if ( ! empty( $category_description ) )
      echo '<div class="archive-meta">' . $category_description . '</div>';

  /* Run the loop for the category page to output the posts.
   * If you want to overload this in a child theme then include a file
   * called loop-category.php and that will be used instead.
   */
  get_template_part( 'loop', 'index' );
  ?>
</div>

<div class="hidden-xs col-sm-3">
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

