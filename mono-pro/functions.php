<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Include Icons
include_once( get_stylesheet_directory() . '/lib/svg_icons.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Setup extended search to include ACF content
include_once( get_stylesheet_directory() . '/lib/custom-search-acf-wordpress.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'monopro', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'monopro' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'mono pro' );
define( 'CHILD_THEME_URL', 'https://github.com/mbernth/mono-pro' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Titillium+Web:600|Ubuntu:400,400i,700,700i&subset=latin-ext', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'monopro-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'mono-jquery', get_stylesheet_directory_uri() . '/js/jquery-1.9.1.min.js', array( 'jquery' ), '1.0.0' );
	// Responsive text for selected headlines
	wp_enqueue_script( 'mono-fittext', get_stylesheet_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '1.0.0', true );
	// Responsive movie scripts
	wp_enqueue_script( 'mono-fitvids-script', get_stylesheet_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'mono-fitvids', get_stylesheet_directory_uri() . '/js/fitvids.js', array( 'jquery' ), '1.0.0', true );
	/* Google map scripts for ACF gmap
	wp_enqueue_script( 'mono-googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'mono-maps', get_stylesheet_directory_uri() . '/js/maps.js', array( 'jquery' ), '1.0.0', true );	 */
	// Flip script used for team
	wp_enqueue_script( 'mono-flip-jquery', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'mono-modernizr', get_bloginfo( 'stylesheet_directory' ) . '/js/modernizr.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'mono-flip', get_bloginfo( 'stylesheet_directory' ) . '/js/mono_flip.js', array( 'jquery' ), '1.0.0' );
	// Timeline script
	wp_enqueue_script( 'moono-timeline', get_bloginfo( 'stylesheet_directory' ) . '/js/timeline.js', array( 'jquery' ), '1.0.0' );
	// Countdown script
	wp_enqueue_script( 'countdown', get_stylesheet_directory_uri() . '/js/countdown.js', array( 'jquery' ), '1.0.0' );
	// Quotes scripts
	wp_enqueue_script( 'quotes', get_stylesheet_directory_uri() . '/js/quotes.js', array( 'jquery' ), '1.0.0' , true);
	wp_enqueue_script( 'quote_action', get_stylesheet_directory_uri() . '/js/quote_action.js', array( 'jquery' ), '1.0.0' , true);
	// Split slider
	wp_enqueue_script( 'ba-cond', get_stylesheet_directory_uri() . '/js/jquery.ba-cond.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'slitslider', get_stylesheet_directory_uri() . '/js/jquery.slitslider.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'slide-nav', get_stylesheet_directory_uri() . '/js/slide.nav.js', array( 'jquery' ), '1.0.0', true );
	// Flickity
	wp_enqueue_script( 'flickity', get_stylesheet_directory_uri() . '/js/flickity.pkgd.min.js', array( 'jquery' ), '1.0.0', true );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

/** Conditional html element classes */
remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'child_do_doctype' );
function child_do_doctype() {
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html class="ie6" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <?php
}

//* Add custom meta tag for mobile browsers
add_action( 'genesis_meta', 'monopro_viewport_meta_tag' );
function monopro_viewport_meta_tag() {
	echo '<meta name="HandheldFriendly" content="True">';
	echo '<meta name="MobileOptimized" content="320">';
}
// Change favicon location and add touch icons
add_filter( 'genesis_pre_load_favicon', 'monopro_favicon_filter' );
function monopro_favicon_filter( $favicon ) {
	echo '<link rel="shortcut icon" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon.ico" type="image/x-icon" />';
	echo '<link rel="apple-touch-icon" sizes="57x57" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-57x57.png">';
	echo '<link rel="apple-touch-icon" sizes="60x60" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-60x60.png">';
	echo '<link rel="apple-touch-icon" sizes="72x72" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-72x72.png">';
	echo '<link rel="apple-touch-icon" sizes="76x76" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-76x76.png">';
	echo '<link rel="apple-touch-icon" sizes="114x114" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-114x114.png">';
	echo '<link rel="apple-touch-icon" sizes="120x120" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-120x120.png">';
	echo '<link rel="apple-touch-icon" sizes="144x144" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-144x144.png">';
	echo '<link rel="apple-touch-icon" sizes="152x152" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-152x152.png">';
	echo '<link rel="apple-touch-icon" sizes="180x180" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-180x180.png">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-16x16.png" sizes="16x16">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-32x32.png" sizes="32x32">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-96x96.png" sizes="96x96">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/android-chrome-192x192.png" sizes="192x192">';
	echo '<meta name="msapplication-square70x70logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//smalltile.png" />';
	echo '<meta name="msapplication-square150x150logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//mediumtile.png" />';
	echo '<meta name="msapplication-wide310x150logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//widetile.png" />';
	echo '<meta name="msapplication-square310x310logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//largetile.png" />';

}

//* Add svg upload
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );	

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Position elemente
// =====================================================================================================================

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Widgets
// =====================================================================================================================

//* Remove the header right widget area
unregister_sidebar( 'header-right' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'before-header',
	'name'        => __( 'Before Header', 'monopro' ),
	'description' => __( 'This is the before header widget area.', 'monopro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'before-header-search',
	'name'        => __( 'Above Header Search', 'monopro' ),
	'description' => __( 'This is the search widget area above header.', 'monopro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-footer-search',
	'name'        => __( 'After Footer Search', 'monopro' ),
	'description' => __( 'This is the search widget area after footer.', 'monopro' ),
) );

//* Hook before header widget area above header
add_action( 'genesis_before_header', 'monopro_before_header', 15 );
function monopro_before_header() {

	genesis_widget_area( 'before-header', array(
		'before' => '<div class="before-header widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}
//* Hook Search widget area above header
add_action( 'genesis_before', 'monopro_search_above', 15 );
function monopro_search_above() {

	genesis_widget_area( 'before-header-search', array(
		'before' => '<nav id="c-menu--push-top" class="c-menu c-menu--push-top widget-area"><div class="wrap"><span class="c-menu__close"><svg class="icon-cross"><use xlink:href="#icon-cross"></use></svg></span>',
		'after'  => '</div></nav><div id="c-mask" class="c-mask"></div>',
	) );

}
//* Hook Search widget area after footer
add_action( 'genesis_before_footer', 'monopro_search_after', 15 );
function monopro_search_after() {

	genesis_widget_area( 'after-footer-search', array(
		'before' => '<div class="footer_search"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

//* Push search
// =====================================================================================================================

add_filter( 'genesis_attr_site-container', 'themeprefix_site_container_id' );
function themeprefix_site_container_id( $attributes ) { 
 $attributes['id'] = 'o-wrapper';
 $attributes['class'] .= ' o-wrapper';
 return $attributes;
}

add_action( 'wp_enqueue_scripts', 'push_scripts_styles' );
function push_scripts_styles() {
		wp_enqueue_script( 'classie-script', get_bloginfo( 'stylesheet_directory' ) . '/js/menu.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'push-script', get_stylesheet_directory_uri() . '/js/menu_push.js', array( 'jquery' ), '1.0.0', true );
}


//* Costum Search form
// =====================================================================================================================

/*
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML. 
*/
function wpdocs_my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div>
	<span class="c-button_icon"><svg class="icon-search"><use xlink:href="#icon-search"></use></svg></span>
    <input class="input__field input__field--yoko" type="search" value="' . get_search_query() . '" name="s" id="s" />
	<label class="input__label input__label--yoko" for="s"><span class="input__label-content input__label-content--yoko">' . __( 'Search' ) . '</span></label>
	<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );


//* Flexible grids
// =====================================================================================================================

// check if the flexible content field has rows of data
add_action( 'genesis_after_entry', 'mono_flexible_grids', 15 );
function mono_flexible_grids() {
	
	if ( is_single() || is_page() ) {
	
	$loopCount = 0;
	
	
	
	if( have_rows('content_row') ):
	
		
	
		// loop through the rows of data
    	while ( have_rows('content_row') ) : the_row();
			$headline = 	get_sub_field('row_headline');
			$rowbutton = get_sub_field('row_button');
			$rowbuttonmanual = get_sub_field('row_button_manual_url');
			$rowtext = 	get_sub_field('row_button_clone');
			$coll = get_sub_field('columns_no');

        	if( get_row_layout() == 'row_setup' ):
			
			// This will hide a whole row
			if (get_sub_field('hide_row')){
				
				}else{
				// Add background color and ID if needed
				echo '<article class="gridcontainer  ';
						the_sub_field('background_colour');
					if (get_sub_field('row_id')){
						echo '" id="';
					 	the_sub_field('row_id');
					}
				echo '" >';
				// Add row headline
				if ($headline){
					echo '<h1 class="row_headline">' . $headline . '</h1>';
				}
				
				
				echo '<div class="wrap">';
					$selected = get_sub_field('background_colour');
					$content = get_sub_field('content');
					
					
					while ( have_rows('column') ) : the_row();
							
							// Column fields
							if (get_sub_field('content')){
							$colbtn = get_sub_field('column_content_button');
							
							echo '<section class="coll' . $coll . ' wysiwyg">';
								the_sub_field('content');
								// Column botton
								if ($colbtn['button_text']){
									if ($colbtn['page_link']){
									echo '<a class="button" href="' . $colbtn['page_link']. '"><span>';
									}else{
									echo '<a class="button" href="' . $colbtn['url_link']. '" target="_blank""><span>';
									}
									echo '' . $colbtn['button_text']. '';
									echo '</span></a>';
								}
							echo '</section>';
							}
							
							// Widget fields
							if (get_sub_field('widget_content')){
							echo '<section class="coll' . $coll. '">';
								the_sub_field('widget_content');
							echo '</section>';
							}
							
							// Timeline fields
							if (get_row_layout() == 'timeline'){
							echo '<section id="cd-timeline" class="coll' . $coll. ' cd-container">';
									$items = get_field( 'timeline_item', 'option' );
									
									if($items) {
										
										foreach($items as $item) {
											$itembtn = $item['item_button_link'];
											
											if ($item['hide_timeline_item']){
											}else{
												echo '
       												 <div class="cd-timeline-block">
													 	<div class="cd-timeline-img cd-picture"></div>
														<div class="cd-timeline-content">
															<h2>' . $item['item_headline'] .'</h2>
															<p><strong>' . $item['item_source'] .'</strong> / ' . $item['item_category'] .'</p>
															' . $item['item_text'] .'';
															// Timeline item button												
															if ($itembtn['button_text']){
																if ($itembtn['page_link']){
																	echo '<a class="button" href="' . $itembtn['page_link']. '"><span>';
																}else{
																	echo '<a class="button" href="' . $itembtn['url_link']. '" target="_blank""><span>';
																}
																echo '' . $itembtn['button_text']. '';
																echo '</span></a>';
															}
								
												echo '		<span class="cd-date">' . $item['item_date'] .'</span>
														</div>
													</div>';
											}
										}
									}
							echo '</section>';
							}
							
							// Image fields
							if (get_sub_field('image_link')){
								// Image Array
								$image =  get_sub_field('image_link');
								$btn = get_sub_field ( 'image_button' );
								
								if( get_sub_field('content') && $selected == 'Non'  || $selected == 'Non Black'  || $selected == 'Non Red'  || $selected == 'Non Grey') {
									// Full field images
									echo '<section class="coll' . $coll. ' backimage" style="background-image: url('.$image['url'].');"></section>';
									
									}else{
										
									echo '<section class="coll' . $coll. '">';
										echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
										// Image button
										if ($btn['button_text']){
											if ($btn['page_link']){
												echo '<a class="button" href="' . $btn['page_link']. '"><span>';
											}else{
												echo '<a class="button" href="' . $btn['url_link']. '" target="_blank""><span>';
											}
											echo '' . $btn['button_text']. '';
											echo '</span></a>';
										}
									echo '</section>';
										
								}
							}
							
							// Flickity
							if (get_row_layout() == 'flickity'){
								
								$rows = get_sub_field( 'flickity_images' );
								
								
								echo '<section class="coll' . $coll. '">';
									echo '<div class="carousel" data-flickity>';
										foreach($rows as $row) {	
										// Image Array
										$image = $row['flickity_image'];
											if($rows) {
												echo '<div class="carousel-cell">';
													echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
												echo '</div>';
											}
										}
									echo '</div>';
								echo '</section>';
							}
							
							// Video fields
							if (get_sub_field('video_embeding_code')){
							echo '<section class="coll' . $coll. '">';
								the_sub_field('video_embeding_code');
							echo '</section>';
							}
							
							// Push content fields
							if (get_sub_field('push_article')){
							echo '<section class="coll' . $coll. '">';
								the_sub_field('push_article');
								echo '<button id="trigger-overlay" type="button"><span>';
									the_sub_field('push_button_text');
								echo '</span></button>';
							echo '</section>';
							}
							
							// Google map fields
							if (get_sub_field('google_map')){
								$location = get_sub_field('google_map');
								
								echo '<section class="coll' . $coll. '">';
								echo '<div class="acf-map">
		 								<div class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'"></div>
		 							  </div>';
								echo '</section>';
							}
							
							// Quotes fields
							if (get_row_layout() == 'quotes_content'){
								$items = get_field( 'quotes', 'option' );
								if($items) {
								echo '<section class="coll' . $coll. '">';
									echo '<div id="cbp-qtrotator" class="cbp-qtrotator">';
										foreach($items as $item) {	
											echo '<div class="cbp-qtcontent">
											      	<blockquote>' . $item['quote'] .'</blockquote>
													<footer>' . $item['quote_name'] .'</footer>
												  </div>';
										}
									echo '</div>';
								echo '</section>';
								}
							}
							
							// Team fields
							if ( get_row_layout() == 'team' ){
								$teamheadline = get_field( 'team_headline', 'option' );
								$rows = get_field( 'team', 'option' );
								$partners = get_field( 'associated_partners', 'option' );
								$partnersheadline = get_field( 'associated_partners_headline', 'option' );
								
								if($rows) {
									
									foreach($rows as $row) {	
						
										if ($row['hide_team_member']){
										// Show nothing
										}else{
										echo '<div class="coll' . $coll. ' column">
            										<div class="caption caption-5">
													<div class="profile">
													<div class="team-image">
														<img src="' . $row['picture'] .'" title="' . $row['name']. ', ' . $row['title']. '" alt="' . $row['name']. ', ' . $row['title']. '">
													</div>
													<div class="team-info">
														<h3>' . $row['name']. '</h3>
														<p><em>' . $row['title']. '</em></p>
													</div>
													</div>
													<div class="info">
													' . $row['profile_text']. '
													<div class="team-info">
														<a href="mailto:' . $row['email']. '" class="btn"><svg class="icon-mail"><use xlink:href="#icon-mail"></use></svg> ' . $row['email']. '</a>
														<a href="tel:' . $row['telephone']. '" class="btn"><svg class="icon-mobile"><use xlink:href="#icon-mobile"></use></svg> ' . $row['telephone']. '</a>
														<a href="' . $row['linkedin']. '" class="btn" target="_blank"><svg class="icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg> Linkedin</a>
													</div>
													</div>
            										</div>  
													</div>';
										}
									
									} // Foreach end
								}
							}
							
							// Preview fields
							if ( get_row_layout() == 'preview' ){
								$btn = get_sub_field ( 'preview_link' );
								// Image Array
								$thumb = get_sub_field('preview_thumbnail');
								
								
								echo '<section class="coll' . $coll. '">';
									echo '<div class="entry-content entry-content-preview hover-preview" itemprop="text">';
										
									
									if ($thumb){
										
										if ($btn){
											if ($btn['page_link']){
												echo '<a href="' . $btn['page_link']. '">';
											}else{
												echo '<a href="' . $btn['url_link']. '" target="_blank"">';
											}
												echo '<div class="thumb-image hover">';
												
													echo '<div class="entry-preview">';
													echo '<header class="entry-header">';
													echo '<h2 class="entry-title" itemprop="headline">';
														the_sub_field('preview_name');
													echo '</h2></header>';
													echo '	<p>';
														the_sub_field('preview_client');
													echo '</p>';
													echo '</div>';
													
													echo '<img src="'. $thumb['url'] . '" alt="'.$thumb['alt'].'">';
												echo '</div>';
											echo '</a>';
										}else{
											echo '<div class="thumb-image hover">';
												
												echo '<div class="entry-preview">';
												echo '<header class="entry-header">';
												echo '<h2 class="entry-title" itemprop="headline">';
													the_sub_field('preview_name');
												echo '</h2></header>';
												echo '	<p>';
													the_sub_field('preview_client');
												echo '</p>';
												echo '</div>';
													
												echo '<img src="'. $thumb['url'] . '" alt="'.$thumb['alt'].'">';
											echo '</div>';
										}
										
									}
												
										the_sub_field('preview_text');
												
												
									echo '</div>';
								
								echo '</section>';
								
							}
					
					endwhile;
				
				echo '</div>';
				
				// Row button field
				if ($rowtext['button_text']){
					if ($rowtext['page_link']){
						echo '<a class="button" href="' . $rowtext['page_link']. '"><span>';
						}else{
						echo '<a class="button" href="' . $rowtext['url_link']. '" target="_blank""><span>';
					}
						echo '' . $rowtext['button_text']. '';
						echo '</span></a>';
				}
				echo '</article>';
			
			}
			endif;
			$loopCount ++;
			
			// Full screen image fields
			if( get_row_layout() == 'full_screen_image' ):
				$btn = get_sub_field ( 'full_screen_button' );
				
				if (get_sub_field ( 'hide_full_screen_image' )){
				}else{
				echo '<article class="gridcontainer fullscreen Black">
					<div class="featured-section" style="background-image:url('; 
					the_sub_field('full_screen_back_image');
					echo');"><div class="image-section">';
					
						echo '<div class="slide_content animation-moveUp">';
						if (get_sub_field ( 'full_screen_headline' )){
							echo '<h1>';
								the_sub_field('full_screen_headline');
							echo '</h1>';
						}
						
						while ( have_rows('full_screen_content_types') ) : the_row();
							$items = get_sub_field('full_screen_quotes');
							
							// Text Content
							if (get_row_layout() == 'full_screen_quotes'){
								the_sub_field('full_screen_content');
							}
							
							// Image Content
							if (get_row_layout() == 'full_screen_image'){
								// Image Array
								$image =  get_sub_field('image');
								echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
							}
							
							// Quotes Rotator
							if (get_row_layout() == 'full_screen_quotes'){
								$items = get_field( 'quotes', 'option' );
								if($items) {
									echo '<div id="cbp-qtrotator" class="cbp-qtrotator">';
										foreach($items as $item) {	
											echo '<div class="cbp-qtcontent">
											      	<blockquote>' . $item['quote'] .'</blockquote>
													<footer>' . $item['quote_name'] .'</footer>
												  </div>';
										}
									echo '</div>';
								}
							}
							
							// Countdown - change date in jquery
							if (get_row_layout() == 'full_screen_countdown'){
								echo '<div id="countdown" class="clearfix">
										<div class="cd-box">
											<span class="numbers days">00</span><span class="strings timeRefDays">Dage</span>
										</div>
										<div class="cd-box">
											<span class="numbers hours">00</span><span class="strings timeRefHours">Timer</span>
										</div>
										<div class="cd-box">
											<span class="numbers minutes">00</span><span class="strings timeRefMinutes">Minutter</span>
										</div>
										<div class="cd-box">
											<span class="numbers seconds">00</span><span class="strings timeRefSeconds">Sekunder</span>
										</div>
									</div>';
							}
							
						endwhile;
						
						if ($btn){
							if ($btn['page_link']){
								echo '<a class="button" href="' . $btn['page_link']. '"><span>';
							}else{
								echo '<a class="button" href="' . $btn['url_link']. '" target="_blank""><span>';
							}
							echo '' . $btn['button_text']. '';
							echo '</span></a>';
						}
					
				echo '</div></div></div></article>';
				}
			endif;
			
			// Full screen slider fields
			if( get_row_layout() == 'full_screen_slider' ):
				$rows = get_sub_field( 'split_slider' );
				
				if (get_sub_field ( 'hide_slider' )){
				}else{
					// if($rows) {
					if($rows){
						$items = $rows['slider'];
						
						echo '<div class="container image-section">
							  <div id="slider" class="sl-slider-wrapper image-section">
							  <div class="sl-slider">';
						
						foreach($items as $item) {
							$btn = $item['link'];
							
							echo '<div class="sl-slide bg-1" data-orientation="vertical" data-slice1-rotation="0" data-slice2-rotation="0" data-slice1-scale="0" data-slice2-scale="0">';
							echo '<div class="sl-slide-inner front-page-1" style="background-image:url(' . $item['image']. ');">';
							
							if( $item['logo'] ){
								echo 	'<img src="' . $item['logo']. '">';
							}
							if( $item['headline'] ){
								echo 	'<h3>' . $item['headline']. '</h3>';
							}
							if( $item['text'] ){
								echo 	'<div class="slider-text">' . $item['text']. '</div>';
							}
							
							if ($btn){
								if ($btn['page_link']){
									echo '<div class="slider-link"><a class="button" href="' . $btn['page_link']. '">';
								}else{
									echo '<div class="slider-link"><a class="button" href="' . $btn['url_link']. '" target="_blank""><span>';
								}
								echo '' . $btn['button_text']. '';
								echo '</a></div>';
							}
							
							echo '</div> <!-- /sl-slide-inner -->';
							echo '</div> <!-- /sl-slide -->';
						
						}
						
						echo '<nav id="nav-arrows" class="nav-arrows">
				  			  <span class="nav-arrow-prev">Previous</span>
				 			  <span class="nav-arrow-next">Next</span>
		  		 		  	  </nav>';
						
						echo '</div></div></div>';
						
					}
					// }
				}
				
			endif;
			
			
    	endwhile;
	
	else :

    // no layouts found

	endif;
	
	}

}

// check if the Push content field has data
// =====================================================================================================================
add_action( 'genesis_after', 'mono_push_content', 15 );
function mono_push_content() {
	
	
	if( have_rows('content_row') ):
		while ( have_rows('content_row') ) : the_row();
			if( get_row_layout() == 'row_setup' ):
				while ( have_rows('column') ) : the_row();
				// $rows = get_field( 'push_content' );
				//	if($rows) {
					if (get_sub_field('push_article')){
						echo '<div class="overlay overlay-contentpush">';
						echo '<button type="button" class="overlay-close">Close</button><section>';
							the_sub_field('text_content');
						echo '</section></div>';
					}
				//	}
				endwhile;
			endif;
		endwhile;
	endif;	
}

add_action( 'wp_enqueue_scripts', 'push_scripts_jquery' );
function push_scripts_jquery() {
	$pushcontent = get_field('content_row');
	$push = get_sub_field( 'push_content' ); 
		
	if( have_rows('content_row') ):
	while ( have_rows('content_row') ) : the_row();
		if( get_row_layout() == 'row_setup' ){
		while ( have_rows('column') ) : the_row();
		if (get_sub_field('push_article')){
			wp_enqueue_script( 'classie-push-script', get_bloginfo( 'stylesheet_directory' ) . '/js/classie.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'push-script-jquery', get_stylesheet_directory_uri() . '/js/push.js', array( 'jquery' ), '1.0.0', true );
		}
		endwhile;
		}
	endwhile;
	endif;
}


//* Featured Image
// =====================================================================================================================


//* DISPLAY FULL WIDTH FEATURED IMAGE ON STATIC PAGES
add_action ( 'genesis_after_header', 'single_post_featured_image', 15 );
function single_post_featured_image() {
	if ( (is_single() || is_page()) && has_post_thumbnail() ) :
	
		$img = genesis_get_image( array( 'format' => 'src' ) );
		printf( '<div class="featured-section" style="background-image:url(%s);"><div class="image-section"></div></div>', $img );
		
		elseif( (! is_front_page()) ):
		printf( '<div class="image-section" style="background-color:#231f20;"></div>', $img );
		
		
	endif;
	
}

//* Post button
// =====================================================================================================================

// check if the flexible content field has rows of data
add_action( 'genesis_entry_content', 'mono_post_button', 15 );
function mono_post_button() {
	$btntype = get_field( 'button_type' );
	$btntext = get_field( 'button_text' );
	$btnpage = get_field( 'page_link' );
	$btnurl = get_field( 'url_link' );
	
	if ($btntype){
		
		if ($bntpage){
			echo '<a class="button" href="' .$bntpage. '"><span>';
		}else{
			echo '<a class="button" href="' .$btnurl. '" target="_blank""><span>';
		}
			echo '' .$btntext. '';
			echo '</span></a>';
		
	}
	
}

// =====================================================================================================================

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_featured_image' );
function enqueue_scripts_featured_image() {
	
	if ( (is_single() || is_page()) && has_post_thumbnail() ) :
		// wp_enqueue_script( 'mono-jquery', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'mono-image-height', get_stylesheet_directory_uri() . '/js/image.height.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'parallax-script', get_bloginfo( 'stylesheet_directory' ) . '/js/parallax.js', array( 'jquery' ), '1.0.0' );
	endif;
	
}

add_filter( 'body_class', 'featured_body_class' );
function featured_body_class( $classes ) {
	
	if ( ( is_single( )  || is_page()) && has_post_thumbnail() )
		$classes[] = 'featured-image';
		return $classes;
		
}

//* Team & Timeline
// =====================================================================================================================

// Add events option page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Team',
		'menu_title'	=> 'Team'
	));
	
	acf_add_options_page(array(
		'page_title' 	=> 'Timeline',
		'menu_title'	=> 'Timeline'
	));
	
	acf_add_options_page(array(
		'page_title' 	=> 'Quotes',
		'menu_title'	=> 'Quotes'
	));
}

//* Case widget
// =====================================================================================================================
//* Add Case widget for ACF
if ( ! class_exists( 'Case_Widget' ) ) {
	class Case_Widget extends WP_Widget
	{
		function Case_Widget() 
		{
			parent::WP_Widget(false, "Costum Search Widget");
		}
 
		function update($new_instance, $old_instance) 
		{  
			return $new_instance;  
		}  
 
		function form($instance)
		{  
			$title = esc_attr($instance["title"]);  
			echo "<br />";
		}
 
		function widget($args, $instance) 
		{
			$widget_id = "widget_" . $args["widget_id"];
 
			// I like to put the HTML output for the actual widget in a seperate file
			include(realpath(dirname(__FILE__)) . "/case_widget.php");
		}
	}
}
register_widget("Case_Widget");

//* Register Case widget areas
genesis_register_sidebar( array(
	'id'          => 'case_widget_area',
	'name'        => __( 'Case', 'monopro' ),
	'description' => __( 'This is the Case widget area.', 'monopro' ),
) );

//* Gravity forms
// =====================================================================================================================

// Enables the confirmation anchor on all forms
add_filter( 'gform_confirmation_anchor', '__return_true' );