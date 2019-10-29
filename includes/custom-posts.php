<?php

if ( ! function_exists('makplus_custom_post_type') ) {
	
    /**
     * Register a custom post type.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_post_type
     */
    function makplus_custom_post_type() {

        //portfolio
        register_post_type(
            'portfolio', array(
            'labels'                 => array(
                'name'               => _x( 'Portfolio', 'post type general name', 'makplus' ),
                'singular_name'      => _x( 'Portfolio', 'post type singular name', 'makplus' ),
                'menu_name'          => _x( 'Portfolio', 'admin menu', 'makplus' ),
                'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'makplus' ),
                'add_new'            => _x( 'Add New', 'Portfolio', 'makplus' ),
                'add_new_item'       => __( 'Add New Portfolio', 'makplus' ),
                'new_item'           => __( 'New Portfolio', 'makplus' ),
                'edit_item'          => __( 'Edit Portfolio', 'makplus' ),
                'view_item'          => __( 'View Portfolio', 'makplus' ),
                'all_items'          => __( 'All Portfolio', 'makplus' ),
                'search_items'       => __( 'Search Portfolio', 'makplus' ),
                'parent_item_colon'  => __( 'Parent Portfolio:', 'makplus' ),
                'not_found'          => __( 'No Portfolio found.', 'makplus' ),
                'not_found_in_trash' => __( 'No Portfolio found in Trash.', 'makplus' )
            ),

            'description'        => __( 'Description.', 'makplus' ),
            'menu_icon'          => 'dashicons-layout',
            'public'             => true,
            'show_in_menu'       => true,
            'has_archive'        => false,
            'hierarchical'       => true,
            'rewrite'            => array( 'slug' => 'portfolio' ),
            'supports'           => array( 'title', 'editor', 'thumbnail' )
        ));

        // portfolio taxonomy
        register_taxonomy(
            'portfolio_category',
            'portfolio',
            array(
                'labels' => array(
                    'name' => __( 'Portfolio Category', 'makplus' ),
                    'add_new_item'      => __( 'Add New Category', 'makplus' ),
                ),
                'hierarchical' => true,
                'show_admin_column'     => true
        ));
    }

    add_action( 'init', 'makplus_custom_post_type' );

}