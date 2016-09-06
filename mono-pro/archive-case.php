<?php
/**
 * This file adds the home template to the mono pro.
 *
 * @author mono voce aps
 * @package mono pro
 * @subpackage Customizations
*/

/*
Template Name: Case Archive
*/

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'pin_enqueue_scripts_styles' );
function pin_enqueue_scripts_styles() {

	// wp_enqueue_script( 'rgc-masonry', get_stylesheet_directory_uri() . '/js/rgc-mason.js', array( 'jquery-masonry' ) );
	wp_enqueue_script( 'filter', get_stylesheet_directory_uri() . '/js/casefilter.js', array( 'jquery' ) );

}

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove entry footer
// ==================================================================================================
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
// remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// ==================================================================================================

// Reposion Entry Header
// ==================================================================================================
//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Add the entry header markup and entry title inside entry content
add_action( 'genesis_entry_content', 'position_entry_header', 1 );
function position_entry_header()
{
	if (is_front_page()) {
		return;
	}
	genesis_entry_header_markup_open();
	genesis_do_post_title();
	genesis_entry_header_markup_close();
}

//* Remove entry content and image
// ==================================================================================================
//* Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//* Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// ==================================================================================================

//* Reposition the entry title
// ==================================================================================================
//* Add the entry header markup and entry title before the content on all pages except the front page
add_action( 'genesis_before_content', 'jw_add_entry_header', 10 );
function jw_add_entry_header() {
	
		echo '<header class="entry-header content"><h1 class="entry-title" itemprop="headline">Cases</h1></header>';
		
}
// ==================================================================================================



// Categories test ==============================

/*
add_action( 'genesis_before_content', 'category_names_2', 15 );
function category_names_2() {
	
	echo '<div class="wrap">';
	
	foreach((get_the_category()) as $category) {
    	$category_name = $category->cat_name;
		if ($category_name){
			echo '' . $category_name . '' . $post->title;
		}
		
	}
	
	echo '</div>';
}
*/

/*
add_action( 'genesis_entry_content', 'robin_do_taxonomy_loop' ); // Add custom loop
function robin_do_taxonomy_loop() {
	$tax = 'category';
	if ( genesis_get_custom_field( 'taxonomy' ) ) {
		$tax = genesis_get_custom_field( 'taxonomy' ); // custom field taxonomy => name
	}
	$args  = genesis_get_custom_field( 'query_args' ); // custom field query_args => orderby=name&order=ASC (example)
	$terms = get_terms( $tax, $args );
	$class = 'two-columns';
	if ( '3' === genesis_get_custom_field( 'columns' ) ) {
		$class = 'three-columns';
	}
	if ( ! is_wp_error( $terms ) ) {
		echo '<ul class="' . $class . '">';
		foreach ( $terms as $term ) {
			echo '<li><a href="' . get_term_link( $term ) .'">' . $term->name . '</a></li>';
		}
		echo '</ul>';
	}
	else {
		echo 'No taxonomy custom field was created.';
	}
}
*/

add_action( 'genesis_before_content', 'robin_do_taxonomy_loop' ); // Add custom loop
function robin_do_taxonomy_loop() {
	$tax = 'category';
	if ( genesis_get_custom_field( 'taxonomy' ) ) {
		$tax = genesis_get_custom_field( 'taxonomy' ); // custom field taxonomy => name
	}
	// $args  = genesis_get_custom_field( 'query_args' ); // custom field query_args => orderby=name&order=ASC (example)
	// $terms = get_terms( $tax, $args );
	$terms = get_terms( $tax );
	// $class = 'two-columns';
	if ( '3' === genesis_get_custom_field( 'columns' ) ) {
		$class = 'three-columns';
	}
	if ( ! is_wp_error( $terms ) ) {
		echo '<div class="gridcontainer"><div class="wrap toolbar mb2 mt2"><div class="coll1">
			 <button class="btn fil-cat active" href="" data-rel="all">'. __( 'All', 'monopro' ) .'</button>';
		foreach ( $terms as $term ) {
			echo '<button class="btn fil-cat" data-rel="' . $term->name . '">' . $term->name . '</button>';
			// echo '<li><a href="' . get_term_link( $term ) .'">' . $term->name . '</a></li>';
		}
		echo '</div></div></div>';
	}
	else {
		echo 'No taxonomy custom field was created.';
	}
}

// =======================================


//* Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {

   $classes[] = 'pin';
   return $classes;
   
}

//* Add custom class to content
add_filter( 'genesis_attr_content', 'add_content_class' );
function add_content_class( $classes ) {

   $classes['class'] .= ' pin-main js-masonry';
   return $classes;
   
}

//* Add custom class to entry
add_filter( 'genesis_attr_entry', 'add_entry_class' );
function add_entry_class( $classes ) {
	foreach((get_the_category()) as $category) {
   	$category_name = $category->cat_name;
	}
   
   $classes['class'] = ' masonry-brick scale-anm tile all ' . $category_name . '' . $post->title;
   return $classes;
   
}


// Add Thumbnail
add_action( 'genesis_entry_header', 'case_thumb' );
function case_thumb() {
	$thumb = get_field( 'case_thumbnail' );
	
			echo '<a href="' . get_permalink() . '"><div class="thumb-image"><img src="' . $thumb . '"></div></a>';
	
}

//* Add Client and summery content
add_action( 'genesis_entry_content', 'case_info', 5 );
function case_info() {
	$kunde = get_field( 'kunde' );
	$uddrag = get_field( 'uddrag' );
	$thumb = get_field( 'case_thumbnai' );
	
			echo '<strong>Kunde: </strong>' . $kunde . '';
			// echo '' . $uddrag . '';
}

//* Reposition archive navigation
// ==================================================================================================
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_content', 'genesis_posts_nav' );

add_filter ( 'genesis_next_link_text' , 'sp_next_page_link' );
function sp_next_page_link ( $text ) {
    return '<svg class="icon-untitled2"><use xlink:href="#icon-untitled2"></use></svg>';
}
add_filter ( 'genesis_prev_link_text' , 'sp_previous_page_link' );
function sp_previous_page_link ( $text ) {
    return '<svg class="icon-arrow-left7"><use xlink:href="#icon-arrow-left7"></use></svg>';
}
// ==================================================================================================

//* Run the Genesis loop
genesis();