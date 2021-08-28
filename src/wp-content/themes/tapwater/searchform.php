<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text v-hidden"><?php echo _x( 'Search City:', 'label' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search city...', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search City:', 'label' ) ?>" />
    </label>
    
        <button type="submit" class="search-submit"><span class="dashicons dashicons-search"></span></button>
</form>