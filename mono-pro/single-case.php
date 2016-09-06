<?php
/**
 * This file adds the home template to the mono pro.
 *
 * @author mono voce aps
 * @package mono pro
 * @subpackage Customizations
*/

/*
Template Name: Case Single
*/


//* Reposition Breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the entry title (requires HTML5 theme support)
// remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove the entry meta in the entry header
// remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
 
//* To remove empty markup, '<p class="entry-meta"></p>' for entries that have not been assigned to any Genre
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


add_action( 'genesis_entry_content', 'case_info', 1 );
function case_info() {
	$case = get_field( 'case_name' );
	$kunde = get_field( 'kunde' );
	$uddrag = get_field( 'uddrag' );
	
	if ( $kunde || $uddrag ) {
		
		echo '<div class="flexcontainer">';
			echo '<div class="box">';
				if ( $case ) {
					echo '<p><strong>Case: </strong></p>';
				}
			echo '</div>';
			echo '<div class="box">';
				if ( $case ) {
					echo '<p>' . $case . '</p>';
				}
			echo '</div>';
			echo '<div class="box">';
				if ( $kunde ) {
					echo '<p><strong>Kunde: </strong></p>';
				}
			echo '</div>';
			echo '<div class="box">';
				if ( $kunde ) {
					echo '<p>' . $kunde . '</p>';
				}
			echo '</div>';
		echo '</div>';
		echo '<div class="gridcontainer">';
			echo '<div class="coll1 excerpt">';
				if ( $uddrag ) {
					echo '<p>' . $uddrag . '</p>';
				}
			echo '</div>';
		echo '</div>';
		
	}
	
}

// Post next previous links
add_action( 'genesis_after_entry', 'ja_prev_next_post_nav', 20 );
function ja_prev_next_post_nav() {
	if( is_single() || is_category( array( 'blog') ) ){
		echo '<selction class="gridcontainer Black"><div class="prev-next-navigation wrap ">';
			
			next_post_link( '<div class="coll2 previous"><svg class="icon-arrow-left7"><use xlink:href="#icon-arrow-left7"></use></svg> %link</div>', '%title' );
			previous_post_link( '<div class="coll2 next">%link <svg class="icon-untitled2"><use xlink:href="#icon-untitled2"></use></svg></div>', '%title' );
			
		echo '</div></section>';
	}
}


//* Run the Genesis loop
genesis();