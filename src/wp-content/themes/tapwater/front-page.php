<?php get_header(); ?>

<section class="front-page-search-section container">

    <h3 class="front-page-search__title">Explore the water quality <span>anywhere in the world</span></h3>

    <div class="front-page-search">

        <?php get_search_form(); ?>
    
    </div>

</section>

<section class="front-page-hero">

    <div class="container">

        <div class="front-page-hero__data">

            <h1 class="front-page-hero__title">Can you drink tap water in...?</h1>
            <pc class="front-page-hero__text">“Can you drink water in...” provides the most up to date and straight forward answers to your questions about the safety of drinking tap water in the most popular travel destinations.</p>
            <p class="front-page-hero__text">In addition to reports about water safety, we also provide reports for the water source for most cities, treatment methods, and specific tests that have been passed or failed.</p>

            <button class="front-page-hero__btn"><a href="<?php the_permalink(2391); ?>">Read More</a></button>

        </div>

    </div>

</section>

<section>

    <h2 class="section-title section-title--bright fp-world-map-title">Interactive World Map</h2>

    <p class="world-map-subtitle">Hover over area to reveal water quality</p>

    <div id="map-container"></div>

</section>

<section>

    <h2 class="section-title section-title-bright">Water Quality Ranking</h2>

    <div class="fp-ratings container">

        <div class="rating-quicklinks">
            <ul>
                <li>
                    <h3><a href="<?php the_permalink(24496); ?>">Most polluted cities</a></h3>
                    <p><a href="<?php the_permalink(24496); ?>">See ranking of 2019’s most polluted cities.</a></p>
                </li>
                <li>
                    <h3><a href="<?php the_permalink(24498); ?>">Most polluted countries</a></h3>
                    <p><a href="<?php the_permalink(24498); ?>">See ranking of 2019’s most polluted countries.</a></p>
                </li>
            </ul>
        </div>

        <div class="fp-city-rankings">

            <h3>City Ranking</h3>

            <p class="fp-city-rankings-best">Cities with the best water in the world</p>

            <?php
    $query = new WP_Query(array(
        'posts_per_page' => 6,
        'post_type' => 'post',
        'meta_key'			=> 'water_quality',
	    'orderby'			=> 'meta_value_num',
	    'order'				=> 'DESC'
    ));

    if($query->have_posts()){

        echo '<ul>';

        while($query->have_posts()){

            $query->the_post(); 

            $categories = wp_get_object_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );
            sort($categories);

            echo '<li><a href="' . get_the_permalink() . '">';

            //display either the country flag or the country thumbnail nest to the country and city name
            if(has_post_thumbnail()){

                the_post_thumbnail();

            }elseif(count($categories) < 3){

                echo '<img src="'.get_field('flag', 'category_'.end($categories)).'">';
                
            // if usa state display usa flag
            }elseif(count($categories) === 3){

                echo '<img src="'.get_field('flag', 'category_'.$categories[1]).'">';

            }
                     

            echo '<h4>' . get_field('city_name') . '</h4>, ';
            
            
            

            echo get_cat_name(end($categories));

            echo '</a></li>';

        }

        echo '</ul>';

        }

        wp_reset_postdata();
    
            ?>

            <a href="<?php the_permalink(24501); ?>" class="fp-city-rankings__more">View More &gt;</a>

        </div>

        <div class="fp-city-rankings">

            <h3>City Ranking</h3>

            <p class="fp-city-rankings-worst">Cities with the most polluted water in the world</p>

            <?php
    $query = new WP_Query(array(
        'posts_per_page' => 6,
        'post_type' => 'post',
        'meta_key'			=> 'water_quality',
        'meta_value'  => 0,
        'meta_compare' => '>',
        'orderby'			=> 'meta_value_num',
	    'order'				=> 'ASC'
    ));

    if($query->have_posts()){

        echo '<ul>';

        while($query->have_posts()){

            $query->the_post(); 

            $categories = wp_get_object_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );
            sort($categories);
            
            echo '<li><a href="' . get_the_permalink() . '">';

            if(has_post_thumbnail()){

                the_post_thumbnail();

            }elseif(count($categories) < 3){

                echo '<img src="'.get_field('flag', 'category_'.end($categories)).'">';
                
            // if usa state display usa flag
            }elseif(count($categories) === 3){

                echo '<img src="'.get_field('flag', 'category_'.$categories[1]).'">';

            }            

            echo '<h4>' . get_field('city_name') . '</h4>, ';
            
            

            echo get_cat_name(end($categories));

            echo '</a></li>';

        }

        echo '</ul>';

        }

        wp_reset_postdata();
    
            ?>

            <a href="<?php the_permalink(24496); ?>" class="fp-city-rankings__more">View More &gt;</a>

        </div>

    </div>

</section>

<section>

    <h2 class="section-title section-title--dark">Explore By Region</h2>

    <div class="fp-region-cards container">
    
        <div class="fp-region-cards__item">
            
            <h3><a href="<?php the_permalink(1765); ?>">Africa</a></h3>

            <?php

            if(get_the_post_thumbnail_url(1765)){
                echo '<a href="'.get_the_permalink(1765).'">';
                echo '<img src="'. get_the_post_thumbnail_url(1765) . '" alt="Region picture">';
                echo '</a>';
            }

            ?>

          
        </div> 

        <div class="fp-region-cards__item">
           <h3><a href="<?php the_permalink(1778); ?>">Asia</a></h3>

            <?php

            if(get_the_post_thumbnail_url(1778)){
                echo '<a href="'.get_the_permalink(1778).'">';
                echo '<img src="'. get_the_post_thumbnail_url(1778) . '" alt="Region picture">';
                echo '</a>';
            }

            ?>

            
        </div>

        <div class="fp-region-cards__item">
            <h3><a href="<?php the_permalink(1780); ?>">Europe</a></h3>

            <?php

            if(get_the_post_thumbnail_url(1780)){
                echo '<a href="'.get_the_permalink(1780).'">';
                echo '<img src="'. get_the_post_thumbnail_url(1780) . '" alt="Region picture">';
                echo '</a>';
            }

            ?>

            
        </div>

        <div class="fp-region-cards__item">
            <h3><a href="<?php the_permalink(1866); ?>">North America</a></h3>

            <?php

            if(get_the_post_thumbnail_url(1866)){
                echo '<a href="'.get_the_permalink(1866).'">';
                echo '<img src="'. get_the_post_thumbnail_url(1866) . '" alt="Region picture">';
                echo '</a>';
            }

            ?>

            
        </div>

        <div class="fp-region-cards__item">
            <h3><a href="<?php the_permalink(1874); ?>">Oceania</a></h3>

            <?php

            if(get_the_post_thumbnail_url(1874)){
                echo '<a href="'.get_the_permalink(1874).'">';
                echo '<img src="'. get_the_post_thumbnail_url(1874) . '" alt="Region picture">';
                echo '</a>';
            }

            ?>

            
        </div>

        <div class="fp-region-cards__item">
            <h3><a href="<?php the_permalink(1869); ?>">South America</a></h3>

            <?php

            if(get_the_post_thumbnail_url(1869)){
                echo '<a href="'.get_the_permalink(1869).'">';
                echo '<img src="'. get_the_post_thumbnail_url(1869) . '" alt="Region picture">';
                echo '</a>';
            }

            ?>

            
        </div>

    </div>

</section>

<?php get_footer(); ?>