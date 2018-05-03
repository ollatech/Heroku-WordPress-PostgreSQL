<?php
get_header(); ?>


<section class="ux-section error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'stencil' ); ?></h1>
	</header><!-- .page-header -->
	<div class="page-content">
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'stencil' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</section><!-- .error-404 -->

<?php get_footer();
