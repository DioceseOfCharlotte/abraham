<form role="search" method="get" class="search-form inline-block" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'abraham' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'abraham' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    </label>
    <button type="submit" class="search-submit none" value="<?php echo esc_attr_x( 'Search', 'submit button', 'abraham' ); ?>">
    </button>
</form>
