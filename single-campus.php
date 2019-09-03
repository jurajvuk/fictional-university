<?php get_header(); ?>
        
        <?php while(have_posts()) : the_post(); ?>
        <?php  pageBanner(); ?>
        <div class="container container--narrow page-section">   
            <div class="post-item">
                <div class="metabox metabox--position-up metabox--with-home-link">
                    <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a> <span class="metabox__main"><?php the_title(); ?></span></p>
                </div>
                <div class="generic-content">
                    <?php the_content(); ?>
                    <div class="acf-map">
                        <?php $mapLocation = get_field('map_location'); ?>
                            <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php echo $mapLocation['address']; ?></div>
                    </div>
                </div>
                <?php 

                    $relatedProgram = new WP_Query(array(
                        'posts_per_page' => -1,
                        'post_type' => 'program',
                        'orderby' =>~ 'ASC',
                        'meta_query' => array(
                        array(
                                'key' => 'related_campus',
                                'compare' => 'LIKE',
                                'value' => '"' . get_the_ID() . '"'
                        )
                        )
                    ));
                    if ($relatedProgram->have_posts()) {
                        echo '<hr class="section-break">';
                        echo '<h2 class="headline headline--medium">Programs Avaiable At This Campus</h2>';
                        echo '<ul class="min-list link-list">';
                        while ($relatedProgram->have_posts()) {
                            $relatedProgram->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        
                        <?php }
                        echo '</ul>';
                    }
                    
                    wp_reset_postdata();

                    
                    ?>
                        </div>
                    <?php endwhile; ?>
                    </div>
<?php get_footer(); ?>