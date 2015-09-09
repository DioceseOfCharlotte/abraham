<form role="search" method="get" class="mx-auto search-form inline-block" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="container mb0">
        <span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'abraham' ); ?></span>
        <i class="white search-icon left-0 material-icons absolute">&#xE8B6;</i>
        <input type="search" class="search-field m0" data-swplive="true" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'abraham' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    </label>
    <button type="submit" class="search-submit none" value="<?php echo esc_attr_x( 'Search', 'submit button', 'abraham' ); ?>">
    </button>
</form>
