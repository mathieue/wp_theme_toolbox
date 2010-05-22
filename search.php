<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
?>

<?php get_header(); ?>

		<div id="container">
			<div id="content">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

	<?php get_template_part( 'loop', 'search' ); ?>

<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'theme' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'theme' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div>
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
