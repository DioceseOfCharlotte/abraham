<?php get_header(); // Loads the header.php template. ?>

<main id="content" class="content layout__item">

	<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

	<?php locate_template( array( 'misc/loop-meta.php' ), true ); // Loads the misc/loop-meta.php template. ?>

	<a href="<?php mb_user_topics_url( get_query_var( 'author' ) ); ?>">View Topics</a>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>