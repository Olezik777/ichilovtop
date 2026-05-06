<?php
/**
 * Header template.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

$phone_display = ichilovtop_get_field('contact_phone', '+972-3-376-0391', get_queried_object_id());
$phone_link    = preg_replace('/[^0-9+]/', '', $phone_display);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header class="site-header" data-site-header>
		<div class="container site-header__inner">
			<div class="site-branding">
				<div class="site-branding__mark">IT</div>
				<div>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
					<p class="site-description"><?php bloginfo('description'); ?></p>
				</div>
			</div>

			<button
				class="mobile-menu-toggle"
				type="button"
				aria-controls="site-mobile-menu"
				aria-expanded="false"
				aria-label="<?php esc_attr_e('Открыть меню', 'ichilovtop'); ?>"
				data-mobile-menu-toggle
			>
				<span class="mobile-menu-toggle__line" aria-hidden="true"></span>
				<span class="mobile-menu-toggle__line" aria-hidden="true"></span>
				<span class="mobile-menu-toggle__line" aria-hidden="true"></span>
			</button>

			<div class="site-header__drawer" id="site-mobile-menu" data-mobile-menu>
				<div class="site-header__drawer-head">
					<span class="site-header__drawer-title"><?php esc_html_e('Меню', 'ichilovtop'); ?></span>
					<button
						class="mobile-menu-close"
						type="button"
						aria-label="<?php esc_attr_e('Закрыть меню', 'ichilovtop'); ?>"
						data-mobile-menu-close
					>
						<span aria-hidden="true"></span>
					</button>
				</div>

				<nav class="main-navigation" aria-label="<?php esc_attr_e('Primary menu', 'ichilovtop'); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'fallback_cb'    => 'wp_page_menu',
							'menu_class'     => 'menu',
						)
					);
					?>
				</nav>

				<div class="header-actions">
					<div class="header-contact">
						<span><?php esc_html_e('Международный отдел', 'ichilovtop'); ?></span>
						<strong><a href="<?php echo esc_url('tel:' . $phone_link); ?>"><?php echo esc_html($phone_display); ?></a></strong>
					</div>
					<a class="button" href="#contact"><?php esc_html_e('Оставить заявку', 'ichilovtop'); ?></a>
				</div>
			</div>
			<div class="site-header__overlay" data-mobile-menu-overlay></div>
		</div>
	</header>

	<main id="content" class="site-main">
