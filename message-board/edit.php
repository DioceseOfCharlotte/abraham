<?php get_header(); // Loads the header.php template. ?>

<main id="content" class="content grid__item">

	<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

	<div class="loop-meta">
			<h1 class="topic-title text-center loop-title"><?php mb_single_topic_title(); ?></h1>
	</div>

	<?php locate_template( array( 'misc/loop-meta.php' ), true ); // Loads the misc/loop-meta.php template. ?>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

	<?php else : // If no posts were found. ?>

		<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

	<?php endif; // End check for posts. ?>

	<?php if ( function_exists( 'mb_edit_form' ) ) mb_edit_form(); ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>