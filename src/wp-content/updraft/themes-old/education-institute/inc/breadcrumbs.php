<?php 
//breadcrump function

if( !function_exists('educationhub_breadcrumbs') ):
    function educationhub_breadcrumbs() { ?>
        <div class="breadcrumbs-area">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php echo esc_html__( 'Home', 'education-institute' ); ?></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php the_title(''); ?>
                    </li>
                </ul>
            </div>
        </div> 
    <?php }
endif
?>