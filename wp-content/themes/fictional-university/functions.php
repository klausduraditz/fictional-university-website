<?php

    function university_files() {
        wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
        wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime());
    }

    add_action('wp_enqueue_scripts', 'university_files');

    // Add Theme features
    function university_features() {
        // Title Tag for Browser Title
        add_theme_support('title-tag');

        // // Register Menu Locations
        // register_nav_menu('headerMenuLocation', 'Header Menu Location');
        // register_nav_menu('footerLocationOne', 'Footer Location One');
        // register_nav_menu('footerLocationTwo', 'Footer Location Two');

    }

    // invoke university_features after page is loaded and theme is initialized
    add_action('after_setup_theme', 'university_features');

    // Adjust default WP Queries if only subtle changes are needed
    // -> avoid creating a custom query if only little changes to default query are needed
    function university_adjust_queries($query) {
        if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', -1);
        }

        // Apply only if not Backend AND only on Archive-Pages AND query is main WP URL Query (to not affect custom queries)
        if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
            $today = date('Ymd');
            $query->set('meta_key', 'event_date');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'ASC');
            $query->set('meta_query', array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                )
            ));
        }
    }

    add_action('pre_get_posts', 'university_adjust_queries');

?>