<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div class="col-xs-12 col-sm-9">

  <?php
  /* Run the loop to output the page.
   * If you want to overload this in a child theme then include a file
   * called loop-single.php and that will be used instead.
   */
  get_template_part( 'loop', 'single' );
  ?>

</div><!-- .span10 -->

<div class="hidden-xs col-sm-3">
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>



