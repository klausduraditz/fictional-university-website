<?php

    // $args = NULL for the case that no $args are provided
    function pageBanner($args = NULL) {
        
        // if no title is provided via $args directly in the template, use 
        if (!$args['title']) {
            $args['title'] = get_the_title();
        }

        if (!$args['subtitle']) {
            $args['subtitle'] = get_field('page_banner_subtitle');
        }

        if (!$args['photo']) {
            if (get_field('page_banner_background_image')) {
                $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
            } else {
                $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
            }
        }

        ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>);">
            </div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
                <div class="page-banner__intro">
                    <p><?php echo $args['subtitle']; ?></p>
                </div>
            </div>  
        </div>        
    <?php }


    function university_files() {
        wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyBN202vzXlnhLGU_PwK79oCgg1eTkT-Z1Y', NULL, '1.0', true);
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
        add_theme_support('post-thumbnails');
        add_image_size('professorLandscape', 400, 260, true); // thumbsize-name, width, length, crop (cropping center can be set via array)
        add_image_size('professorPortrait', 480, 650, true);
        add_image_size('pageBanner', 1500, 350, true);

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
        if (!is_admin() && is_post_type_archive('campus') && $query->is_main_query()) {
            $query->set('posts_per_page', -1);
        }
        
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

    // hand google maps js api key to acf plugin
    function universityMapKey($api) {
        $api['key'] = 'AIzaSyBN202vzXlnhLGU_PwK79oCgg1eTkT-Z1Y';
        return $api;
    }

    add_filter('acf/fields/google_map/api', 'universityMapKey');

?>