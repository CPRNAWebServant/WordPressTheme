<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?ver=3" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body>
<div id="cprna-wrapper" class="container-fluid" >
	<div id="header">
		<div id="masthead">
      <img src="http://www.cprna.org/wordpress/wp-content/uploads/2011/11/434x92xcp_na_logo.jpg.pagespeed.ic.pn3RWEnJ8-.jpg"
            width="434" height="92" alt="" class="visible-phone" style="padding-bottom: 15px"/>
     
      <div id="branding" role="banner">
        <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
        <<?php echo $heading_tag; ?> id="site-title">
          <span>
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
        </<?php echo $heading_tag; ?>>
        <div id="site-description"><?php bloginfo( 'description' ); ?></div>

        <?php
          // Compatibility with versions of WordPress prior to 3.4.
          if ( function_exists( 'get_custom_header' ) ) {
            // We need to figure out what the minimum width should be for our featured image.
            // This result would be the suggested width if the theme were to implement flexible widths.
            $header_image_width = get_theme_support( 'custom-header', 'width' );
          } else {
            $header_image_width = HEADER_IMAGE_WIDTH;
          }

          // Check if this is a post or page, if it has a thumbnail, and if it's a big one
          if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
              has_post_thumbnail( $post->ID ) &&
              ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
              $image[1] >= $header_image_width ) :
            // Houston, we have a new header image!
            echo get_the_post_thumbnail( $post->ID );
          elseif ( get_header_image() ) :
            // Compatibility with versions of WordPress prior to 3.4.
            if ( function_exists( 'get_custom_header' ) ) {
              $header_image_width  = get_custom_header()->width;
              $header_image_height = get_custom_header()->height;
            } else {
              $header_image_width  = HEADER_IMAGE_WIDTH;
              $header_image_height = HEADER_IMAGE_HEIGHT;
            }
          ?>
          <?php endif; ?>
      </div><!-- #branding -->
      <div class="navbar navbar-inverse">
        <div class="header-image">
          <img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" 
               alt="" class="hidden-phone center"/>
        </div>
        <?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
        <?php wp_nav_menu( array( 'container_class' => 'navbar-inner', 'theme_location' => 'primary', 
              'menu_class' => 'nav', 'walker' => new wp_bootstrap_navwalker()) ); ?>
        <p class="navbar-text pull-right lead">Helpline: 1-800-543-4670</p>
      </div><!-- #navbar -->
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div class="row-fluid">
