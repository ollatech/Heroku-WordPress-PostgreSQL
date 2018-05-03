<?php
/**
 * Displays the header content
 *
 * @package Theme Freesia
 * @subpackage Magbook
 * @since Magbook 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$magbook_settings = magbook_get_theme_options(); ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif;
wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<!-- Masthead ============================================= -->
	<header id="masthead" class="site-header">
		<div class="header-wrap">
			<?php the_custom_header_markup(); ?>
			<!-- Top Header============================================= -->
			<div class="top-header">

				<?php 
				if( $magbook_settings['magbook_logo_sitetitle_display'] == 'above_topbar') {
					do_action('magbook_site_branding');
				}

				if(is_active_sidebar( 'magbook_header_info' ) || has_nav_menu( 'top-menu' ) || $magbook_settings['magbook_current_date'] ==0): ?>
					<div class="top-bar">
						<div class="wrap">
							<?php
							if( $magbook_settings['magbook_current_date'] ==0) { ?>
								<div class="top-bar-date">
									<span><?php echo date_i18n(__('l, F d, Y','magbook')); ?></span>
								</div>
							<?php }

						 	if( is_active_sidebar( 'magbook_header_info' )){
								dynamic_sidebar( 'magbook_header_info' );
							}

							if(has_nav_menu ('top-menu')){ ?>
							<div class="top-bar-menu">
								<div class="top-menu-toggle">			
									<i class="fa fa-bars"></i>
							  	</div>
								<?php
									wp_nav_menu( array(
										'container' 	=> '',
										'theme_location' => 'top-menu',
										'depth'          => 3,
										'items_wrap'      => '<ul class="top-menu">%3$s</ul>',
									) );
								?>
							</div> <!-- end .top-bar-menu -->
							<?php }

							if($magbook_settings['magbook_top_social_icons'] == 0):
								echo '<div class="header-social-block">';
									do_action('magbook_social_links');
								echo '</div>'.'<!-- end .header-social-block -->';
							endif;  ?>

						</div> <!-- end .wrap -->
					</div> <!-- end .top-bar -->
				<?php endif; ?>

				<!-- Main Header============================================= -->
				<?php

				if( $magbook_settings['magbook_logo_sitetitle_display'] == 'above_menubar') {
					do_action('magbook_site_branding');
				} ?>

				<div id="sticky-header" class="clearfix">
					<div class="wrap">
						<div class="main-header clearfix">

							<!-- Main Nav ============================================= -->
							<?php do_action ('magbook_new_site_branding');
							if($magbook_settings['magbook_disable_main_menu']==0){ ?>
								<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
								<?php if (has_nav_menu('primary')) {
									$args = array(
									'theme_location' => 'primary',
									'container'      => '',
									'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>',
									); ?>
								
									<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
										<span class="line-bar"></span>
									</button><!-- end .menu-toggle -->
									<?php wp_nav_menu($args);//extract the content from apperance-> nav menu
									} else {// extract the content from page menu only ?>
									<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
										<span class="line-bar"></span>
									</button><!-- end .menu-toggle -->
									<?php	wp_page_menu(array('menu_class' => 'menu', 'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>'));
									} ?>
								</nav> <!-- end #site-navigation -->
							<?php }

							$search_form = $magbook_settings['magbook_search_custom_header'];
							if (1 != $search_form) { ?>
								<div id="search-toggle" class="header-search"></div>
								<div id="search-box" class="clearfix">
									<?php get_search_form();?>
								</div>  <!-- end #search-box -->
							<?php }

							$magbook_side_menu = $magbook_settings['magbook_side_menu'];
							if(1 != $magbook_side_menu){ 
								if (has_nav_menu('side-nav-menu') || (has_nav_menu( 'social-link' ) && $magbook_settings['magbook_side_menu_social_icons'] == 0 ) || is_active_sidebar( 'magbook_side_menu' )):?>
									<div class="show-menu-toggle">			
										<span class="sn-text"><?php _e('Menu Button','magbook'); ?></span>
										<span class="bars"></span>
								  	</div>
						  	<?php endif;
						  	} ?>

						</div><!-- end .main-header -->
					</div> <!-- end .wrap -->
				</div><!-- end #sticky-header -->

				<?php
				if( $magbook_settings['magbook_logo_sitetitle_display'] == 'below_menubar') {
					do_action('magbook_site_branding');
				} ?>
			</div><!-- end .top-header -->
			<?php if(1 != $magbook_side_menu){
				if (has_nav_menu('side-nav-menu') || (has_nav_menu( 'social-link' ) && $magbook_settings['magbook_side_menu_social_icons'] == 0 ) || is_active_sidebar( 'magbook_side_menu' ) || has_nav_menu('side-nav-menu')): ?>
					<div class="side-menu-wrap">
						<div class="side-menu">
					  		<div class="hide-menu-toggle">			
								<span class="bars"></span>
						  	</div>

							<?php do_action ('magbook_new_site_branding');

							if (has_nav_menu('side-nav-menu')) { 
								$args = array(
									'theme_location' => 'side-nav-menu',
									'container'      => '',
									'items_wrap'     => '<ul class="side-menu-list">%3$s</ul>',
									); ?>
							<nav class="side-nav-wrap">
								<?php wp_nav_menu($args); ?>
							</nav><!-- end .side-nav-wrap -->
							<?php }
							if($magbook_settings['magbook_side_menu_social_icons'] == 0):
								do_action('magbook_social_links');
							endif;

							if( is_active_sidebar( 'magbook_side_menu' )) {
								echo '<div class="side-widget-tray">';
									dynamic_sidebar( 'magbook_side_menu' );
								echo '</div> <!-- end .side-widget-tray -->';
							} ?>
						</div><!-- end .side-menu -->
					</div><!-- end .side-menu-wrap -->
				<?php endif;
			} ?>
		</div><!-- end .header-wrap -->

		<!-- Breaking News ============================================= -->
		<?php if(is_front_page()){
			do_action ('magbook_breaking_news');
		} ?>

		<!-- Main Slider ============================================= -->
		<?php
			$magbook_enable_slider = $magbook_settings['magbook_enable_slider'];
			if ($magbook_enable_slider=='frontpage'|| $magbook_enable_slider=='enitresite'){
				 if(is_front_page() && ($magbook_enable_slider=='frontpage') ) {

				 	if(is_active_sidebar( 'slider_section' )){

				 		dynamic_sidebar( 'slider_section' );

				 	} else {

				 		if($magbook_settings['magbook_slider_type'] == 'default_slider') {
							magbook_category_sliders();

						} else {

							if(class_exists('Magbook_Plus_Features')):
								do_action('magbook_image_sliders');
							endif;
						}

				 	}
					
				}
				if($magbook_enable_slider=='enitresite'){

					if(is_active_sidebar( 'slider_section' )){

				 		dynamic_sidebar( 'slider_section' );

				 	} else {

				 		if($magbook_settings['magbook_slider_type'] == 'default_slider') {

								magbook_category_sliders();

						} else {

							if(class_exists('Magbook_Plus_Features')):

								do_action('magbook_image_sliders');

							endif;
						}
				 	}

					
				}
			} ?>
	</header> <!-- end #masthead -->

	<!-- Main Page Start ============================================= -->
	<div class="site-content-contain">
		<div id="content" class="site-content">
		<?php
		if(is_front_page()){

			do_action('magbook_display_front_page_feature_news');

		}  ?>
		