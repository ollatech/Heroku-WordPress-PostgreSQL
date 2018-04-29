<?php get_header(); ?>

		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'templates/page/content', 'front-page' );
			endwhile;
		else : 
			get_template_part( 'templates/post/content', 'none' );
		endif; 
		?>

<?php get_footer(); ?>