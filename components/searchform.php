<form role="search" method="get" class="mx-auto search-form inline-block" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="container mb0">
        <span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'abraham' ); ?></span>
        <input type="search" class="search-field m0" data-swplive="true" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'abraham' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    </label>
    <button type="submit" class="search-submit visuallyhidden" value="<?php echo esc_attr_x( 'Search', 'submit button', 'abraham' ); ?>">
    </button>
</form>
