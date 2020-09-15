<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div class="col-xs-12 col-sm-9">
  <?php
  /* Run the loop to output the posts.
   * If you want to overload this in a child theme then include a file
   * called loop-index.php and that will be used instead.
   */
   get_template_part( 'loop', 'index' );
  ?>
</div><!-- .span10 -->

<div class="hidden-xs col-sm-3">
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
