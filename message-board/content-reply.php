

	<li id="post-<?php echo esc_attr( mb_get_topic_id( get_the_ID() ) ); ?>" class="topic topic-post">
		<article>
		<div class="forum-comment layout">
			<div class="comment-author layout__item md-3-24">
				<?php echo get_avatar( mb_get_topic_author_id() ); ?>
				<span <?php hybrid_attr( 'entry-author' ); ?>>
					<?php mb_topic_author_profile_link(); ?>
					<?php if ( get_the_author_meta('url') ) : ?>
						<span class="profile-link">(<a href="<?php echo esc_url( get_the_author_meta( 'url' ), mb_get_topic_author_id() ); ?>">Web Site</a>)</span>
					<?php endif; ?>
				</span>
				</div>
			<div class="comment-content layout__item md-21-24">
				<?php mb_topic_content(); ?>
				<?php wp_link_pages(); ?>
			</div><!-- .entry-content -->


<div class="comment-footer all-1 centered">
							<time <?php hybrid_attr( 'entry-published' ); ?>><?php printf( __( '%s ago', 'th4' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
				<a class="comment-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><i class="fa fa-link"></i></a>
				<?php edit_post_link(); ?>
</div>
</div>
		</article>
	</li>
