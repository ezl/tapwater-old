<?php   

/* For Single page Results
*/

?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="row">
            <div class="col-lg-12">
                <div class="news-box blog-big">
                    <?php if(has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                    <?php endif; ?>
                    <?php if(has_post_thumbnail()) { ?>
                    <ul class="blog-meta-tag">
                    <?php } else { ?>
                    <ul class="blog-meta-tags">
                    <?php } ?>
                        <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><span class="fa fa-user" aria-hidden="true"></span> <?php echo esc_html__( 'By', 'education-institute' ); ?> <?php the_author(); ?></a></li>
                        <li><span class="fa fa-calendar" aria-hidden="true"></span> <?php echo esc_html(get_the_date()); ?></li>
                        <li><span class="fa fa-comment-o" aria-hidden="true"></span> <?php comments_number( esc_html__('0 Comment', 'education-institute'), esc_html__('1 Comment', 'education-institute'), esc_html__('% Comments', 'education-institute') ); ?></li>
                    </ul>
                </div>
                <div class="blog-big-details">
                    <h3 class="title-line"><?php the_title(); ?></h3>
                    <?php the_content(); ?>
                        <?php
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__('Pages: ', 'education-institute' ),
                                'after'  => '</div>',
                            ) );
                        ?>
                    <?php if (has_tag()) : ?>
                        <ul class="blog-meta-diss">
                            <li> <i class="fa fa-tags" aria-hidden="true"></i> <span><?php echo esc_html__( 'Tags :', 'education-institute' ); ?></span>
                                <div class="tags-group">
                                    <?php $seperator = ''; // blank instead of comma ?>
                                            <?php echo esc_html__(' ', 'education-institute' ); ?><?php the_tags( $seperator,'&nbsp;'); ?>
                                </div>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="pagination-two">
                    <ul>
                        <?php $prev_post = get_previous_post();
                            if (!empty( $prev_post )): ?>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>" class="fa fa-long-arrow-left" aria-hidden="true"></a>
                                    <span><?php echo esc_html__( 'Prev Post', 'education-institute' ); ?></span>
                                </li>
                            <?php endif; ?>    
                            <?php $next_post = get_next_post();
                                if (!empty( $next_post )):  ?>  
                                    <li class="float-right">    
                                        <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>" class="fa fa-long-arrow-right" aria-hidden="true"></a>
                                        <span><?php echo esc_html__( 'Next Post', 'education-institute' ); ?></span>
                                    </li>
                            <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php 
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif; 
            ?> 
        </div>
    </div> 