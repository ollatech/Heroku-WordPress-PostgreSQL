<footer class="text-muted">
	<div class="container">

		<p class="float-right">
			<a href="#">© 2016 Global Group</a>
		</p>

   <?php
   wp_nav_menu([
     'theme_location'  => 'footer_menu',
     'container'       => 'div',
     'container_id'    => 'bs4navbar',
     'container_class' => '',
     'menu_id'         => false,
     'menu_class'      => 'navbar-nav mr-auto',
     'depth'           => 1,
     'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
     'walker'          => new WP_Bootstrap_Navwalker()
   ]);
   ?>

	</div>
</footer>