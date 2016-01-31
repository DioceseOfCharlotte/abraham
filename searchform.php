
<form role="search" method="get" class="search-form u-m0 u-p2-md u-text-right" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-label u-m0 u-p0 u-1of1-sm">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'abraham' ); ?></span>
		<input type="search" class="search-field u-m0 u-1of1" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'abraham' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit screen-reader-text" value="<?php echo _x( 'Search', 'submit button', 'abraham' ); ?>" />
</form>
