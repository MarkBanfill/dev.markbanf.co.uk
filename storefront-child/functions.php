<?php
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles' );
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array(), false, true );

    wp_enqueue_script( 'aos-script', get_stylesheet_directory_uri() . '/assets/js/aos.js', array(), false, true );
    wp_enqueue_style( 'aos-style', get_stylesheet_directory_uri() . '/assets/css/aos.css' );
}

/* CUSTOM WIDGET AREA */
function pagetop_widget_init() {
    register_sidebar( array(
        'name'          => 'Page Top',
        'id'            => 'pagetop-widget-area',
        'before_widget' => '<div class="ptwa">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="ptwa-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'pagetop_widget_init' );

/**
 * Add product category descriptions (disabled by default)
 */
add_action( 'woocommerce_before_subcategory', 'custom_add_product_description', 12);
function custom_add_product_description ($category) {
  $cat_id        =    $category->term_id;
  $prod_term    =    get_term($cat_id,'product_cat');
  $description=    $prod_term->description;
  echo '<div class="product-category-description">'.$description.'</div><h2>'.$category->name.'</h2>';
}

/**
 * Remove sidebar from gallery page
 */
add_action( 'get_header', 'remove_storefront_sidebar' );
function remove_storefront_sidebar() {
	if ( is_woocommerce() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
	}
}

/**
 * Remove breadcrumbs
 */
add_action( 'init', 'z_remove_wc_breadcrumbs');
function z_remove_wc_breadcrumbs() {
    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10);
}

/**
 * Modify header
 */
add_action( 'init', 'remove_sf_actions' );
function remove_sf_actions() {
  remove_action( 'storefront_header', 'storefront_product_search', 40 );
  add_action( 'storefront_header', 'storefront_header_cart', 40 );
  remove_action( 'storefront_header', 'storefront_header_cart', 60 );
}

/**
 * Add custom nav
 */
if ( ! function_exists( 'storefront_secondary_navigation' ) ) {
    function storefront_secondary_navigation() {
        ?>
            <nav><ul class="navmenu">
              <li class="nav-about"><a href="<?php echo get_page_link( get_page_by_title( "About" )->ID ); ?>"><svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><g id="Layer_1_1_"><circle cx="25" cy="25" r="23" stroke="black" stroke-width="2" fill="none"></circle><rect height="3" width="2" x="24" y="10" /><rect height="2" width="5" x="21" y="16" /><rect height="24" width="2" x="24" y="16" /></g></svg></a></li>
              <li class="nav-gallery"><a href="<?php echo get_page_link( get_page_by_title( "Gallery" )->ID ); ?>"><svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><g id="Layer_1_1_"><path xmlns="http://www.w3.org/2000/svg" d="M43,39h6V4H8v6H1v36h42V39z M10,6h37v31h-4V10H10V6z M8,12h33v7.586l-4-4l-17,17l-10-10l-7,7V12H8z M41,44H3V32.414l7-7   l10,10l17-17l4,4V39V44z"/><circle cx="20" cy="20" r="3" stroke="black" stroke-width="2" fill="none" /></g></svg></a></li>
              <li class="nav-blog"><a href="<?php echo get_page_link( get_page_by_title( "Blog" )->ID ); ?>"><svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><g id="Layer_1_1_"><rect height="2" width="22" x="8.793" y="14"/><rect height="2" width="22" x="8.793" y="20"/><rect height="2" width="17" x="8.793" y="26"/><rect height="2" width="12" x="8.793" y="32"/><rect height="2" width="12" x="8.793" y="38"/><path d="M38.793,18.586v-10L31.207,1H0.793v48h38V31.414L49.207,21l-6.414-6.414L38.793,18.586z M37.793,22.414L41.379,26l-12,12   h-3.586v-3.586L37.793,22.414z M31.793,4.414L35.379,8h-3.586V4.414z M36.793,47h-34V3h27v7h7v10.586l-13,13V40h6.414l6.586-6.586   V47z M42.793,24.586L39.207,21l3.586-3.586L46.379,21L42.793,24.586z"/></g></svg></a></li>
              <li class="nav-contact"><a href="<?php echo get_page_link( get_page_by_title( "Contact" )->ID ); ?>"><svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><g id="Layer_1_1_"><path d="M1,11.487v29.146V43h48v-2.367V11.487V7H1V11.487z M3,13.053l15.6,12.209L3,38.886V13.053z M3.62,41l16.584-14.483 L25,30.27l4.796-3.753L46.38,41H3.62z M47,38.886L31.4,25.261L47,13.052V38.886z M3,9h44v1.513L25,27.73L3,10.513V9z"/></g></svg></a></li>
            </ul></nav>
        <?php
    }
}




add_filter( 'storefront_handheld_footer_bar_links', 'jk_remove_handheld_footer_links' );
function jk_remove_handheld_footer_links( $links ) {
	unset( $links['my-account'] );
	return $links;
}
add_filter( 'storefront_handheld_footer_bar_links', 'jk_add_home_link' );
function jk_add_home_link( $links ) {
	$new_links = array(
		'home' => array(
			'priority' => 10,
			'callback' => 'jk_home_link',
		),
	);

	$links = array_merge( $new_links, $links );

	return $links;
}

function jk_home_link() {
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home' ) . '</a>';
}


function wpforo_search_form( $html ) {

        $html = str_replace( 'placeholder="Search ', 'placeholder="Search photos ', $html );

        return $html;
}
add_filter( 'get_search_form', 'wpforo_search_form' );


function storefront_product_categories( $args ) {

  if ( storefront_is_woocommerce_activated() ) {

    $args = apply_filters( 'storefront_product_categories_args', array(
      'limit' 			=> 3,
      'columns' 			=> 3,
      'child_categories' 	=> 0,
      'orderby' 			=> 'name',
      'title'				=> __( 'Shop by Category', 'storefront' ),
    ) );

    $shortcode_content = storefront_do_shortcode( 'product_categories', apply_filters( 'storefront_product_categories_shortcode_args', array(
      'number'  => intval( $args['limit'] ),
      'columns' => intval( $args['columns'] ),
      'orderby' => esc_attr( $args['orderby'] ),
      'parent'  => esc_attr( $args['child_categories'] ),
    ) ) );

    /**
     * Only display the section if the shortcode returns product categories
     */
    if ( false !== strpos( $shortcode_content, 'product-category' ) ) {

      echo '<section data-aos="fade-up" data-aos-duration="1000" class="storefront-product-section storefront-product-categories" aria-label="' . esc_attr__( 'Product Categories', 'storefront' ) . '">';

      do_action( 'storefront_homepage_before_product_categories' );

      echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

      echo '<div class="category-description"><p>Most of my work involves flowers, animals and beautiful scenery</p></div>';

      do_action( 'storefront_homepage_after_product_categories_title' );

      echo $shortcode_content;

      do_action( 'storefront_homepage_after_product_categories' );

      echo '</section>';

    }
  }
}

function storefront_recent_products( $args ) {

	if ( storefront_is_woocommerce_activated() ) {

		$args = apply_filters( 'storefront_recent_products_args', array(
			'limit'   => 4,
			'columns' => 4,
			'orderby' => 'date',
			'order'   => 'desc',
			'title'   => __( 'New In', 'storefront' ),
		) );

		$shortcode_content = storefront_do_shortcode( 'products', apply_filters( 'storefront_recent_products_shortcode_args', array(
			'orderby'  => esc_attr( $args['orderby'] ),
			'order'    => esc_attr( $args['order'] ),
			'per_page' => intval( $args['limit'] ),
			'columns'  => intval( $args['columns'] ),
		) ) );

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {

			echo '<section data-aos="fade-up" data-aos-duration="1000" class="storefront-product-section storefront-recent-products" aria-label="' . esc_attr__( 'Recent Products', 'storefront' ) . '">';

			do_action( 'storefront_homepage_before_recent_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_homepage_after_recent_products_title' );

			echo $shortcode_content;

			do_action( 'storefront_homepage_after_recent_products' );

			echo '</section>';

		}
	}
}

function storefront_featured_products( $args ) {

	if ( storefront_is_woocommerce_activated() ) {

		$args = apply_filters( 'storefront_featured_products_args', array(
			'limit'      => 4,
			'columns'    => 4,
			'orderby'    => 'date',
			'order'      => 'desc',
			'visibility' => 'featured',
			'title'      => __( 'Recommended', 'storefront' ),
		) );

		$shortcode_content = storefront_do_shortcode( 'products', apply_filters( 'storefront_featured_products_shortcode_args', array(
			'per_page'   => intval( $args['limit'] ),
			'columns'    => intval( $args['columns'] ),
			'orderby'    => esc_attr( $args['orderby'] ),
			'order'      => esc_attr( $args['order'] ),
			'visibility' => esc_attr( $args['visibility'] ),
		) ) );

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {

			echo '<section data-aos="fade-up" data-aos-duration="1000" class="storefront-product-section storefront-featured-products" aria-label="' . esc_attr__( 'Featured Products', 'storefront' ) . '">';

			do_action( 'storefront_homepage_before_featured_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_homepage_after_featured_products_title' );

			echo $shortcode_content;

			do_action( 'storefront_homepage_after_featured_products' );

			echo '</section>';

		}
	}
}

function storefront_popular_products( $args ) {

	if ( storefront_is_woocommerce_activated() ) {

		$args = apply_filters( 'storefront_popular_products_args', array(
			'limit'   => 4,
			'columns' => 4,
			'orderby' => 'rating',
			'order'   => 'desc',
			'title'   => __( 'Fan Favorites', 'storefront' ),
		) );

		$shortcode_content = storefront_do_shortcode( 'products', apply_filters( 'storefront_popular_products_shortcode_args', array(
			'per_page' => intval( $args['limit'] ),
			'columns'  => intval( $args['columns'] ),
			'orderby'  => esc_attr( $args['orderby'] ),
			'order'    => esc_attr( $args['order'] ),
		) ) );

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {

			echo '<section data-aos="fade-up" data-aos-duration="1000" class="storefront-product-section storefront-popular-products" aria-label="' . esc_attr__( 'Popular Products', 'storefront' ) . '">';

			do_action( 'storefront_homepage_before_popular_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_homepage_after_popular_products_title' );

			echo $shortcode_content;

			do_action( 'storefront_homepage_after_popular_products' );

			echo '</section>';

		}
	}
}

function storefront_on_sale_products( $args ) {

	if ( storefront_is_woocommerce_activated() ) {

		$args = apply_filters( 'storefront_on_sale_products_args', array(
			'limit'   => 4,
			'columns' => 4,
			'orderby' => 'date',
			'order'   => 'desc',
			'on_sale' => 'true',
			'title'   => __( 'On Sale', 'storefront' ),
		) );

		$shortcode_content = storefront_do_shortcode( 'products', apply_filters( 'storefront_on_sale_products_shortcode_args', array(
			'per_page' => intval( $args['limit'] ),
			'columns'  => intval( $args['columns'] ),
			'orderby'  => esc_attr( $args['orderby'] ),
			'order'    => esc_attr( $args['order'] ),
			'on_sale'  => esc_attr( $args['on_sale'] ),
		) ) );

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {

			echo '<section data-aos="fade-up" data-aos-duration="1000" class="storefront-product-section storefront-on-sale-products" aria-label="' . esc_attr__( 'On Sale Products', 'storefront' ) . '">';

			do_action( 'storefront_homepage_before_on_sale_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_homepage_after_on_sale_products_title' );

			echo $shortcode_content;

			do_action( 'storefront_homepage_after_on_sale_products' );

			echo '</section>';

		}
	}
}

function storefront_best_selling_products( $args ) {
	if ( storefront_is_woocommerce_activated() ) {

		$args = apply_filters( 'storefront_best_selling_products_args', array(
			'limit'   => 4,
			'columns' => 4,
			'orderby' => 'popularity',
			'order'   => 'desc',
			'title'	  => esc_attr__( 'Best Sellers', 'storefront' ),
		) );

		$shortcode_content = storefront_do_shortcode( 'products', apply_filters( 'storefront_best_selling_products_shortcode_args', array(
			'per_page' => intval( $args['limit'] ),
			'columns'  => intval( $args['columns'] ),
			'orderby'  => esc_attr( $args['orderby'] ),
			'order'    => esc_attr( $args['order'] ),
		) ) );

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {

			echo '<section data-aos="fade-up" data-aos-duration="1000" class="storefront-product-section storefront-best-selling-products" aria-label="' . esc_attr__( 'Best Selling Products', 'storefront' ) . '">';

			do_action( 'storefront_homepage_before_best_selling_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_homepage_after_best_selling_products_title' );

			echo $shortcode_content;

			do_action( 'storefront_homepage_after_best_selling_products' );

			echo '</section>';

		}
	}
}


/**
 * Move blog post meta to below post rather than above
 */
if ( ! function_exists( 'storefront_post_header' ) ) {
	function storefront_post_header() {
		?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}
if ( ! function_exists( 'storefront_post_content' ) ) {
	function storefront_post_content() {
		?>
		<div class="entry-content">
		<?php
		do_action( 'storefront_post_content_before' );

		the_content(
			sprintf(
				/* translators: %s: post title */
				__( 'Continue reading %s', 'storefront' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

    if ( 'post' === get_post_type() ) {
      storefront_post_meta();
    }

		do_action( 'storefront_post_content_after' );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
				'after'  => '</div>',
			)
		);
		?>
		</div><!-- .entry-content -->
		<?php
	}
}
















/**
 * Add SVG support
 */
function add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');




?>
