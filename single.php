<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div class="span9">

  <?php
  /* Run the loop to output the page.
   * If you want to overload this in a child theme then include a file
   * called loop-single.php and that will be used instead.
   */
  get_template_part( 'loop', 'single' );
  ?>

</div><!-- .span10 -->

<div class="span3 hidden-phone">
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>



