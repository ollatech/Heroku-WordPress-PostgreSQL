<?php get_header(); ?>
<section class="ux-section ">
	<div class="container">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'templates/post/content', get_post_format() );
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; 
		else :
			get_template_part( 'templates/post/content', 'none' );
		endif;
		?>
	</div>
</section>
<?php get_footer();
