<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>
        
        <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);">
        </div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title">Welcome to our Blog!</h1>
                <div class="page-banner__intro">
                    <p>!! Implement Subtitle later !!</p>
                </div>
            </div>  
        </div>

        <div class="container container--narrow page-section">

            <?php 
                $parentID = wp_get_post_parent_id(get_the_ID());
                // Show metabox menu only on child pages
                if ($parentID) { ?>
                    <div class="metabox metabox--position-up metabox--with-home-link">
                        <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($parentID); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentID); ?></a> <span class="metabox__main"><?php the_title() ?></span></p>
                    </div>
                <?php }
            ?>
            
            <?php

            // if get_pages returns empty array, current page is not a parent page
            $isParent = get_pages(array(
                'child_of' => get_the_ID()
            ));

            // if current page HAS a parent ($parentID !== 0) or IS a parent ($isParent !== array()), output sidebar menu
            if ($parentID || $isParent) { ?>
                <div class="page-links">
                    <h2 class="page-links__title"><a href="<?php echo get_permalink($parentID); ?>"><?php echo get_the_title($parentID); ?></a></h2>
                    <ul class="min-list">
                        <?php
                            // store ID of parent page in $childOfID to use in args for wp_list_pages -> show context menu on either parent or child pages 
                            // if not on parent page store value from $parentID, else just use get_the_ID for current page ID (as we already are on parent page)
                            if ($parentID) {
                                $childOfID = $parentID;
                            } else {
                                $childOfID = get_the_ID();
                            }

                            $listPagesArgs = array(
                                'title_li' => NULL,
                                'child_of' => $childOfID,
                                'sort_column' => 'menu_order'
                            );

                            wp_list_pages($listPagesArgs);
                        ?>
                    </ul>
                </div>
            <?php }
            ?>

            <div class="generic-content">
                <?php the_content(); ?>
            </div>

        </div>

    <?php }

    get_footer();
?>