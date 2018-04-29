<?php get_header(); ?>
<section class="ux-section ">
	<div class="container">
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'templates/page/content', 'page' );
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile; 
		?>
	</div>
</section>
<?php get_footer();
