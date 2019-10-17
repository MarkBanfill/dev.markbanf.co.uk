<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Parisienne" rel="stylesheet">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php dynamic_sidebar( 'pagetop-widget-area' ); ?>

	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">

		<?php
		/**
		 * Functions hooked into storefront_header action
		 *
		 * @hooked storefront_header_container                 - 0
		 * @hooked storefront_skip_links                       - 5
		 * @hooked storefront_social_icons                     - 10
		 * @hooked storefront_site_branding                    - 20
		 * @hooked storefront_secondary_navigation             - 30
		 * @hooked storefront_product_search                   - 40
		 * @hooked storefront_header_container_close           - 41
		 * @hooked storefront_primary_navigation_wrapper       - 42
		 * @hooked storefront_primary_navigation               - 50
		 * @hooked storefront_header_cart                      - 60
		 * @hooked storefront_primary_navigation_wrapper_close - 68
		 */
		do_action( 'storefront_header' ); ?>

	</header>

	<div id="fakehead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">

		<?php
		/**
		 * Functions hooked into storefront_header action
		 *
		 * @hooked storefront_header_container                 - 0
		 * @hooked storefront_skip_links                       - 5
		 * @hooked storefront_social_icons                     - 10
		 * @hooked storefront_site_branding                    - 20
		 * @hooked storefront_secondary_navigation             - 30
		 * @hooked storefront_product_search                   - 40
		 * @hooked storefront_header_container_close           - 41
		 * @hooked storefront_primary_navigation_wrapper       - 42
		 * @hooked storefront_primary_navigation               - 50
		 * @hooked storefront_header_cart                      - 60
		 * @hooked storefront_primary_navigation_wrapper_close - 68
		 */
		do_action( 'storefront_header' ); ?>

	</div>

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'storefront_before_content' ); ?>

  <?php if ( is_front_page() ) {
	echo'<div class="slider-text">';
	echo'<h1 class="entry-title">Welcome</h1>';
	echo'<p>You&apos;ve found my portfolio of photography. I specialise in wildlife and landscapes.</p>';
	echo'<a class="arrow downbounce" href="#primary">';
	echo'<svg version="1.1" viewBox="0 0 8 5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="chevron">';
	echo'<g class="chevron__group">';
	echo'<path d="M1.30834787,0.121426937 L4.87569247,3.68780701 C5.04143584,3.8541036 5.04143584,4.11557261 4.87569247,4.2818692 L4.2807853,4.87693487 C4.20364253,4.95546204 4.09599241,5 3.98333171,5 C3.87067101,5 3.76302089,4.95546204 3.68587812,4.87693487 L0.122730401,1.30754434 C-0.0409101338,1.14044787 -0.0409101338,0.880578628 0.122730401,0.713482155 L0.718686793,0.119419971 C0.79596299,0.0427616956 0.902628913,-0.000376468522 1.01396541,2.47569236e-06 C1.1253019,0.000381419907 1.2316441,0.0442445771 1.30834787,0.121426937 L1.30834787,0.121426937 Z" class="chevron__box chevron__box--left" />';
	echo'<path d="M3.12493976,3.68899585 L6.68683713,0.123119938 C6.76404711,0.0445502117 6.8717041,3.56458529e-15 6.98436032,0 C7.09701655,-3.56458529e-15 7.20467353,0.0445502117 7.28188351,0.123119938 L7.87588228,0.717098143 C8.04137257,0.883371226 8.04137257,1.14480327 7.87588228,1.31107635 L4.31398491,4.87695226 C4.23695994,4.95546834 4.1294742,5 4.01698553,5 C3.90449685,5 3.79701111,4.95546834 3.71998614,4.87695226 L3.12493976,4.28197072 C2.95998402,4.11649361 2.95814736,3.85659624 3.12074929,3.68899585 L3.12493976,3.68899585 Z" class="chevron__box chevron__box--right" />';
	echo'</g></svg></a><p>&nbsp;</p></div>';
  }
	?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		do_action( 'storefront_content_top' );
