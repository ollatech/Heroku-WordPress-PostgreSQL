<?php get_header(); ?>
<section class="ux-section ">
	<div class="container">
		<header class="page-header">
			<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'stencil' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			<?php else : ?>
				<h1 class="page-title"><?php _e( 'Nothing Found', 'stencil' ); ?></h1>
			<?php endif; ?>
		</header>
		<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'templates/post/content', 'excerpt' );
				endwhile; 
				else : ?>
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'stencil' ); ?></p>
				<?php get_search_form();
			endif;
			?>
			?>
		</main>
	</div>
</section>
<?php get_footer();
