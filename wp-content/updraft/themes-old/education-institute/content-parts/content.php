<?php
/**
 * @package education-institute
 */
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="news-box">
                <?php if(has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail(); ?>
                <?php endif; ?>
                <h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="btn-line p-t-10"><?php echo esc_html__( 'Read More', 'education-institute' ); ?><i class="fa fa-caret-right" aria-hidden="true"></i>
                </a>
                <ul class="blog-meta-tag">
                    <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><span class="fa fa-user" aria-hidden="true"></span> <?php echo esc_html__( 'By', 'education-institute' ); ?> <?php the_author(); ?></a></li>
                    <li><span class="fa fa-calendar" aria-hidden="true"></span> <?php echo esc_html(get_the_date()); ?></li>
                    <li><span class="fa fa-comment-o" aria-hidden="true"></span> <?php comments_number( esc_html__('0 Comment', 'education-institute'), esc_html__('1 Comment', 'education-institute'), esc_html__('% Comments', 'education-institute') ); ?></li>
                </ul>
            </div>
        </div>
    </div>