<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

if ( ! function_exists( 'facultad_setup' ) ) {
  function facultad_usil() {
    add_theme_support('post-thumbnails');
  }
  add_action( 'after_setup_theme', 'facultad_usil');
}

if ( ! function_exists( 'mytheme_register_nav_menu' ) ) {
 
    function mytheme_register_nav_menu(){
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'text_domain' ),
            'footer_menu'  => __( 'Footer', 'text_domain' ),
        ) );
    }
    add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
}

if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

add_post_type_support( 'page', 'excerpt' );



// PAGINACIÓN
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('<'),
    'next_text'       => __('>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      //echo "<span class='page-numbers page-num'>Página " . $paged . " de " . $numpages . "</span> ";//
      echo $paginate_links;
    echo "</nav>";
  }

}

/**
 * Fix pagination on archive pages
 * After adding a rewrite rule, go to Settings > Permalinks and click Save to flush the rules cache
 */
function my_pagination_rewrite() {
    add_rewrite_rule('blog/page/?([0-9]{1,})/?$', 'index.php?category_name=blog&paged=$matches[1]', 'top');
}
add_action('init', 'my_pagination_rewrite');

/*INTERVENCIÓN DE SEND CF7*/
require get_template_directory() . '/inc/custom-function.php';
