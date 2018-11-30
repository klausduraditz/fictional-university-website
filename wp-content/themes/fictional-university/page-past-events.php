<?php

    get_header(); 
    
    pageBanner(array(
        'title' => 'Past Events',
        'subtitle' => 'A recap of our past events.'
    ))
    
    ?>
    
    <div class="container container--narrow page-section">
        <?php 

            $today = date('Ymd');

            $pastEvents = new WP_Query(array(
                // When using custom queries instead of default URL-based queries, pagination requires the following line 
                // (see also function paginate_links at the bottom)
                'paged' => get_query_var('paged', 1),
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                // show only dates that are in the past
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'compare' => '<=',
                        'value' => $today,
                        'type' => 'numeric'
                    )
                )
            ));

            while($pastEvents->have_posts()) {
                $pastEvents->the_post();
                get_template_part('template-parts/content-event');
                                 
            }

            // When using custom queries instead of default URL-based queries, pagination requires additional setup in paginate_links function
            echo paginate_links(array(
                'total' => $pastEvents->max_num_pages
            ));
        ?>
    </div>


    <?php get_footer();

?>