<?php get_header(); ?>
<?php
$parent_id = $post->ID;
if( $post->post_parent > 0 ) { 
	$parent_id = $post->post_parent;
} 
?>
<section id="title-belt" class="ux-title">
	<nav class="navbar navbar-expand-lg">
		<div class="container">


			<div class="collapse navbar-collapse" id="navbarsExample07">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo get_the_title($parent_id); ?></a>
						<div class="dropdown-menu" aria-labelledby="dropdown07">
							<?php

							$parent = new WP_Query(array(
								'post_type'			=> 'page',
								'post_parent'       => $parent_id,                               
								'order'             => 'ASC',
								'orderby'           => 'menu_order',
								'posts_per_page'    => 20
							));

							if ($parent->have_posts()) : ?>

							<?php while ($parent->have_posts()) : $parent->the_post(); ?>

								<a class="dropdown-item" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>


							<?php endwhile; ?>

							<?php 
							unset($parent); 
						endif;
						wp_reset_postdata(); ?>
					</div>
				</li>
			</ul>
			
		</div>
	</div>
</nav>



</section>
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
