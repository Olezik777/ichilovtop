<?php
/**
 * Main fallback template.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<div class="content-area">
	<div class="container content-layout">
		<div class="single-content">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h1>
							<p class="post-meta"><?php echo esc_html(get_the_date()); ?></p>
						</header>

						<?php if (has_post_thumbnail()) : ?>
							<div class="single-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('large'); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					</article>
				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>
			<?php else : ?>
				<article class="archive-empty">
					<h1 class="entry-title"><?php esc_html_e('Материалы не найдены', 'ichilovtop'); ?></h1>
					<p><?php esc_html_e('Пока здесь нет записей или страниц для отображения.', 'ichilovtop'); ?></p>
				</article>
			<?php endif; ?>
		</div>

		<aside class="sidebar-box">
			<span class="eyebrow"><?php esc_html_e('Навигация', 'ichilovtop'); ?></span>
			<h3><?php esc_html_e('Разделы сайта', 'ichilovtop'); ?></h3>
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
		</aside>
	</div>
</div>

<?php
get_footer();
