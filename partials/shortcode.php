<?php

add_shortcode( 'tiny-events', 'display_custom_post_type' );

function display_custom_post_type(){

    $args = array(
        'post_type'         => 'event',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'meta_query'        => array(
            'relation'      => 'AND',
            'event_date'    => array(
                'key'       => 'date',
                'compare'   => 'EXISTS',
                'type'      => 'NUMERIC'
            ),
            'event_time'    => array(
                'key'       => 'start_time',
                'compare'   => 'EXISTS',
                'type'      => 'NUMERIC'
            ),
        ),
        'orderby'           => array(
            'event_date'    => 'ASC',
            'event_time'    => 'ASC'
        ),
    );

    $tiny_events_loop = '';

    $query = new WP_Query( $args );
    
    if( $query->have_posts() ){

        // filters
        require_once(TINY_EVENTS_PATH . '/templates/filters.php');

        // loop
        require_once(TINY_EVENTS_PATH . '/templates/loop.php');

    }

    wp_reset_postdata();
    return $tiny_events_loop;
}