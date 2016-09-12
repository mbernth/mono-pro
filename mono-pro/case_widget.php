<?php
	
	echo '<span id="c-button--push-top" class="c-button"><svg class="icon-search"><use xlink:href="#icon-search"></use></svg></span>';
	/*
	$args = array('post_type' => 'case_post');
	
	$query = new WP_query ( $args );
    if ( $query->have_posts() ) {
		echo 'Hello world';
	}
	*/
	
	/*
	$button_text = get_field( 'button_text', $widget_id );  //Button text
	$button_url = get_field( 'button_url', $widget_id );  //Button url
	
	if ( $button_text || $button_url ) {
		if ( ! wp_is_mobile() ) {
			echo '<a href="#" data-display="box-bottom" class="button">' . $button_text . '</a>';
		}else{
			echo '<a href="' . $button_url . '" class="button" target="_blank">' . $button_text . '</a>';
		}
		if ( ! wp_is_mobile() ) {
			echo '<span id="box-bottom" class="portBox">';
			echo '<iframe  height="540" width="1080" scrolling="auto" frameborder="0" src="' . $button_url . '"></iframe>';
			echo '</span>';
		}else{
		
		}
	}
	*/
?>