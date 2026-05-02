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
	<header class="site-header">
		<div class="container site-header__inner">
			<div class="site-branding">
				<div class="site-branding__mark">IT</div>
				<div>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
					<p class="site-description"><?php bloginfo('description'); ?></p>
				</div>
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
	</header>

	<main id="content" class="site-main">
