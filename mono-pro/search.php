<?php
/**
 * This file adds custom search results template to the mono pro.
 *
 * @author mono voce aps
 * @package mono pro
 * @subpackage Customizations
*/

add_action( 'genesis_before_loop', 'genesis_do_search_title' );
/**
 * Echo the title with the search term.
 *
 * @since 1.9.0
 */
function genesis_do_search_title() {

	$title = sprintf( 
		'<article class="entry">
			<header class="entry-header">
				<h1 class="entry-title" itemprop="headline">%s</h1>
			</header>
			<div class="entry-content">
				<h5>Du søgte efter: <em>%s</em></5>
			</div>
		</article>
		'
		, apply_filters( 'genesis_search_title_text', __( 'Søgeresultat', 'genesis' ) ), get_search_query() );

	echo apply_filters( 'genesis_search_title_output', $title ) . "\n";

}

remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
add_action( 'genesis_loop_else', 'themeprefix_genesis_do_noposts' );
function themeprefix_genesis_do_noposts() {
	printf( 
	'<div class="entry">
		<p>%s</p>
	</div>'
	, apply_filters( 'genesis_noposts_text', __( 'Der var desværre igen resultater af din søgning, prøv igen.', 'genesis' ) ) );
	
	echo '<div class="gridcontainer Black">
			<div class="wrap">
				<section class="coll1 search_again">
					<h5>Søg igen</h5>
				</section>
				<section class="coll1 search_again">';
					get_search_form();
	echo '		</section>
			</div>
		  </div>';
}

genesis();
