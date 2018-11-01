<?php

add_action('after_setup_theme', function ( ) {
        /**
         * Enable features from Soil when plugin is activated
         * @link https://roots.io/plugins/soil/
         */
        add_theme_support('soil-clean-up');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        // add_theme_support('soil-relative-urls');

        /**
         * Enable plugins to manage the document title
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
         */
        add_theme_support('title-tag');

        /**
         * Register navigation menus
         * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
         */
        register_nav_menus([
                'primary_navigation' => __('Primary Navigation', 'mml-wp-api-primary-navigation')
        ]);

        /**
         * Enable post thumbnails
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // load_theme_textdomain( '<text-domain>', get_template_directory( ) . '/lang' );

}, 20);
