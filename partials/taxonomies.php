<?php

function tiny_events_taxonomies() {

    // Add new taxonomy, NOT hierarchical (like tags)
    $event_type_labels = array(
        'name'                       => _x( 'Event type', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Event type', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Event types', 'textdomain' ),
        'all_items'                  => __( 'All Event types', 'textdomain' ),
        'parent_item'                => __( 'Parent Event Type', 'textdomain' ),
        'parent_item_colon'          => __( 'Parent Event Type:', 'textdomain' ),
        'edit_item'                  => __( 'Edit Event Type', 'textdomain' ),
        'update_item'                => __( 'Update Event Type', 'textdomain' ),
        'add_new_item'               => __( 'Add New Event Type', 'textdomain' ),
        'new_item_name'              => __( 'New Event Type Name', 'textdomain' ),
        'menu_name'                  => __( 'Event Types', 'textdomain' ),
    );

    $event_type_args = array(
        'hierarchical'          => true,
        'labels'                => $event_type_labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'type' ),
    );

    register_taxonomy( 'event_type', 'event', $event_type_args );

}
add_action( 'init', 'tiny_events_taxonomies' );