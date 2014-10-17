<?php if ( !mb_is_topic_paged() ) : ?>

	<article id="post-<?php echo esc_attr( mb_get_topic_id( get_the_ID() ) ); ?>" class="forum-comment layout">
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


<div class="comment-footer text-minor all-1 text-center">
							<time <?php hybrid_attr( 'entry-published' ); ?>><?php printf( __( '%s ago', 'th4' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
				<?php edit_post_link(); ?>
				<a class="comment-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><span class="hint--top" data-hint="Get a link to this comment"><i class="fa fa-link"></i></span></a>
</div>
		</article>

<?php endif; ?>
